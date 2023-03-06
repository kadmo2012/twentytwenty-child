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
$sectionTitle = get_field('section_title');
$repeater = get_field('action_post');
$repeatNum = count($repeater);
//echo $actionNum;



// echo '<pre>';
// print_r(get_field('featured_post'));
// echo '</pre>';
// die();





if ($repeatNum == 3) :
{	
	$colcss ='col-sm-4';
	//echo $actionNum.'=3';
}
else :
{
	$colcss ='col-md-6';
	//echo $actionNum.'<>3';
}
endif;
//echo $colcss;

?>







<div class="section-devider"> 
<h3 class="has-text-align-center"><?php echo ($sectionTitle); ?><h3>
</div>







<?php

// check if the repeater field has rows of data
if( have_rows('action_post') ): ?>





<div class="parent-wrapper">
	
	 
    <?php
	while ( have_rows('action_post') ) : the_row();

		$post  = get_sub_field('post');
	
		            setup_postdata($post); ?>
		

				    <div class="<?php echo $colcss; ?>">
					     <a href="<?php the_permalink(); ?>">
						
					     <!-- <?php the_post_thumbnail('thumbnail'); ?> <br>  -->
						 <h5 class="has-text-color has-palette-color-2-color"><?php the_title(); ?></h5> </a> 
						 
						 <p><?php the_excerpt(); ?>  </p> 
						 <!-- <p><?php the_excerpt(); ?> <?php the_author(); ?>,  <?php the_date(); ?>  </p>  -->



				    </div>
	<?php endwhile;
	?>



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
