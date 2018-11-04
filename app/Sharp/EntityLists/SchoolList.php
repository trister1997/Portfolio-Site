<?php

namespace App\Sharp\EntityLists;

use App\Project;
use App\School;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\Eloquent\Transformers\SharpUploadModelAttributeTransformer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class SchoolList extends SharpEntityList {

    function buildListDataContainers()
    {
        $this->addDataContainer(EntityListDataContainer::make("name")->setLabel("School Name")->setSortable())
            ->addDataContainer(EntityListDataContainer::make("major")->setLabel("Major Name")->setSortable());
    }

    function buildListLayout()
    {
        $this->addColumn("name", 6, 6)
            ->addColumn("major", 6, 6);
    }

    function getListData(EntityListQueryParams $params)
    {
        $schools = School::select("schools.*")->distinct();
        if ($params->specificIds()) {
            $schools->whereIn("id" < $params->specificIds());
        }
        if ($params->sortedBy()) {
            $schools->orderBy($params->sortedBy(), $params->sortedDir());
        }
        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $schools->where(function ($query) use ($word) {
                    $query->orWhere("schools.name", "like", $word)
                    ->orWhere("schools.major", "like", $word);
                });
            }
        }

        return $schools->paginate(25);
    }

    function buildListConfig()
    {
        $this->setInstanceIdAttribute("id")
            ->setSearchable()
            ->setDefaultSort("name", "asc")
            ->setPaginated();
    }
}