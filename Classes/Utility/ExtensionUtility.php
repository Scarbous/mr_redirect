<?php
namespace Scarbous\MrRedirect\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class ExtensionUtility
{
    const EXT_KEY = 'mr_redirect';

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    static protected $objectManager;

    /**
     * @var \Scarbous\MrRedirect\Domain\Repository\LogRepository
     */
    static protected $logRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    static protected $persistenceManager;

    /**
     * @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    static protected $typoScriptFrontendController;

    /**
     * @var array
     */
    static protected $configuration = null;

    /**
     * @var string
     */
    static protected $extPath = null;

    /**
     * @return string
     */
    static function getExtPath()
    {
        if (!self::$extPath) {
            self::$extPath = ExtensionManagementUtility::extPath(self::EXT_KEY);
        }
        return self::$extPath;
    }


    static function getConfiguration()
    {
        if (!self::$configuration) {
            $configuration = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXT_KEY];
            if (is_string($configuration)) {
                $configuration = @unserialize($configuration);
            }
            if (is_array($configuration)) {
                self::$configuration = $configuration;
            }
        }
        return self::$configuration;
    }

    /**
     * @return \Scarbous\MrRedirect\Domain\Model\Log
     */
    static public function getEmptyLog()
    {
        /** @var \Scarbous\MrRedirect\Domain\Model\Log $log */
        $log = self::getObjectManager()->getEmptyObject(\Scarbous\MrRedirect\Domain\Model\Log::class);
        return $log;
    }

    static public function addLog($log)
    {
        self::getLogRepository()->add($log);
        self::getPersistenceManager()->persistAll();
    }

    static private function getObjectManager()
    {
        if (!self::$objectManager) {
            self::$objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        }
        return self::$objectManager;
    }

    static private function getLogRepository()
    {
        if (!self::$logRepository) {
            self::$logRepository = self::getObjectManager()->get(\Scarbous\MrRedirect\Domain\Repository\LogRepository::class);
        }
        return self::$logRepository;
    }

    static private function getPersistenceManager()
    {
        if (!self::$persistenceManager) {
            self::$persistenceManager = self::getObjectManager()->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
        }
        return self::$persistenceManager;
    }

    static public function getTypoScriptFrontendController(){
        if (!self::$typoScriptFrontendController) {
            self::$typoScriptFrontendController = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController::class,
                $GLOBALS['TYPO3_CONF_VARS'],
                1, // page ID
                0 // pageType.
            );
            #self::$typoScriptFrontendController = self::getObjectManager()->get(\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController::class);
        }
        return self::$typoScriptFrontendController;
    }
}
