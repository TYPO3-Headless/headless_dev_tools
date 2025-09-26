<?php

return [
    'frontend' => [
        // Replace regular by headless middleware
        'typo3/cms-adminpanel/renderer' => [
            'target' => \FriendsOfTYPO3\HeadlessDevTools\Middleware\AdminPanelRenderer::class,
        ],
    ],
];
