<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Daniel Lienert <daniel@lienert.cc>, Daniel Lienert
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
 *
 *
 * @package dl_voucher
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_DlVoucher_Domain_Model_Voucher extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_PtExtbase_State_Session_SessionPersistableInterface {

	/**
	 * info
	 *
	 * @var string
	 */
	protected $info;

	/**
	 * voucherImage
	 *
	 * @var integer
	 */
	protected $voucherImage;

	/**
	 * fromName
	 *
	 * @var string
	 */
	protected $fromName;

	/**
	 * toName
	 *
	 * @var string
	 */
	protected $toName;

	/**
	 * amount
	 *
	 * @var integer
	 */
	protected $amount;


	/**
	 * printAmount
	 *
	 * @var boolean
	 */
	protected $printAmount = false;


	/**
	 * offer
	 *
	 * @var Tx_DlVoucher_Domain_Model_Offer
	 */
	protected $offer;



	/**
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager;


	/**
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}


	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Returns the info
	 *
	 * @return string $info
	 */
	public function getInfo() {
		return $this->info;
	}

	/**
	 * Sets the info
	 *
	 * @param string $info
	 * @return void
	 */
	public function setInfo($info) {
		$this->info = $info;
	}

	/**
	 * Returns the voucherImage
	 *
	 * @return integer $voucherImage
	 */
	public function getVoucherImage() {
		return $this->voucherImage;
	}


	/**
	 * @return Tx_Yag_Domain_Model_Item
	 */
	public function getVoucherYAGImage() {
		return $this->objectManager->get('Tx_Yag_Domain_Repository_ItemRepository')->findByUid($this->voucherImage);
	}

	

	/**
	 * Sets the voucherImage
	 *
	 * @param integer $voucherImage
	 * @return void
	 */
	public function setVoucherImage($voucherImage) {
		$this->voucherImage = $voucherImage;
	}

	/**
	 * Returns the fromName
	 *
	 * @return string $fromName
	 */
	public function getFromName() {
		return $this->fromName;
	}

	/**
	 * Sets the fromName
	 *
	 * @param string $fromName
	 * @return void
	 */
	public function setFromName($fromName) {
		$this->fromName = $fromName;
	}

	/**
	 * Returns the toName
	 *
	 * @return string $toName
	 */
	public function getToName() {
		return $this->toName;
	}

	/**
	 * Sets the toName
	 *
	 * @param string $toName
	 * @return void
	 */
	public function setToName($toName) {
		$this->toName = $toName;
	}

	/**
	 * Returns the amount
	 *
	 * @return integer $amount
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Sets the amount
	 *
	 * @param integer $amount
	 * @return void
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
	}


	/**
	 * Returns the printAmount
	 *
	 * @return boolean $printAmount
	 */
	public function getPrintAmount() {
		return(bool) $this->printAmount;
	}

	/**
	 * Sets the printAmount
	 *
	 * @param boolean $printAmount
	 * @return void
	 */
	public function setPrintAmount($printAmount) {
		$this->printAmount = $printAmount;
	}

	/**
	 * Returns the boolean state of printAmount
	 *
	 * @return boolean
	 */
	public function isPrintAmount() {
		return $this->getPrintAmount();
	}


	/**
	 * Returns the offer
	 *
	 * @return Tx_DlVoucher_Domain_Model_Offer $offer
	 */
	public function getOffer() {
		return $this->offer;
	}

	/**
	 * Sets the offer
	 *
	 * @param Tx_DlVoucher_Domain_Model_Offer $offer
	 * @return void
	 */
	public function setOffer(Tx_DlVoucher_Domain_Model_Offer $offer) {
		$this->offer = $offer;
	}


	/**
	 * Generates an unique namespace for an object to be used
	 * for addressing object specific session data and gp variables.
	 *
	 * Expected notation: ns1.ns2.ns3.(...)
	 *
	 * @return String Unique namespace for object
	 */
	public function getObjectNamespace() {
		return 'voucher';
	}


	/**
	 * Called by any mechanism to persist an object's state to session
	 *
	 * @return array Object's state to be persisted to session
	 */
	public function persistToSession() {
		return array(
			'info' => $this->info,
			'fromName' => $this->fromName,
			'toName' => $this->toName,
			'printAmount' => $this->printAmount,
			'amount' => $this->amount,
			'offer' => $this->offer->getUid(),
		);
	}



	/**
	 * Called by any mechanism to inject an object's state from session
	 *
	 * @param array $sessionData Object's state previously persisted to session
	 */
	public function injectSessionData(array $sessionData) {
		$this->setFromArrayIfExists($sessionData, 'info');
		$this->setFromArrayIfExists($sessionData, 'fromName');
		$this->setFromArrayIfExists($sessionData, 'toName');
		$this->setFromArrayIfExists($sessionData, 'printAmount');
		$this->setFromArrayIfExists($sessionData, 'amount');
		$this->setFromArrayIfExists($sessionData, 'offer');
	}



	/**
	 * Set a value if the key in the given array and a setter with the same name exists
	 *
	 * @param $array
	 * @param $key
	 */
	protected function setFromArrayIfExists($array, $key) {
		$setter = 'set' . ucfirst($key);
		if(array_key_exists($key, $array) && method_exists($this, $setter)) {
			$this->$setter($array[$key]);
		}
	}



}
?>