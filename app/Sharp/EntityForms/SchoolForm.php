<?php

namespace App\Sharp\EntityForms;

use App\School;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class SchoolForm extends SharpForm {
    use WithSharpFormEloquentUpdater;

    function buildFormFields()
    {
        $this->addField(SharpFormTextField::make("major")->setLabel("Major"))
            ->addField(SharpFormTextField::make("name")->setLabel("School Name"))
            ->addField(SharpFormTextField::make("start_year")->setLabel("Start Year"))
            ->addField(SharpFormTextField::make("end_year")->setLabel("End Year"));
    }

    function buildFormLayout()
    {
        $this->addColumn(12, function(FormLayoutColumn $column) {
            $column->withFields("major", "name", "start_year", "end_year");
        });
    }

    function create(): array
    {
        return $this->transform(new School());
    }

    function find($id): array
    {
        return School::findOrFail($id)->toArray();
    }

    function update($id, array $data)
    {
        $instance = $id ? School::findOrFail($id) : new School;
        $this->save($instance, $data);
        $this->notify("Success")->setDetail("School has been updated!")->setLevelSuccess()->setAutoHide(true);
        return $instance->id;
    }

    function delete($id)
    {
        School::findOrFail($id)->delete();
        $this->notify("Deleted")->setDetail("School has been deleted!")->setAutoHide(true)->setLevelSuccess();
    }
}