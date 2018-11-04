<?php
return [
    "name" => "Rister IO",
    "entities" => [
        "projects" => [
            "list" => \App\Sharp\EntityLists\ProjectsList::class,
            "form" => \App\Sharp\EntityForms\ProjectForm::class
        ],
        "schools" => [
            "list" => \App\Sharp\EntityLists\SchoolList::class,
            "form" => \App\Sharp\EntityForms\SchoolForm::class
        ],
        "skills" => [
            "list" => \App\Sharp\EntityLists\SkillList::class,
            "form" => \App\Sharp\EntityForms\SkillForm::class
        ],
        "profile_attributes" => [
            "form" => \App\Sharp\EntityForms\ProfileAttributesForm::class
        ]
    ],
    "auth" => [
        'login_attribute' => 'username',
        'password_attribute' => 'password',
        'display_attribute' => 'username'
    ],
    "menu" => [
        [
            "label" => "Profile",
            "icon" => "fa-user",
            "url" => env('APP_URL') . '/sharp/form/profile_attributes/update',
        ],
        [
            "label" => "Projects",
            "icon" => "fa-folder",
            "entity" => "projects"
        ],
        [
            "label" => "Schools",
            "icon" => "fa-book",
            "entity" => "schools"
        ],
        [
            "label" => "Skills",
            "icon" => "fa-cogs",
            "entity" => "skills"
        ]
    ]
];