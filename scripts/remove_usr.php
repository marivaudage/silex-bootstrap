<?php
include('./bootstrap.php');
use Model\Tweet;
use Model\Following;

$screen_name = "Taylorkinney1";
$sql = "SELECT user_id FROM election_following WHERE screen_name = '$screen_name'";
$users = $app['db']->fetchAll($sql);
if(count($users) > 0) {
	$user = current($users);
	echo "User " . $user->name . " found\n";

	// $sql = "DELETE FROM 

}