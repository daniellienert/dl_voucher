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
class Tx_DlVoucher_Controller_OrderController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * orderRepository
	 *
	 * @var Tx_DlVoucher_Domain_Repository_OrderRepository
	 */
	protected $orderRepository;


	/**
	 * @var Tx_DlVoucher_Domain_Repository_OfferRepository
	 */
	protected $offerRepository;


	/**
	 * @var Tx_Yag_Domain_Repository_AlbumRepository
	 */
	protected $albumRepository;



	/**
	 * @param Tx_Yag_Domain_Repository_AlbumRepository $albumRepository
	 * @return void
	 */
	public function injectAlbumRepository(Tx_Yag_Domain_Repository_AlbumRepository $albumRepository) {
		$this->albumRepository = $albumRepository;
	}


	/**
	 * injectOrderRepository
	 *
	 * @param Tx_DlVoucher_Domain_Repository_OrderRepository $orderRepository
	 * @return void
	 */
	public function injectOrderRepository(Tx_DlVoucher_Domain_Repository_OrderRepository $orderRepository) {
		$this->orderRepository = $orderRepository;
	}


	/**
	 * @param Tx_DlVoucher_Domain_Repository_OfferRepository $offerRepository
	 * @return void
	 */
	public function injectOfferRepository(Tx_DlVoucher_Domain_Repository_OfferRepository $offerRepository) {
		$this->offerRepository = $offerRepository;
	}



	/**
	 * @return void
	 */
	public function initializeAction() {
		$this->objectManager->get('Tx_Yag_Utility_Bootstrap')->setTheme('dlVoucher')->boot();
	}



	/**
	 * action new
	 *
	 * @param Tx_DlVoucher_Domain_Model_Order $order
	 * @dontvalidate $order
	 * @return void
	 */
	public function voucherAction(Tx_DlVoucher_Domain_Model_Order $order = NULL) {

		$voucherAlbum = $this->albumRepository->findByUid((int) $this->settings['voucherImageAlbum']); /** @var $voucherAlbum Tx_Yag_Domain_Model_Album */

		if($order == NULL) {

			$order = $this->orderRepository->restoreFromSession();

			if($order === NULL) {
				$order = $this->objectManager->get('Tx_DlVoucher_Domain_Model_Order');
				$order->setVoucherImage($voucherAlbum->getItems()->current()->getUid());
				$order->init();
				$this->orderRepository->persistToSession($order);
			}
		}

		$this->view->assign('offers', $this->offerRepository->findAll());
		$this->view->assign('voucherAlbum', $voucherAlbum);

		$this->view->assign('order', $order);
	}



	/**
	 * @param null|Tx_DlVoucher_Domain_Model_Order $order
	 */
	public function saveVoucherAction(Tx_DlVoucher_Domain_Model_Order $order = NULL) {

		$sessionOrder = $this->orderRepository->restoreFromSession();
		if(!$sessionOrder instanceof Tx_DlVoucher_Domain_Model_Order) $sessionOrder = $this->objectManager->get('Tx_DlVoucher_Domain_Model_Order');

		$sessionOrder->setVoucherValuesFromOrder($order);
		$this->orderRepository->persistToSession($sessionOrder);

		$this->forward('billing');
	}



	/**
	 * show the billing form
	 */
	public function billingAction() {

		$sessionOrder = $this->orderRepository->restoreFromSession();
		$this->view->assign('order', $sessionOrder);
	}


	public function  saveBillingAction(Tx_DlVoucher_Domain_Model_Order $order) {

		$sessionOrder = $this->orderRepository->restoreFromSession();
		$sessionOrder->setBillingValuesFromOrder($order);
		$this->orderRepository->persistToSession($sessionOrder);

		$emailValidator = $this->objectManager->get('Tx_Extbase_Validation_Validator_EmailAddressValidator'); /** @var Tx_Extbase_Validation_Validator_EmailAddressValidator $emailValidator  */

		if(!$order->isBillAddressValid()) {
			$this->flashMessageContainer->add('Bitte füllen Sie alle Rechnungsdaten-Felder aus.', '', t3lib_FlashMessage::ERROR);
			$this->forward('billing');
		}

		if(!$emailValidator->isValid($order->getEmail())) {
			$this->flashMessageContainer->add('Bitte geben Sie eine korrekte e-Mail Adresse an.', '', t3lib_FlashMessage::ERROR);
			$this->forward('billing');
		}

		if(!$order->isAgbAccepted()) {
			$this->flashMessageContainer->add('Bitte akzeptieren Sie unsere AGBs.', '', t3lib_FlashMessage::ERROR);
			$this->forward('billing');
		}

		$this->forward('overview');
	}


	/**
	 * Overview
	 */
	public function overviewAction() {
		$order = $this->orderRepository->restoreFromSession();
		$voucherYAGImage = $this->objectManager->get('Tx_Yag_Domain_Repository_ItemRepository')->findByUid($order->getVoucherImage());
		$order->setVoucherYAGImage($voucherYAGImage);

		$documentCreator = $this->objectManager->get('Tx_DlVoucher_Domain_Pdf_DocumentCreator'); /** @var $documentCreator Tx_DlVoucher_Domain_Pdf_DocumentCreator */
		$documentCreator->setOrder($order);
		$documentCreator->buildVoucherPreview();

		$this->view->assign('order', $order);
	}


	
	/**
	 * action create
	 *
	 * @return void
	 */
	public function createAction() {
		$order = $this->orderRepository->restoreFromSession();
		$this->orderRepository->add($order);

		$this->objectManager->get('Tx_Extbase_Persistence_ManagerInterface')->persistAll();

		$documentCreator = $this->objectManager->get('Tx_DlVoucher_Domain_Pdf_DocumentCreator'); /** @var $documentCreator Tx_DlVoucher_Domain_Pdf_DocumentCreator */
		$documentCreator->setOrder($order);
		$documentCreator->build();

		$this->sendMail($order, 'Company');
		$this->sendMail($order, 'Customer');

		$this->redirect('exit');
	}


	/**
	 * Show an overview
	 */
	public function exitAction() {

		$order = $this->orderRepository->restoreFromSession();

		if($order instanceof Tx_DlVoucher_Domain_Model_Order) {
			$this->view->assign('order', $order);
			$this->orderRepository->cleanUpSession();
		} else {
			$this->forward('voucher');
		}

	}


	/**
	 * @param Tx_DlVoucher_Domain_Model_Order $order
	 * @param string $for Company / Customer
	 */
	protected function sendMail(Tx_DlVoucher_Domain_Model_Order $order, $for) {

		$fluidRenderer = $this->objectManager->get('Tx_Fluid_View_StandaloneView'); /** @var Tx_Fluid_View_StandaloneView $fluidRenderer */
		$fluidRenderer->assign('order', $order);
		$templatePathAndFileName = sprintf(t3lib_extMgm::extPath('dl_voucher') . 'Resources/Private/Templates/Mail/%s.html', $for);
		$fluidRenderer->setTemplatePathAndFilename($templatePathAndFileName);
		$mailText = $fluidRenderer->render();

		$mail = t3lib_div::makeInstance('t3lib_mail_Message'); /** @var $mail t3lib_mail_Message */
		$mail->setFrom('gutschein@foto-lienert.de', 'Foto Lienert Gutscheine');

		if($for == 'Company') {
			$mail->setSubject('Neue Gutscheinbestellung');
			$mail->setTo(array('gutschein@foto-lienert.de' => 'Foto Lienert Gutscheine'));
			$mail->attach(Swift_Attachment::fromPath($order->getVoucherPDFPathAndFileName())->setFilename('Gutschein.pdf'));
		} else {
			$mail->setSubject('Ihr Gutschein von Foto Lienert');
			$mail->setTo(array($order->getEmail() => $order->getFullName()));

			if($order->getReceiveVoucher() == 'print') {
				$mail->attach(Swift_Attachment::fromPath($order->getVoucherPDFPathAndFileName())->setFilename('Gutschein.pdf'));
			}
		}

		$mail->setBody($mailText);
		$mail->attach(Swift_Attachment::fromPath($order->getInvoicePDFPathAndFileName())->setFilename('Rechnung.pdf'));

		$mail->send();
	}
}
?>