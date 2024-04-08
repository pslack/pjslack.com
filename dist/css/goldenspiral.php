@charset "UTF-8";

<?php

//THE ESSENCE OF PLEASING FORM BEGINS WITH PHI
//calculate phi
$phi = (1+sqrt(5))/2;


//the screen width should be input
$width = 1100;
$lmargin = round($width /2);


//make some calculations and create the top window
$height = round($width / $phi);
$tmargin = round($height /2);

?>

.topbanner {
  position:relative;
  top:0%;
  left:0%;
  width:100%;
  height:50px;
  background-color:#000;
}

.container {
  position: fixed;
  top: 50px;
  left: 50%;
  margin: 0 -<?=$lmargin?>px;
  width:<?=$width?>px;
  height:<?=$height?>px;

}

<?php
//the number of steps to compute should be the second
//input var
$steps = 10;


//we're going to do a clockwise spiral with
//origin at bottom left of 0,0

//set the initial start point
$x0=0;
$y0=0;
$x1=0;
$y1=0;

//generate the squares
for($i=0;$i<$steps;++$i){
  
  $y=$i+1;
  $zname="phi_$y";
  //the vector angle of the segment	
  $vangle = 45 - 90 * $i;
  	
  $zwidth=round( $width * ( 1/ pow($phi, $y) ) );
  $hypotenuse = round(sqrt(2* pow($zwidth,2)));

  $y1=$y0+$hypotenuse*sin(deg2rad($vangle));
  $x1=$x0+$hypotenuse*cos(deg2rad($vangle));

  $mybox=getGoldenBoxSet($x0,$y0,$x1,$y1,getQuadrant($vangle));
  $mybox['top'] = -1 * ($mybox['top'] - $height);
  if(round($mybox['top'])==0){
   $mybox['top']=0;
  }

  $padding=2;
  $margin=2;
  $border=0;
?>

.<?=$zname?> {
box-shadow: 6px 6px 5px #000000;
position:absolute;
width:<?=$zwidth - 2*($padding + $border + $margin) ?>px;
height:<?=$zwidth - 2*($padding + $border + $margin) ?>px;
left:<?=round($mybox['left'] + $padding + $border + $margin )?>px;
top:<?=round($mybox['top'] + $padding + $border + $margin)?>px;
background-color:<?=$mybox['color']?>;
margin:<?=$margin?>px;
padding:<?=$padding?>px;
opacity:0.85;
<?if($i<3){?>
overflow:auto;
<?}else{?>
overflow:hidden;
<?}?>
}

<?

 $x0=$x1;
 $y0=$y1;

}

//input angle is in degrees
//this returns which quadrant the angle lies in

function getQuadrant($angle){

 $xism = cos(deg2rad($angle));
 $yism = sin(deg2rad($angle));

 if($xism > 0 && $yism > 0){
  return (1);
 }
 if($xism < 0 && $yism > 0){
  return (2);
 }
 if($xism < 0 && $yism < 0){
  return (3);
 }
 if($xism > 0 && $yism < 0){
  return (4);
 }


}

//this function returns the top, left, bottom, right 
//of a box in a golden spiral given the two box points
//and the quadrant of the point sets
function getGoldenBoxSet($x_0,$y_0,$x_1,$y_1,$quadrant){
  if($quadrant == 1){
	$box['top']  = $y_1;
	$box['left'] = $x_0;
        $box['color']="#777";
	return $box;
  }
  if($quadrant == 2){
	$box['top']  = $y_1;
	$box['left'] = $x_1;
        $box['color']="#999";
	return $box;
  }
  if($quadrant == 3){
	$box['top']  = $y_0;
	$box['left'] = $x_1;
        $box['color']="#AAA";

	return $box;

  }
  if($quadrant == 4){
	$box['top']  = $y_0;
	$box['left'] = $x_0;
        $box['color']="#CCC";

	return $box;
  }

}




?>

body {
width:100%;
height:100%;
background-color:#000;
background-image:url('../images/pjbackdrop.jpg');
background-repeat: no-repeat;
Background-position: center top;

font-family:"Arial", Helvetica, sans-serif;

}

h1 {
 text-align:center;
 color:#EEE;
 font-size:250%;
}

h2 {
 text-align:center;
 color:#00E;
 font-size:150%;


}

h3 {
 text-align:center;
 color:#EE0;
 font-size:105%;
}

h4 {
}



.link_image{
width:220px;
position:relative;
left:50%;
margin:0px -110px;
}
.solar_image{
width:420px;
position:relative;
left:50%;
margin:0px -210px;
}

.front_image{
width:450px;
position:relative;
left:50%;
margin:0px -225px;
}


.full_stretch{
width:100%;
height:100%;
position:relative;
left:0%;
top:0%;
}


.social_links{
  position: fixed;
  top: 5px;
  left: 50%;
  margin: 0 -<?=$lmargin?>px;
  width:<?=$width?>px;
  height:50px;
}

.copyright_footer{
  position: fixed;
  top: <?=$height+50?>px;
  left: 50%;
  margin: 0 -<?=$lmargin?>px;
  width:<?=$width?>px;
  height:60px;

}
.scrollable_box {

}

.pjs_player {
box-shadow: 6px 6px 5px #000000;
  position:absolute;
  visibility:visible;
  width:<?=round( $width * ( 1/ pow($phi, 2) ) )?>px;
  height:45px;
  right:0px;
  overflow:hidden;
  background-color:#ffffff;
}

.pjs_player_position {
  position:absolute;
  visibility:visible;
  width:50%;
  height:5px;
  left:0px;
  bottom:0px;
  background-color:#ff0000;
}
