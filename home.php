<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('connect.php');

$user_id = $_GET['user_id'];
$_SESSION['user_id'] = $_GET['user_id'];

$u_q = $baglan->query("SELECT * FROM users WHERE user_id = '$user_id' ");
$user = $u_q->fetch(PDO::FETCH_ASSOC);


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

</head>
<style>
    body {
        background-color: #f8f8f8;
    }
</style>

<body>
    <div class="container mt-5 p-5">
        <div class="row mb-4">
            <div class="col-sm-6 text-center">
                <p>Welcome, <strong><?php echo $user['firstname'] . " " . $user['lastname']; ?></strong></p>
            </div>
            <div class="col-sm-6 text-center">
                <a class="btn btn-danger" href="logout">
                    Log out
                </a>
            </div>
        </div>

        <div class="row  ">
            <div id="user_details" class="col-sm-12 shadow shadow-4-soft rounded-3 p-0">

            </div>
        </div>



        <!-- Modal -->

        <div class="row mt-5 ">
            <div class="col-sm-8 offset-sm-2" id="user_model_details">

            </div>
        </div>




    </div>


</body>
<!-- JQUERY DAHİL ETME OPERASYONU: -->
<script src="js/jquery-3.7.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {


        fetch_user();
        setInterval(function() {
            update_last_activity();
            fetch_user();
        }, 1000);

        function fetch_user() {
            $.ajax({
                url: "fetch-user.php",
                method: "POST",
                success: function(data) {
                    $('#user_details').html(data);
                }
            })
        }

        function update_last_activity() {
            $.ajax({
                url: "update-last-activity.php",
                success: function() {

                }
            })
        }

        function make_chat_dialog_box(to_user_id, to_user_name) {
            var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog shadow shadow-4-soft rounded-3 p-3" >';
            modal_content += '<div class="modal-header"><h3> <i class="fas fa-comments-alt fa-2x"></i> You have chat with <strong class="mark">' + to_user_name + '</strong></h3></div> <div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-success mt-3 send_chat">Send</button></div></div>';
            $('#user_model_details').html(modal_content);
        }

        $(document).on('click', '.start_chat', function() {
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);
            $("#user_dialog_" + to_user_id).dialog({
                autoOpen: false,
                width: 400
            });
            $('#user_dialog_' + to_user_id).dialog('open');
        });

        $(document).on('click', '.send_chat', function() {
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_' + to_user_id).val();
            $.ajax({
                url: "insert_chat.php",
                method: "POST",
                data: {
                    to_user_id: to_user_id,
                    chat_message: chat_message
                },
                success: function(data) {
                    $('#chat_message_' + to_user_id).val('');
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        });


    });
</script>



</html>