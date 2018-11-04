<?php

namespace App\Sharp\EntityLists;

use App\Project;
use App\School;
use App\Skill;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\Eloquent\Transformers\SharpUploadModelAttributeTransformer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class SkillList extends SharpEntityList {

    function buildListDataContainers()
    {
        $this->addDataContainer(EntityListDataContainer::make("title")->setLabel("Skill")->setSortable())
            ->addDataContainer(EntityListDataContainer::make("percentage")->setLabel("Skill Percentage"));
    }

    function buildListLayout()
    {
        $this->addColumn("title", 6, 6)
            ->addColumn("percentage", 6, 6);
    }

    function getListData(EntityListQueryParams $params)
    {
        $skills = Skill::select("skills.*")->distinct();
        if ($params->specificIds()) {
            $skills->whereIn("id" < $params->specificIds());
        }
        if ($params->sortedBy()) {
            $skills->orderBy($params->sortedBy(), $params->sortedDir());
        }
        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $skills->where(function ($query) use ($word) {
                    $query->orWhere("schools.title", "like", $word);
                });
            }
        }

        return $skills->paginate(25);
    }

    function buildListConfig()
    {
        $this->setInstanceIdAttribute("id")
            ->setSearchable()
            ->setDefaultSort("title", "asc")
            ->setPaginated();
    }
}