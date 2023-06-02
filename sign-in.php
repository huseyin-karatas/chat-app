!
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('connect.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!--  BOOTSTRAP v5.2.3 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />




    <title>
        Register
    </title>

    <?php

    if (isset($_POST['signin'])) {
        $_SESSION['user'] = 1;
        $new_user_id = uniqid();
        $new_user_firstname = $_POST['signin_firstname'];
        $new_user_lastname = $_POST['signin_lastname'];
        $new_user_username = $_POST['signin_username'];
        $new_user_email = $_POST['signin_email'];
        $new_user_password = $_POST['signin_pass'];

        $add_user = $baglan->query("INSERT INTO users (user_id, username, password, firstname, lastname, email) 
        VALUES ('$new_user_id','$new_user_username','$new_user_password','$new_user_firstname','$new_user_lastname','$new_user_email') ");


        if ($add_user) {
            header('Location: home?user_id='. $new_user_id .'');
        }
    }

    ?>
</head>

<body>

    <div class="container mt-5">
        <div class="row ">
            <div class="col-sm-4 offset-sm-4 pt-1 text-white bg-danger rounded-top text-center ">
                <h5>Sign In</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-3 shadow shadow-3-soft rounded-3 p-5 pt-0">
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="row mt-3">
                            <div class="col-sm-10 offset-sm-1">
                                <input type="text" name="signin_firstname" placeholder="First Name*" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-10 offset-sm-1">
                                <input type="text" name="signin_lastname" placeholder="Last Name*" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-10 offset-sm-1">
                                <input type="text" name="signin_username" placeholder="Username*" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-10 offset-sm-1">
                                <input type="text" name="signin_email" placeholder="E-mail*" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-10 offset-sm-1">
                                <input type="password" name="signin_pass" placeholder="Password*" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <button class="btn btn-success form-control" type="submit" name="signin">
                                Sign in
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-outline-primary form-control" href="login">
                                Log in
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>