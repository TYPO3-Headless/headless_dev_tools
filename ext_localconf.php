<?php

/*
 * This file is part of the "headless dev tools" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

(static function (string $extension) {
    $features = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\Features::class);

    if ($features->isFeatureEnabled('headless.storageProxy') &&
        class_exists(\IchHabRecht\Filefill\Resource\RemoteResourceCollection::class)) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\IchHabRecht\Filefill\Resource\RemoteResourceCollection::class]['className'] = \FriendsOfTYPO3\HeadlessDevTools\Xclass\RemoteResourceCollection::class;
    }

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['headlessDevTools'] = ['FriendsOfTYPO3\\HeadlessDevTools\\ViewHelpers'];
})('headless_dev_tools');

