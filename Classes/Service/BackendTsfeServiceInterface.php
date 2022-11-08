<?php

/*
 * This file is part of the "headless dev tools" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

namespace FriendsOfTYPO3\HeadlessDevTools\Service;

use FriendsOfTYPO3\HeadlessDevTools\Dto\JsonViewDemandInterface;
use TYPO3\CMS\Core\Http\ServerRequest;

/**
 * @codeCoverageIgnore
 */
interface BackendTsfeServiceInterface
{
    public function bootFrontendControllerForPage(int $pageId, JsonViewDemandInterface $demand, JsonViewConfigurationServiceInterface $configurationService, array $settings, bool $bootContent = false): void;
    public function getPageFromTsfe(JsonViewDemandInterface $demand, JsonViewConfigurationServiceInterface $configurationService, array $settings): string;
    public function getFrontendRequest(JsonViewDemandInterface $demand, JsonViewConfigurationServiceInterface $configurationService): ServerRequest;
}
