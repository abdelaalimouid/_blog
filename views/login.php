

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Login</h2>
                <form action="../controllers/auth.php" method="post"> 
                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="form2Example1" class="form-control" />
                        <label class="form-label" for="form2Example1">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example2" class="form-control" />
                        <label class="form-label" for="form2Example2">Password</label>
                    </div>

                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                <label class="form-check-label" for="form2Example31"> Remember me </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-4" name="login">Log in</button> <!-- Changed type to "submit" -->

                    <div class="text-center">
                        <p>Not a member? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
