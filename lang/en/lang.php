<?php

return [
    'details' => [
        'name' => 'Toolbox',
        'description' => 'Toolbox plugin for October CMS',
        'author' => 'Prismify',
    ],
    'models' => [
        'all' => [
            'fields' => [
                'enabled_at' => [
                    'validation' => 'Please specific enabled date'
                ]
            ]
        ]
    ]
];