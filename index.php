<?php 
	session_start();
	require_once __DIR__ . '/Facebook/autoload.php';
	require_once __DIR__ . '/auth.php';

	//unset($_SESSION['chave']);
	
	$fb = new Facebook\Facebook([
	  'app_id' => $app_id,
	  'app_secret' => $app_secret,
	  'default_graph_version' => $version_graph,
	]);

	$logar = $fb->getRedirectLoginHelper();
	$permissions = ['user_likes','user_events', 'user_photos', 'publish_actions'];
	$url = $logar->getLoginUrl("http://localhost:8080/trypix/retorno_login.php", $permissions);
	echo '<a href="'.$url.'">Faça Login com o Facebook</a>';

?>