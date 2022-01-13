
<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://seconique.co.uk/ranges/cambourne-range/cambourne-computer-desk");
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
   'cookie: temp_id=temp-1036; _ga=GA1.3.830207600.1641877203; _gid=GA1.3.1458659679.1641877203; mailchimp_landing_site=https://seconique.co.uk/?wc-ajax=get_refreshed_fragments; wordpress_test_cookie=WP+Cookie+check; wordpress_logged_in_30b1663b28ebfb0399f8303112b69847=info@bedroomking.co.uk|1642050023|W5g08npGeaeaFPbpVfmceHXcXilx9B54P5unRlOVnZB|b6556711b1ee1b03c3d377ff951a3c973f57bc35acaeb40875b6e933192fbe31; wfwaf-authcookie-ff0b1846b8d2d99eab14f08da055e4a9=4618|other|read|62b71516bae5f4e48fe404602132ee58da6816becf524dd3e600b0c6ccfdc921; woocommerce_items_in_cart=1; woocommerce_cart_hash=993384c154d5b2ec5a9c7d6dec977efd; wp_woocommerce_session_30b1663b28ebfb0399f8303112b69847=4618||1642050024||1642046424||7d5e52f1396b63c07f29aa18f7c8ba9a; hidePopup=true',
    
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);

curl_close ($ch);

echo  $server_output;

?>