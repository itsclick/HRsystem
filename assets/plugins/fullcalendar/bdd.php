<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=kuo_payroll;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
