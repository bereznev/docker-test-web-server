<?php

if (!extension_loaded('pdo')) {
	fwrite(STDERR, 'PDO MySQL is required'); exit(1);
}

$db = new PDO('pgsql:host=postgres;dbname=dbname', 'dev', 'qweqwe');
