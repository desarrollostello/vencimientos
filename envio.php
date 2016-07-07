<?php 
require ("phpmailer/class.phpmailer.php"); 
require ("phpmailer/class.smtp.php");
$mail = new PHPMailer(); 
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->IsSMTP (); 
$mail->ContentType = "text/html";
$mail->Host = "mail.serviciossql.com.ar"; 
$mail->Port = 465;
$mail->Username = "contacto@serviciossql.com.ar"; 
$mail->Password = "xTA8FJqV";
$mail->From = "contacto@serviciossql.com.ar";
$mail->FromName = "Aviso Vencimientos";
$mail->Subject = "Aviso de vencimientos cercanos";

$enlace = mysql_connect("localhost", "serviciossql_vto", "o1m15Io7"); 
mysql_select_db("serviciossql_vto1"); 

// devuelve los vencidos A HOY
$sql_vencidos = "SELECT v.*, cru.iduser, v.idCoope, c.mail, t.tema FROM vencimientos v, cooperativas c, cruge_user cru, temas t WHERE v.usuario = cru.iduser AND v.idCoope = c.id AND v.idTema = t.id and v.cumplido=0 AND v.fechaLimite < date(now())";
$resultado = mysql_query($sql_vencidos, $enlace);
$numero_filas = mysql_num_rows($resultado);
if ($numero_filas > 0){
    while ($row = mysql_fetch_array($resultado)) {
        $mensaje = "Se les informa que en el día de la fecha se encuentra vencido el siguiente elemento: <br />";
        $mensaje.="Fecha de Vencimiento: ". $row['fechaLimite'] . "<br />";
	$email = $row['mail'];
	$mail->Body = $mensaje; 
	$mail->AltBody = "Mensaje desde el sistema de Vencimientos";
        if ($row['idCoope'] == 0){
            // tengo que mandarles el mail a todas las cooperativas
            $sql_todas= "SELECT * FROM cooperativas";
            $r_todas = mysql_query($sql_todas, $enlace);
            while ($row_todo = mysql_fetch_array($r_todas)) {
                $mail->AddAddress($row_todo['mail']);
            }
        }else{
            $mail->AddAddress($email);
        }
	if(!$mail->Send())
            echo "There has been a mail error sending to " . $email . "<br>";
    }
    $mail->ClearAddresses(); 
    $mensaje = "";
}

$sql_hoy = "SELECT v.*, cru.iduser, v.idCoope, c.mail, t.tema FROM vencimientos v, cooperativas c, cruge_user cru, temas t WHERE v.usuario = cru.iduser AND v.idCoope = c.id AND v.idTema = t.id AND v.cumplido=0 AND v.fechaLimite = date(now())";
$resultado_hoy = mysql_query($sql_hoy, $enlace);
$numero_filas_hoy = mysql_num_rows($resultado_hoy);

if ($numero_filas_hoy > 0){
    while ($row_hoy = mysql_fetch_array($resultado_hoy)) {
        $mensaje = "Se les informa que en el día de la fecha se vence el siguiente elemento: <br />";
        $mensaje.="Fecha de Vencimiento: ". $row_hoy['fechaLimite'] . "<br />";
	$email = $row_hoy["mail"];
	$mail->Body = $mensaje; 
	$mail->AltBody = "Mensaje desde el sistema de Vencimientos";
        if ($row_hoy['idCoope'] == 0){
            // tengo que mandarles el mail a todas las cooperativas
            $sql_hoy= "SELECT * FROM cooperativas";
            $r_hoy = mysql_query($sql_hoy, $enlace);
            while ($row_hoy = mysql_fetch_array($r_hoy)) {
                $mail->AddAddress($row_hoy['mail']);
            }
        }else{
            $mail->AddAddress($email);
        }
	
	if(!$mail->Send())
            echo "There has been a mail error sending to " . $email . "<br>";
	$mail->ClearAddresses(); 
        $mensaje="";
    }
}

$sql_maniana = "SELECT v.*, cru.iduser, cru.username, v.fecha, v.idCoope, c.mail, t.tema, s.sector FROM vencimientos v, cruge_user cru, cooperativas c, temas t, sectores s WHERE t.idSector = s.id AND v.usuario = cru.iduser AND v.idCoope = c.id AND v.idTema = t.id AND v.cumplido=0 AND v.fechaLimite  BETWEEN CURDATE() AND INTERVAL 5 day + curdate();";
$resultado_maniana = mysql_query($sql_maniana, $enlace);
$numero_filas_maniana = mysql_num_rows($resultado_maniana);

if ($numero_filas_maniana > 0){
    while ($row_m = mysql_fetch_array($resultado_maniana)) {
        $mensaje = "Se le informa que dentro de los siguientes 5 días corridos se vence el siguiente documento: </br></br>";
        $mensaje.="Tema: <b>". $row_m['tema'] . "</b><br />" ;
        $mensaje.="Sector: <b>". $row_m['sector'] . "</b><br />" ;
        $mensaje.="Fecha de carga: <b>". $row_m['fecha'] . "</b><br />" ;
        $mensaje.="Cargado por: <b>". $row_m['username'] . "</b><br />" ;
        $mensaje.= "Fecha de Vencimiento: <b>". $row_m['fechaLimite'] . "</b><br />";
        $mensaje.="para verlo haga click <a href='http://www.serviciossql.com.ar/vto1/index.php?r=vencimientos/view&id=1'>aqu&iacute;</a>";
	$email = $row_m["mail"];
	$mail->Body = $mensaje; 
	$mail->AltBody = "Mensaje desde el sistema de Vencimientos";
        if ($row_m['idCoope'] == 0){
            // tengo que mandarles el mail a todas las cooperativas
            $sql_m= "SELECT * FROM cooperativas";
            $r_m = mysql_query($sql_m, $enlace);
            while ($row_m = mysql_fetch_array($r_m)) {
                $mail->AddAddress($row_m['mail']);
            }
        }else{
            $mail->AddAddress($email);
        }
	$mail->AddAddress($email);
	if(!$mail->Send())
            echo "There has been a mail error sending to " . $email . "<br>";
	$mail->ClearAddresses(); 
        $mensaje="";
    }
}
?>