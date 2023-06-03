<?php
include('connect.php');

session_start();

$query = "SELECT * FROM users WHERE user_id !='" . $_SESSION['user_id'] . "'";

$statement = $baglan->prepare($query);
$statement->execute();

$result = $statement->fetchAll();




$output = ' <table class="table  table-striped">
  <thead>
    <tr>
      <th scope="col" class="text-center">Users</th>
      <th scope="col" class="text-center">Status</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>';
date_default_timezone_set('Turkey');
foreach ($result as $row) {
  $status = '';
  $current_timestamp = strtotime(date('Y-m-d h:i:s') . '-600 second');

  $current_timestamp = date('Y-m-d h:i:s', $current_timestamp);


  $user_last_activity  = fetch_user_last_activity($row['user_id'], $baglan);

  /*   echo "user last activity: " . $user_last_activity;
  echo "<br><br>";
  echo "current timestampt: " . $current_timestamp; */
  if ($user_last_activity > $current_timestamp) {
    $status = '  <button class="btn btn-success form-control">
    Online
  </button>';
  } else {
    $status = '  <button class="btn btn-outline-danger form-control">
    Offline
  </button>';
  }

  $output .= '
    <tbody>
    <tr>
      <td class="text-center">' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
      <td> <div class="row"><div class="col-sm-6 offset-sm-3"> ' . $status . ' </div></div> </td>
      <td>

      <div class="row"><div class="col-sm-6 offset-sm-3">
      <button type="button" class="btn btn-primary form-control start_chat" data-touserid="' . $row['user_id'] . '" data-tousername=" ' . $row['firstname'] . " " . $row['lastname'] . ' ">Start Chat</button>
      </div></div>
     

       
      </td>
    </tr>
    ';
}

$output .= ' </tbody> </table>';

echo $output;

/* <button type="button" class="btn btn-primary start_chat" data-bs-toggle="modal" data-bs-target="#user_dialog_' . $row['user_id'] . '" data-touserid="' . $row['user_id'] . '" data-tousername="' . $row['username'] . '">
Start Chat
</button> */