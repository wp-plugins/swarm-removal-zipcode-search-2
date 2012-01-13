<?php
/*
Plugin Name: Swarm Removal Zipcode Search
Plugin URI: http://www.honeyrunapiaries.com/
Description: Returns results for swarm removal by zip code.
Version: 0.3
Author: Tim Arheit
Author URI: http://www.honeyrunapiaries.com/
*/

function swarmsearch_handler($atts) {
   $enable_add_swarm_info_link = 1;
   $enable_provided_by_link = 1;

   $output =  '<div id="swarmsearch_input"><form method="post"> <input class="text" name="zipcode" size="5" type="text" /> <input class="btn" type="submit" value="Search by Zip" /> </form></div>' .
              '<div id="swarmsearch_results">';

   $args = array();
   $args['swarm_key'] = 'k2389zafhza$@1';  
   $args['info_link'] = $enable_add_swarm_info_link;
   $args['provided_by'] = $enable_provided_by_link;

   $url = 'http://www.honeyrunapiaries.com/swarm_removal/interface_swarm.php' ;

   if(isset ($_POST['zipcode'])){
      $zip = preg_replace("/[^0-9]/", '',$_POST['zipcode']);

      if(strlen($zip) == 5){    
         $args['z'] = $zip;
      }
      else{
         $output.='Invalid zip code.<br \><br \>';
      }
   }
   else
    if(isset ($_POST['html'])){      
      $args['html'] = $_POST['html'];
    
   }

   $output.= wp_remote_retrieve_body(wp_remote_post($url, array('method'=>'POST', 'body' => $args )));
   $output .= '</div>';

   return $output;

}


function swarmsearch_init() {    
    add_shortcode('swarmsearch', 'swarmsearch_handler');
       
}

add_action('init','swarmsearch_init');

?>