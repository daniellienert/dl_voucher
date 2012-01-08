<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_dlvoucher_domain_model_order'] = array(
	'ctrl' => $TCA['tx_dlvoucher_domain_model_order']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, info, voucher_image, from_name, to_name, amount, first_name, last_name, street, zip, city, country, email, print_amount, agb_accepted, offer',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, info, voucher_image, from_name, to_name, amount, first_name, last_name, street, zip, city, country, email, print_amount, agb_accepted, offer,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_dlvoucher_domain_model_order',
				'foreign_table_where' => 'AND tx_dlvoucher_domain_model_order.pid=###CURRENT_PID### AND tx_dlvoucher_domain_model_order.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'info' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.info',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'voucher_image' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.voucher_image',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'from_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.from_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'to_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.to_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'amount' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.amount',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'last_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'street' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.street',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.country',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'print_amount' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.print_amount',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'agb_accepted' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.agb_accepted',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),

		'receive_voucher' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.receive_voucher',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		
		'offer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.offer',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_dlvoucher_domain_model_offer',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		
		'code' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dl_voucher/Resources/Private/Language/locallang_db.xml:tx_dlvoucher_domain_model_order.code',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	),
);
?>