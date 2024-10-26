<?php

/*linha de conexao com o BD
$banco = new mysqli(host, usuario, senha, banco); */
$banco = new mysqli("localhost", "root", "", "bd1_games");

/*se houver algum erro na conexao sera emitido uma msg e die() mata tudo*/
if($banco->connect_errno){
    echo "<p> Encontrei um erro $banco->errno --> $banco->connect_error </p>";
    die();
}

/*transformar os resultados com padroes utf8*/
$banco->query("SET NAMES 'utf8'");
$banco->query("SET character_set_connection=utf8");
$banco->query("SET character_set_client=utf8");
$banco->query("SET character_set_results=utf8");
?>