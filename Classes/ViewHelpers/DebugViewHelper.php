<?php
declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessDevTools\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\ViewHelpers\DebugViewHelper as Fluid_DebugViewHelper;

class DebugViewHelper extends Fluid_DebugViewHelper
{
    /**
     * A wrapper for \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump().
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        echo DebuggerUtility::var_dump($renderChildrenClosure(), $arguments['title'], $arguments['maxDepth'], (bool)$arguments['plainText'], (bool)$arguments['ansiColors'], (bool)$arguments['inline'], $arguments['blacklistedClassNames'], $arguments['blacklistedPropertyNames']);
        die();
    }
}
