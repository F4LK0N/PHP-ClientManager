<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' lang='pt-br' xml:lang='pt-br'>
<head>
	<title>Clientes</title>
</head>
<body style='margin:0;  padding:0px;'>
<div style='width:600px;  margin:auto;  border:2px solid #BBB;  padding:0px 10px 30px;'>
	<?php require"#init.php" ?>

	<h1 style='text-align:center; text-decoration:underline;'>Clientes</h1>
	
	<?php
		//DB CHECK
		$clientesTotal=db_query("SELECT COUNT(*)   FROM `clientes`   WHERE `db_status`='1';");
		if(!$clientesTotal['result']){
			print($clientesTotal['error_msg']);
		}else{
			
			//ADICIONAR
			print"<a href='add.php' style='float:right;  display:inline-block;  border-radius:5px;  border:1px solid #000;  padding:2px 5px;  text-decoration:none;'>Adicionar Cliente</a>";
			
			//CLIENTES CADASTRADOS
			$clientesTotal=mysql_fetch_row($clientesTotal['result']);
			$clientesTotal=$clientesTotal[0];
			print"<b>$clientesTotal</b> clientes cadastrados.<br/>";
			
			
			print
			"<div style='clear:both;'><br/></div>";
			
			
				//LISTA TODOS OS CLIENTES
				$db_op=db_query("SELECT id, nome, sobrenome   FROM clientes      WHERE `db_status`='1'   ORDER BY nome ASC, sobrenome ASC", true);
				if(!$db_op['result']){
					print($db_op['error_msg']);
				}
				else{
					print
					"<table style='width:100%;  border:1px solid #CCC;'>".
					"<tr><td><b>Nome</b></td><td><b>Sobrenome</b></td></tr>";
					
					while($cliente=mysql_fetch_assoc($db_op['result'])){
					
						print
						"<tr>".
							"<td><a href='view.php?cliente=".$cliente['id']."' style='display:block;'>".$cliente['nome']."</a></td>".
							"<td><a href='view.php?cliente=".$cliente['id']."' style='display:block;'>".$cliente['sobrenome']."</a></td>".
						"</tr>";
					}
					
					print
					"</table>";
				}
		
		
		
		
		
		}
	?>

</div>
</body>
</html>