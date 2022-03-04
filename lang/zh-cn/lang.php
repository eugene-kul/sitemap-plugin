<?php return [
    'plugin' => [
        'name' => 'Sitemap.xml',
        'description' => '用于创建Sitemap.xml',
    ],

    'config' => [
        'use_in_sitemap' => '在 Sitemap.xml 中启用',
        'model_class' => [
            'label' => '将此页面与模型链接相关联将从它的记录中生成',
            'comment' => 'Author\Plugin\Models\modelClass，可以指定多个,用逗号隔开',
        ],
        'priority' => '页面优先级',
        'changefreq' => '换页频率',
    ],

    'permissions' => [
        'labels' => [
            'sitemap' => 'Sitemap选项卡',
        ]
    ],
];