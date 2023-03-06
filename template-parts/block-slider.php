<?php
/**
 * Team Member block
 *
 * @package      Custom Blocks
 * @author       Bonkaroo
 * @since        1.0.0
 * @license      GPL-2.0+
**/
?>

<style type="text/css">

.responsive-div {

  max-width: 400px;
  width: 100%
}

.slides {
  margin-right: auto;
  margin-left: auto;
  width: 350px;

}

.flexslider {
  margin: auto;
  background: rgba(0,0,0,.5);
  border: 4px solid rgba(0,0,0,.5);
  max-width: 400px;
}

.flex-caption {
  padding: 2%;
  left: 0;
  bottom: 0;
  background: rgba(0,0,0,0);
  color: #fff;
  text-shadow: 0 -1px 0 rgba(0,0,0,5);
  font-size: 18px;
  line-height: 22px;
}


.flex-direction-nav a  { 
    display: block; 
    width: 40px; 
    height: 45px; 
    margin: -20px 0 0; 
    position: absolute; 
    top: 50%; z-index: 10; 
    overflow: hidden; /* Remove this line */
    opacity: 0; 
    cursor: pointer; 
    color: rgba(0,0,0,0.8); 
    text-shadow: 1px 1px 0 rgba(255,255,255,0.3); 
    -webkit-transition: all .3s ease; 
    -moz-transition: all .3s ease; 
    transition: all .3s ease; 
}
  </style>

<?php
// echo '<pre>';
// print_r( get_template_directory_uri() );
// echo '</pre>';
// die();




$images = get_field('slider');
$size = 'medium_large'; // (thumbnail, medium, large, full or custom size)



// echo '<pre>';
//     print_r( get_field('slider')  );
// echo '</pre>';
// die;



?>

<!-- 

<div class="section-devider"> 

	<hr>
</div>

 -->
 <div class="responsive-div">
 <?php 
//$images = get_field('gallery');
if( $images ): ?>
        
   
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

                    <?php
                    if( filter_var($image['description'], FILTER_VALIDATE_URL)) { ?>

                      <a href="<?php echo esc_html($image['description']); ?>" target="_blank"> <p class="flex-caption"><?php echo esc_html($image['caption']); ?></u></p></a>
                   
              <?php }  
                    else { ?>

                      <p class="flex-caption"><?php echo esc_html($image['caption']); ?></p>      

               <?php  }  ?>

                </li>
            <?php endforeach; ?>
        
        </ul>
       
    </div>
<?php endif; ?>

</div>

<?php


// echo '<pre>';
//     print_r( get_field('featured_post')  );
// echo '</pre>';
// die;


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