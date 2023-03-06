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
$post = get_field('featured_post');
$end_date= get_field('end_date');
$cur_date= date("m/d/Y");
$action = get_field('action_alert');
$actionNum = count($action);
echo $actionNum;

if ($actionNum == 3) :
{	
	$colcss ='col-sm-4';
	echo $actionNum.'=3';
}
else :
{
	$colcss ='col-md-6';
	echo $actionNum.'<>3';
}
endif;
echo $colcss;

$images = get_field('homepage_picture');
$size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)

$post_ID=$post->ID;

$d1=strtotime($cur_date);
$d2=strtotime($end_date);
if ($d1 < $d2):

// query
$the_query = new WP_Query( array('p' => $post_ID) );


?>


<?php if( $the_query->have_posts() ): ?>
	<?php $the_query->the_post(); ?>
	
		<div class="<?php echo $colcss; ?>">
			<a href="<?php the_permalink(); ?>">
				
			<?php the_post_thumbnail('thumbnail'); ?> <br> <h4><?php the_title(); ?></h4> 
			
			<p><?php the_excerpt(); ?> <?php the_author(); ?>,  <?php the_date(); ?>  </p></a>
		</div>
<?php endif; ?>


<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

<?php endif; ?>

<div class="section-devider"> 

	<hr>
</div>



<div class="grid-container">
    <div class="swiper-container">
  		<div class="swiper-wrapper">

		  <?php foreach(  $images as $image_id ): ?>
			<?php $result = $image_id['sizes']['2048x2048']; ?>
			<div class="swiper-slide"><?PHP echo '<img src="'.$result.'">' ?></div>
		  <?php endforeach; ?>
		
		</div>		  
		<div class="swiper-pagination"></div>

	</div>	  
</div>



<?php

// check if the repeater field has rows of data
if( have_rows('action_alert') ): ?>






<div class="parent-wrapper">
	<?php 
	 // loop through the rows of data
	 

	while ( have_rows('action_alert') ) : the_row();

		$post_ID  = get_sub_field('alert');
	
		$the_query = new WP_Query( $post_ID ); ?>
		<?php setup_postdata($the_query); ?>

		<?php if( $the_query->have_posts() ): ?>
			
			<?php $the_query->the_post(); ?>
		

				    <div class="<?php echo $colcss; ?>">
					     <a href="<?php the_permalink(); ?>">
						
					     <?php the_post_thumbnail('thumbnail'); ?> <br> 
						 <h5><?php the_title(); ?></h5> </a> 
						 
						 <p><?php the_excerpt(); ?> <?php the_author(); ?>,  <?php the_date(); ?>  </p> 

				    </div>
			


		<?php endif; 

	endwhile;
	?>

</div>
	
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

<?php
else :

    // no rows found

endif;

?>















<?php 
// echo '<pre>';
// print_r(get_field('gallery'));
// echo '</pre>';
//die();
