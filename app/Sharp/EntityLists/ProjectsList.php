<?php

namespace App\Sharp\EntityLists;

use App\Project;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\Eloquent\Transformers\SharpUploadModelAttributeTransformer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class ProjectsList extends SharpEntityList {

    function buildListDataContainers()
    {
        $this->addDataContainer(EntityListDataContainer::make("project_image"))
            ->addDataContainer(EntityListDataContainer::make("title")->setLabel("Project Name")->setSortable())
            ->addDataContainer(EntityListDataContainer::make("link")->setLabel("Project Link"));
    }

    function buildListLayout()
    {
        $this->addColumn("project_image", 2, 4)
            ->addColumn("title", 8, 4)
            ->addColumn("link", 2,4);
    }

    function getListData(EntityListQueryParams $params)
    {
        $projects = Project::select("projects.*")->distinct();
        if ($params->specificIds()) {
            $projects->whereIn("id"< $params->specificIds());
        }
        if ($params->sortedBy()) {
            $projects->orderBy($params->sortedBy(), $params->sortedDir());
        }
        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $projects->where(function($query) use ($word) {
                    $query->orWhere("projects.title", "like", $word);
                });
            }
        }

        return $this->setCustomTransformer("project_image", new SharpUploadModelAttributeTransformer(100))
            ->transform($projects->with("project_image")->paginate(25));
    }

    function buildListConfig()
    {
        $this->setInstanceIdAttribute("id")
            ->setSearchable()
            ->setDefaultSort("title", "asc")
            ->setPaginated();
    }
}