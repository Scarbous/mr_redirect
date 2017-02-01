<?php
namespace Scarbous\MrRedirect\Handler;

use Scarbous\MrRedirect\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;

class PageNotFound
{
    /**
     * @var \Scarbous\MrRedirect\Service\RedirectService
     */
    protected $redirectService;

    /**
     *
     */
    function main()
    {

        $this->redirectService = GeneralUtility::makeInstance(
            \Scarbous\MrRedirect\Service\RedirectService::class,
            '404'
        );

        if ($_SERVER['REQUEST_URI'] == '/testRedirects/') {
            $this->redirectService->testRedirects();
        } else {
            $target = $this->redirectService->check($_SERVER['REQUEST_URI']);
            if ($target) {
                $this->redirect($target);
            } else {
                if (boolval(@ExtensionUtility::getConfiguration()['404.']['log'])) {
                    $log = ExtensionUtility::getEmptyLog();
                    $log->setType('404');
                    $log->setRequestUri($_SERVER['REQUEST_URI']);
                    ExtensionUtility::addLog($log);
                }
            }
        }

        $configuration = ExtensionUtility::getConfiguration();
        $this->redirect($configuration['404.']['redirectIfError']);

        $typoScriptFrontendController = ExtensionUtility::getTypoScriptFrontendController();
        if ($typoScriptFrontendController->TYPO3_CONF_VARS['FE']['pageNotFound_handling_after']) {
            $header = $typoScriptFrontendController->TYPO3_CONF_VARS['FE']['pageNotFound_handling_statheader'] ?: "HTTP/1.0 404 Not Found";
            $reason = 'The requested page does not exist';
            $typoScriptFrontendController->pageNotFoundHandler(
                $typoScriptFrontendController->TYPO3_CONF_VARS['FE']['pageNotFound_handling_after'],
                $header,
                $reason
            );
        }

    }

    /**
     * @param $url
     */
    protected function redirect($url)
    {
        HttpUtility::redirect($url);
    }
}