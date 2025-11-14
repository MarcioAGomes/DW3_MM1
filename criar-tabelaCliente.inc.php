<?php
 $sql = "CREATE TABLE IF NOT EXISTS $nomeDaTabelaCliente (
           id INT PRIMARY KEY AUTO_INCREMENT,
           nome VARCHAR(300),
           endereco VARCHAR(200),
           numero INT,
           email VARCHAR(100),
           celular VARCHAR(15),
           user VARCHAR(15),
           pass VARCHAR(15))";

 $conexao->query($sql);