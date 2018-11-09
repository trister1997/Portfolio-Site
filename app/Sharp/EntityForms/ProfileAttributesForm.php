<?php

namespace App\Sharp\EntityForms;

use App\ProfileAttribute;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Fields\SharpFormWysiwygField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class ProfileAttributesForm extends SharpForm {

    function buildFormFields()
    {
        $this->redirect = false;
        $this->deletable = false;
        $this->addField(SharpFormUploadField::make("profile_image")->setLabel("Profile Image")->setStorageDisk('media')->setFileFilterImages())
            ->addField(SharpFormTextField::make("name")->setLabel("Name"))
            ->addField(SharpFormTextField::make("job_title")->setLabel("Job Title"))
            ->addField(SharpFormTextField::make("email")->setLabel("Email"))
            ->addField(SharpFormWysiwygField::make("about_me")->setLabel("About Me"))
            ->addField(SharpFormTextField::make("twitter")->setLabel("Twitter"))
            ->addField(SharpFormTextField::make("linkedin")->setLabel("LinkedIn"))
            ->addField(SharpFormTextField::make("stack_overflow")->setLabel("Stack Overflow"))
            ->addField(SharpFormTextField::make("github")->setLabel("Github"));
    }

    function buildFormLayout()
    {
        $this->addColumn(12, function(FormLayoutColumn $column) {
            $column->withFields("profile_image", "name", "job_title", "email", "about_me", "twitter", "linkedin", "stack_overflow", "github");
        });
    }

    function find($id): array
    {
        $attributes = [];
        $profileAttributes = ProfileAttribute::all();
        foreach ($profileAttributes as $profileAttribute) {
            if ($profileAttribute->name == 'about_me') {
                $attributes[$profileAttribute->name] = ['text' => $profileAttribute->value];
            } else {
                $attributes[$profileAttribute->name] = ($profileAttribute->name == 'profile_image') ? json_decode($profileAttribute->value) : $profileAttribute->value;
            }
        }
        if (!array_key_exists('about_me', $attributes)) {
            $attributes['about_me'] = ['text' => ''];
        }
        return $attributes;
    }

    function update($id, array $data)
    {
        foreach ($data as $key => $value) {
            if ($key == 'profile_image') {
                if ($value) {
                    $attribute = ProfileAttribute::firstOrNew([
                        'name' => $key
                    ]);
                    $name = $value['file_name'];
                    $thumbnail = env('MEDIA_URL') . '/' . $name;
                    $attribute->value = json_encode(['name' => $name, 'thumbnail' => $thumbnail]);
                    $attribute->save();
                } else {
                    $attribute = ProfileAttribute::where('name', $key)->first();
                    if ($attribute)
                        $attribute->delete();
                }
            } else {
                $attribute = ProfileAttribute::firstOrNew([
                    'name' => $key
                ]);
                $attribute->value = $value;
                $attribute->save();
            }
        }
        $this->notify('Success')->setDetail('Profile has been updated!')->setLevelSuccess()->setAutoHide(true);
    }

    function delete($id)
    {
    }
}