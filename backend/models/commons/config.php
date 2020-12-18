<?php
define('ENV', 'dev');
define('DB', array(
    'dsn' => (ENV === 'dev') ? 'mysql:host=localhost;dbname=gbook_db' : '',
    'user' => (ENV === 'dev') ? 'root' : '',
    'pass' => (ENV === 'dev') ? '' : ''
));

define('APIKEY','fdmk35465%^#@)985@##cep@');

// PHP_EOL salto de linea \n