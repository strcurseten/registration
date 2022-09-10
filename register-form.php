<html>
    <title>Registration Form</title>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="w-75 p-3">
            <h1>Registration Form</h1>
            <form action="upload-handler.php" enctype="multipart/form-data" method="POST">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Complete Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="complete_name" name="complete_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="picture" class="col-sm-2 col-form-label">Picture</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" id="picture_path" name="picture_path">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit Registration</button>
                </div>
            </form>
        </div>
    </body>
</html>