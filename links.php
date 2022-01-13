<?php
include ('./simple_html_dom.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scraping";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>
<html>
  <head>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .divc{
      display: flex;
    justify-content: center;
    align-items: center;       
    align-content: center;
    }
  </style>
  </head>
  <body class="bg-gray-800">
  <div class="w-full max-w-lg mx-auto mt-10">
    <h1 class="text-white text-xl font-bold my-4 mx-20"> Product Link Scraper </h1>
  <form class="bg-gray-900 shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="#">
    <div class="mb-4">
      <label class="block text-white text-sm font-bold mb-2">
       Page Link 
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="link" type="text" name="link">
    </div>

    <div class="mb-4">
      <label class="block text-white text-sm font-bold mb-2" >
        Main Collection
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="m_col" type="text" name="m_col" value="<?php if(!empty($_POST['m_col'])) {echo $_POST['m_col'];} ?>">
    </div>

    <div class="mb-4">
      <label class="block text-white text-sm font-bold mb-2">
        Sub Collection 
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="s_col" type="text" name="s_col">
    </div>
    
    <div class="flex items-center justify-between">
      <button class="mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
        Fetch
      </button>
    </div>
  </form>
  



<?php
if(!empty($_POST['link'])){
$link = $_POST['link'];
$url = file_get_html($link);

$line=0;
$main_collection = $_POST['m_col'];
$sub_collection = $_POST['s_col'];



foreach($url->find('.reveal_button a') as $element)
{
      
    {
        $line++;
        $sql = "INSERT INTO `collection_links` (`id`, `links`, `collection`, `checked`) VALUES (NULL, '$element->href', '$main_collection', '0')";
        $result =mysqli_query($conn, $sql);

        $sql = "INSERT INTO `collection_links` (`id`, `links`, `collection`, `checked`) VALUES (NULL, '$element->href', '$sub_collection', '0')";
        $result =mysqli_query($conn, $sql);

        if ($result) {
           
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }

        ;
    }
    
}
}
?>
 <div class="mb-4">
      <label class="block text-white text-lg font-bold mb-2">
      <?php 
      if(!empty($main_collection) && !empty($sub_collection) && !empty($url))
      {

        echo '<p style="font-family:verdana;"><h1> '.$line. ' </h1> <h3>Product Fetched  <br> Main Collection :  '.$main_collection.' <br> Sub Collection :  '. $sub_collection .'</h3></p> '; 
      }
      else{
        echo '<p style="font-family:verdana;"><h1> 0 </h1> <h3>Product Fetched  <br> Main Collection :   <br> Sub Collection :  </h3></p> '; 
      }
      
      ?>
      </label>
</div>


<?php
// $line=0;

// foreach($bedroom->find('.reveal_button a') as $element)
// {
//     {
//         $line++;
//         $sql = "INSERT INTO `p_links` (`id`, `links`, `checked`) VALUES (NULL, '$element->href', '0')";
//         $result =mysqli_query($conn, $sql);

//         if ($result) {
//             echo "success  ";
//           } else {
//             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//           }

//         echo $line. '  ' . $element->href . '<br>';
//     }
    
// }
// $line=0;

// foreach($dining_room->find('.reveal_button a') as $element)
// {
//     {
//         $line++;
//         $sql = "INSERT INTO `p_links` (`id`, `links`, `checked`) VALUES (NULL, '$element->href', '0')";
//         $result =mysqli_query($conn, $sql);

//         if ($result) {
//             echo "success  ";
//           } else {
//             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//           }

//         echo $line. '  ' . $element->href . '<br>';
//     }
    
// }
// $line=0;
// foreach($home_office->find('.reveal_button a') as $element)
// {
//     {
//         $line++;
//         $sql = "INSERT INTO `p_links` (`id`, `links`, `checked`) VALUES (NULL, '$element->href', '0')";
//         $result =mysqli_query($conn, $sql);

//         if ($result) {
//             echo "success  ";
//           } else {
//             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//           }

//         echo $line. '  ' . $element->href . '<br>';
//     }
    
// }
mysqli_close($conn);

?>

</div>
  </body>
</html>
