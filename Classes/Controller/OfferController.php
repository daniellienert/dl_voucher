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
class Tx_DlVoucher_Controller_OfferController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * offerRepository
	 *
	 * @var Tx_DlVoucher_Domain_Repository_OfferRepository
	 */
	protected $offerRepository;



	/**
	 * injectOfferRepository
	 *
	 * @param Tx_DlVoucher_Domain_Repository_OfferRepository $offerRepository
	 * @return void
	 */
	public function injectOfferRepository(Tx_DlVoucher_Domain_Repository_OfferRepository $offerRepository) {
		$this->offerRepository = $offerRepository;
	}


	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$offers = $this->offerRepository->findAll();
		$this->view->assign('offers', $offers);
	}

	/**
	 * action show
	 *
	 * @param $offer
	 * @return void
	 */
	public function showAction(Tx_DlVoucher_Domain_Model_Offer $offer) {
		$this->view->assign('offer', $offer);
	}

	/**
	 * action new
	 *
	 * @param $newOffer
	 * @dontvalidate $newOffer
	 * @return void
	 */
	public function newAction(Tx_DlVoucher_Domain_Model_Offer $newOffer = NULL) {

		$this->view->assign('newOffer', $newOffer);
	}

	/**
	 * action create
	 *
	 * @param $newOffer
	 * @return void
	 */
	public function createAction(Tx_DlVoucher_Domain_Model_Offer $newOffer) {
		$this->offerRepository->add($newOffer);
		$this->flashMessageContainer->add('Your new Offer was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $offer
	 * @return void
	 */
	public function editAction(Tx_DlVoucher_Domain_Model_Offer $offer) {
		$this->view->assign('offer', $offer);
	}

	/**
	 * action update
	 *
	 * @param $offer
	 * @return void
	 */
	public function updateAction(Tx_DlVoucher_Domain_Model_Offer $offer) {
		$this->offerRepository->update($offer);
		$this->flashMessageContainer->add('Your Offer was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $offer
	 * @return void
	 */
	public function deleteAction(Tx_DlVoucher_Domain_Model_Offer $offer) {
		$this->offerRepository->remove($offer);
		$this->flashMessageContainer->add('Your Offer was removed.');
		$this->redirect('list');
	}

}
?>