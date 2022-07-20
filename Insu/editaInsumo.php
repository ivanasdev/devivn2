<?php
if (!isset($_GET["idSucursal"])) {
	echo "Parametro Incorrecto";
	exit;
}


$ruta2index = "../../../../";
require($ruta2index . 'dbConexion.php');
$idSucursal = $_GET["idSucursal"];
//echo $idSucursal;



include("class.Catalogos.php");
$objCatalogos = new Catalogos();
//////////////////////////////////////////////////////////////////////
//$selectAreasInsumo = $objCatalogos->obtieneAreasInsumo($idSucursal);
$checkBoxSucursalesInsumo = $objCatalogos->obtieneSucursalesInsumo($idSucursal);
$checkBoxSucursalesOP = $objCatalogos->obtieneSucursalesInsumoOP($idSucursal);
$checkBoxSucursalesInsumoDEN = $objCatalogos->obtieneSucursalesInsumoDEN($idSucursal);
$checkBoxSucursalesInsumoLAB = $objCatalogos->obtieneSucursalesInsumoLAB($idSucursal);
$checkBoxSucursalesInsumoGIN = $objCatalogos->obtieneSucursalesInsumoGIN($idSucursal);
$checkBoxareas = $objCatalogos->GetAreas($idSucursal);



//QUERY VALIDA QUE EXISTA 

$queryval="SELECT id_FlagActivo FROM tbl_RelSucursalInsumosA WHERE id_Sucursal=".$idSucursal." ";
$resq1=mssql_query($queryval);
$activa=mssql_fetch_array($resq1);
$sucactiva=$activa['id_FlagActivo'];
if($sucactiva != 1){
	$botonactiva="
<div class='card text-center'>


<form id='FORMSIGNUP'>
<p>SUCURSAL INACTIVA!</p>

<input type='hidden' value='$idSucursal' name='idSucursal'>
<button class='btn btn-danger' style='margin:9px;'> ACTIVAR SUSURSAL</button>
</form>

</div>
	";




}

$query0 = "SELECT st_Nombre FROM cat_SucursalClinica WHERE id_SucursalClinica=" . $idSucursal . " ";
$resq = mssql_query($query0);
$nombresucs = mssql_fetch_array($resq);
$sucursalQ = $nombresucs['st_Nombre'];





$noasignada="
<div class='card s10'>
<div class='btn btn-warning center'>AREA NO ASIGNADA </div>	
</div> ";


$error1="";
//QUERY PARA VALIDAR AREAS //
$query0 = "SELECT st_AreasInsumos FROM tbl_RelSucursalInsumosA WHERE id_Sucursal=" . $idSucursal . " ";
$res0 = mssql_query($query0);

while ($arryareas = mssql_fetch_array($res0)) {
	$AreasInusmos = explode(",", $arryareas['st_AreasInsumos']); 
}


$dos=2;
$tres=3;
$cuatro=4;
$cinco=5;
$seis=6;

$flagam="";
$flagop="";
$flagden="";
$flaglab="";
$flaggin="";

$am=array($dos);
//echo $am[0];
if(in_array($am[0],$AreasInusmos)){
	$flagam=1;
}
else
{
	$flagam=0;
}

$op=array($tres);
if(in_array($op[0],$AreasInusmos)){
	$flagop=1;
}
else
{
	$flagop=0;
}


$den=array($cuatro);
if(in_array($den[0],$AreasInusmos)){
	$flagden=1;
}
else
{
	$flagden=0;
}


$lab=array($cinco);
if(in_array($lab[0],$AreasInusmos)){
	$flaglab=1;
}
else
{
	$flaglab=0;
}

$gin=array($seis);
if(in_array($gin[0],$AreasInusmos)){
	$flaggin=1;
}
else
{
	$flaggin=0;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="<?= $ruta2index ?>utils/jquery-1.11.1.min.js"></script>
	<!--<link rel="stylesheet" href="<?= $ruta2index ?>bionline/securitylayer/styles/styleTrasnparentBody.css" type="text/css">-->
	<link href="<?= $ruta2index ?>bionline/securitylayer/styles/style_botones.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

	<style type="text/css">
		#tablaForm td {
			height: 30px;
		}

		body {
			background-color: #EEE;
		}


		.card {
			background: rgba(247, 247, 247, 0.65);
			box-shadow: 0 8px 32px 0 #b2b2b2;
			backdrop-filter: blur(14px);
			-webkit-backdrop-filter: blur(14px);
			border-radius: 10px;
			border: 1px solid rgba(255, 255, 255, 0.18);
		}
	</style>
