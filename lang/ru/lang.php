<?php return [
    'plugin' => [
        'name' => 'Sitemap.xml',
        'description' => 'Плагин для генерации Sitemap.xml'
    ],

    'config' => [
        'use_in_sitemap' => 'Включить страницу в sitemap.xml',
        'model_class' => [
            'label' => 'PHP Class для списка страниц в Sitemap.xml',
            'comment' => 'Author\Plugin\Models\modelClass, можно указывать несколько через запятую'
        ],
        'priority' => 'Приоритет страницы',
        'changefreq' => 'Частота изменения страницы',
    ],

    'permissions' => [
        'labels' => [
            'sitemap' => 'Вкладка Sitemap',
        ]
    ],
];