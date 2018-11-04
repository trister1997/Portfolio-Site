<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'link'];

    public function project_image() {
        return $this->morphOne(Upload::class, "model")->where("model_key", "project_image");
    }

    public function getDefaultAttributesFor($attribute)
    {
        return in_array($attribute, ["project_image"])
            ? ["model_key" => $attribute]
            : [];
    }
}