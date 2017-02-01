<?php
defined('TYPO3_MODE') or die('Access denied.');

$extConfig = \Scarbous\MrRedirect\Utility\ExtensionUtility::getConfiguration();


if (@$extConfig['404.']['activate']) {
    $TYPO3_CONF_VARS['FE']['pageNotFound_handling_after'] = $TYPO3_CONF_VARS['FE']['pageNotFound_handling'];
    $TYPO3_CONF_VARS['FE']['pageNotFound_handling'] =
        'USER_FUNCTION:' . \Scarbous\MrRedirect\Handler\PageNotFound::class . '->main';
}

if (@$extConfig['301.']['activate']) {
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['checkAlternativeIdMethods-PostProc']['tx_mr_redirect'] =
        \Scarbous\MrRedirect\Handler\Redirect::class . '->main';
}