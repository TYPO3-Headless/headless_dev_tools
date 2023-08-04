<?php

/*
 * This file is part of the "headless dev tools" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessDevTools\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Adminpanel\Controller\MainController;
use TYPO3\CMS\Adminpanel\Utility\StateUtility;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Render the admin panel via PSR-15 middleware
 *
 * @internal
 */
class AdminPanelRenderer implements MiddlewareInterface
{
    /**
     * Render the admin panel if activated
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        if (
            $GLOBALS['TSFE'] instanceof TypoScriptFrontendController
            && StateUtility::isActivatedForUser()
            && StateUtility::isActivatedInTypoScript()
            && !StateUtility::isHiddenForUser()
        ) {
            $mainController = GeneralUtility::makeInstance(MainController::class);
            $body = $response->getBody();
            $body->rewind();
            $contents = $response->getBody()->getContents();
            $adminPanel = str_replace(["\n", "\r"], ['', ''], $mainController->render($request));
            $adminPanel = json_encode($adminPanel);
            $content = preg_replace(
                '/}$/',
                ',"adminPanel":' . $adminPanel . '}',
                $contents
            );
            $body = new Stream('php://temp', 'rw');
            $body->write($content);
            $response = $response->withBody($body);
        }
        return $response;
    }
}
