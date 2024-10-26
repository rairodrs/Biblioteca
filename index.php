<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <title>listagem de jogos</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos/estilo.css">
    </head>

<body>

    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        require_once "includes/login.php";
        $ordem = $_GET['o'] ?? "n"; /*recebe 'o' se não receber fica 'n'*/
        $chave = $_GET['c'] ?? ""; /*recebe 'c' se não receber fica ""*/
    ?>

    <div id="corpo">
        <?php include_once "topo.php"; /*incluir*/ ?>
        <h1>Escolha seu jogo</h1>

        <form method = "get" id = "busca" action = "index.php">
            Ordenar: 
            <a href= "index.php?o=n">Nome </a> | 
            <a href= "index.php?o=p"> Produtora </a> | 
            <a href= "index.php?o=n1"> Nota Alta </a> | 
            <a href= "index.php?o=n2"> Nota Baixa </a> | 
            Buscar: <input type="text" name= "c" size= 10 maxlenght="40"/>
            <input type= "submit" value= "OK"/>
        </form>    

        <table class="listagem">
            <?php

                //alterar a query para join
                $q="select j.cod, j.nome, j.capa, g.genero, p.produtora from jogos j join generos g on j.genero=g.cod join produtoras p on j.produtora = p.cod ";
                /*insira um espaço no final da query*/
                /*crie o switch com concatenação de q no final*/

                if(!empty ($chave)){
                    $q .= "where j.nome like '%$chave%' or p.produtora like '%$chave%' or g.genero like '%$chave%' ";
                }
                
                switch ($ordem){
                    case "p":
                        $q .="order by p.produtora";
                        break;
                    case "n1":
                        $q .="order by j.nota desc";
                        break;
                    case "n2":
                        $q .="order by j.nota asc";
                        break;
                    default:
                        $q .="order by j.nome";
                }
        
                $busca = $banco->query($q);
                if(!$busca){
                    echo "<tr><td>infelizmente a busca deu errado";
                }
                else{

                    if($busca->num_rows==0){
                        echo"<tr><td>nenhum registro encontrado";
                    }
                    else{

                        while($reg=$busca->fetch_object()){
                            $t = thumb($reg->capa);
                            echo"<tr><td><img src='$t' class='mini'/>";
                            echo"<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                            //inserir genero e produtora

                            echo "[$reg->genero]";
                            echo "<br>$reg->produtora";
                            echo"<td>Adm";

                        }
                    }
                }
            ?>

        </table>
    </div>
    

    <?php include_once "rodape.php"; /*incluir*/ ?>

</body>
</html>