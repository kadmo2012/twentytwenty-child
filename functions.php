<?php
/* enqueue script for parent theme stylesheeet */
function childtheme_parent_styles() {

 // enqueue style
 wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'childtheme_parent_styles');


function add_theme_scripts() {
	//wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' );
	//wp_enqueue_style( 'external_css', 'https://unpkg.com/purecss@2.0.3/build/grids-responsive-min.css');

	// Swiper Slider
	//wp_enqueue_style( 'swiper-style', get_template_directory_uri() . '-child/scripts/css/swiper-bundle.min.css');
	//wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '-child/scripts/js/swiper-bundle.min.js');

	// Flexslider
	// wp_enqueue_style( 'flexslider-style', get_template_directory_uri() . '-child/scripts/css/flexslider.css');
	// wp_enqueue_script( 'jquery_flexslider', get_template_directory_uri() . '-child/scripts/js/jquery.flexslider-min.js');
	wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'slug-ajax', get_template_directory_uri() . '-child/scripts/js/myjquery.js', array('jquery'), false, true );
		
		$jp = array(
			'nonce' => wp_create_nonce( 'nonce' ),
			'ajaxURL' => admin_url( 'admin-ajax.php' )
		); 
		wp_localize_script( 'slug-ajax', 'jp', $jp ); 


		@ini_set( 'upload_max_size' , '120M' );
		@ini_set( 'post_max_size', '120M');
		@ini_set( 'max_execution_time', '300' );


  }
  add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


//require_once 'inc/wp_flexslider.php';
//require_once 'inc/reg_acf_cpt.php';



// Initialize jquery and php code for interactive tables – used with Covid19 data on Bonkaroo
require_once 'inc/wp_tablecode.php';



 // FLEXSLIDER
function flexslider() {
    if (!is_admin()) {

    // wp_enqueue_style( 'flexslider-style', get_template_directory_uri() . '-child/scripts/css/flexslider.css');
	// wp_enqueue_script( 'jquery_flexslider', get_template_directory_uri() . '-child/scripts/js/jquery.flexslider-min.js');

        // Enqueue FlexSlider JavaScript
        wp_register_script('jquery_flexslider', get_template_directory_uri(). '-child/scripts/js/jquery.flexslider-min.js', array('jquery') );
        wp_enqueue_script('jquery_flexslider');

        // Enqueue FlexSlider Stylesheet        
        wp_register_style( 'flexslider-style', get_template_directory_uri() . '-child/scripts/css/flexslider.css', 'all' );
        wp_enqueue_style( 'flexslider-style' );

        // FlexSlider custom settings       
        add_action('wp_footer', 'flexslider_settings');

        function flexslider_settings() { ?>         
            <script>
                jQuery(document).ready(function($){

                    $('.flexslider').flexslider({
						slideshowSpeed: 4000,
						animation: "slide"
					});
                });
            </script>
        <?php 
        }
    }
}
add_action('init', 'flexslider');




/**
 * Register Blocks
 * @package CoreFunctionality
 * @author	Bonkaroo
 * @since	1.0.0
 * @license	GPL-2.0
 * @link https://www.Bonkaroo.com
 **/

