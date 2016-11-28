<?php
//##################################################################################################################################################################
$_ENV['db_queries']=0; //Numero total de db queries
//##################################################################################################################################################################
function db_query ($query, $count=false){

	//INICIALIZAÇÕES
	$db['host']  = "127.0.0.1";
	$db['user']  = "usuario";
	$db['senha'] = "123456";
	$db['base']  = "bancodedados";
	
	
	$retorno['result']=false;
	$retorno['count']=false;
	$retorno['link']=false;
	$retorno['error_msg']=false;

	//CONNECT
	$retorno['link']=mysql_connect($db['host'], $db['user'], $db['senha']);   if(!$retorno['link']){
		$retorno['error_msg']="Erro conectando ao banco de dados!<br/>";
		if($_ENV['debug']){ $retorno['error_msg'].="<small><b>MySQL error:</b> ".mysql_error()."</small><br/>"; }
		return $retorno;
	}
	
	//SELECT DB
	if(!mysql_select_db($db['base'], $retorno['link'])){
		$retorno['error_msg']="Erro selecionando base de dados!<br/>";
		if($_ENV['debug']){ $retorno['error_msg'].="<small><b>MySQL error:</b> ".mysql_error()."</small><br/>"; }
		return $retorno;
	}
	
	//QUERY
	$retorno['result']=mysql_query($query, $retorno['link']);   if(!$retorno['result']){
		$retorno['error_msg']="Houve um erro realizando a consulta SQL!<br/>";
		if($_ENV['debug']){ $retorno['error_msg'].="<small><b>MySQL error:</b> ".mysql_error()."</small><br/>"; }
		return $retorno;
	}
	

	/* Conta DB Queries. */ $_ENV['db_queries']++;
	/* Conta resultados. */ if($count){ $retorno['count']=mysql_num_rows($retorno['result']); }
	/* SUCESSO.          */ return $retorno;
}
//##################################################################################################################################################################