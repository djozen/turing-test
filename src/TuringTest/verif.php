<?php
// This is an example form using the Turing test class : check if the test success.
session_start();
include('turing.cls.php');

try
{
	$turing = new Turing();
	if(isset($_POST['saisie_turing']) && isset($_SESSION['turing']))
		if(strtolower($_POST['saisie_turing']) == strtolower($_SESSION['turing']))
			echo'Vous n\'êtes pas un robot.';
		else
			echo'Vous êtes un robot.';
	else
		echo 'Une erreur est apparue';
		
	echo'<br /><a href="example.php">Réessayer</a>';
}
catch(Exception $e)
{
  echo $e->getMessage();
}
?>