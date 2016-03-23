<?php 
	session_start();
	require_once __DIR__ . '/Facebook/autoload.php';
	require_once __DIR__ . '/auth.php';

	$fb = new Facebook\Facebook([
	  'app_id' => $app_id,
	  'app_secret' => $app_secret,
	  'default_graph_version' => $version_graph,
	]);


	if(!isset($_COOKIE['chave'])){
		$helper = $fb->getRedirectLoginHelper();
		try {
			$chavedeacesso = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		}
	}else{
		$chavedeacesso = $_COOKIE['chave'];
	}

	if(isset($chavedeacesso)){
		setcookie("chave", $chavedeacesso );
		$fb->setDefaultAccessToken( $_COOKIE['chave'] );
		echo '<a href="post.php?chave='.$chavedeacesso.'">Link</a>';
		try{
			$resposta = $fb->get('/me?fields=id,name');
			$linha = $resposta->getGraphUser();
			echo "Olá ". $linha->getName();
			echo "<br /> <img src=\"https://www.facebook.com/photo.php?fbid=".$linha->getId()."\" >";
		}catch(Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Bad Request ' . $e->getMessage();
			exit;
		}
	}
?>