</head>

<body>
	<input type="hidden" name="refreshPagina" id="refreshPagina" value="0" />
	<table>
		<tr>
	
			<td><img src="<?= $ruta2index ?>bionline/securitylayer/images/statistics.gif" width="48" height="48"></td>
			<td><strong>ASIGNACION DE INSUMOS</strong></td>
			<?= $botonactiva ?>
		
	
		</tr>

	</table>
	<div class="card text-center">
			
	<h5><strong>Sucursal:</strong><?php echo $sucursalQ; ?></h5>

	</div>
	<button class="btn btn-dark" style="margin:18px ;" onclick="menuareasS()" ondblclick="menuareasH()">ASIGNAR AREAS</button>
	<div class="card text-center" id="areasmenu">
		<p>
		<h6>ASIGNAR AREAS</h6>

		
		</p>
		<form id="formAreas">
		<input type="hidden" name="idSucursal" id="idSucursal" value="<?php echo $idSucursal; ?>" />
			<div class="form-check">
				<?= $checkBoxareas ?>
			</div>
			<button class="btn btn-primary" id="btnareas">ACTUALIZAR AREAS</button>
		</form>
	</div>


	<div class="card card-bodie">

			<!--AREA MEDICA-->
		<button type="button" class="btn btn-dark" onclick="menuAMS()" ondblclick="menuAMH()" style="margin:18px;">AREA MEDICA</button>
		<div  id="AMFORM">
		<?php
   if($flagam){
	include("includes/am.php");
   }else{
	echo $noasignada;
   }


   ?>

		</div>

		<!--OPTICA-->
		<button type="button" class="btn btn-dark" onclick="menuOPS()" ondblclick="menuOPH()" style="margin:18px;">OPTICA</button>
		<div id="OPFORM">

		<?php
   if($flagop){
	include("includes/op.php");
   }else{
	echo $noasignada;
   }


   ?>



		</div>

		<!--DENTAL-->

		<button type="button" class="btn btn-dark" onclick="menuDENS()" ondblclick="menuDENH()" style="margin:18px;">DENTAL</button>
		<div id="DENFORM">

		<?php
   if($flagden){
	include("includes/den.php");
   }else{
	echo $noasignada;
   }


   ?>


		</div>


		<!--LABORATORIO-->
		<button type="button" class="btn btn-dark" onclick="menuLABS()" ondblclick="menuLABH()" style="margin:18px;">LABORATORIO</button>
		<div id="LABFORM">


		<?php
   if($flaglab){
	include("includes/lab.php");
   }else{
	echo $noasignada;
   }


   ?>


		</div>



		<!--GINECOLOGIA-->
		<button type="button" class="btn btn-dark" onclick="menuGINS()" ondblclick="menuGINH()" style="margin:18px;">GINECOLOGIA</button>
		<div id="GINFORM">
			

		<?php
   if($flaggin){
	include("includes/gin.php");
   }else{
	echo $noasignada;
   }


   ?>


		</div>
	</div>
	</div>
	</div>



	<script type="text/javascript">
		$(document).ready(function() {

			$("#AMFORM").hide();
			$("#OPFORM").hide();
			$("#DENFORM").hide();
			$("#LABFORM").hide();
			$("#GINFORM").hide();
			$("#areasmenu").hide();



			$("#selectallAM").on("click", function() {
				$(".caseAM").prop("checked", this.checked);
			});
			$(".caseAM").on("click", function() {
				if ($(".caseAM").length == $(".caseAM:checked").length) {
					$("#selectallAM").prop("checked", true);
				} else {
					$("#selectallAM").prop("checked", false);
				}
			});


			$("#selectallOP").on("click", function() {
				$(".caseOP").prop("checked", this.checked);
			});
			$(".caseOP").on("click", function() {
				if ($(".caseOP").length == $(".caseOP:checked").length) {
					$("#selectallOP").prop("checked", true);
				} else {
					$("#selectallOP").prop("checked", false);
				}
			});


			$("#selectallDEN").on("click", function() {
				$(".caseDEN").prop("checked", this.checked);
			});
			$(".caseDEN").on("click", function() {
				if ($(".caseDEN").length == $(".caseDEN:checked").length) {
					$("#selectallDEN").prop("checked", true);
				} else {
					$("#selectallDEN").prop("checked", false);
				}
			});


			$("#selectallLAB").on("click", function() {
				$(".caseLAB").prop("checked", this.checked);
			});
			$(".caseLAB").on("click", function() {
				if ($(".caseLAB").length == $(".caseLAB:checked").length) {
					$("#selectallLAB").prop("checked", true);
				} else {
					$("#selectallLAB").prop("checked", false);
				}
			});

			$("#selectallGIN").on("click", function() {
				$(".caseGIN").prop("checked", this.checked);
			});
			$(".caseGIN").on("click", function() {
				if ($(".caseGIN").length == $(".caseGIN:checked").length) {
					$("#selectallGIN").prop("checked", true);
				} else {
					$("#selectallGIN").prop("checked", false);
				}
			});


					$("#formAreas").submit(function(e) {
						e.preventDefault();
						var data = $("#formAreas").serializeArray();
						data.push({
							name: 'flag',
							value: 'areas'
						})
						$.ajax({
								url: 'doEditaInsumo.php',
								type: 'post',
								dataType: 'json',
								data: data
							})

							.always(function() {
								alert("DATOS GUARDADOS");
								window.location.href = window.location.href;
							})

					});

			$("#formAM").submit(function(e) {
				e.preventDefault();
				var data = $("#formAM").serializeArray();
				data.push({
					name: 'flag',
					value: 'am'
				})
				$.ajax({
						url: 'doEditaInsumo.php',
						type: 'post',
						dataType: 'json',
						data: data
					})

					.always(function() {
						alert("DATOS GUARDADOS");
						window.location.href = window.location.href;
					})

			});


			$("#formOP").submit(function(e) {
				e.preventDefault();
				var data = $("#formOP").serializeArray();
				data.push({
					name: 'flag',
					value: 'op'
				})
				$.ajax({
						url: 'doEditaInsumo.php',
						type: 'post',
						dataType: 'json',
						data: data
					})
					.always(function() {
						alert("Datos Guardados.");
						window.location.href = window.location.href;
					})
			});

			$("#FORMDEN").submit(function(e) {
				e.preventDefault();
				var data = $("#FORMDEN").serializeArray();
				data.push({
					name: 'flag',
					value: 'den'
				})
				$.ajax({
						url: 'doEditaInsumo.php',
						type: 'post',
						dataType: 'json',
						data: data
					})
					.always(function() {
						alert("Datos Guardados.");
						window.location.href = window.location.href;
					})
			});

			$("#FORMLAB").submit(function(e) {
				e.preventDefault();
				var data = $("#FORMLAB").serializeArray();
				data.push({
					name: 'flag',
					value: 'lab'
				})
				$.ajax({
						url: 'doEditaInsumo.php',
						type: 'post',
						dataType: 'json',
						data: data
					})
					.always(function() {
						alert("Datos Guardados.");
						window.location.href = window.location.href;
					})
			});


			$("#FORMGIN").submit(function(e) {
				e.preventDefault();
				var data = $("#FORMGIN").serializeArray();
				data.push({
					name: 'flag',
					value: 'gin'
				})
				$.ajax({
						url: 'doEditaInsumo.php',
						type: 'post',
						dataType: 'json',
						data: data
					})
					.always(function() {
						alert("Datos Guardados.");
						window.location.href = window.location.href;
					})
			});

			$("#FORMSIGNUP").submit(function(e) {
				e.preventDefault();
				var data = $("#FORMSIGNUP").serializeArray();
				data.push({
					name: 'flag',
					value: 'signup'
				})
				$.ajax({
						url: 'doEditaInsumo.php',
						type: 'post',
						dataType: 'json',
						data: data
					})
					.always(function() {
						alert("Datos Guardados.");
						window.location.href = window.location.href;
					})
			});

		}); //END OF READY FUNCTION

		//FUNCTIONS 


		function menuAMS() {
			$("#AMFORM").show();
		};

		function menuAMH() {
			$("#AMFORM").hide();
		};

		//OPTICA
		function menuOPS() {
			$("#OPFORM").show();
		};

		function menuOPH() {
			$("#OPFORM").hide();
		};


		//DENTAL
		function menuDENS() {
			$("#DENFORM").show();
		};

		function menuDENH() {
			$("#DENFORM").hide();
		};
		//LABORATORIO
		function menuLABS() {
			$("#LABFORM").show();
		};

		function menuLABH() {
			$("#LABFORM").hide();
		};
		//GINE
		function menuGINS() {
			$("#GINFORM").show();
		};

		function menuGINH() {
			$("#GINFORM").hide();
		};

		function menuareasS() {
			$("#areasmenu").show();
		}

		function menuareasH() {
			$("#areasmenu").hide();
		}
	</script>

</body>


</html>