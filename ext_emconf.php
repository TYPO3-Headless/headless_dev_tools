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
    'version' => '0.1',
    'constraints' => [
        'depends' => [
            'frontend' => '10.4.0-11.5.99',
            'typo3' => '10.4.0-11.5.99',
            'headless' => '2.6-3.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
