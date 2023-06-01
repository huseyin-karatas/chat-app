<!DOCTYPE html>
<html lang="en">

<?php
session_start();


$baglan = new PDO("mysql:host=localhost;dbname=chatapp", 'root', 'mysql', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
if ($_SESSION['user'] == 0) {
    header('Location:login.php');
} elseif ($_SESSION['user'] == 1) {
}




?>

<head>
    <meta charset="utf-8">
    <title>Chat App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!--  BOOTSTRAP v5.2.3 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

    <!-- JQUERY DAHİL ETME OPERASYONU: -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

</head>
<style>
    body{
        background-color: #f8f8f8;
    }
</style>
<body>
    <div class="container mt-5 p-5">
        <div class="row ">
            <div class="col-sm-6 offset-sm-3 text-center bg-dark">
                <p>Name Last Name</p>
            </div>
        </div>
        <div class="row shadow shadow-4-soft rounded-3 p-3">
            <div class="col-sm-3 shadow shadow-1-soft p-3 rounded-4">
                <!-- Arama çubuğu -->
                <div class="row">
                    <div class="col-sm-3">
                        <button class="btn btn-success form-control">
                            <i class="fa fa-search text-white"></i>
                        </button>
                    </div>
                    <div class="col-sm-9 p-0 m-0">
                        <input type="text" placeholder="Search.." class="form-control">
                    </div>
                </div>

                <!-- Kişiler listelenecek: -->
                <div class="row mt-3">
                    <h5 class="border-bottom">Other Friends</h5>
                    <div class="col-sm-12">

                        <div class="d-flex align-items-start">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <?php
                                $users_sql = $baglan->query("SELECT * FROM users");
                                $users = $users_sql->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($users as $user) { ?>
                                    <button class="nav-link" id="v-pills-<?= $user['user_id'] ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?= $user['user_id'] ?>" type="button" role="tab" aria-controls="v-pills-<?= $user['user_id'] ?>" aria-selected="false">
                                        <h5>
                                            <?php echo $user['firstname'] . " " . $user['lastname']; ?>
                                        </h5>
                                    </button>
                                <? }
                                ?>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- KİŞİLERE ÖZEL İÇERİK KISMI: MESAJLAR -->
            <div class="col-sm-9 p-5 pt-0 bg-white">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php
                            $users_sql = $baglan->query("SELECT * FROM users");
                            $users = $users_sql->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($users as $user) { ?>
                                <div class="tab-pane fade" id="v-pills-<?= $user['user_id'] ?>" role="tabpanel" aria-labelledby="v-pills-<?= $user['user_id'] ?>-tab" tabindex="0">
                                    <?= $user['user_id'] ?> id'li kişinin chatbox'u
                                </div>
                            <? }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    </script>
</body>

</html>