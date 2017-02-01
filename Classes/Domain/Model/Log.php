<?php
namespace Scarbous\MrRedirect\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Log
 */
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * type
	 *
	 * @var string
	 */
	protected $type = '';

	/**
	 * requestUri
	 *
	 * @var string
	 */
	protected $requestUri = '';

	/**
	 * target
	 *
	 * @var string
	 */
	protected $target = '';

	/**
	 * logData
	 *
	 * @var string
	 */
	protected $logData = '';

    /**
     * @var int
     */
	protected $tstamp = 0;

	/**
	 * Returns the type
	 *
	 * @return string $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the requestUri
	 *
	 * @return string $requestUri
	 */
	public function getRequestUri() {
		return $this->requestUri;
	}

	/**
	 * Sets the requestUri
	 *
	 * @param string $requestUri
	 * @return void
	 */
	public function setRequestUri($requestUri) {
		$this->requestUri = $requestUri;
	}

	/**
	 * Returns the target
	 *
	 * @return string $target
	 */
	public function getTarget() {
		return $this->target;
	}

	/**
	 * Sets the target
	 *
	 * @param string $target
	 * @return void
	 */
	public function setTarget($target) {
		$this->target = $target;
	}

	/**
	 * Returns the logData
	 *
	 * @return string $logData
	 */
	public function getLogData() {
		return $this->logData;
	}

	/**
	 * Sets the logData
	 *
	 * @param string $logData
	 * @return void
	 */
	public function setLogData($logData) {
		$this->logData = $logData;
	}

    /**
     * Returns the tstamp
     *
     * @return string $tstamp
     */
    public function getTstamp() {
        return $this->tstamp;
    }

    /**
     * Sets the tstamp
     *
     * @param string $tstamp
     * @return void
     */
    public function setTstamp($tstamp) {
        $this->tstamp = $tstamp;
    }

}