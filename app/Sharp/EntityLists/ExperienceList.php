<?php

namespace App\Sharp\EntityLists;

use App\Experience;
use App\School;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class ExperienceList extends SharpEntityList {

    function buildListDataContainers()
    {
        $this->addDataContainer(EntityListDataContainer::make("company")->setLabel("Company Name")->setSortable())
            ->addDataContainer(EntityListDataContainer::make("title")->setLabel("Job Title")->setSortable());
    }

    function buildListLayout()
    {
        $this->addColumn("company", 6, 6)
            ->addColumn("title", 6, 6);
    }

    function getListData(EntityListQueryParams $params)
    {
        $experiences = Experience::select("experiences.*")->distinct();
        if ($params->specificIds()) {
            $experiences->whereIn("id" < $params->specificIds());
        }
        if ($params->sortedBy()) {
            $experiences->orderBy($params->sortedBy(), $params->sortedDir());
        }
        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $experiences->where(function ($query) use ($word) {
                    $query->orWhere("experiences.company", "like", $word)
                    ->orWhere("experiences.title", "like", $word);
                });
            }
        }

        return $experiences->paginate(25);
    }

    function buildListConfig()
    {
        $this->setInstanceIdAttribute("id")
            ->setSearchable()
            ->setDefaultSort("company", "asc")
            ->setPaginated();
    }
}