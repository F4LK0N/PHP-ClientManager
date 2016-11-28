<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' lang='pt-br' xml:lang='pt-br'>
<head>
	<title>Clientes</title>
</head>
<body style='margin:0;  padding:0px;'>
<div style='width:600px;  margin:auto;  border:2px solid #BBB;  padding:0px 10px 30px;'>
	<?php require"#init.php" ?>

	<h1 style='text-align:center; text-decoration:underline;'>Cliente</h1>
	
	<?php
		//VERIFICAÇÃO DE ID
		$erro=false;
		if(!isset($_GET['cliente']) || !is_numeric($_GET['cliente']) || $_GET['cliente']<1){ $erro="Cliente invalido!"; }
		else{
			$_GET['cliente']=intval($_GET['cliente']);
			$db_op=db_query("SELECT id, db_status   FROM clientes   WHERE id='".$_GET['cliente']."'", true);
			if(!$db_op['result']){ $erro=$db_op['error_msg']; }
			elseif($db_op['count']<1){ $erro="Cliente não encontrado!"; }
			else{  
				$db_op['result']=mysql_fetch_assoc($db_op['result']);
				if($db_op['result']['db_status']==0){ $erro="Este cliente foi removido!"; }
			}
		}
		if($erro){   print"Não é possivel continuar!<br/>".$erro;   }
		else{
		
				//BUSCA DADOS DO CLIENTE
				$db_op2=db_query("SELECT *   FROM clientes   WHERE id='".$_GET['cliente']."'");
				if(!$db_op2['result']){ 
					print($db_op2['error_msg']);
				}
				else{
					$cliente=mysql_fetch_assoc($db_op2['result']);
					
					print"
					<h3>Dados Pessoais:</h3>
					<table style='width:100%'>
						<tr>
							<td width='100'>Nome:</td>
							<td>".$cliente['nome']."</td>
							<td style='text-align:right;'><a href='edit_nome.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
						<tr>
							<td>Sobrenome:</td>
							<td>".$cliente['sobrenome']."</td>
							<td style='text-align:right;'><a href='edit_sobrenome.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
						<tr>
							<td>Telefone:</td>
							<td>".$cliente['telefone']."</td>
							<td style='text-align:right;'><a href='edit_telefone.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td>".$cliente['email']."</td>
							<td style='text-align:right;'><a href='edit_email.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
					</table>
					<br/>
					
					<h3>Endereço:</h3>
					<table style='width:100%'>
						<tr>
							<td width='100'>Pais:</td>
							<td>".$cliente['end_pais']."</td>
							<td style='text-align:right;'><a href='edit_pais.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
						<tr>
							<td>Estado:</td>
							<td>".$cliente['end_estado']."</td>
							<td style='text-align:right;'><a href='edit_estado.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
						<tr>
							<td>Cidade:</td>
							<td>".$cliente['end_cidade']."</td>
							<td style='text-align:right;'><a href='edit_cidade.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
						<tr>
							<td>Bairro:</td>
							<td>".$cliente['end_bairro']."</td>
							<td style='text-align:right;'><a href='edit_bairro.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
						<tr>
							<td>Logradouro:</td>
							<td>".$cliente['end_logradouro']."</td>
							<td style='text-align:right;'><a href='edit_logradouro.php?cliente=".$cliente['id']."'>Editar</a></td>
						</tr>
					</table>
					<br/>
					
					
					<a href='rem.php?cliente=".$cliente['id']."' style='float:right;'>Remover cliente</a>
					<div style='clear:both;'></div>";
				}
		}
	?>

</div>
</body>
</html>