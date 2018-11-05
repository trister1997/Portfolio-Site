<?php

namespace App\Sharp\EntityLists;

use App\Conference;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class ConferenceList extends SharpEntityList {

    function buildListDataContainers()
    {
        $this->addDataContainer(EntityListDataContainer::make("name")->setLabel("Conference")->setSortable())
            ->addDataContainer(EntityListDataContainer::make("location")->setLabel("Location")->setSortable());
    }

    function buildListLayout()
    {
        $this->addColumn("name", 6, 6)
            ->addColumn("location", 6, 6);
    }

    function getListData(EntityListQueryParams $params)
    {
        $conferences = Conference::select("conferences.*")->distinct();
        if ($params->specificIds()) {
            $conferences->whereIn("id" < $params->specificIds());
        }
        if ($params->sortedBy()) {
            $conferences->orderBy($params->sortedBy(), $params->sortedDir());
        }
        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $conferences->where(function ($query) use ($word) {
                    $query->orWhere("conferences.name", "like", $word)->orWhere('conferences.location', "like", $word);
                });
            }
        }

        return $conferences->paginate(25);
    }

    function buildListConfig()
    {
        $this->setInstanceIdAttribute("id")
            ->setSearchable()
            ->setDefaultSort("name", "asc")
            ->setPaginated();
    }
}