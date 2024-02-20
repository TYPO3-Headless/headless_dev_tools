<?php

declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessDevTools\Xclass;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ShowMissingFiles extends \IchHabRecht\Filefill\Form\Element\ShowMissingFiles
{
    /**
     * Fixed method with latest v12 changes
     * @return array
     */
    public function render()
    {
        $result = $this->initializeResultArray();

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_file');
        $expressionBuilder = $queryBuilder->expr();
        $count = $queryBuilder->count('*')
            ->from('sys_file')
            ->where(
                $expressionBuilder->eq(
                    'storage',
                    $queryBuilder->createNamedParameter($this->data['vanillaUid'], \PDO::PARAM_INT)
                ),
                $expressionBuilder->eq(
                    'missing',
                    $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)
                )
            )
            ->execute()
            ->fetchOne();

        $html = [];
        $html[] = '<div class="form-control-wrap">';

        if ($count === 0) {
            $html[] = '<span class="badge badge-success">'
                . $this->languageService->sL('LLL:EXT:filefill/Resources/Private/Language/locallang_db.xlf:sys_file_storage.filefill.no_missing')
                . '</span>';
        } else {
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
            $html[] = '<span class="badge badge-danger">'
                . sprintf(
                    $this->languageService->sL('LLL:EXT:filefill/Resources/Private/Language/locallang_db.xlf:sys_file_storage.filefill.missing_files'),
                    $count
                )
                . '</span>';
            $html[] = '</div>';
            $html[] = '<div class="form-control-wrap t3js-module-docheader">';
            $html[] = '<a class="btn btn-default t3js-editform-submitButton" data-name="_save_tx_filefill_missing" data-form="EditDocumentController" data-value="1">';
            $html[] = $iconFactory->getIcon('actions-database-reload', Icon::SIZE_SMALL);
            $html[] = ' ' . $this->languageService->sL('LLL:EXT:filefill/Resources/Private/Language/locallang_db.xlf:sys_file_storage.filefill.reset');
            $html[] = '</a>';
        }

        $html[] = '</div>';

        $result['html'] = implode('', $html);

        return $result;
    }
}
