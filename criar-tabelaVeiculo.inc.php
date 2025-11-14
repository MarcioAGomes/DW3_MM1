<?php
 $sql = "CREATE TABLE IF NOT EXISTS $nomeDaTabelaVeiculo (
           id INT PRIMARY KEY AUTO_INCREMENT,
           marca VARCHAR(30),
           modelo VARCHAR(40),
           placa VARCHAR (7))";

 $conexao->query($sql);