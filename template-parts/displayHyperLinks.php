<?php
/**
 * Team Member block
 *
 * @package      Custom Blocks
 * @author       Bonkaroo
 * @since        1.0.0
 * @license      GPL-2.0+
**/


global $post;
$post = get_field('hyperlinks');
$colcss ="pure-u-1 pure-u-xl-1-3";




if( $post->post_type=='network_links' ): ?>

<div class="parent-wrapper">
    
	 
<?php 

		displayHyperPost ($post, $colcss );


?>



</div>
	
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). 

else :

    // no rows found

endif;


// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;





?>

















<!-- echo '<pre>';
    print_r( get_field('post_objects')  );
echo '</pre>';
die; -->





<?php 
// echo '<pre>';
// print_r(get_field('gallery'));
// echo '</pre>';
//die();
?>