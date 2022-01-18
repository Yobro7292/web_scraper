<?php
ini_set('max_execution_time', '2400');
set_time_limit(2400);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scraping";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  for($i=1;$i<=5871;$i++){

      $sql = "SELECT `body` FROM `products` WHERE `id` = ".$i;
          $result = mysqli_query($conn, $sql);
          $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
         
          if(!empty($data['body']))
          {

              $a = str_replace("	","",$data['body']);
              $a = str_replace("    ","",$a);
              $a = str_replace("<small>","<h3>",$a);
              $a = str_replace("</small>","</h3>",$a);
              $a = str_replace("Key Features","<h3>Key Features</h3>",$a);
              $a = str_replace("Information &amp; Materials","<h3>Information &amp; Materials</h3>",$a);
              
              $sql = "UPDATE `products` SET `body`='".$a."' WHERE `id` = ".$i;
                $result = mysqli_query($conn, $sql);
          }

         
         
  }
    mysqli_close($conn);
?>



