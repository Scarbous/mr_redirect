<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Mr.redirect',
    'description' => '',
    'category' => 'misc',
    'author' => 'Sascha Heilmeier',
    'author_email' => 's.heilmeier@misterknister.com',
    'author_company' => '',
    'state' => 'beta',
    'clearCacheOnLoad' => 0,
    'version' => '0.4.1',
    'constraints' =>
        array(
            'depends' =>
                array(
                    'typo3' => '6.2.0-7.6.99',
                    'php' => '5.5.0-7.0.99',
                ),
            'conflicts' =>
                array(),
            'suggests' =>
                array(),
        ),
    'uploadfolder' => false,
    'createDirs' => NULL,
    'clearcacheonload' => false,
);