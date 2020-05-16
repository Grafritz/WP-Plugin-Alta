<?php
class Tools
{		
	private function __construct()//Declaration du constructeur privee pour empechee toute instanciation de la classe
	{
	}//
	
	static function ClearString($texte){
		$texte = utf8_decode($texte); // converti en utf8
		$texte = stripslashes($texte); // �limine les anti-slashs d'�chappement
		$texte = nl2br($texte); // pour bien traduire les retour � la ligne
		$texte = trim($texte); // �limine les '\n', '\r', '\t' etc
		return $texte;
	}//
	//
	static function Replace_specialChar($Texte)
	{
		$Texte = str_replace(" ", "_", $Texte);
		$Texte = str_replace("'", "", $Texte);
		$Texte = str_replace(".", "_", $Texte);
		$Texte = str_replace("(", "_", $Texte);
		$Texte = str_replace(")", "", $Texte);
		$Texte = str_replace("é","e", $Texte);
		$Texte = str_replace("è", "e", $Texte);
		$Texte = str_replace("à", "a", $Texte);
		$Texte = str_replace("â","a", $Texte);
		$Texte = str_replace("é","e", $Texte);
		$Texte = str_replace("ô","o", $Texte);
		$Texte = str_replace("«","", $Texte);
		$Texte = str_replace("»","", $Texte);
		return $Texte;
	}//
	//
	static function GetPageName()
	{
		// r�cup�ration du nom de la page courante ainsi que ses arguments
		if ($_SERVER['QUERY_STRING'] == "") {
		  $PageCourante = $_SERVER['PHP_SELF'];
		}
		else {
		  $PageCourante = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
		return basename($PageCourante);
	}//
	//
	static function GetCurrent_Url()
	{
		// r�cup�ration du nom de la page courante ainsi que ses arguments
		if ($_SERVER['QUERY_STRING'] == "") {
		  $PageCourante = $_SERVER['PHP_SELF'];
		}
		else {
		  $PageCourante = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
		return $PageCourante;
		//$_SERVER['REQUEST_URI'];
	}//
	//
	static function getServerUrl() 
	{ 
		return "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	}//
	//	
	static function _getServerUrl() 
	{
		/*$server_url = ''; 
		if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) 
		{ 
			// explode the host list separated by comma and use the first host 
			$hosts = explode(',', $_SERVER['HTTP_X_FORWARDED_HOST']); 
			$server_url = $hosts[0]; 
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_SERVER'])) 
		{ 
			$server_url = $_SERVER['HTTP_X_FORWARDED_SERVER']; 
		}else{ 
			if(empty($_SERVER['SERVER_NAME']))
			{ 
				$server_url = $_SERVER['HTTP_HOST']; 
			}else{ 
				$server_url = $_SERVER['SERVER_NAME']; 
			} 
		} 
		
		if (!strpos($server_url, ':'))
		{ 
			if ( ($this->_isHttps() && $_SERVER['SERVER_PORT']!=443) || (!$this->_isHttps() && $_SERVER['SERVER_PORT']!=80) )
			{ 
				$server_url .= ':'; 
				$server_url .= $_SERVER['SERVER_PORT']; 
			} 
		} *///
		return "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		//return $server_url; 
	}//
	//
	
// -- Generer Code Automatique -
// Methode permettant de generer une chaine automatique de facon aleatoire
	static function Generer_Code()
	{
		$pass='';
		$chaine = "abcdefghijklmnopqrstuvwxyz";
		
		//nombre de caract�res dans le mot de passe
		$nb_caract = 10;
		//on fait une boucle
		for($u = 1; $u <= $nb_caract; $u++) 
		{
			//on compte le nombre de caract�res pr�sents dans notre chaine
			$nb = strlen($chaine);
			// on choisie un nombre au hasard entre 0 et le nombre de caract�res de la chaine
			$nb = mt_rand(0,($nb-1));
			// on ecrit  le r�sultat
			$pass.= $chaine[$nb];
		}
		return $pass;
	}//
	//
	// Function qui revoi un POPUp en Javascript
	static function DialogPopUP($Message)
	{
		$Message = addslashes($Message);
		echo '<script language="javascript" type="text/javascript"> 
					alert("'.$Message.'");
			  </script>';
    }
    // Function qui Affiche un Message dans une division en rouge et bleu
	static function Show_Message($Message, $E_or_S ="E", $Racine='../')
	{
		$Message = stripslashes(addslashes($Message));
		if ($E_or_S == "E"){
			$Image = '<img src="'.$Racine.'images/alert.png" width="16" height="16" alt="" />';
			$color = ' style="color:#900;"';
		}else{
			$Image = '<img src="'.$Racine.'images/accept.png" width="16" height="16" alt="." />';
			$color = ' style="color:green;"';
		}
		
		return $_message = '<div class="ClassMessage" 
		style="background-color: #FFE3D7;
		border-top-width: 1px;
		border-right-width: 10px;
		border-bottom-width: 1px;
		border-left-width: 10px;
		border-top-style: solid;
		border-right-style: solid;
		border-bottom-style: solid;
		border-left-style: solid;
		border-top-color: #FFAE88;
		border-right-color: #FFAE88;
		border-bottom-color: #FFAE88;
		border-left-color: #FFAE88;
		padding: 5px; '.$color.'" > 
					'.$Image.'  '.$Message.'
					</div>';
	}
	static function ShowMessageBS($message, $E_or_S ="E")
	{
		$message = stripslashes(addslashes($message));
		if ($E_or_S == "E"){
			$image = '<i class="fa fa-warning"></i> <strong>Attention!</strong> ';
			$alert = ' alert-danger ';
		}elseif ($E_or_S == "W"){
			$image = '<i class="fa fa-warning"></i> <strong>Warning!</strong> ';
			$alert = ' alert-warning ';
		}elseif ($E_or_S == "I"){
			$image = '<i class="fa fa-info"></i> <strong>Info!</strong> ';
			$alert = ' alert-info ';
		}else{
			$image = '<i class="fa fa-check sign"></i> <strong>Success!</strong> ';
			$alert = ' alert-success ';
		}
		
        return $_message = '
        <div class="alert '.$alert.'">
            '.$image.'  '.$message.'
        </div>';
	}
	// Cette fonction permet d'avoir l'icon du Document xsl,pdf,ppt,doc...
	static function GetIconDocument($Type)
	{
		switch(strtolower($Type))
		{
			case "xls": return 'page_excel.png'; break;
			case "xlsx": return 'page_excel.png'; break;
			case "ppt": return 'page_powerpoint.png'; break;
			case "pptx": return 'page_powerpoint.png'; break;
			case "doc": return 'page_word.png'; break;
			case "docx": return 'page_word.png'; break;
			case "pdf": return 'page_pdf.png'; break;				
		}
	}//
	//
	// Cette fonction permet d'avoir l'icon du Document xsl,pdf,ppt,doc...
	static function GetIconStatut($Type, $racine = '')
	{
		switch(strtolower($Type))
		{
			case "1": return '<img src="../images/accept.png" width="16" border="0" alt="Actif" title="Actif" />'; break;
			case "0": return '<img src="../images/cancel.png" width="16" border="0" alt="Inactif" title="Inactif" />'; break;			
		}
	}//
	//
	
// Function qui permet de rafraichire la fenetre mere
// et qui ferme le PopUp
	static function Refresh_MainPage($RefreshMainPage=true, $CloseWindow=true)
	{
		$CloseWindow = ($CloseWindow)? 'window.close();' : '';
		$RefreshMainPage = ($RefreshMainPage)? 'window.opener.location.href = window.opener.location.href;' : '';
		echo '<script>'.$RefreshMainPage.' '.$CloseWindow.'</script>';
	}//
	//
	// et qui ferme le PopUp
	static function Close_Window()
	{
		echo '<script>window.close();</script>';
	}//
	//
	// - Fonction Redirection --
	static function redirige($url)
	{
	   die('<meta http-equiv="refresh" content="0;URL='.$url.'">');
	}//
	//
	// Methode permetant d'envoyee un email personalise a l'utilisateur
	static function Mail_Personaliser($to, $From, $YourName, $subject, $ContenuMsg)
	{
		$message = '
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title> Feed-Back</title>
	<style type="text/css">
		body{
			font-family:Verdana, Arial, Helvetica, sans-serif;
			font-size:11px;
			margin: 0; 
			padding: 0;
			text-align: left;
			background-color:#000000;
		}
		#DIV_Comments{
			margin-top:10px; 
			background-color:#FFFFFF; 
			margin:0px auto; 
			width:942px;
		}
	</style>
	</head>
	
	<body>
		 <div id="DIV_Comments">
			<center>
			<img src="www.radiotimoun.ht/images/Header.jpg" border="0" />
			</center><br /><br />
			<table align="center" width="100%" border="0" cellpadding="1">
				<tr>
					<td width="144" nowrap="nowrap"><b>Nom complet :</b></td>
					<td>'.$YourName.'</td>
				</tr>
				<tr>
					<td width="144" nowrap="nowrap"><b>e-mail (destinataire) :</b></td>
					<td>'.$From.'</td>
				</tr>
				<tr>
					<td width="144" nowrap="nowrap"><b>Subjet :</b></td>
					<td>'.$subject.'</td>
				</tr>
				<tr>
					<td colspan="2">
					<b>Comments :</b>
					</td>
				<tr>
				<tr>
					<td colspan="2">
					'.$ContenuMsg.'
					</td>
				<tr>
			</table><br /><br />
	</div>
	</body>
	</html>
		';
		 $Compte = '"'.$YourName.'"&#8249;'.$From.'&#8250;';
		 // Pour envoyer un mail HTML, l'en-t�te Content-type doit �tre d�fini charset="iso-8859-1"
		 // Kisakihiphop "<camalay02@hotmail.com>
		 $headers  = 'MIME-Version: 1.0' . "\r\n";
		 //$headers .= 'From: "MSPP "<support@mspp.gouv.ht>' . "\r\n";
		 $headers .= 'From: '.$From . "\r\n";
		 $headers .= 'Reply-To: '.$From . "\r\n";
		 $headers .= 'Content-Type: text/html;  charset=utf-8'."\r\n";
		 $headers .= 'Content-Transfer-Encoding: 8bit';
			 
		if(mail($to,$subject,$message,$headers))
		{
			return true;
		}else{
			return false;
		}
	}
	static function check_date($day, $month, $year) 
	{ 
		if ( (($month%2 != 0) and ($month <= 7)  or ($month%2 == 0) and ($month >= 8) and ($month <= 12)) and ($day > 31) ){ 
			$res = 0; 
		}   elseif ( ( ($month%2 == 0) and ($month <= 6) or (($month == 9) or ($month == 11)) ) and ($day > 30) ){
				$res = 0;   
		}   elseif ( (($month == 2) and ($year%4 != 0) and ($day > 28)) or (($month == 2) and ($year%4 == 0) and ($day > 29)) ) {
				$res = 0;   
		} else { 
			$res = ($year.$month.$day); 
		}
		return $res;
	}//
	//
	static function check_expirdate($month, $year)
	{ 
		if ( $year > (int)date('Y') ){ 
			$res = true; 
		}   elseif (($month > (int)date('m')) and ( $year == (int)date('Y') ) ){
				$res = true;  
		} else {
				$res = false;
		}
		return $res;
	}//
	//
	static function fulldate ( $ts='', $format=1){
		setlocale (LC_ALL, 'fr_FR', 'fr', 'FR'); //fr_FR sur unix/linux
		switch ($format) {
			case 1: return strftime('%A %d %B %Y', $ts ); break; //Sortie: lundi 07 septembre 2005 ;
			case 2: return strftime('%d %B %Y', $ts ); break; //Sortie: 07 septembre 2005 ; 
			case 3: return strftime('%d %b %Y', $ts ); break; //Sortie: 07 sept 2005 ;
			case 4: return strftime('%d %b', $ts ); break; //Sortie: 07 sept  ;
			case 5: return strftime('%d-%m-%Y', $ts ); break; //Sortie: 07-07-2005  ;
			case 6: return strftime('%b %Y', $ts ); break; //sept 2005
			default: return strftime('%d-%m-%Y', $ts ); break; //Sortie: 07-07-2005 ;
		}
	}//
	//
	
	// -----------------------------------------
	// crypte une chaine (via une cl� de cryptage)
	// -----------------------------------------
	static function crypter($maChaineACrypter)
	{
		$maCleDeCryptage="KapabHaitiBrainDjesussewamapadorel";
		if($maCleDeCryptage==""){
			$maCleDeCryptage=$GLOBALS['PHPSESSID'];
		}
		$maCleDeCryptage = md5($maCleDeCryptage);
		$letter = -1;
		$newstr = '';
		$strlen = strlen($maChaineACrypter);
		for($i = 0; $i < $strlen; $i++ ){
			$letter++;
			if ( $letter > 31 ){
				$letter = 0;
			}
			$neword = ord($maChaineACrypter{$i}) + ord($maCleDeCryptage{$letter});
			if ( $neword > 255 ){
				$neword -= 256;
			}
			$newstr .= chr($neword);
		}
		return base64_encode($newstr);
	}//
	//
	// -----------------------------------------
	// d�crypte une chaine (avec la m�me cl� de cryptage)
	// -----------------------------------------
	static function decrypter($maChaineCrypter)
	{
		$maCleDeCryptage="KapabHaitiBrainDjesussewamapadorel";
		if($maCleDeCryptage==""){
			$maCleDeCryptage=$GLOBALS['PHPSESSID'];
		}
		$maCleDeCryptage = md5($maCleDeCryptage);
		$letter = -1;
		$newstr = '';
		$maChaineCrypter = base64_decode($maChaineCrypter);
		$strlen = strlen($maChaineCrypter);
		for ( $i = 0; $i < $strlen; $i++ ){
			$letter++;
			if ( $letter > 31 ){
				$letter = 0;
			}
			$neword = ord($maChaineCrypter{$i}) - ord($maCleDeCryptage{$letter});
			if ( $neword < 1 ){
				$neword += 256;
			}
			$newstr .= chr($neword);
		}
		return $newstr;
	}
	// Checking for Credit card Format 
	static function checkFormatCC($element)
	{	
		if(preg_match('/^([0-9]{4})[\-|\s]*([0-9]{4})[\-|\s]*([0-9]{4})[\-|\s]*([0-9]{4})$/', $element))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}//
	//
	static function validateCC($cc_num, $type)
	{	
		if($type == "American")
		{
			$denum = "American Express";
		}elseif($type == "Dinners"){
			$denum = "Diner's Club";
		}elseif($type == "Discover") {
			$denum = "Discover";
		}elseif($type == "Master") {
			$denum = "Master Card";
		}elseif($type == "Visa") {
			$denum = "Visa";
		}
	
		if($type == "American")
		{
			$pattern = "/^([34|37]{2})([0-9]{13})$/";//American Express
			if(preg_match($pattern,$cc_num)) {
				$verified = true;
			}else {
				$verified = false;
			}
		}elseif($type == "Dinners")
		{
			$pattern = "/^([30|36|38]{2})([0-9]{12})$/";//Diner's Club
			if (preg_match($pattern,$cc_num)) {
				$verified = true;
			}else{
				$verified = false;
			}
		}elseif($type == "Discover")
		{
			$pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
			if (preg_match($pattern,$cc_num)) {
				$verified = true;
			}else{
				$verified = false;
			}
		} elseif($type == "Master")
		{
			$pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
			if (preg_match($pattern,$cc_num)) {
				$verified = true;
			}else{
				$verified = false;
			}
		} elseif($type == "Visa")
		{
			$pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
			if (preg_match($pattern,$cc_num)) {
				$verified = true;
			}else {
				$verified = false;
			}
		}//
		
		if($verified == false) {
		//Do something here in case the validation fails
			echo "Credit card invalid. Please make sure that you entered a valid <em>" . $denum . "</em> credit card ";
		}else{ //if it will pass...do something
			echo "Your <em>" . $denum . "</em> credit card is valid";
		}
	}//
	//
	// Checking for Digits Only
	static function isDigits($element) {
	  return !preg_match ("/[^0-9 ]/", $element);
	}//
	//
	// Checking for NIF 
	static function checkNIF($element) {
		  $res = preg_match( '/^(([0-9]{3})[\-|\s]*){3}([0-9])$/', $element);
		return $res; 
	}//
	//	
	// Checking for CIN 
	static function checkCIN($element) {
		 $res = preg_match( '/^([0-9]{2})[\-|\s]*([0-9]{2})[\-|\s]*([0-9]{2})[\-|\s]*([0-9]{4})[\-|\s]*([0-9]{2})[\-|\s]*([0-9]{5})[\-|\s]*$/', $element);
		return $res; 
	}//
	//	
	//Checking for Letters Only
	static function isLetters($element) {
	  return !preg_match ("/[^A-z  ']/", $element);
	}//
	//
	//
	//Checking a String for Length
	static function checkLength($string, $min, $max) {
	  $length = strlen ($string);
	  if (($length < $min) || ($length > $max)) {
		return FALSE;
	  } else {
		return TRUE;
	  }
	}//
	//	
	//Checking a Number  Value
	static function checkValue($number, $min, $max) {
	  if (($number < $min) || ($number > $max)) {
		return FALSE;
	  } else {
		return TRUE;
	  }
	}//
	//
	//CeckiURL
	static function checkURL($url) {
	  return preg_match ("/http:\/\/(.*)\.(.*)/i", $url);
	}//
	//
	// Checking an URL and Connect
	static function checkURLandConnect($url) {  
	  if (!preg_match ("/http:\/\/(.*)\.(.*)/i", $url)) {
		return FALSE;
	  }
	  $parts = parse_url($url);
	  $fp = fsockopen($parts['host'], 80, $errno, $errstr, 10);
	  if(!$fp) {
		return FALSE;
	  }
	  fclose($fp);
	  return TRUE;
	}//
	//
	// Check e-mail
	static function checkEmail($email) {
	  $pattern = "/^[A-z0-9\._-]+"
			 . "@"
			 . "[A-z0-9][A-z0-9-]*"
			 . "(\.[A-z0-9_-]+)*"
			 . "\.([A-z]{2,6})$/";
	  return preg_match ($pattern, $email);
	}//
	//	
	// Check Password
	static function checkPassword($password) {
	  $length = strlen ($password);
	  if ($length < 8) {
		return FALSE;
	  }
	  $unique = strlen (count_chars ($password, 3));
	  $difference = $unique / $length;
	  echo $difference;
	  if ($difference < .60) {
		return FALSE;
	  }
	  return preg_match ("/[A-z]+[0-9]+[A-z]+/", $password);
    }
    
################################################################
static function PHPMailer_AuthYES($FromEmail, $FromName, $To, $Subject, $MsgBody)
{
	require_once("./Query/PHPMailer/class.phpmailer.php");
	$email = new PHPMailer();
	
	//$body = file_get_contents('contents.html');
	//$body = eregi_replace("[\]",'',$body);

	$email -> CharSet = "UTF-8";
	$email -> IsSMTP();
	$email -> Host = "smtp.eebv.net"; // SMTP servers 
	$email -> SMTPAuth = true;
	$email -> Username = "info@eebv.net";
	$email -> Password = "eebv_net_pass";
	
	$email -> Subject = $Subject;
	$email -> Body = $MsgBody;
	$email -> From = $FromEmail;//"info@brain-dev.net";
	$email -> FromName = $FromName." (".$FromEmail.")";
	$email -> AddAddress($To);//'info@brain-dev.net');
	$email -> AddReplyTo($FromEmail, $FromName);
	$email -> IsHTML(true);
	
	
	if(!$email->Send())
	{
		return 0;
		//echo 'There was a problem sending this mail!';
	}else{
		return 1;
		//echo 'Mail sent!';
	}
	
	$email -> ClearAddresses();
	$email -> ClearAttachments();
}//
}//End Class
//

?>