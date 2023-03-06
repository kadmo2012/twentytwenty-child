<?php
/**
 * Team Member block
 *
 * @package      Custom Blocks
 * @author       Bonkaroo
 * @since        1.0.0
 * @license      GPL-2.0+
**/

global $wpdb;
$sectionTitle = get_field('data_description');
$period_days = get_field('period_days');


if( isset($_GET[ 'period' ]) ) {
  $period = $_GET[ 'period' ];
}
else {
  // What is ACF doing?  Should just be sending the value, instead it is sending value and label separated by a ':'
  $length = stripos($period_days,":");
  $period = substr($period_days,0,$length); 
}

    // echo '<pre>';
    //     print_r( $period_days);
    // echo '</pre>';
    // die;
      //echo $period_days['value'];




?>

<!-- CSS code -->

<style type="text/css">
table {
table-layout: auto;
width: 100%;  
margin: 4px;
border-collapse: collapse;
border-spacing: 2px;
border-color: gray
   
}


col {
  display: table-column;
} 



th {
font-family: Arial, Helvetica, sans-serif;
font-size: 1.0em;
background: #666;
color: #FFF;
padding: 2px 3px;
border-collapse: separate;
border: 1px solid #000;
text-align:left;
position: sticky;
top: 0; /* Don't forget this, required for the stickiness */
}

td {
font-family: Arial, Helvetica, sans-serif;
font-size: 1.0em;
border: 1px solid #DDD;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
}


.scrollit {
    overflow:scroll;
    height:650px;
    max-width: 800;
    background-color: oldlace;
    /* background-color: powderblue; */
    /* background-color: #f4ecd2;*/
}

.btn-group button {
  /*background-color: #4CAF50; /* Green background */
  /* border: 1px solid green; Green border */
  /*color: white; /* White text */
  /*padding: 10px 24px;  Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
  font-family: Arial, Helvetica, sans-serif;
  font-size: 1.0em;
  /*border: 1px solid #DDD;*/
  width: 100%;
  table-layout: fixed;
  border-collapse: collapse;
}

/* Clear floats (clearfix hack) */
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}

.btn-group button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
  /*background-color: #3e8e41;*/
}

.column {
  float: left;
  width: 50%;
  padding: 10px;
  column-gap: 20px;
  column-width:100%;
}

.column2 {
  float: left;
  width: 45%;
  padding: 10px;
  column-gap: 10px;
  column-width: 500px;
}

.column3 {
  float: left;
  width: 20%;
  padding: 10px;
  column-gap: 20px;
  column-width:100%;
}
.column4 {
  float: left;
  width: 30%;
  padding: 10px;
  column-gap: 20px;
  column-width:100%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.row {
  width: 100%;
}

caption {
    text-align:left;
}

.center {
  margin: auto;
  width: 70%;
  padding: 10px;
}
nav { text-align: center }

/* 
p {
  font-size: 18px;
}
 */


/* Responsive layout - makes the two columns stack on top of each other instead of next to each other on screens that are smaller than 600 px */
@media screen and (max-width: 800px) {
  .column {
    width: 100%;
  }
}
@media screen and (max-width: 1022px) {
  .column4 {
    width: 100%;
  }
}

@media screen and (max-width: 1022px) {
  .column3 {
    width: 100%;
  }
}


@media only screen and (min-width: 482px) {
	:root {
		--responsive--aligndefault-width: min(calc(100vw - 4 * var(--global--spacing-horizontal)), 1110px);
	}
}
@media only screen and (min-width: 822px) {
	:root {
		--responsive--aligndefault-width: min(calc(100vw - 8 * var(--global--spacing-horizontal)), 1110px);
	}
}


</style>

<div class="row"> 
<h4  style="text-align:center"><?php echo ($sectionTitle); ?></h4>

<form>
  <select name="period" id="period" >
    <option value="1" <?php echo selected($period,"1"); ?>>1 Day</option>
    <option value="7" <?php echo selected($period,"7"); ?>>7 Day</option>
    <option value="14" <?php echo selected($period,"14"); ?>>14 Day</option>
  </select>

  <button type="submit">Apply</button>
  </form>

  <hr>

<div class="column" style="background-color:#bbb;">

  <?php 
  
     displayTable1 ($period);
    // displayTable1 ($period_days['value']); ?>

</div>

<div class="column" id="ajax-target" style="background-color:#aaa;">
    
    <?php 
    
    // echo '<pre>';
    //     print_r( $period_days  );
    // echo '</pre>';
    // die;
      // echo $period_days['value'];
    
      $inStateCd = 0;
      displayTable ($inStateCd, $period);
        
    
    ?>
      
           
</div>

</div>
<hr>

<!-- <p> <?php echo get_template_directory_uri().'-child/mapapp/index.html'; ?> </p> -->



<?php

// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;





/* ************************************************ */


?>