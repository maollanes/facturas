<?php
	// Incluir SQL link
	include('sql_link.php');
	include('loginOff.php');

	// Inicia la sesion
	session_start();

	$ip = $_SERVER['REMOTE_ADDR'];

	// Inicializar variables de sesion
	$_SESSION['attr'] = '9';
	$_SESSION['auth'] = 'NO';
	$_SESSION['id_usuario'] = session_id();
	$_SESSION['user'] = session_id();
	$_SESSION['tipo_plantel'] = session_id();
	
	// Recibir variables POST
	$usuario = @$_POST['txtUsuario'];
	$password = @$_POST['txtPassword'];
	
	// Cast: AddSlashes
	addslashes($usuario);
	addslashes($password);
	
	// Cast: Del Crlf & Space
	$usuario = chop($usuario);
	$password = chop($password);
	
	// Revisar número de caracteres de ambas cadenas
	if(strlen($usuario)>12 and strlen($password)>12){
		$usuario = substr($usuario, 0, 8);
		$password = substr($password, 0, 8);
	}

	// Obtener la fecha	
	$ahora = getdate();
	$fecha = $ahora["year"] . "-" .  $ahora["mon"] . "-" . $ahora["mday"];

	// Conexión con la base de datos
	db_connect();

	//=== Antes de todo, verificamos la fecha para ver si terminó el periodo de captura. Si es así, se cambia el status a 0 ===//
	$date = date("Y-m-d"); // Se obtiene la fecha con el formato correcto
		
	$query = mysql_query('SELECT * FROM usuarios') or die(mysql_error());
	
		while($ret = mysql_fetch_array($query)){
			$idus = $ret['id_usuario'];
			$user = $ret['usuario'];
			$pass = $ret['password'];
			$type = $ret['tipo'];
			$nom = $ret['nombre'];
			$ap = $ret['ap_paterno'];
					
			if($user == $usuario) { // Identificado
				if($pass == $password) { // Autentificado
					$_SESSION['attr'] = $type;
					$_SESSION['id_usuario']=$type;
					$_SESSION['auth'] = 'YES';
					$_SESSION['id_usuario'] = $idus;
					$_SESSION['user'] = $user;
					$_SESSION['tipo'] = $type;
					$_SESSION['nombre'] = $nom;
					$_SESSION['paterno'] = $ap;
					
					break;
				}
			}
		}
			
		// Registrar ingreso
		if($_SESSION['auth'] == 'YES'){
			mysql_query("INSERT INTO ingresos (usuario) VALUES ('$idus')") or die(mysql_error());
			$flag = false;
			
			switch($_SESSION['attr']){
			
				case 'A0x1': // Manager
					header('location:../index.php');
					die();
				break;
				
				case 'P0x1': // Docentes
					
					header('location:../index.php'); // Redireccionar a check_periodo
					die();
					
				break;				
				
				case 'P0x2': // Alumnos
				
						header('location:../index.php'); // Redireccionar a verify_status
						die();
				break;

			}
		} 
		elseif($_SESSION['auth'] == 'NO'){
			//print('<br>intruso!');
			mysql_query("INSERT INTO intrusos (usuario,password,ip) VALUES ('$usuario','$password','$ip')") or die(mysql_error());
		}
		
		header('location:../message.html');
?>