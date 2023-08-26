<?php
$receiving_email_address = 'cspencer.gutierrez@csgmgroup.com.mx';

if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  include( $php_email_form );
} else {
  die( 'Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = 'Contacto CSGM Group';
$contact->from_email = 'contacto@csgmgroup.com.mx';
$contact->subject = 'Formularios de Contacto';
$contact->recaptcha_secret_key = '6LdenqknAAAAAMTPwjtOluMQUbfl9OJ0SigaIISd';

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials

$contact->smtp = array(
  'host' => 'smtp.hostinger.com',
  'username' => 'tech@csgmgroup.com.mx',
  'password' => 'PapaSinCaptsu90!',
  'port' => '587'
);


$contact->add_message( $_POST['name'], 'Nombre');
$contact->add_message( $_POST['email'], 'Email');
$contact->add_message( $_POST['subject'], 'Asunto');
$contact->add_message( $_POST['message'], 'Mensaje', 10);

echo $contact->send();
?>