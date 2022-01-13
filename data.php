<?php
include ('./simple_html_dom.php');

  
    $product = file_get_html('https://seconique.co.uk/ranges/abbey-range/300-303-035-abbey-nest-of-tables-clear-glass-grey');


        $e = $product->find("div", 0);

        // echo $e->tag;           // Returns: " div"
        // echo $e->outertext;  // Returns: " <div>foo <b>bar</b></div>"
        $t = explode("<div class=\"top_bar\">", $e->innertext);
        echo $t[0];     // Returns: " foo <b>bar</b>"
        // echo $e->plaintext;

    // foreach($product->find('div[class="inner_panel_info"]') as $element)
    // {   
    //     $data = explode("Document", $element->innertext);

    //     echo  $data[0];
    // }
    

    
?>

            