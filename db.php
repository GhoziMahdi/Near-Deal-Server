<?php
require_once('vendor/autoload.php');
require_once('config.php');

$db = new MysqliDb (DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
