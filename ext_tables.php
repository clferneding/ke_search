<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

(function () {
    // add help file
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'tx_kesearch_filters',
        'EXT:ke_search/locallang_csh.xml'
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'KeSearch',
        'web',
        'backend_module',
        '',
        [
            \Tpwd\KeSearch\Controller\BackendModuleController::class => 'startIndexing, indexedContent, indexTableInformation, searchwordStatistics, clearSearchIndex, lastIndexingReport, alert',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:ke_search/Resources/Public/Icons/moduleicon.svg',
            'labels' => 'LLL:EXT:ke_search/Resources/Private/Language/locallang_mod.xml',
        ]
    );

    // add scheduler task
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Tpwd\KeSearch\Scheduler\IndexerTask::class]
        = array(
        'extension' => 'ke_search',
        'title' => 'Indexing process for ke_search (DEPRECATED, please use "Execute console commands" --> "ke_search:indexing" instead)',
        'description' => 'This task updates the ke_search index (DEPRECATED, please use "Execute console commands" --> "ke_search:indexing" instead)'
    );

    /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'ext-kesearch-wizard-icon',
        'TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider',
        ['source' => 'EXT:ke_search/Resources/Public/Icons/moduleicon.svg']
    );
})();