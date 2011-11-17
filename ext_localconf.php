<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Voucher',
	array(
		'Order' => 'new, create,step2',
		'Offer' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Order' => 'new,create,step2',
		'Offer' => 'create, update, delete',
		
	)
);

?>