<?php

namespace App\Sharp\EntityLists;

use App\Project;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class Projects extends SharpEntityList {

    function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make("title")->setLabel("Name")->setSortable()
        );
    }

    function buildListLayout()
    {
        $this->addColumn("title", 12, 1);
    }

    function getListData(EntityListQueryParams $params)
    {
        return Project::paginate(20);
    }

    function buildListConfig()
    {
        $this->setSearchable()->setDefaultSort('title', 'asc')->setPaginated();
    }
}