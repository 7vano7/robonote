<?php
$servername = 'localhost';
$bdName = 'test_robo';
$username = 'vano';
$password = 'cnfhjcnf2007';

try {
  		$mysql = new mysqli($servername, $username, $password, $bdName);
	} catch(PDOException $e) {
  		echo "Connection failed: " . $e->getMessage();
	}
