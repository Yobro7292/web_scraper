<?php

require 'vendor/autoload.php';
include ('./simple_html_dom.php');
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


  //Product links id (from p_links table) given in variable i for fetching data from that link.
  // id starts from 9 and ends at 385 !!!
for($i=329;$i<=400;$i++)
{


    $sql = "SELECT * FROM `collection_links` WHERE `id` = ".$i;
        $result =mysqli_query($conn, $sql);

        $data_links = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if($data_links['checked']==0)
        {

        
    

        $url = $data_links['links'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [
              'authority: seconique.co.uk',
            'cache-control: max-age=0', 
            'sec-ch-ua: ^\^" Not;A Brand^\^";v=^\^"99^\^", ^\^"Google Chrome^\^";v=^\^"97^\^", ^\^"Chromium^\^";v=^\^"97^\^"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: ^\^"Windows^\^"',
            'upgrade-insecure-requests: 1',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'sec-fetch-site: none',
            'sec-fetch-mode: navigate',
            'sec-fetch-user: ?1',
            'sec-fetch-dest: document',
            'accept-language: en-IN,en-US;q=0.9,en;q=0.8,gu-IN;q=0.7,gu;q=0.6,en-GB;q=0.5',
            'cookie: _ga=GA1.3.830207600.1641877203; _gid=GA1.3.1458659679.1641877203; mailchimp_landing_site=https://seconique.co.uk/?wc-ajax=get_refreshed_fragments; wfwaf-authcookie-ff0b1846b8d2d99eab14f08da055e4a9=4618|other|read|0f6bd8ad801ab6a55355dbf1e96572bc06be8155a79f0192e0f6f2e818c39a35; wp_woocommerce_session_30b1663b28ebfb0399f8303112b69847=4618||1642225018||1642221418||307e17449a2936f9cd01ae5bafe48ef2; woocommerce_items_in_cart=1; woocommerce_cart_hash=993384c154d5b2ec5a9c7d6dec977efd; temp_id=temp-9663; wordpress_test_cookie=WP+Cookie+check; wordpress_logged_in_30b1663b28ebfb0399f8303112b69847=info@bedroomking.co.uk|1642232891|hVwEXtAvTTaLtYlTV8L8FrREeEcsXTSQAXR3l800hMB|bc54ef9bc45cdb8b64e85192b673cfcaa2bbc93ea3f850f3a18d4cf785cc506c; hidePopup=true; _gat_gtag_UA_55289651_2=1',
            
    
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = curl_exec ($ch);


            curl_close ($ch);


            $httpClient = new \GuzzleHttp\Client();



                    
            //add this line to suppress any warnings
            libxml_use_internal_errors(true);
            $doc = new DOMDocument();
                    
            $doc->loadHTML($server_output);
                    
            $xpath = new DOMXPath($doc);
            $titles = $xpath->evaluate('//*[@id="barba-wrapper"]/div/div[3]/div/main/div[1]/div/div[2]/div[2]/h1');
            $prices = $xpath->evaluate('/html/body/div[1]/div/div[3]/div/main/div[1]/div/div[2]/div[3]');
            $product_codes = $xpath->evaluate('//*[@id="barba-wrapper"]/div/div[3]/div/main/div[1]/div/div[2]/div[6]/span[1]/span[2]');
            $barcodes = $xpath->evaluate('//*[@id="barba-wrapper"]/div/div[3]/div/main/div[1]/div/div[2]/div[6]/span[2]/span[2]');
            $size = $xpath->evaluate('//*[@id="tabs-features"]/div[2]/div[1]/div[2]');
            $qty = $xpath->evaluate('//*[@id="tabs-features"]/div[2]/div[2]/div/div/div[2]');
            $product = file_get_html($url);
            $img = $xpath->evaluate('//*[@id="barba-wrapper"]/div/div[3]/div/main/div[2]/div/div[2]/div[1]/div/div/div[1]/div/img');
                    

        $extractedTitles = [];

        $t = []; //t for title
            $handle =[];
        foreach($product->find('h1[class="darkblack_font font22"]') as $titles)
        {
            $t = explode("<br>", $titles->innertext);
        
            $handle = str_replace(" ","-",trim($t[0])); // Put dashes between handle name
        }

    $extractedPrices = [];
    $o_price = []; // o_price for price without pound symbol
        foreach ($prices as $price) {
            $extractedPrices[] = $price->textContent.PHP_EOL;
            $o_price = explode("£",$extractedPrices[0]);
                }

    $extractedProductCodes = []; //SKU
        foreach ($product_codes as $product_code) {
            $extractedProductCodes[] = $product_code->textContent.PHP_EOL;
           
        }

    $extractedBarcode = [];
        foreach ($barcodes as $barcode) {
            $extractedBarcode[] = $barcode->textContent.PHP_EOL;
           
        }


        $data = []; //data for description in HTML 
        foreach($product->find('div[class="column info_prods_panel"]') as $element)
                 {   
                      $data = explode("Downloads", $element->innertext);
        }

        $images = []; //image SRC
        foreach($product->find('div[class="slide_fs_photo"]') as $div)
            {
                foreach($div->find('img') as $rich)
                {   
                    $images[] = $rich->src.PHP_EOL;
                }
            }  

    
    $desc = "<br><h3>".$t[1]."</h3><br>".$data[0]."<br>"; // for joining product title description and whole html description 
            

            // Adding to Databasse Starts from here

        $number=0;
        foreach($images as $imge)
        {
        
            if(!empty($t[$number]) && !empty($extractedBarcode[$number]) && !empty($o_price[$number])) //if title and price and barcode is not empty 
            {
                $sql = "INSERT INTO `products` (`id`, `handle`, `title`, `body`, `sku`, `price`, `barcode`, `img_src`, `img_position`, `collection`) VALUES (NULL, '".strtolower($handle)."', '".trim($t[0])."', '".trim($desc)."', '".trim($extractedProductCodes[0])."', '".trim($o_price[1])."', '".trim($extractedBarcode[0])."', '".$imge."', '".($number+1)."','".$data_links['collection']."')";
                
                        $result2 = mysqli_query($conn, $sql);
            }
            else{ 
                //insert only handle, image src and image position 

                $sql = "INSERT INTO `products` (`handle`, `img_src`, `img_position`) VALUES ('".strtolower($handle)."', '".$imge."', '".($number+1)."')";
               
                        $result3 = mysqli_query($conn, $sql);
                }

            
         $number++;
         
    }

            //set 0 to 1 in p_links table for fetched linked
            mysqli_free_result($result);
              $sql = "UPDATE `collection_links` SET `checked` = '1' WHERE `collection_links`.`id` = ".$i;
                   $result4 =mysqli_query($conn, $sql);
   
                   echo "<br> Done ! Checked True for id : ".$i."<br/> <br/>";

             
    }

    else{
            echo "<br> Data already fetched for id ".$i;
    }

}
        mysqli_close($conn);
?>