function pm_register_blocks() {
	
	if( ! function_exists( 'acf_register_block_type' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'action-post',
		'title'			=> ('Action Post'),
		'description'	=> ('Display post that has been designated an Action Post'),
		'render_template'	=> 'template-parts/block-action-post.php',
		'category'		=> 'formatting',
		'icon'			=> 'warning',
		'keywords'		=> array( 'action', 'alert'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));


	acf_register_block_type( array(
		'name'			=> 'displayPosts',
		'title'			=> ('Display Posts'),
		'description'	=> ('Display posts on page'),
		'render_template'	=> 'template-parts/displayPosts.php',
		'category'		=> 'formatting',
		'icon'			=> 'networking',
		'keywords'		=> array( 'posts', 'hyperlink'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));


	acf_register_block_type( array(
		'name'			=> 'slider',
		'title'			=> ('Slider'),
		'description'	=> ('Slider for ACF gallery'),
		'render_template'	=> 'template-parts/block-slider.php',
		'category'		=> 'formatting',
		'icon'			=> 'format-gallery',
		'keywords'		=> array( 'slider', 'gallery'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));


	acf_register_block_type( array(
		'name'			=> 'dataTable',
		'title'			=> ('Display dataTable'),
		'description'	=> ('Display dataTable in a page'),
		'render_template'	=> 'template-parts/dataTable.php',
		'category'		=> 'formatting',
		'icon'			=> 'media-spreadsheet',
		'keywords'		=> array( 'table', 'data'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));

	acf_register_block_type( array(
		'name'			=> 'movie_display',
		'title'			=> ('YouTube Showcase'),
		'description'	=> ('Great Lakes ADA Center YouTube Showcase'),
		'render_template'	=> 'template-parts/youtube_showcase_view.php',
		'category'		=> 'formatting',
		'icon'			=> 'networking',
		'keywords'		=> array( 'youtube','ada', 'video'),
		'mode'			=> 'edit',
		'Supports'		=> array( 'mode' => false)
	));


}

add_action('acf/init', 'pm_register_blocks' );




/*
* Creating a function to create our CPT
*/
 
function pmm_register_post_types() {

	$textDomain ='twentytwenty';
 
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Hyperlinks', 'Post Type General Name', $textDomain ),
			'singular_name'       => _x( 'Hyperlink', 'Post Type Singular Name', $textDomain ),
			'menu_name'           => __( 'Hyperlinks', $textDomain ),
			'view_item'           => __( 'View Links', $textDomain ),
			'add_new_item'        => __( 'Add new list of Hyperlinks', $textDomain ),
			'add_new'             => __( 'Add New', $textDomain ),
			'edit_item'           => __( 'Edit list', $textDomain ),
			'update_item'         => __( 'Update Hyperlinks', $textDomain ),
			'search_items'        => __( 'Search Hyperlinks', $textDomain ),
			'not_found'           => __( 'Not Found', $textDomain ),
			'not_found_in_trash'  => __( 'Not found in Trash', $textDomain ),
		);
		 
	// Set other options for Custom Post Type
		 
		$args = array(
			'label'               => __( 'links', $textDomain ),
			'description'         => __( 'Links to organizations that support women', $textDomain ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'revisions', 'custom-fields'),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_custom_fields'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	 
		);
		 
		// Registering your Custom Post Type
		register_post_type( 'network_links', $args );
	 
	}
	 
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	 
	add_action( 'init', 'pmm_register_post_types', 0 );


	

/*
* Creating a function to display hyperlink custom post type
*/

function displayHyperPost ($post, $colcss ) {

	//$repeater = get_field('network_links');
	//$repeatNum = count($repeater);


					// collect the tags associated with the links
					$array1=[];
					while ( have_rows('network_links', $post) ) : the_row();
						$tag_ID  = get_sub_field('tag');
						$array1[] = $tag_ID;
					endwhile;

					//$numArray1=count($array1);
					$array1 = array_unique($array1);
					
					// print_r($array1); 

	?>		
					<div class="<?php echo $colcss; ?>">
					<h4><?php the_title(); ?></h4>
				
	<?php
								
					foreach ($array1 as &$tag_ID) {

						$tag = get_tag($tag_ID); 
						
	?>
						<h5><?php echo $tag->name; ?></h5> 

						<ul>
						
	<?php		

						while ( have_rows('network_links', $post) ) : the_row();

						if(  $tag_ID == get_sub_field('tag')): 
							$link=get_sub_field('link');     ?>						
						

							<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
							<p><li><?php echo $link['title']; ?></li></p></a>



							
						<?php endif; 

					    endwhile; ?>

						</ul>
							
			<?php	} //end foreach ?>


					</div>

<?php
	return;

	}   // End Function


// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;


//admin_url('admin-ajax.php?action=copyRemoteTable') 
//http://bonkaroo.local/wp-admin/admin-ajax.php?action=copyRemoteTable


add_action( 'wp_ajax_nopriv_copyRemoteTable', 'copyRemoteTable' );
add_action( 'wp_ajax_copyRemoteTable', 'copyRemoteTable' );
function copyRemoteTable() {

	global $wpdb;
	
	//$mydb = new wpdb('username','password','database','localhost');
	$mydb = new wpdb('unnsldnhgagjd','bonkaroo202','dbohla8puf6vh3','bonkaroo.com');
	
	//                  unnsldnhgagjd dbohla8puf6vh3



	$query = $mydb->prepare('SELECT COUNT(*) FROM aiw_covidrpt_state_chg');
	$NumRecords = $mydb->get_var( $query );

	//$sqlStatement = "SELECT startDate, sessionName, webinarURL FROM access20_accessboard.vw_sessions where startDate > '2021-10-2' order by startDate;";
	//$sqlStatement = "SELECT date(startDate) as Date, time(startDate) as Time, sessionName, concat('https://accessibilityonline.org/ada-tech/session/?id=', ses.id) as URL, app.name as Application, ses.application_id FROM access20_accessboard.vw_sessions as ses join access20_accessboard.application app on ses.application_id=app.id where startDate > '2021-10-2' order by startDate;";
	$sqlStatement = "SELECT * FROM aiw_covidrpt_state_chg order by date_end desc, period_days desc, section, casesPer100k desc";


	$file = get_stylesheet_directory()."/log/copyRemoteTable.log";

	date_default_timezone_set("America/Chicago");
	$record="\n\n *** Update Bonkaroo for ". date("Y-m-d h:i:sa")."\n";
	file_put_contents($file, $record);

	$record="NumRecords is >>>".$NumRecords."<<<\n";
	file_put_contents($file, $record, FILE_APPEND);



	$username = "unnsldnhgagjd";
	$password = "bonkaroo202";
	$database = "dbohla8puf6vh3";
	$mysqli = new mysqli("bonkaroo.com", $username, $password, $database);
	//$query="CREATE TABLE tablename(id int(6) NOT NULL auto_increment,first varchar(15) NOT NULL,last varchar(15) NOT NULL,field1-name varchar(20) NOT NULL,field2-name varchar(20)NOT NULL,field3-name varchar(20) NOT NULL,field4-name varchar(30) NOT NULL, field5-name varchar(30)NOT NULL,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";
	$query='SELECT COUNT(*) FROM aiw_covidrpt_state_chg';
	$mysqli->query("$query");
	$mysqli->close();

// Check connection
 $record="I believe I connected to MySqli!!\n";

 if ($mysqli -> connect_errno) {
	$record="Failed to connect to MySQL: " . $mysqli -> connect_error;
  }
 
  file_put_contents($file, $record, FILE_APPEND);




	$record=admin_url('admin-ajax.php?action=copyRemoteTable')."\n";
	file_put_contents($file, $record, FILE_APPEND);

	//$sqlStatement="SELECT * FROM adagreatlakes13_db.resource where status<>0 and name<>'' order by status, ltrim(name) desc;";
		
	$record="SqlStatement=".$sqlStatement."\n\n";
	file_put_contents($file, $record, FILE_APPEND);
	
	// Open the remote table
	$rows = $mydb->get_results( $sqlStatement);
		
	// prepare the local input table
	$tableName = $wpdb->prefix."coviddata_state_chg";
	$wpdb->query('TRUNCATE TABLE '.$tableName.';');

	if($wpdb->last_error !== '') {

        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );

		$record = "wpdb Error! Error: ".$wpdb->last_error.", last result: ".$str.", Query: ".$query."\n";
		file_put_contents($file, $record, FILE_APPEND);          
	}

	$record = "date_end, date_begin, period, period_days, state, fips, state_cd, cases_begin, cases_end, cases_chg, cases_avg, deaths_begin, deaths_end, deaths_chg, deaths_avg, pop, casesPer100k, rate_chg, flag, section, max_value, description\n";
	file_put_contents($file, $record, FILE_APPEND);        

	$i=0;  
	foreach ( $rows as $print )   {


		$date_end = $print->date_end;
		$date_begin = $print->date_begin;
		$period = $print->period;
		$period_days = $print->period_days;
		$state = $print->state;
		$fips = $print->fips;
		$state_cd = $print->state_cd;
		$cases_begin = $print->cases_begin;
		$cases_end = $print->cases_end;
		$cases_chg = $print->cases_chg;
		$cases_avg = $print->cases_avg;
		$deaths_begin = $print->deaths_begin;
		$deaths_end = $print->deaths_end;
		$deaths_chg = $print->deaths_chg;
		$deaths_avg = $print->deaths_avg;
		$pop = $print->pop;
		$casesPer100k = $print->casesPer100k;
		$rate_chg = $print->rate_chg;
		$flag = $print->flag;
		$section = $print->section;
		$max_value = $print->max_value;
		$description = $print->description;


		$inserted_resource = $wpdb->insert($tableName, array(
			'date_end' => $print->date_end,
			'date_begin' => $print->date_begin,
			'period' => $print->period,
			'period_days' => $print->period_days,
			'state' => $print->state,
			'fips' => $print->fips,
			'state_cd' => $print->state_cd,
			'cases_begin' => $print->cases_begin,
			'cases_end' => $print->cases_end,
			'cases_chg' => $print->cases_chg,
			'cases_avg' => $print->cases_avg,
			'deaths_begin' => $print->deaths_begin,
			'deaths_end' => $print->deaths_end,
			'deaths_chg' => $print->deaths_chg,
			'deaths_avg' => $print->deaths_avg,
			'pop' => $print->pop,
			'casesPer100k' => $print->casesPer100k,
			'rate_chg' => $print->rate_chg,
			'flag' => $print->flag,
			'section' => $print->section,
			'max_value' => $print->max_value,
			'description' => $print->description
		));
			
		if( is_wp_error( $inserted_resource ) || $inserted_resource === 0 ) {
			$record="?*?*?*?* Resource NOT inserted!!! inserted_resource = ".$inserted_resource."!!!\n\n";				
			file_put_contents($file, $record, FILE_APPEND);
  
		  //die('Could not insert brewery: ' . $brewery_slug);
		  //error_log( 'Could not insert resource: ' . $resource_slug );
		  //continue;
		  }

		  $i=$i+1;
}

$record="i=".$i."!\n\n";				
file_put_contents($file, $record, FILE_APPEND);

	
	  return;
	
	}
	?>