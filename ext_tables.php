<?php

/*
 * This file is part of the "headless dev tools" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

declare(strict_types=1);

use FriendsOfTYPO3\HeadlessDevTools\Controller\JsonViewController;
use TYPO3\CMS\Core\Configuration\Features;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(
    static function () {
        $features = GeneralUtility::makeInstance(Features::class);

        if ($features->isFeatureEnabled('headless.jsonViewModule')) {
            ExtensionUtility::registerModule(
                'Headless',
                'web',
                'jsonview',
                'bottom',
                [
                    JsonViewController::class => 'main'
                ],
                [
                    'access' => 'admin',
                    'icon' => 'EXT:headless_dev_tools/Resources/Public/Icons/module-jsonview.svg',
                    'labels' => 'LLL:EXT:headless_dev_tools/Resources/Private/Language/locallang_mod.xlf'
                ]
            );
        }
    }
);
