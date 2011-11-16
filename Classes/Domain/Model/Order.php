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
class Tx_DlVoucher_Domain_Model_Order extends Tx_Extbase_DomainObject_AbstractEntity {

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
	 * @validate NotEmpty
	 */
	protected $voucherImage;

	/**
	 * fromName
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $fromName;

	/**
	 * toName
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $toName;

	/**
	 * amount
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $amount;

	/**
	 * defaultOffer
	 *
	 * @var Tx_DlVoucher_Domain_Model_Offer
	 */
	protected $defaultOffer;

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
	 * Returns the defaultOffer
	 *
	 * @return Tx_DlVoucher_Domain_Model_Offer $defaultOffer
	 */
	public function getDefaultOffer() {
		return $this->defaultOffer;
	}

	/**
	 * Sets the defaultOffer
	 *
	 * @param Tx_DlVoucher_Domain_Model_Offer $defaultOffer
	 * @return void
	 */
	public function setDefaultOffer(Tx_DlVoucher_Domain_Model_Offer $defaultOffer) {
		$this->defaultOffer = $defaultOffer;
	}

}
?>