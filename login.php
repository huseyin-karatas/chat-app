<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('connect.php');

$message = '';

?>

<head>
    <title>
        Log in - Register
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  BOOTSTRAP v5.2.3 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />





    <?php

    if (isset($_POST['login'])) {
        $_SESSION['user'] = 1;

        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_pass'];

        $kontrol = $baglan->query("SELECT * FROM users WHERE username='$login_username' AND password='$login_password' ");
        $son_kontrol = $kontrol->fetchAll(PDO::FETCH_ASSOC);
        if ($son_kontrol) {
            $q= $baglan->query("SELECT * FROM users WHERE username='$login_username' AND password='$login_password'");
            $d = $q->fetch(PDO::FETCH_ASSOC);
            header('Location: home?user_id='. $d['user_id'] .'');
        }
    }
    ?>
</head>

<body>

    <div class="container mt-5">
        <div class="row ">
            <div class="col-sm-4 offset-sm-4 pt-1 text-white bg-primary rounded-top text-center ">
                <h5>Log In</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-3 shadow shadow-3-soft rounded-3 p-4 ">
                <?php
                if (isset($son_kontrol)) {
                    if (!$son_kontrol) { ?>
                        <div class="row mt-3">
                            <div class="col-sm-6 offset-sm-3 alert alert-danger text-center">
                                <h6>Wrong username or password</h6>
                            </div>
                        </div>
                <?
                    }
                }
                ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <input type="text" name="login_username" required placeholder="Username*" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <input type="password" name="login_pass" required placeholder="Password*" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <?php 
                           
                            ?>
                            <button class="btn btn-success form-control" type="submit" name="login">
                                Log in
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-outline-primary form-control" href="sign-in">
                                Sign in
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>