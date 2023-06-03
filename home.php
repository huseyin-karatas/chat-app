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

        <div class="row shadow shadow-4-soft rounded-3 p-3">
            <div id="user_details" class="col-sm-12">

            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="user_modal_details" tabindex="-1" aria-hidden="true">

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

            /* modal divi açıldı */
            var modal_content = '<div class="user_dialog modal-dialog"  title="You have chat with' + to_user_name + '" ';

            /* modal dialog > modal content > modal-body divleri açıldı. */
            modal_content += '<div class="modal-content"  > <div class="modal-body"> ';


            /* Chat kısmı burada. Modal-body kapatıldı. */
            modal_content += ' <div class="row"><div class="col-sm-12"><div style="height:500px; width:100%" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '"> </div> </div></div> </div>';

            /* Mesja gönderme input kısmı. Modal-footer'da. Modal-footer da kapatıldı, modal-body de. Modal-content de.*/
            modal_content += '<div class="modal-footer"><div class="form-group"><div class="row"><div class="col-sm-9"> <textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control" ></textarea></div> <div class="col-sm-3"><button class="btn btn-success form-control" type="button" name="send_chat" id="' + to_user_id + '">Send</button></div> </div> </div> </div></div></div>';

            $('$user_modal_details').html(modal_content);

        }

        $(document).on('click', '.start_chat', function() {
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);


            $('#user_dialog_' + to_user_id).dialog({
                autoOpen: false,
                width: 400
            });

            $('#user_dialog_' + to_user_id).dialog('open');
        });


    });
</script>



</html>