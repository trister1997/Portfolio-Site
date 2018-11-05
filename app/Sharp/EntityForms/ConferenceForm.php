<?php

namespace App\Sharp\EntityForms;

use App\Conference;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class ConferenceForm extends SharpForm {
    use WithSharpFormEloquentUpdater;

    function buildFormFields()
    {
        $this->addField(SharpFormTextField::make("name")->setLabel("Conference Name"))
            ->addField(SharpFormTextField::make("location")->setLabel("Conference Location"))
            ->addField(SharpFormTextField::make("link")->setLabel("Like to Conference Site"));
    }

    function buildFormLayout()
    {
        $this->addColumn(12, function(FormLayoutColumn $column) {
            $column->withFields("name", "location", "link");
        });
    }

    function create(): array
    {
        return $this->transform(new Conference());
    }

    function find($id): array
    {
        return Conference::findOrFail($id)->toArray();
    }

    function update($id, array $data)
    {
        $instance = $id ? Conference::findOrFail($id) : new Conference;
        $this->save($instance, $data);
        $this->notify("Success")->setDetail("Conference has been updated!")->setLevelSuccess()->setAutoHide(true);
        return $instance->id;
    }

    function delete($id)
    {
        Conference::findOrFail($id)->delete();
        $this->notify("Deleted")->setDetail("Conference has been deleted!")->setAutoHide(true)->setLevelSuccess();
    }
}