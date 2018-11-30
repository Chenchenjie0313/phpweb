<?php 

define('APP_SLASH', '/');
// define('WEB_APP_DEFAULT_VIEW', 'index');
define('WEB_APP_DEFAULT_VIEW', 'layout2|index');
define('WEB_APP_DEFAULT_VIEW_PATH', '/');

const SETTINGS = [
    local_database =>[
        ip => 'localhost',
        name => 'root',
        pwd => 'ccjie',
        schema => 'chen',
        charset =>'utf-8'
    ]
];


/** バージョン */
const VERSION = '1.1';
