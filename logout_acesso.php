<?php 
	session_start();
	unset($_SESSION['nome']);
	unset($_SESSION['email']);
	unset($_SESSION['comissao']);
	header('Location: index.php');
?>