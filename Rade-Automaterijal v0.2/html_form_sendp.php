<?php
if(isset($_POST['email'])) {
     
    // CHANGE THE TWO LINES BELOW
    $email_to = "radespasoje@gmail.com";
     
    $email_subject = "Registracija pravnog lica";
     
     
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
   if(!isset($_POST['all_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['licna_karta'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
   $all_name = $_POST['all_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $licna_karta = $_POST['licna_karta']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Ime firme: ".clean_string($all_name)."\n";
    $email_message .= "Adresa firme: ".clean_string($last_name)."\n";
	$email_message .= "Pristup web portalu: ".implode(" ", $_POST['services'])."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Kontakt telefon: ".clean_string($telephone)."\n";
    $email_message .= "Pib: ".clean_string($licna_karta)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
header("Location: index.html");
?>
 
<!-- place your own success html below -->


 
<?php
}
die();
?>