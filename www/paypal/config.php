<?php
//ProPayPal es vital para declarar si es demo o prueba las transacciones

//define('ProPayPal', 0); // El cero simboliza entorno de Prueba
//define('ProPayPal', 1); // El 1 simboliza entorno de producción

define('ProPayPal', 0);
if(ProPayPal){
define("PayPalClientId", "*********************");
define("PayPalSecret", "*********************");
define("PayPalBaseUrl", "https://demo.baulphp.com/paypal-php-integracion-con-ejemplo-completo/");
define("PayPalENV", "production");
} else {
define("PayPalClientId", "ATy-d9gqjbPqvfgNONW8sKqXZet6_9CKQbNuVeX6xeNQeW4UH0PFOBcVvYj57B7BplfQQsfihcAYQ_Bf");
define("PayPalSecret", "EPJsF9S3awmu1FQd7ZVHp2VYS5JBbUGUmQA8ofPNBxcfh0Y_-0NPvAe_ug2jjYRKdeZqPZfChKAAGV-9");
define("PayPalBaseUrl", "http://demo.baulphp.com/paypal-php-integracion-con-ejemplo-completo/");
define("PayPalENV", "sandbox");
}
?>
