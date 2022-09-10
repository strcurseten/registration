<?php

class Registration
{
	protected $id;
	protected $complete_name;
	protected $email;
	protected $password;
	protected $picture_path;

	const TYPE_IMAGE = 'image';

	const DIRECTORY_IMAGES = 'images/';

	public function __construct(
		$complete_name,
        $email,
        $password,
		$picture_path,
	)

	{
		$this->complete_name = $complete_name;
		$this->email = $email;
		$this->password = $password;
        $this->picture_path = $picture_path;
	}

	public function getName()
	{
		return $this->complete_name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}

    public function getPath()
	{
		return $this->picture_path;
	}

	public function save()
	{
		global $pdo;
		try {

			$sql = "INSERT INTO registrations SET complete_name=:complete_name, email=:email, password=:password, picture_path=:picture_path";
			$statement = $pdo->prepare($sql);

			return $statement->execute([
				':complete_name' => $this->getName(),
				':email' => $this->getEmail(),
				':password' => $this->getPassword(),
        ':picture_path' => $this->getPath()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public static function handleUpload($obj)
	{
		try {

			$check = getimagesize($obj['tmp_name']);
			if ($check !== false) {
				$target_dir = $base_dir . static::DIRECTORY_IMAGES;
			}

			if (is_uploaded_file($obj['tmp_name'])) {
				$target_file_path = $target_dir . $obj['name'];
				if (move_uploaded_file($obj['tmp_name'], $target_file_path)) {
					if (strpos($target_file_path, static::DIRECTORY_IMAGES)) {
						$file_type = static::TYPE_IMAGE;
					}
					return [
						'path' => $target_file_path
					];
				}
			}
		} catch (Exception $e) {
			error_log($e->getMessage());
			return false;
		}
	}

  public static function retrieveRegistration(){
		global $pdo;
			$sql_statement = $pdo->prepare(
				"SELECT * from registrations");

			$sql_statement->execute();
			$registrations = $sql_statement->fetchAll();
			
			return $registrations;
	}
}

?>

<html>
    <title></title>
    <head> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></head>
    <body>
        <?php 
        $success = $_GET['success'] ?? null;
        $error = $_GET['error'] ?? null;
        ?> 

        <?php if (!is_null($success)): ?>
          <div class="alert alert-success" role="alert">
            Your file was successfully uploaded
          </div>
        <?php endif ?>

        <?php if (!is_null($error)): ?>
          <div class="alert alert-danger" role="alert">
            Unable to upload your file
          </div>
        <?php endif ?>

        <div class="container">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Complete Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Picture</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $registrations = Registration::retrieveRegistration();
              foreach($registration as $reg_data)?>
            
              <tr>
                <th scope="row"><?php echo $reg_data['id'] ?></th>
                <td><?php echo $reg_data['complete_name'] ?></td>
                <td><?php echo $reg_data['email'] ?></td>
                <td><?php echo $reg_data['pasword'] ?></td>
                <td><?php echo $reg_data['picture_path'] ?></td>
              </tr>

              <?php ; ?> 

            </tbody>
          </table>
        </div>
    </body>
</html>
