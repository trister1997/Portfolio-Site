<?php
return [
    "entities" => [
        "projects" => [
            "list" => \App\Sharp\EntityLists\Projects::class
        ]
    ],
    "auth" => [
        'login_attribute' => 'username',
        'password_attribute' => 'password',
        'display_attribute' => 'username'
    ],
    "menu" => [
        [
            "entity" => "projects",
            "properties" => [
                "label" => "Projects",
                "icon" => "fa-folder"
            ]
        ],
        [
            "label" => "Projects",
            "entities" => [
                "projects" => [
                    "label" => "Projects",
                    "icon" => "fa-folder"
                ]
            ]
        ]
    ]
];