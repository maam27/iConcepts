<?php
/*
 * Enable error reporting
 */
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

/*
 * Setup email addresses and change it to your own
 */
$from = "noreply@iproject24.icasites.nl";
$to = "bcv_neo@hotmail.com";
$subject = "Simple test for mail function";
$message = "This is a test to check if php mail function sends out the email";
$headers = "From:" . $from;

mail($to,$subject,$message, $headers);