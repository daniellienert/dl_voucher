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
	 * The uuid is a unique identifier for this order to be used before the
	 * order is actually written to the database.
	 *
	 * @var string
	 */
	protected $uuid;

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
	 * @var Tx_Yag_Domain_Model_Item
	 */
	protected $voucherYAGImage;


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
	 * @var string
	 */
	protected $amountType;


	/**
	 * firstName
	 *
	 * @var string
	 */
	protected $firstName;

	/**
	 * lastName
	 *
	 * @var integer
	 */
	protected $lastName;

	/**
	 * street
	 *
	 * @var string
	 */
	protected $street;

	/**
	 * zip
	 *
	 * @var string
	 */
	protected $zip;

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city;

	/**
	 * country
	 *
	 * @var string
	 */
	protected $country;

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email;

	/**
	 * printAmount
	 *
	 * @var boolean
	 */
	protected $printAmount = false;

	/**
	 * agbAccepted
	 *
	 * @var boolean
	 */
	protected $agbAccepted = false;


	/**
	 * @var string
	 */
	protected $receiveVoucher = 'print';


	/**
	 * offer
	 *
	 * @var Tx_DlVoucher_Domain_Model_Offer
	 */
	protected $offer;


	/**
	 * @var string
	 */
	protected $code;


	/**
	 * @var int
	 */
	protected $paymentReceived;


	/**
	 * @var int
	 */
	protected $paymentDate;


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
	 * called on deserialize
	 */
	public function __wakeup() {
		if(!$this->objectManager) {
			$this->objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
		}
	}


	public function init() {
		$this->getUUid();
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
	 * @param Tx_Yag_Domain_Model_Item $voucherYAGImage
	 */
	public function setVoucherYAGImage(Tx_Yag_Domain_Model_Item $voucherYAGImage) {
		$this->voucherYAGImage = $voucherYAGImage;
	}


	/**
	 * @return Tx_Yag_Domain_Model_Item
	 */
	public function getVoucherYAGImage() {
		if(!$this->voucherYAGImage) {
			$this->voucherYAGImage = $this->objectManager->get('Tx_Yag_Domain_Repository_ItemRepository')->findByUid($this->voucherImage);
		}

		return $this->voucherYAGImage;
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
		if($this->amountType == 'offer' && $this->offer instanceof Tx_DlVoucher_Domain_Model_Offer) {
			return $this->offer->getPrice();
		} else {
			return $this->amount;
		}
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
	 * Returns the firstName
	 *
	 * @return string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the lastName
	 *
	 * @return integer $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param integer $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the street
	 *
	 * @return string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the country
	 *
	 * @return string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
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
	 * Returns the agbAccepted
	 *
	 * @return boolean $agbAccepted
	 */
	public function getAgbAccepted() {
		return (bool) $this->agbAccepted;
	}

	/**
	 * Sets the agbAccepted
	 *
	 * @param boolean $agbAccepted
	 * @return void
	 */
	public function setAgbAccepted($agbAccepted) {
		$this->agbAccepted = $agbAccepted;
	}

	/**
	 * Returns the boolean state of agbAccepted
	 *
	 * @return boolean
	 */
	public function isAgbAccepted() {
		return $this->getAgbAccepted();
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
	 * @param string $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}


	/**
	 * @return string
	 */
	public function getCode() {
		if(!$this->code) {
			$this->code = strtoupper(substr(uniqid(''),-8,8));
		}

		return $this->code;
	}



	/**
	 * @param Tx_DlVoucher_Domain_Model_Order $order
	 */
	public function setVoucherValuesFromOrder(Tx_DlVoucher_Domain_Model_Order $order) {

		$this->setOffer($order->getOffer());
		$this->setAmount($order->getAmount());
		$this->setAmountType($order->getAmountType());
		$this->setInfo($order->getInfo());
		$this->setFromName($order->getFromName());
		$this->setToName($order->getToName());
		$this->setPrintAmount($order->getPrintAmount());
		$this->setVoucherImage($order->getVoucherImage());
		$this->setReceiveVoucher($order->getReceiveVoucher());
	}



	/**
	 * @param Tx_DlVoucher_Domain_Model_Order $order
	 */
	public function setBillingValuesFromOrder(Tx_DlVoucher_Domain_Model_Order $order) {

		$this->setFirstName($order->getFirstName());
		$this->setLastName($order->getLastName());
		$this->setStreet($order->getStreet());
		$this->setZip($order->getZip());
		$this->setCity($order->getCity());
		$this->setEmail($order->getEmail());

		$this->setAgbAccepted($order->getAgbAccepted());
	}


	/**
	 * @return bool
	 */
	public function isBillAddressValid() {
		if(trim($this->getFirstName())
			&& trim($this->getLastName())
			&& trim($this->getStreet())
			&& trim($this->getZip())
			&& trim($this->getCity())) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	/**
	 * @return string
	 */
	public function getInvoiceNo() {
		return 'G' . date('Y') . '-' .  sprintf('%1$05d', $this->uid);
	}


	/**
	 * @return int
	 */
	public function getGross() {
		if((int)$this->amount) {
			return $this->amount;
		}  else {
			return $this->offer->getPrice();
		}
	}


	/**
	 * @return float
	 */
	public function getNet() {
		return number_format($this->getGross() * (1/1.19),2);
	}


	/**
	 * @return float
	 */
	public function getTax() {
		$tax = (float)$this->getGross() - $this->getGross() * (1/1.19);
		return number_format($tax,2);
	}


	/**
	 * @return string
	 */
	public function getFullname() {
		return $this->firstName . ' ' . $this->lastName;
	}


	/**
	 * @return string
	 */
	public function getDocumentDirectory() {
		$basePath = PATH_site . 'fileadmin/';
		$pathToCreate = 'dl_voucher_documents/' . $this->getUUid() .'/';
		$completePath = $basePath . $pathToCreate;

		if(!is_dir($completePath)) {
			$ret = t3lib_div::mkdir_deep($basePath, $pathToCreate);

			if($ret) {
				throw new Exception($ret);
			}
		}

		return $completePath;
	}



	/**
	 * @return string
	 */
	public function getInvoicePDFPathAndFileName() {
		return $this->getDocumentDirectory() . 'Foto-Lienert-Rechnung.pdf';
	}


	/**
	 * @return string
	 */
	public function getInvoiceWebPath() {
		$path = $this->getInvoicePDFPathAndFileName();
		return substr($path, strlen(PATH_site));
	}


	/**
	 * @return string
	 */
	public function getVoucherPDFPathAndFileName() {
		return $this->getDocumentDirectory() . 'Foto-Lienert-Gutschein.pdf';
	}


	/**
	 * @return string
	 */
	public function getVoucherWebPath() {
		$path = $this->getVoucherPDFPathAndFileName();
		return substr($path, strlen(PATH_site));
	}


	/**
	 * @return string
	 */
	public function getVoucherPreviewPathAndFileName() {
		return $this->getDocumentDirectory() . 'VoucherPreview.pdf';
	}



	/**
	 * @return string
	 */
	public function getVoucherPreviewWebPath() {
		$path = $this->getVoucherPreviewPathAndFileName();
		return substr($path, strlen(PATH_site));
	}



	/**
	 * @return bool
	 */
	public function getOfferIsSelected() {
		return $this->amountType == 'offer';
	}



	/**
	 * @return bool
	 */
	public function getAmountIsSelected() {
		return $this->amountType = 'amount';
	}



	/**
	 * @param string $amountType
	 */
	public function setAmountType($amountType) {
		$this->amountType = $amountType;
	}



	/**
	 * @return string
	 */
	public function getAmountType() {
		return $this->amountType;
	}

	/**
	 * @param string $receiveVoucher
	 */
	public function setReceiveVoucher($receiveVoucher) {
		$this->receiveVoucher = $receiveVoucher;
	}

	/**
	 * @return string
	 */
	public function getReceiveVoucher() {
		return $this->receiveVoucher;
	}


	/**
	 * @return string
	 */
	public function getUUid() {
		if(!$this->uuid) {
			$this->uuid = spl_object_hash($this);
		}

		return $this->uuid;
	}



	/**
	 * @param string $uuid
	 */
	public function setUuid($uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * @param int $paymentDate
	 */
	public function setPaymentDate($paymentDate) {
		$this->paymentDate = $paymentDate;
	}

	/**
	 * @return int
	 */
	public function getPaymentDate() {
		return $this->paymentDate;
	}

	/**
	 * @param int $paymentReceived
	 */
	public function setPaymentReceived($paymentReceived) {
		$this->paymentReceived = $paymentReceived;
	}

	/**
	 * @return int
	 */
	public function getPaymentReceived() {
		return $this->paymentReceived;
	}


}
?>