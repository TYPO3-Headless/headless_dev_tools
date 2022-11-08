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
use Symfony\Component\ExpressionLanguage\SyntaxError;
use TYPO3\CMS\Core\ExpressionLanguage\Resolver;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Site\Entity\Site;
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

        $headlessStorageProxy = '';

        if (GeneralUtility::makeInstance(Typo3Version::class)->getVersion() >= 11) {
            $urlUtility = GeneralUtility::makeInstance(UrlUtility::class);
            $headlessStorageProxy = $urlUtility->getStorageProxyUrl();
        } else {
            $request = $GLOBALS['TYPO3_REQUEST'] ?? null;

            if ($request instanceof ServerRequestInterface) {
                $site = $request->getAttribute('site');
                if ($site instanceof Site) {
                    $resolver = GeneralUtility::makeInstance(Resolver::class, 'site', []);

                    foreach ($site->getConfiguration()['baseVariants'] ?? [] as $variant) {
                        try {
                            if ($resolver->evaluate($variant['condition'])) {
                                $headlessStorageProxy = rtrim($variant['frontendFileApi'] ?? '', '/');
                                break;
                            }
                        } catch (SyntaxError $e) {
                        }
                    }
                }
            }
        }

        if ($headlessStorageProxy === '') {
            return $filePath;
        }

        return str_replace($headlessStorageProxy, 'fileadmin', $filePath);
    }
}
