<?php

include "registration-form-handler.php";

$dsn = "mysql:host=localhost;dbname=pdc10_db";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);

$result = Registration::handleUpload($_FILES['picture_path']);

if ($result !== FALSE) {

    $obj = new Registration($_POST['complete_name'], $_POST['email'], $_POST['password'],$result['path'] );
	$result = $obj->save();

	header('Location: index.php?success=1');

} else {

	header('Location: index.php?error=' . $e->getMessage());

}