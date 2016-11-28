<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' lang='pt-br' xml:lang='pt-br'>
<head>
	<title>Clientes - Rem</title>
</head>
<body style='margin:0;  padding:0px;'>
<div style='width:600px;  margin:auto;  border:2px solid #BBB;  padding:0px 10px 30px;'>
	<?php require"#init.php" ?>

	<h1 style='text-align:center; text-decoration:underline;'>Remover Cliente</h1>
	
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
		
			//REMOVE CLIENTE
			if(isset($_POST['formulario']) && $_POST['formulario']==="enviado"){
				
				$db_op=db_query("UPDATE clientes   SET `db_status`='0'   WHERE id='".$_GET['cliente']."'");
				
				if(!$db_op['result']){
					print
					"<div style='border:1px solid #D00;  margin-bottom:20px;  padding:10px;  background-color:#FEE;'>".
						$db_op['error_msg'].
					"</div>";
				}
				else{
					$showForm=false;
					
					print
					"<div style='border:1px solid #0B0;  margin-bottom:20px;  padding:10px;  background-color:#EFE;'>".
						"Cliente removido com sucesso!".
					"</div>".
					
					"<script type=\"text/javascript\">\n".
					"<!--\n".
						"window.location = \"index.php\";\n".
					"//-->\n".
					"</script>\n".
					"<small>".
					"Redirecionando...<br/>\n".
					"<a href=\"index.php\">Clique aqui caso não redirecione automaticamente.</a><br/>\n".
					"</small>";
					;
				}
				
			}
			else{
			
				//BUSCA DADOS DO CLIENTE
				$db_op2=db_query("SELECT *   FROM clientes   WHERE id='".$_GET['cliente']."'");
				if(!$db_op2['result']){ 
					print($db_op2['error_msg']);
				}
				else{
					$cliente=mysql_fetch_assoc($db_op2['result']);
					
					print"
					Tem certeza que deseja remover este cliente?
					<table style='width:100%'>
						<tr>
							<td width='100'>Nome:</td>
							<td>".$cliente['nome']."</td>
						</tr>
						<tr>
							<td>Sobrenome:</td>
							<td>".$cliente['sobrenome']."</td>
						</tr>
					</table>
					<br/>
					
					
					<form action='' method='post' enctype='multipart/form-data'>
						<input type='hidden' name='formulario' value='enviado' />
						<input type='submit' value='Remover' title='Remove o cliente.' style='float:right;  margin-right:20px;'/>
						<div style='clear:both;'></div>
					</form>";
				}
			}
		}
	?>

</div>
</body>
</html>