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
    ?>

    <div id="corpo">
        <?php
        if(!is_admin()){
            echo msg_erro('Área restrita! Você não é administrador!');
        }else{
            if(!isset($_POST['usuario'])){
                require "user_new_form.php";
            }else{
                $usuario = $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;
                $tipo = $_POST['tipo'] ?? null;

                if($senha1 === $senha2){
                    if(empty($usuario)|| empty($nome)|| empty($senha1)|| empty($senha2)|| empty($tipo)){
                        echo msg_erro('Todos os dados são obrigatórios');
                    }else{
                        $senha = gerarHash($senha1);
                        if($banco->query($q)){
                            echo msg_sucesso("Usuário $nome cadastro com sucesso");
                        }else{
                            echo msg_sucesso("Não foi possivel criar o usuário $usuario");
                        }
                    }
                }else{
                    echo msg_sucesso("Senhas não conferem. Repita o procedimento");
                }
            }
        }
        echo voltar();
        ?>
        </div>
    </body>
</html>