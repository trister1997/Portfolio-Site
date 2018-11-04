<?php

namespace App\Sharp\EntityForms;

use App\Project;
use Code16\Sharp\Form\Eloquent\Transformers\FormUploadModelTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Fields\SharpFormWysiwygField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class ProjectForm extends SharpForm {
    use WithSharpFormEloquentUpdater;

    function buildFormFields()
    {
        $this->addField(SharpFormTextField::make("title")->setLabel("Project Name"))
            ->addField(SharpFormWysiwygField::make("description")->setLabel("Project Description"))
            ->addField(SharpFormTextField::make("link")->setLabel("Project Link"))
            ->addField(SharpFormUploadField::make("project_image")->setLabel("Project Image")->setStorageDisk('media')->setFileFilterImages());
    }

    function buildFormLayout()
    {
        $this->addColumn(12, function(FormLayoutColumn $column) {
            $column->withFields("title", "description", "link", "project_image");
        });
    }

    function create(): array
    {
        return $this->transform(new Project());
    }

    function find($id): array
    {
        return $this->setCustomTransformer("project_image", new FormUploadModelTransformer())
            ->transform(
                Project::with("project_image")->findOrFail($id)
            );
    }

    function update($id, array $data)
    {
        $instance = $id ? Project::findOrFail($id) : new Project;
        $this->save($instance, $data);
        $this->notify("Success")->setDetail("Project has been updated!")->setLevelSuccess()->setAutoHide(true);
        return $instance->id;
    }

    function delete($id)
    {
        Project::findOrFail($id)->delete();
        $this->notify("Deleted")->setDetail("Project has been deleted!")->setAutoHide(true)->setLevelSuccess();
    }
}