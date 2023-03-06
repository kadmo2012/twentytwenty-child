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
$repeater = get_field('featured_post');
$repeatNum = count($repeater);
//echo $actionNum;



// echo '<pre>';
// print_r(get_field('featured_post'));
// echo '</pre>';
// die();





if ($repeatNum == 3) :
{	
	//$colcss ='col-sm-6';
	$colcss ="col-md-6";

	//echo $actionNum.'=3';
}
else :
{
	//$colcss ='col-md-6';
	$colcss ="col-sm-2";
	//echo $actionNum.'<>3';
}
endif;
//echo $colcss;

$colcss ="";


?>

<!-- 

<div class="section-devider"> 

	<hr>
</div>

 -->

<?php


// echo '<pre>';
//     print_r( get_field('featured_post')  );
// echo '</pre>';
// die;





// check if the repeater field has rows of data
if( have_rows('featured_post') ): ?>

<div class="parent-wrapper">

    
	 
	<?php
	
	
	while ( have_rows('featured_post') ) : the_row();

		$post  = get_sub_field('post');
	
		        setup_postdata($post);

				if($post->post_type=='post'): 
					//<?php the_post_thumbnail('thumbnail'); 
					?>
				    <div class="<?php echo $colcss; ?>">
					     <a href="<?php the_permalink(); ?>">
						
					     
						 <h4><?php the_title(); ?></h4> </a> 
						 
						 <p><?php the_content(); ?> <?php the_author(); ?>,  <?php the_date(); ?>  </p> 

				    </div>

				<?php elseif($post->post_type=='network_links'): 

					displayHyperPost ($post, $colcss );


			endif;

	endwhile; ?>



</div>
	
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

<?php
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
