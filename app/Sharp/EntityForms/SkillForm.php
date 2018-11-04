<?php

namespace App\Sharp\EntityForms;

use App\Skill;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormNumberField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class SkillForm extends SharpForm {
    use WithSharpFormEloquentUpdater;

    function buildFormFields()
    {
        $this->addField(SharpFormTextField::make("title")->setLabel("Skill Name"))
            ->addField(SharpFormNumberField::make("percentage")->setLabel("Skill Percentage")->setMin(0)->setMax(100)->setShowControls(true));
    }

    function buildFormLayout()
    {
        $this->addColumn(12, function(FormLayoutColumn $column) {
            $column->withFields("title", "percentage");
        });
    }

    function create(): array
    {
        return $this->transform(new Skill());
    }

    function find($id): array
    {
        return Skill::findOrFail($id)->toArray();
    }

    function update($id, array $data)
    {
        $instance = $id ? Skill::findOrFail($id) : new Skill;
        $this->save($instance, $data);
        $this->notify("Success")->setDetail("Skill has been updated!")->setLevelSuccess()->setAutoHide(true);
        return $instance->id;
    }

    function delete($id)
    {
        Skill::findOrFail($id)->delete();
        $this->notify("Deleted")->setDetail("Skill has been deleted!")->setAutoHide(true)->setLevelSuccess();
    }
}