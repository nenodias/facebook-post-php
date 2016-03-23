<?php 
	session_start();
	require_once __DIR__ . '/Facebook/autoload.php';
	require_once __DIR__ . '/auth.php';

	$fb = new Facebook\Facebook([
	  'app_id' => $app_id,
	  'app_secret' => $app_secret,
	  'default_graph_version' => $version_graph,
	]);
	if(isset($_COOKIE['chave'])){
		
		$fb->setDefaultAccessToken( $_COOKIE['chave'] );
		$mensagem = [
			'message' => 'Olá amiguinho',
			'link' => 'http://www.dolly.com.br',
			'picture' => 'https://pbs.twimg.com/profile_images/3382643320/5e7323e465d26ebdddf2cab4c5b26c31_400x400.jpeg'
		];

		$request = $fb->request('POST', '/me/feed', $mensagem);

		$execucao = ['post-to-feed' => $request];

		$fb->sendBatchRequest($execucao);
	}
?>