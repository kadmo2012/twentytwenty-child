<?php

/*
* ajax code for displaying current record when you click on the state button
*/
add_action( 'wp_ajax_nopriv_jp_ajax_test', 'slug_ajax_callback' );
add_action( 'wp_ajax_jp_ajax_test', 'slug_ajax_callback' );
function slug_ajax_callback() {

	//$nonce = $_GET['nonce'];
	$nonce = $_REQUEST['nonce'];
	//echo "nonce: ".$nonce;
	if ( wp_verify_nonce( $nonce, 'nonce' ) ) {

		$inStateCd =  $_GET["state"];
		//$logfile = get_stylesheet_directory()."/log/wp_tablecode.log";
	
	    displayTable ($inStateCd, -1);

		wp_die( "" );
	}
	else{
        wp_die( 'Nonce error' );
    }


 
}

/*
* A function to display a table
*/

function displayTable ($inStateCd, $inPeriod) {

global $wpdb;

if ($inPeriod==-1) {
	//unpack period and stateCd
	$period = intval($inStateCd / 100);
	$stateCd=$inStateCd - $period*100;

}else {

	$period = $inPeriod;
	$stateCd=$inStateCd;

}

$sqlStatementSubtitle = "SELECT * FROM ".$wpdb->prefix."covidrpt_state_chg Where fips=".$stateCd." and period_days=".$period;
$result = $wpdb->get_results( $sqlStatementSubtitle);

// echo '<pre>';
//     print_r(  $result );
// echo '</pre>';
// die;


$subTitle = $result[0]->description;
$population=$result[0]->pop;

$sqlStatement="SELECT * FROM ".$wpdb->prefix."covidrpt_state_history Where period_days=".$period." and fips=".$stateCd." order by date_end desc";


?>


<div id="ajax-target2">

<?php
		//$wpdb->show_errors();
		$result = $wpdb->get_results( $sqlStatement);
		//$wpdb->print_error();

		//<p> <?php echo $print->date_end.', '.$print->period;	</p>
        $i=0;
		foreach ( $result as $print )   { 
		
			if ( $i==0 ): ?>
				
				<div class="scrollit">

				<table>
				<caption><?php echo $print->state.' Covid19 History: '; ?><?php echo $subTitle;	?> </caption>

				<thead>
				<tr>
				<th>Date</th>	
      			<th>TotalCases</th>
  			    <th>NewCases</th>
			    <th>DailyAverage</th>
				<th>Per100k</th>
     			<th>TotalDeaths</th>
	 			<th>NewDeaths</th>
	 			<th>DailyAverage</th>
				 <th>TotalDeaths/100k</th>
				 <th>Notes</th>
    			</tr>
				</thead>
				<tbody>
			<?php endif; 
			
			$date2=date_create($print->date_begin);        
			$baseDate = date_format($date2,"M d");			
			?>


          <tr>
		  		  <td><?php echo $print->date_end; ?> </td>
				  <td> <?php echo number_format($print->cases_end); ?> </td>
				  <td><?php echo number_format($print->cases_chg); ?> </td>
				  <td><?php echo number_format($print->cases_avg); ?> </td>
				  <td><?php echo (int)($print->casesPer100k/$print->period_days); ?> </td>
                  <td> <?php echo number_format($print->deaths_end); ?> </td>
				  <td> <?php echo number_format($print->deaths_chg); ?> </td>  
				  <td> <?php echo number_format($print->deaths_avg); ?> </td>  
				  <td><?php echo round($print->deaths_end / ($population / 100000)); ?> </td>
		  		  <td><?php echo $print->period." base date is ".$baseDate.". Total cases were ".number_format($print->cases_begin)."; total deaths were ".number_format($print->deaths_begin)."."; ?> </td>
          </tr>
			<?php $i=$i+1; 
			
		}
      ?>
</tbody>
</table>
</div>
</div>
<?php

	} // End function

// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;




function displayTable1 ($inPeriod) {

global $wpdb;

$sqlStatement = "SELECT * FROM ".$wpdb->prefix."covidrpt_state_chg Where period_days=".$inPeriod." order by date_end desc, section, casesPer100k desc";

$period100 = $inPeriod*100;



// echo '<pre>';
//     print_r(  $result );
// echo '</pre>';
// die;


?>



<div id="ajax-target2a">

<?php
		//$wpdb->show_errors();
		$result = $wpdb->get_results( $sqlStatement);
		//$wpdb->print_error();

        $i=0;
foreach ( $result as $print )   { 

	if ( $i==0 ): ?>
		
		<div class="scrollit">

		<table>
		<caption><?php echo 'Current Day National and State Data for ';	?><?php echo date("M j", strtotime($print->date_end)).', Period: '.$print->period.'.';	?></caption>
		<thead>
		<tr>
		 <th style="text-align:center">State</th>
		 <th>TotalCases</th>
		 <th>NewCases</th>
		 <th>DailyAverage</th>
		 <th>Per100k</th>
		 <th>TotalDeaths</th>
		 <th>NewDeaths</th>
		 <th>DailyAverage</th>
		 <th>TotalDeaths/100k</th>
		 <th>FullName</th>
		 <th>Notes</th>
		</tr>
		</thead>
		<tbody>
	<?php endif; 
	
		$stateNumericCd = $period100 + $print->fips;
		$date2=date_create($print->date_begin);
        
		$baseDate = date_format($date2,"M d");
	
	
	?>


  <tr>
		  <td> <div ID=<?php echo $stateNumericCd; ?> class="btn-group"><button ><?php echo $print->state_cd; ?>  </button></div> </td>
		  <td> <?php echo number_format($print->cases_end); ?> </td>
		  <td><?php echo number_format($print->cases_chg); ?> </td>
		  <td><?php echo number_format($print->cases_avg); ?> </td>
		  <td><?php echo (int)($print->casesPer100k/$print->period_days); ?> </td>
		  <td> <?php echo number_format($print->deaths_end); ?> </td>
		  <td> <?php echo number_format($print->deaths_chg); ?> </td>
		  <td> <?php echo number_format($print->deaths_avg); ?> </td>		  		  
		  <td><?php echo round($print->deaths_end / ($print->pop / 100000)); ?> </td>
		  <td><?php echo $print->state; ?> </td>
		  <td><?php echo $print->period." base date is ".$baseDate.". Total cases were ".number_format($print->cases_begin)."; total deaths were ".number_format($print->deaths_begin)."."; ?> </td>
  </tr>
	<?php $i=$i+1; 
	
}
?>
</tbody>
</table>
</div>


</div>
<?php

	} // End function

// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;

?>