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
class Tx_DlVoucher_Domain_Repository_OrderRepository extends Tx_Extbase_Persistence_Repository {


	/**
	 * Session Handling methods
	 */

	/**
	 * @var Tx_PtExtbase_State_Session_Storage_SessionAdapter
	 */
	protected $sessionHandler = NULL;


	public function __construct() {
		parent::__construct();
		// get an instance of the session handler
		$this->sessionHandler = Tx_PtExtbase_State_Session_Storage_SessionAdapter::getInstance();
	}



	/**
	 * Returns the object stored in the user´s PHP session
	 * @return Tx_DlVoucher_Domain_Model_Order the stored Object
	 */
	public function restoreFromSession() {
		$order = $this->sessionHandler->read('Tx_DlVoucher_Domain_Model_Order');
		if(is_a($order, 'Tx_DlVoucher_Domain_Model_Order')) {
			return $order;
		} else {
			return $this->objectManager->get('Tx_DlVoucher_Domain_Model_Order');
		}
	}



	/**
	 * @param Tx_DlVoucher_Domain_Model_Order $order
	 * @return Tx_DlVoucher_Domain_Repository_OrderRepository
	 */
	public function persistToSession(Tx_DlVoucher_Domain_Model_Order $order) {
		$this->sessionHandler->store('Tx_DlVoucher_Domain_Model_Order', $order);
		return $this;
	}



	/**
	 * Cleans up the session: removes the stored object from the PHP session
	 * @return	Tx_MyExt_Domain_Repository_ObjectRepository this
	 */
	public function cleanUpSession() {
		$this->sessionHandler->delete('Tx_DlVoucher_Domain_Model_Order');
		return $this;
	}
}
?>