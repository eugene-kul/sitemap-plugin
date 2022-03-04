<?php return [
    'plugin' => [
        'name' => 'Sitemap.xml',
        'description' => 'Plugin for generation Sitemap.xml'
    ],

    'config' => [
        'use_in_sitemap' => 'Enable in the Sitemap.xml',
        'model_class' => [
            'label' => 'Associate this page with a model links will be generated from it\s records',
            'comment' => 'Author\Plugin\Models\modelClass, you can specify several separated by commas'
        ],
        'priority' => 'Page priority',
        'changefreq' => 'Page change frequency',
    ],

    'permissions' => [
        'labels' => [
            'sitemap' => 'Sitemap tab',
        ]
    ],
];