<?php header("Content-type: text/css");?>
@charset "UTF-8";

/*  /////////////////////////////////////////////////

 FRACTAL PHI, PROGRAMMABLE  CSS Document 
 Written by Peter J Slack
 http://www.pjslack.com

 This is a concept of having a server side, dynamic CSS page
 I happen to use PHP but this could certainly be any server side language
 The idea is to enable the creation of geometric from through mathematical
 algorithm.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.


   //////////////////////////////////////////////////
*/
<?



?>

@media all and (min-width: 1200px) {



<?
$width=1100;
generate($width,0,0,10,0);   
generate_extras($width);

?>



}
@media all and (max-width: 1199px) and (min-width: 700px) {
<?
$width=600;
generate($width,0,0,10,0);   
generate_extras($width);

?>

}
@media all and (max-width: 699px) and (min-width: 640px) {
<?generate(540,0,0,5,0);   ?>

}
@media all and (max-width: 639px) and (min-width: 400px) {
<?generate(300,0,0,5,0);   ?>

}



<?php

function generate_extras($width){
//THE ESSENCE OF PLEASING FORM BEGINS WITH PHI
//calculate phi
$phi = (1+sqrt(5))/2;

//the screen width should be input
$lmargin = round($width /2);
//make some calculations and create the top window
$height = round($width / $phi);
$tmargin = round($height /2);


?>
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

.pjs_player {
  position:absolute;
  visibility:visible;
  width:<?=round( $width * ( 1/ pow($phi, 2) ) )?>px;
  height:45px;
  right:0px;
  overflow:hidden;
  background-color:#ffffff;
}
<?php

}


function generate($width,$x0,$y0,$steps,$theta){

//THE ESSENCE OF PLEASING FORM BEGINS WITH PHI
//calculate phi
$phi = (1+sqrt(5))/2;

//the screen width should be input
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
	//$steps = 10;


	//we're going to do a clockwise spiral with
	//origin at bottom left of 0,0

	//set the initial start point
	//$x0=0;
	//$y0=0;
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

  	$padding=1;
  	$margin=2;
  	$border=0;
?>

.<?=$zname?> {
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

}

///////////////////////////////////////////////////
//
//
// input angle is in degrees
// this returns which quadrant the angle lies in
// we require the quadrant to get a vector of our spiral
//
//         |
//     I   |   II
//         |
//  -------|---------
//         |
//   IV    |  III
//         |
//
//

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

///////////////////////////////////////////////////
//
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



.pjs_player_position {
  position:absolute;
  visibility:visible;
  width:50%;
  height:5px;
  left:0px;
  bottom:0px;
  background-color:#ff0000;
}
