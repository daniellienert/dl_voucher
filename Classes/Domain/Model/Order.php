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
	 * voucherType
	 *
	 * @var integer
	 */
	protected $voucherType;

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
	 * Returns the voucherType
	 *
	 * @return integer $voucherType
	 */
	public function getVoucherType() {
		return $this->voucherType;
	}

	/**
	 * Sets the voucherType
	 *
	 * @param integer $voucherType
	 * @return void
	 */
	public function setVoucherType($voucherType) {
		$this->voucherType = $voucherType;
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