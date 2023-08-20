<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' =>'127.0.0.1',
    'port' => 3307,
    'dbname' => 'expense_tracker'
], 'expense_tracker', 'password');

$sqlFile = file_get_contents("./db/database.sql");

$db->query($sqlFile);

