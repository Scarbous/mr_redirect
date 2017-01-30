<?php
namespace Scarbous\MrRedirect\Utility;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class ExtensionUtility
{
    const EXT_KEY = 'mr_redirect';

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

}
