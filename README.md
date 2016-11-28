# PHP-ClientManager

APPLICATION
    Client manager, with the add, remove, edit and list functions.
    
    
    
DEVELOP TIME
	12:34 -> 14:47 (2:13)
    16:10 -> 16:32 (0:22)
    17:05 -> 17:25 (0:20)
    17:27 -> 18:05 (0:38)
    Total time: 3 hours e 33 minutes.
    
    
    
SQL
    Change host, bank, user and password in the file "_source/db.php".
    Utilize the above code to create the table in the DB.
    
    
    
CREATE TABLE IF NOT EXISTS `clientes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `db_status` tinyint(4) NOT NULL DEFAULT '1',
    `nome` text NOT NULL,
    `sobrenome` text NOT NULL,
    
    `telefone` text NOT NULL,
    `email` text NOT NULL,
    
    `end_pais` text NOT NULL,
    `end_estado` text NOT NULL,
    `end_cidade` text NOT NULL,
    `end_bairro` text NOT NULL,
    `end_logradouro` text NOT NULL,
    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
