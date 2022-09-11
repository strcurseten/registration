<?php

include "upload-handler.php";

$dsn = "mysql:host=localhost;dbname=pdc10_db";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);

$result = Registration::handleUpload($_FILES['picture_path']);
$encrypt_pwd = Registration::encryptPass($_POST['password']);

if ($result !== FALSE) {

    $obj = new Registration($_POST['complete_name'], $_POST['email'], $encrypt_pwd['password'],$result['path'] );
	$result = $obj->save();

	?>

	<div class="alert alert-success" role="alert">
        Your file was successfully uploaded
    </div>

<?php

} else { 

?>

	<div class="alert alert-danger" role="alert">
        Unable to upload your file
    </div>

<?php
} 
?>

<html>
    <title></title>
    <head> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>

    <body>
        <div class="container">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Complete Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Picture</th>
				<th scope="col">Registered Time</th>
              </tr>
            </thead>

            <tbody>
            <?php
              $registrations = Registration::retrieveRegistration();
              foreach($registrations as $reg_data) {
			?>
            
              <tr>
                <th scope="row"><?php echo $reg_data['id']; ?></th>
                <td><?php echo $reg_data['complete_name']; ?></td>
                <td><?php echo $reg_data['email']; ?></td>
                <td><?php echo $reg_data['password']; ?></td>
                <td><?php echo "<img width:10px; height:5px; src=" . $reg_data['picture_path'] . ">"; ?></td>
				<td><?php echo $reg_data['registered_at']; ?></td>
              </tr>

              <?php } ?> 

            </tbody>
          </table>
        </div>
    </body>
</html>
