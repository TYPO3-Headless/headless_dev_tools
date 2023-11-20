<?php

/*
 * This file is part of the "headless dev tools" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessDevTools\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class DebugViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('title', 'string', 'optional custom title for the debug output');
        $this->registerArgument('maxDepth', 'int', 'Sets the max recursion depth of the dump (defaults to 8). De- or increase the number according to your needs and memory limit.', false, 8);
        $this->registerArgument('plainText', 'bool', 'If TRUE, the dump is in plain text, if FALSE the debug output is in HTML format.', false, false);
        $this->registerArgument('ansiColors', 'bool', 'If TRUE, ANSI color codes is added to the plaintext output, if FALSE (default) the plaintext debug output not colored.', false, false);
        $this->registerArgument('inline', 'bool', 'if TRUE, the dump is rendered at the position of the <f:debug> tag. If FALSE (default), the dump is displayed at the top of the page.', false, false);
        $this->registerArgument('blacklistedClassNames', 'array', 'An array of class names (RegEx) to be filtered. Default is an array of some common class names.');
        $this->registerArgument('blacklistedPropertyNames', 'array', 'An array of property names and/or array keys (RegEx) to be filtered. Default is an array of some common property names.');
    }

    /**
     * A wrapper for \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump().
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {
        if (!($GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] ?? false)) {
            return '';
        }

        DebuggerUtility::var_dump(
            $renderChildrenClosure(),
            $arguments['title'],
            $arguments['maxDepth'],
            $arguments['plainText'],
            $arguments['ansiColors'],
            $arguments['inline'],
            $arguments['blacklistedClassNames'],
            $arguments['blacklistedPropertyNames']
        );

        die();
    }
}
