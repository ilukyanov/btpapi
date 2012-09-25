#!/usr/bin/php
<?php

include "../src/BtpApi/Connection.php";
include "../src/BtpApi/Request.php";
include "../src/BtpApi/Counter.php";
include "../src/BtpApi/Settings.php";

use \BtpApi\Request;
use \BtpApi\Connection;
use \BtpApi\Counter;
use \BtpApi\Settings;

if (count($argv)<5) die("usage: put.php SERVICE SERVER OP TIME\n");

$req = Request::getLast();
$counter = new Counter($req, array(
	'ts' => floatval($argv[4]),
	'srv' => $argv[2],
	'service' => $argv[1],
	'op' => $argv[3],
));
