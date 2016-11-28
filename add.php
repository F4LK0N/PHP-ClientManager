<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' lang='pt-br' xml:lang='pt-br'>
<head>
	<title>Clientes - Add</title>
</head>
<body style='margin:0;  padding:0px;'>
<div style='width:600px;  margin:auto;  border:2px solid #BBB;  padding:0px 10px 30px;'>
	<?php require"#init.php" ?>

	<h1 style='text-align:center; text-decoration:underline;'>Adicionar Cliente</h1>
	
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
				if($_ENV['debug']){ print"O campo <b>$name</b> não foi declarado!"; }
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
		
		//FORMULARIO
		$showForm=true;
		
		//DECLARAÇÃO DOS CAMPOS
		form_field_declare("Nome", "width:300px;");
		form_field_declare("Sobrenome", "width:300px;");
		form_field_declare("Telefone", "width:100px;");
		form_field_declare("E-mail", "width:300px;");
		form_field_declare("Pais", "width:150px;");
		form_field_declare("Estado", "width:150px;");
		form_field_declare("Cidade", "width:150px;");
		form_field_declare("Bairro", "width:150px;");
		form_field_declare("Logradouro", "width:300px;");
		
		//ATUALIZAÇÃO DOS CAMPOS
		if(isset($_POST['formulario']) && $_POST['formulario']==="enviado"){   unset($_POST['formulario']);
			
			//VERIFICAÇÃO DE SEGURANÇA
			foreach($_POST as $postIndex => $postContent){
				if(isset($_ENV['form_fields'][$postIndex])){
					$postContent=trim($postContent);
					$postContent=str_replace("\"", "&#34;", $postContent);
					$postContent=str_replace("'", "&#39;", $postContent);
					while(false!==strpos($postContent, "  ")){ $postContent=str_replace("  ", " ", $postContent); }
					$_ENV['form_fields'][$postIndex]['value']=$postContent;
				}
			}
			
			//VERIFICAÇÃO DE PREENCHIMENTO DOS CAMPOS
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
			
				//CADASTRO O CLIENTE
				$db_op=db_query("
					INSERT INTO `clientes`   
					(`nome`, `sobrenome`, `telefone`, `email`, `end_pais`, `end_estado`, `end_cidade`, `end_bairro`, `end_logradouro`) 
					VALUES 
					('".$_ENV['form_fields']['Nome']['value']."', '".$_ENV['form_fields']['Sobrenome']['value']."', '".$_ENV['form_fields']['Telefone']['value']."', '".$_ENV['form_fields']['E-mail']['value']."', '".$_ENV['form_fields']['Pais']['value']."', '".$_ENV['form_fields']['Estado']['value']."', '".$_ENV['form_fields']['Cidade']['value']."', '".$_ENV['form_fields']['Bairro']['value']."', '".$_ENV['form_fields']['Logradouro']['value']."')
				");
				
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
		}
	?>
	
	
	
	<?php if($showForm){ ?>
	<form action='' method='post' enctype='multipart/form-data' style='width:500px;  margin:auto;'>
	
		<h3>Dados Pessoais:</h3>
		<table>
			<tr>
				<td>Nome:</td>
				<td><?php form_field_print("Nome"); ?></td>
			</tr>
			<tr>
				<td>Sobrenome:</td>
				<td><?php form_field_print("Sobrenome"); ?></td>
			</tr>
			<tr>
				<td>Telefone:</td>
				<td><?php form_field_print("Telefone"); ?></td>
			</tr>
			<tr>
				<td>E-mail:</td>
				<td><?php form_field_print("E-mail"); ?></td>
			</tr>
		</table>
		<br/>
		
		<h3>Endereço:</h3>
		<table>
			<tr>
				<td>Pais:</td>
				<td><?php form_field_print("Pais"); ?></td>
			</tr>
			<tr>
				<td>Estado:</td>
				<td><?php form_field_print("Estado"); ?></td>
			</tr>
			<tr>
				<td>Cidade:</td>
				<td><?php form_field_print("Cidade"); ?></td>
			</tr>
			<tr>
				<td>Bairro:</td>
				<td><?php form_field_print("Bairro"); ?></td>
			</tr>
			<tr>
				<td>Logradouro:</td>
				<td><?php form_field_print("Logradouro"); ?></td>
			</tr>
		</table>
		<br/><br/>
		
		
		<input type="hidden" name="formulario" value="enviado" />
		<input type="submit" value="Adicionar" title="Envia as informações do formulario." style='float:right;  margin-right:20px;'/>
		<div style='clear:both;'></div>
	</form>
	<?php } ?>

</div>
</body>
</html>