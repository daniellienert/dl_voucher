<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Daniel Lienert <lienert@punkt.de>
*  All rights reserved
*
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 */
class Tx_DlVoucher_Domain_Pdf_VoucherCreator  {

	/**
	 * @var Tx_DlVoucher_Domain_Model_Order
	 */
	protected $order;


	/**
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager;


	/**
	 * @var Tx_Fluid_View_StandaloneView
	 */
	protected $fluidRenderer;


	/**
	 * @var string domPdf source absolute path
	 */
	protected $dompdfSourcePath;


	/**
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}


	/**
	 * @param Tx_Fluid_View_StandaloneView $fluidRenderer
	 * @return void
	 */
	public function injectFluidRenderer(Tx_Fluid_View_StandaloneView $fluidRenderer) {
		$this->fluidRenderer = $fluidRenderer;
	}


	/**
	 * @param Tx_DlVoucher_Domain_Model_Order $order
	 * @return void
	 */
	public function setOrder(Tx_DlVoucher_Domain_Model_Order $order) {
		$this->order = $order;
	}


	public function initializeObject() {
		$this->dompdfSourcePath = t3lib_div::getFileAbsFileName('EXT:pt_dompdf/Classes/dompdf');
		Tx_PtExtbase_Assertions_Assert::isTrue(is_dir($this->dompdfSourcePath), array('message' => 'DomPdf source in path ' . $this->dompdfSourcePath . ' was not found. 1322753515'));
		$this->dompdfSourcePath = substr($this->dompdfSourcePath,-1,1) == '/' ? $this->dompdfSourcePath : $this->dompdfSourcePath . '/';
	}


	/**
	 * @return void
	 */
	public function loadDomPDFClasses() {
		require_once ($this->dompdfSourcePath . 'dompdf_config.inc.php');
	}



	public function build() {

		$this->loadDomPDFClasses();
		$templatePathAndFileName = t3lib_extMgm::extPath('dl_voucher') . 'Resources/Private/Templates/Pdf/Invoice.html';

		$this->fluidRenderer->setTemplatePathAndFilename($templatePathAndFileName);
		$this->fluidRenderer->assign('order', $this->order);
		$html = $this->fluidRenderer->render();

		// die($html);

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();


		$dompdf->stream("test" . time() .'.pdf', array("Attachment" => 0));
//		$dompdf->stream("test" . time() .'.pdf');

	}


	public function send() {
		//$this->pdf->Output('Gutschein.pdf', 'D');
	}



}
?>