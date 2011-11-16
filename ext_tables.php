<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Voucher',
	'Voucher'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . voucher;
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .voucher. '.xml');






t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Order a Voucher');


t3lib_extMgm::addLLrefForTCAdescr('tx_dlvoucher_domain_model_order', 'EXT:dl_voucher/Resources/Private/Language/locallang_csh_tx_dlvoucher_domain_model_order.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_dlvoucher_domain_model_order');
$TCA['tx_dlvoucher_domain_model_order'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order',
		'label' => 'info',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Order.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dlvoucher_domain_model_order.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_dlvoucher_domain_model_offer', 'EXT:dl_voucher/Resources/Private/Language/locallang_csh_tx_dlvoucher_domain_model_offer.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_dlvoucher_domain_model_offer');
$TCA['tx_dlvoucher_domain_model_offer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_offer',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Offer.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dlvoucher_domain_model_offer.gif'
	),
);

?>