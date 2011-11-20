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
 * Test case for class Tx_DlVoucher_Domain_Model_Order.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Order a Voucher
 *
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_DlVoucher_Domain_Model_OrderTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_DlVoucher_Domain_Model_Order
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_DlVoucher_Domain_Model_Order();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getInfoReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setInfoForStringSetsInfo() { 
		$this->fixture->setInfo('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getInfo()
		);
	}
	
	/**
	 * @test
	 */
	public function getVoucherImageReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getVoucherImage()
		);
	}

	/**
	 * @test
	 */
	public function setVoucherImageForIntegerSetsVoucherImage() { 
		$this->fixture->setVoucherImage(12);

		$this->assertSame(
			12,
			$this->fixture->getVoucherImage()
		);
	}
	
	/**
	 * @test
	 */
	public function getFromNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFromNameForStringSetsFromName() { 
		$this->fixture->setFromName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFromName()
		);
	}
	
	/**
	 * @test
	 */
	public function getToNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setToNameForStringSetsToName() { 
		$this->fixture->setToName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getToName()
		);
	}
	
	/**
	 * @test
	 */
	public function getAmountReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getAmount()
		);
	}

	/**
	 * @test
	 */
	public function setAmountForIntegerSetsAmount() { 
		$this->fixture->setAmount(12);

		$this->assertSame(
			12,
			$this->fixture->getAmount()
		);
	}
	
	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() { 
		$this->fixture->setFirstName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFirstName()
		);
	}
	
	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForIntegerSetsLastName() { 
		$this->fixture->setLastName(12);

		$this->assertSame(
			12,
			$this->fixture->getLastName()
		);
	}
	
	/**
	 * @test
	 */
	public function getStreetReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStreetForStringSetsStreet() { 
		$this->fixture->setStreet('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getStreet()
		);
	}
	
	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() { 
		$this->fixture->setZip('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getZip()
		);
	}
	
	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() { 
		$this->fixture->setCity('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCity()
		);
	}
	
	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCountryForStringSetsCountry() { 
		$this->fixture->setCountry('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCountry()
		);
	}
	
	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() { 
		$this->fixture->setEmail('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getEmail()
		);
	}
	
	/**
	 * @test
	 */
	public function getOfferReturnsInitialValueForTx_DlVoucher_Domain_Model_Offer() { }

	/**
	 * @test
	 */
	public function setOfferForTx_DlVoucher_Domain_Model_OfferSetsOffer() { }
	
}
?>