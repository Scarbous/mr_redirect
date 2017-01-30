<?php
namespace Scarbous\MrRedirect\Handler;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;

class Redirect
{
    /**
     * @var \Scarbous\MrRedirect\Service\RedirectService
     */
    protected $redirectService;

    function main()
    {

        $this->redirectService = GeneralUtility::makeInstance(
            \Scarbous\MrRedirect\Service\RedirectService::class,
            '301'
        );

        if (@$_GET['urlTest'] == '301') {
            $this->redirectService->testRedirects();
        } else {
            $target = $this->redirectService->check($_SERVER['REQUEST_URI']);
            if ($target) {
                $this->redirect($target);
            }
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
