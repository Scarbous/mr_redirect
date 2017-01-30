<?php
namespace Scarbous\MrRedirect\Handler;

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