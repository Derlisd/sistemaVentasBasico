<?php 
require_once "global.php";

$conexion=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

//muestra posible error en la conexion
if (mysqli_connect_errno()) {
	printf("Falló en la conexion con la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta')) {
Function ejecutarConsulta($sql){ 
global $conexion;
$query=$conexion->query($sql);
return $query;

	}
	Function ejecutarConsulta1($sql1){ 
		global $conexion;
		$query=$conexion->query($sql1);
		return $query;
	}
	// nuevo codigo
	function ejecutarUpdateVenta($sql){
		global $conexion;
		$query=$conexion->query($sql);
			$num_elementos=0;
			$sw=true;
	 while($row=$query->fetch_assoc())  
	   {

			$sql_detalle="UPDATE articulo set stock = stock + ".$row['cantidad']." WHERE idarticulo =".$row['idarticulo'];
   
			ejecutarConsulta($sql_detalle) or $sw=false;
   
	   }
	   
	   return $sw;
		}
		function ejecutarUpdateCompra($sql){
			global $conexion;
			$query=$conexion->query($sql);
				$num_elementos=0;
				$sw=true;
		 while($row=$query->fetch_assoc())  
		   {
	   
				$sql_detalle="UPDATE articulo set stock = stock - ".$row['cantidad']." WHERE idarticulo =".$row['idarticulo'];
	   
				ejecutarConsulta($sql_detalle) or $sw=false;
	   
		   }
		 
		   return $sw;
			}
	function ejecutarConsultaSimpleFila($sql){
global $conexion;
$query=$conexion->query($sql);
$row=$query->fetch_assoc();
return $row;
	}
function ejecutarConsulta_retornarID($sql){
global $conexion;
$query=$conexion->query($sql);
return $conexion->insert_id;
}

function limpiarCadena($str){
global $conexion;
$str=mysqli_real_escape_string($conexion,trim($str));
return htmlentities($str);
}

}

 ?>