<?php 

	include('../../cmd/sql_link.php'); //Base de Datos
	db_connect();

	switch($_POST['botonCom']){
			case "agregar":
				session_start();
				extract($_REQUEST);
				$precio = $_POST['precio'];	
				$nombre = $_POST['desComp'];	
				$id = $_POST['idArti'];


				if(!isset($cantidad)){$cantidad=1;}

				if(isset($_SESSION['carro']))
				$carro=$_SESSION['carro'];
			
				$carro[md5($id)]=array('identificador'=>md5($id),'cantidad'=>$cantidad,'producto'=>$nombre,'precio'=>$precio,'id'=>$id);

				$_SESSION['carro']=$carro;
				header("Location:compra.php?".SID);
			break;	
			
			case "actualizar":
				session_start();
				extract($_REQUEST);
				$cantidad= $_POST['cantidad'];
				$precio = $_POST['precio'];	
				$nombre = $_POST['desComp'];	
				$id = $_POST['idArti'];  
				
				//incluímos la conexión a nuestra base de datos
				if(!isset($cantidad)){$cantidad=1;}

				if(isset($_SESSION['carro']))
				$carro=$_SESSION['carro'];

				$carro[md5($id)]=array('identificador'=>md5($id),'cantidad'=>$cantidad,'producto'=>$nombre,'precio'=>$precio,'id'=>$id);

				$_SESSION['carro']=$carro;
				header("Location:vercarrito.php?".SID);
				
			break;	

			case "noAgregar":	
				session_start();
				$id = $_POST['idArti'];
				extract($_GET);

				$carro=$_SESSION['carro'];
				
				unset($carro[md5($id)]);

				$_SESSION['carro']=$carro;

				header("Location:compra.php?".SID);		
			break;	
	}	
?>