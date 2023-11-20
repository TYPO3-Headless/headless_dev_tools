<?php

/*
 * This file is part of the "headless dev tools" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessDevTools\Xclass;

use FriendsOfTYPO3\Headless\Utility\UrlUtility;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Utility\GeneralUtility;

use function str_replace;

class RemoteResourceCollection extends \IchHabRecht\Filefill\Resource\RemoteResourceCollection
{
    public function get($fileIdentifier, $filePath)
    {
        return parent::get($fileIdentifier, $this->fixFilePathForStorageProxy($filePath));
    }

    private function fixFilePathForStorageProxy(string $filePath): string
    {
        if (($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface &&
            ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isBackend()) {
            return $filePath;
        }

        if (!($GLOBALS['TYPO3_REQUEST'] ?? null)) {
            return $filePath;
        }

        $urlUtility = GeneralUtility::makeInstance(UrlUtility::class)->withRequest($GLOBALS['TYPO3_REQUEST']);
        $headlessStorageProxy = $urlUtility->getStorageProxyUrl();

        if ($headlessStorageProxy === '') {
            return $filePath;
        }

        return str_replace($headlessStorageProxy, 'fileadmin', $filePath);
    }
}
