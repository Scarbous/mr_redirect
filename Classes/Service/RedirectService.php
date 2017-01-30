<?php
namespace Scarbous\MrRedirect\Service;

use Scarbous\MrRedirect\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;


class RedirectService implements \TYPO3\CMS\Core\SingletonInterface
{
    const MAX_CHECK_COUNT = 20;

    /**
     * @var string
     */
    protected $configFile;

    /**
     * @var string
     */
    protected $testFile;

    /**
     * @var array
     */
    protected $redirectsConfig;

    /**
     * @var int
     */
    protected $checkCount = 0;

    /**
     * RedirectService constructor.
     *
     * @param string $type
     */
    function __construct($type)
    {
        $this->type = $type;
    }

    function testRedirects()
    {
        $this->testFile = 'typo3conf/' . $this->type . '_test.csv';

        $testFile = PATH_site . $this->testFile;

        if (file_exists($testFile)) {
            $testRedirects = GeneralUtility::getUrl($testFile);

            $testRedirects = explode("\n", $testRedirects);
            $testTesult    = [];
            foreach ($testRedirects as $redirect) {
                if (trim($redirect)) {
                    list($from, $to) = explode("\t", $redirect);
                    $result = $this->check($from);

                    if (
                        trim($result) == trim($to)
                        || trim($to) == '-' && $result
                    ) {
                        $state = 'ok';
                    } else {
                        $state = 'error';
                    }

                    $testTesult[$state][$from] = [
                        'old' => $to,
                        'new' => $result,
                        'checkCount' => $this->getCheckCount()
                    ];
                }
            }
            echo 'OK: ' . count($testTesult['ok']) . PHP_EOL;
            echo 'ERROR: ' . count($testTesult['error']) . PHP_EOL;
            if (is_array($testTesult['error']) && count($testTesult['error']) > 0) {
                foreach ($testTesult['error'] as $from => $value) {
                    echo 'FROM:' . $from . PHP_EOL
                        . 'OLD: ' . $value['old'] . PHP_EOL
                        . 'NEW: ' . $value['new'] . PHP_EOL
                        . 'COUNT:' . $value['checkCount'] . PHP_EOL
                        . PHP_EOL;


                }
            }
        }
        die();
    }

    /**
     * @return int
     */
    function getCheckCount()
    {
        return $this->checkCount;
    }

    /**
     * @return bool|string
     */
    function check($url)
    {
        $target           = false;
        $this->checkCount = 0;

        do {
            $this->checkCount++;
            $lastTarget = $target;
            $url        = $lastTarget ?: $url;

            $target = $this->checkDirectRedirects($url);
            if (!$target) {
                $target = $this->checkPregMatchRedirects($url);
            }
            if (!$target) {
                $target = $this->checkPregReplaceRedirects($url);
            }
            if ($this->checkCount > self::MAX_CHECK_COUNT) break;

        } while ($target);

        return $lastTarget;
    }

    /**
     * @param string $url
     *
     * @return bool|mixed
     */
    function checkDirectRedirects($url)
    {
        $redirects = $this->getDirectRedirects();
        if ($redirects) {
            if (array_key_exists($url, $redirects)) {
                return $redirects[$url];
            }
        }
        return false;
    }


    /**
     * @param string $url
     *
     * @return bool|mixed
     */
    function checkPregMatchRedirects($url)
    {
        $redirects = $this->getPregMatchRedirects();

        if ($redirects) {
            foreach ($redirects as $pattern => $target) {
                if (preg_match($pattern, $url)) {
                    return $target;
                }
            }
        }
        return false;
    }

    /**
     * @param string $url
     *
     * @return bool|mixed
     */
    function checkPregReplaceRedirects($url)
    {
        $redirects = $this->getPregReplaceRedirects();

        if ($redirects) {
            foreach ($redirects as $pattern => $target) {
                $target = preg_replace($pattern, $target, $url, -1, $count);
                if ($count > 0) {
                    return $target;
                }
            }
        }
        return false;
    }

    /**
     * @return array|bool
     */
    function getDirectRedirects()
    {
        if (!$this->redirectsConfig) {
            if (!($this->redirectsConfig = $this->loadConfig())) {
                return false;
            }
        }
        return $this->redirectsConfig['direct'];
    }

    /**
     * @return array|bool
     */

    function getPregMatchRedirects()
    {
        if (!$this->redirectsConfig) {
            if (!($this->redirectsConfig = $this->loadConfig())) {
                return false;
            }
        }
        return $this->redirectsConfig['preg_match'];
    }

    /**
     * @return array|bool
     */

    function getPregReplaceRedirects()
    {
        if (!$this->redirectsConfig) {
            if (!($this->redirectsConfig = $this->loadConfig())) {
                return false;
            }
        }
        return $this->redirectsConfig['preg_replace'];
    }

    /**
     * @param $configFile
     *
     * @return bool|mixed
     */
    protected function loadConfig()
    {
        $configuration = ExtensionUtility::getConfiguration();

        if ($configFile = $configuration[$this->type . '.']['configFile']) {
            $this->configFile = $configFile;
        }

        if (file_exists($configFile)) {
            $redirects = include $configFile;
            if (is_array($redirects) && count($redirects) > 0) {
                return $redirects;
            }
        }
        return false;
    }

}
