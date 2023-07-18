<?php
require_once('Database.php');
require_once('UserStats.php');

$db = new Database("servername", "username", "password", "dbname");

$db->connect();

$user_stats = new UserStats($db);

$user_stats->getStats('2022-10-01', '2022-10-15', 9000);

$db->close();
