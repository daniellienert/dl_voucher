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
class Tx_DlVoucher_Controller_OrderAdminController extends Tx_PtExtbase_Controller_AbstractActionController {

	/**
	 * orderRepository
	 * @var Tx_DlVoucher_Domain_Repository_OrderRepository
	 */
	protected $orderRepository;


	/**
	 * @param Tx_DlVoucher_Domain_Repository_OrderRepository $orderRepository
	 */
	public function injectOrderRepository(Tx_DlVoucher_Domain_Repository_OrderRepository $orderRepository) {
		$this->orderRepository = $orderRepository;
	}


	public function showListAction() {
		$this->objectManager->get('Tx_PtExtlist_Extbase_ExtbaseContext')->setControllerContext($this->controllerContext);
		$context = Tx_PtExtlist_ExtlistContext_ExtlistContextFactory::getContextByListIdentifier('voucherAdmin');
		$listTemplateParts = $context->getAllListTemplateParts();

		$this->view->assignMultiple($listTemplateParts);
	}


	/**
	 * @param int $voucherUid
	 */
	public function markAsPaidAction($voucherUid) {
		$voucher = $this->orderRepository->findByUid($voucherUid); /** @var Tx_DlVoucher_Domain_Model_Order $voucher */

		if($voucher instanceof Tx_DlVoucher_Domain_Model_Order) {
			$voucher->setPaymentReceived(1);
			$voucher->setPaymentDate(time());
			$this->orderRepository->update($voucher);
		}


		$this->redirect('showList');
	}


	/**
	 * @param int $voucherUid
	 */
	public function markAsUnPaidAction($voucherUid) {
		$voucher = $this->orderRepository->findByUid($voucherUid); /** @var Tx_DlVoucher_Domain_Model_Order $voucher */

		if($voucher instanceof Tx_DlVoucher_Domain_Model_Order) {
			$voucher->setPaymentReceived(0);
			$voucher->setPaymentDate(0);
			$this->orderRepository->update($voucher);
		}


		$this->redirect('showList');
	}
}
?>