<?php
// PHP ERRORS. (0 ou E_ALL)  (PRODUÇÃO ou DESENVOLVIMENTO)
error_reporting(0);

//DEVELOPER OPTIONS
$_ENV['debug']=true;  //Quando "false" impede que informações SQL sejam mostradas aos usuario normais.

// SOURCE CODE LOAD
require"_source/db.php";