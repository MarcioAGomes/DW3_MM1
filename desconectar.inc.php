<?php
if (isset($db_conexao) && is_object($db_conexao)) {
    $db_conexao->close();
}