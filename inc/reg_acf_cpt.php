<?php



/**
 * Register Blocks
 * @package CoreFunctionality
 * @author	Bonkaroo
 * @since	1.0.0
 * @license	GPL-2.0
 * @link https://www.Bonkaroo.com
 **/

/*
* Creating a function to create our CPT
*/
 
function pmm_register_post_types() {

	$textDomain ='twentytwentyone';
 
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


	function pm_register_blocks() {
	
		if( ! function_exists( 'acf_register_block_type' ) )
			return;
	
	
		acf_register_block_type( array(
			'name'			=> 'displayPosts',
			'title'			=> ('Display Posts'),
			'description'	=> ('Display posts on page'),
			'render_template'	=> 'template-parts/displayPosts.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'posts', 'hyperlink'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'videoDisplay',
			'title'			=> ('Video Display'),
			'description'	=> ('Display Video of the Month on a page'),
			'render_template'	=> 'template-parts/video_of_the_month.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'posts', 'video'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'calendarList',
			'title'			=> ('Training Calendar'),
			'description'	=> ('Display Webinar List'),
			'render_template'	=> 'template-parts/displayCalendar.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'training','calendar'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
		
		acf_register_block_type( array(
			'name'			=> 'MonthlyMaintenancePage',
			'title'			=> ('Monthly Maintenance Page'),
			'description'	=> ('Links and shortcuts for updating Chronicle Newsletter'),
			'render_template'	=> 'template-parts/MonthlyMaintenancePage.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'chronicle','newsletter', 'Resources', 'Announcements'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'ada_resource_display',
			'title'			=> ('Great Lakes ADA'),
			'description'	=> ('Display Great Lakes ADA Contact Information'),
			'render_template'	=> 'template-parts/contact_greatlakesada.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'contact','ada'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'ada_resource_associations',
			'title'			=> ('Great Lakes Associations'),
			'description'	=> ('Display list of ADA associates'),
			'render_template'	=> 'template-parts/adaAssociates_greatlakesada.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'contact','ada'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
	
		acf_register_block_type( array(
			'name'			=> 'q_and_a',
			'title'			=> ('Questions and Answers'),
			'description'	=> ('Accessible IT frequently asked questions'),
			'render_template'	=> 'template-parts/accessibleIT_q_a.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'questions','ada', 'answers', 'accessible IT'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'staff_display',
			'title'			=> ('Staff Display'),
			'description'	=> ('Great Lakes Staff'),
			'render_template'	=> 'template-parts/staff_greatlakesada.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'staff','employee'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'chronicle_view',
			'title'			=> ('Chronicle View'),
			'description'	=> ('Mainly for displaying current issue'),
			'render_template'	=> 'template-parts/chronicle_view.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'chronicle','ada', 'newsletter'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'youtube_showcase_display',
			'title'			=> ('YouTube Showcase'),
			'description'	=> ('Great Lakes ADA Center YouTube Showcase'),
			'render_template'	=> 'template-parts/youtube_showcase_view.php',
			'category'		=> 'formatting',
			'icon'			=> 'networking',
			'keywords'		=> array( 'youtube','ada', 'video'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'dataTable_tp',
			'title'			=> ('Display dataTable TP'),
			'description'	=> ('Display dataTable in a page'),
			'render_template'	=> 'template-parts/dataTable_TP.php',
			'category'		=> 'formatting',
			'icon'			=> 'media-spreadsheet',
			'keywords'		=> array( 'table', 'data'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));	
	
		acf_register_block_type( array(
			'name'			=> 'online_resource_repository',
			'title'			=> ('Online Resource Repository'),
			'description'	=> ('Read in urls from a file and fill a page'),
			'render_template'	=> 'template-parts/online_resource_repository.php',
			'category'		=> 'formatting',
			'icon'			=> 'media-spreadsheet',
			'keywords'		=> array( 'table', 'data'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
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
			'Supports'		=> array( 'mode' => false)
		));
	
		acf_register_block_type( array(
			'name'			=> 'colored_text_box',
			'title'			=> ('Colored Text Box'),
			'description'	=> ('Add a colored text box to a page or post'),
			'render_template'	=> 'template-parts/colored_text_box.php',
			'category'		=> 'formatting',
			'icon'			=> 'format-gallery',
			'keywords'		=> array( 'color', 'text'),
			'mode'			=> 'edit',
			'Supports'		=> array( 'mode' => false)
		));
	}
	
	add_action('acf/init', 'pm_register_blocks' );
	
?>
