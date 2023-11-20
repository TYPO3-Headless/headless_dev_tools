<?php

/*
 * This file is part of the "headless dev tools" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'Headless',
    'description' => 'Headless dev tools - helpful code for local development',
    'state' => 'stable',
    'author' => 'Tomasz Woldański',
    'author_email' => 'extensions@macopedia.pl',
    'author_company' => 'Macopedia Sp. z o.o.',
    'category' => 'fe',
    'internal' => '',
    'version' => '2.0',
    'constraints' => [
        'depends' => [
            'frontend' => '12.4.0-12.4.99',
            'typo3' => '12.4.0-12.4.99',
            'headless' => '4.0-4.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
