<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:mr_redirect/Resources/Private/Language/locallang_db.xlf:tx_mrredirect_domain_model_log',
		'label' => 'request_uri',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'dividers2tabs' => TRUE,

		'searchFields' => 'type,request_uri,target,log_data,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('mr_redirect') . 'Resources/Public/Icons/tx_mrredirect_domain_model_log.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'type, request_uri, target, log_data, tstamp',
	),
	'types' => array(
		'1' => array('showitem' => 'type, request_uri, target, log_data, tstamp'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
        'tstamp' => array(
            'label' => 'tstamp',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'datetime',
                'readOnly' => 1,
            ),
        ),
		'type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mr_redirect/Resources/Private/Language/locallang_db.xlf:tx_mrredirect_domain_model_log.type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
                'readOnly' =>1,
			),
		),
		'request_uri' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mr_redirect/Resources/Private/Language/locallang_db.xlf:tx_mrredirect_domain_model_log.request_uri',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
                'readOnly' =>1,
			),
		),
		'target' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mr_redirect/Resources/Private/Language/locallang_db.xlf:tx_mrredirect_domain_model_log.target',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
                'readOnly' =>1,
			),
		),
		'log_data' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mr_redirect/Resources/Private/Language/locallang_db.xlf:tx_mrredirect_domain_model_log.log_data',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
                'readOnly' =>1,
			)
		),
		
	),
);