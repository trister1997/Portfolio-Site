<?php

namespace App\Sharp\EntityForms;

use App\Experience;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class ExperienceForm extends SharpForm {
    use WithSharpFormEloquentUpdater;

    function buildFormFields()
    {
        $this->addField(SharpFormTextField::make("company")->setLabel("Company Name"))
            ->addField(SharpFormTextField::make("title")->setLabel("Job Title"))
            ->addField(SharpFormTextField::make("start_year")->setLabel("Start Year"))
            ->addField(SharpFormTextField::make("end_year")->setLabel("End Year"))
            ->addField(SharpFormTextareaField::make('description')->setLabel("Job Description"));
    }

    function buildFormLayout()
    {
        $this->addColumn(12, function(FormLayoutColumn $column) {
            $column->withFields("company", "title", "start_year", "end_year", "description");
        });
    }

    function create(): array
    {
        return $this->transform(new Experience());
    }

    function find($id): array
    {
        return Experience::findOrFail($id)->toArray();
    }

    function update($id, array $data)
    {
        $instance = $id ? Experience::findOrFail($id) : new Experience;
        $this->save($instance, $data);
        $this->notify("Success")->setDetail("Experience has been updated!")->setLevelSuccess()->setAutoHide(true);
        return $instance->id;
    }

    function delete($id)
    {
        Experience::findOrFail($id)->delete();
        $this->notify("Deleted")->setDetail("Experience has been deleted!")->setAutoHide(true)->setLevelSuccess();
    }
}