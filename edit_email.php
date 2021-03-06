<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' lang='pt-br' xml:lang='pt-br'>
<head>
	<title>Cliente - Edit</title>
</head>
<body style='margin:0;  padding:0px;'>
<div style='width:600px;  margin:auto;  border:2px solid #BBB;  padding:0px 10px 30px;'>
	<?php require"#init.php" ?>

	<h1 style='text-align:center; text-decoration:underline;'>Editar Cliente</h1>
	
	<?php
		//#####################################################################################
		$_ENV['form_fields']=false;
		//#####################################################################################
		function form_field_declare ($name, $style="") {
			$_ENV['form_fields'][$name]['value']="";
			$_ENV['form_fields'][$name]['style']=$style;
		}
		//#####################################################################################
		function form_field_print ($name) {
			if(!isset($_ENV['form_fields'][$name])){
				if($_ENV['debug']){ print"O campo <b>$name</b> n�o foi declarado!"; }
				return null;
			}
			
			print
			"<input type='text' name='$name' value='".$_ENV['form_fields'][$name]['value']."' ";
			
			if($_ENV['form_fields'][$name]['style']){
				print"style='".$_ENV['form_fields'][$name]['style']."' ";   }
				
			print
			"/>";
		}
		//#####################################################################################
		
		//VERIFICA��O DE ID
		$erro=false;
		if(!isset($_GET['cliente']) || !is_numeric($_GET['cliente']) || $_GET['cliente']<1){ $erro="Cliente invalido!"; }
		else{
			$_GET['cliente']=intval($_GET['cliente']);
			$db_op=db_query("SELECT id, db_status   FROM clientes   WHERE id='".$_GET['cliente']."'", true);
			if(!$db_op['result']){ $erro=$db_op['error_msg']; }
			elseif($db_op['count']<1){ $erro="Cliente n�o encontrado!"; }
			else{  
				$db_op['result']=mysql_fetch_assoc($db_op['result']);
				if($db_op['result']['db_status']==0){ $erro="Este cliente foi removido!"; }
			}
		}
		if($erro){   print"N�o � possivel continuar!<br/>".$erro;   }
		else{
		
		
					//FORMULARIO
					$showForm=true;
					
					//DECLARA��O DOS CAMPOS
					form_field_declare("E-mail", "width:100px;");
					
					//ATUALIZA��O DOS CAMPOS
					$valor=db_query("SELECT email   FROM clientes   WHERE id='".$_GET['cliente']."'");
					$valor=mysql_fetch_row($valor['result']);
					$_ENV['form_fields']['E-mail']['value']=$valor[0];
					unset($valor);
					if(isset($_POST['formulario']) && $_POST['formulario']==="enviado"){   unset($_POST['formulario']);
						
						//VERIFICA��O DE SEGURAN�A
						foreach($_POST as $postIndex => $postContent){
							if(isset($_ENV['form_fields'][$postIndex])){
								$postContent=trim($postContent);
								$postContent=str_replace("\"", "&#34;", $postContent);
								$postContent=str_replace("'", "&#39;", $postContent);
								while(false!==strpos($postContent, "  ")){ $postContent=str_replace("  ", " ", $postContent); }
								$_ENV['form_fields'][$postIndex]['value']=$postContent;
							}
						}
						
						//VERIFICA��O DE PREENCHIMENTO DOS CAMPOS
						$erros=false;
						foreach($_ENV['form_fields'] as $name => $content){
							if($content['value']===""){ $erros.="O campo <b>$name</b> deve ser preenchido.<br/>"; }
						}
						if($erros){
							print
							"<div style='border:1px solid #D00;  margin-bottom:20px;  padding:10px;  background-color:#FEE;'>".
								"Por favor, verifique os erros abaixo antes de continuar:<br/>".
								"<small>".$erros."</small>".
							"</div>";
						}
						else{
						
							//ATUALIZA O CLIENTE
							$db_op=db_query("UPDATE `clientes`   SET `email`='".$_ENV['form_fields']['E-mail']['value']."'   WHERE id='".$_GET['cliente']."'");
							
							//RESULTADO
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
									"Cliente cadastrado com sucesso!".
								"</div>".
								
								"<script type=\"text/javascript\">\n".
								"<!--\n".
									"window.location = \"view.php?cliente=".$_GET['cliente']."\";\n".
								"//-->\n".
								"</script>\n".
								"<small>".
								"Redirecionando...<br/>\n".
								"<a href=\"view.php?cliente=".$_GET['cliente']."\">Clique aqui caso n�o redirecione automaticamente.</a><br/>\n".
								"</small>";
							}
						}
					}
				?>
				
				
				
				<?php if($showForm){ ?>
				<form action='' method='post' enctype='multipart/form-data' style='width:500px;  margin:auto;'>
				
					<br/>
					<table>
						<tr>
							<td>E-mail:</td>
							<td><?php form_field_print("E-mail"); ?></td>
						</tr>
					</table>
					<br/>
					
					
					<input type="hidden" name="formulario" value="enviado" />
					<input type="submit" value="Salvar" title="Envia as informa��es do formulario." style='float:right;  margin-right:20px;'/>
					<div style='clear:both;'></div>
				</form>
				<?php } ?>
				
		<?php } ?>

</div>
</body>
</html>