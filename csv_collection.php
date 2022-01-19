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
 
   
  $p_barcode = '';

  $p_collection = "";
  
  $count= 0;
  $filename = "Products_collection.csv";
  $heading = [['id', 'handle', 'title', 'collection']];
  $d =[];

  $f = fopen($filename, 'w');
  if ($f === false) {
	die('Error opening the file ' . $filename);
}



  for($i=0;$i<=5871;$i++)
  {
    $sql = "SELECT * FROM `products` WHERE `id` = ".$i;
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

   
      if (!empty($data['collection']))
      {
          
        if($data['collection'] != 'All Living Room' && $data['collection'] != 'All Bedroom' && $data['collection'] != 'All Dining Room' && $data['collection'] != 'All Home Office' && $data['collection'] != 'Sofas') 
              {

                  // echo "<hr> <br>";
                  echo "<br> Handle : ".$data['sku']."-".$data['handle']."<br>";
                  // echo "<br> Title : ".$data['title']."<br>";
                  // echo "<br> SKU : ".$data['sku']."<br>";
                  // echo "<br> Barcode : ".$data['barcode']."<br>";
                  // echo "<br> Price : ".$data['price']."<br>";
                  echo "<br> Collection : ".$data['collection']."<br>";
                  // echo "<br> Img SRC : ".$data['img_src']."<br>";
                  array_push($d, $data);
                  $count++;
              }
              $p_collection = $data['collection']; 
          
          
      }
     
      
    }
      foreach($heading as $row)
        fputcsv($f, $row);
    foreach($d as $row)
    {
        if($row['collection'] != 'All Living Room' || $row['collection'] != 'All Bedroom' || $row['collection'] != 'All Dining Room' || $row['collection'] != 'All Home Office' || $row['collection'] != 'Sofas') 
        {
            
            if(!empty($row['sku']))
              $sku = $row['sku'];
        
            $row['handle'] = $sku.'-'.$row['handle'];
            fputcsv($f, $row);
        }
        
    }
    fclose($f);
    echo "<br> <h1> Total : ".$count." Products </h1> <br>";
    
     


?>