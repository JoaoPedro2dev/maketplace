<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        header('Content-Type: application/json');
        ob_start();

        include_once"../conexao.php";

        if(empty($_POST['user']) || empty($_POST['email']) || empty($_POST['cpf']) || empty($_POST['pass'])){
            ob_clean();
            die(json_encode(['status' => 'erro2']));   
        }else{
            $email = trim($_POST['email'] ?? '');
            $user = trim($_POST['user'] ?? '');
            $cpf = trim($_POST['cpf'] ?? '');
            $tel = trim($_POST['tel'] ?? '');

            function verificarDados($conexao, $valor, $tabela, $condicao, $dadoUser){
                $sql = $conexao->prepare("SELECT $valor FROM $tabela WHERE $condicao = ?");
                $sql->bind_param('s', $dadoUser);
                $sql->execute();
                return $sql->get_result();
            }

            if(!empty($tel)){
                $telLimpo = preg_replace('/\D/', '', $tel);

                if(preg_match('/^\d{10,11}$/', $telLimpo)){
                    $telefone = $telLimpo; 
                    $resultado5 = verificarDados($conexao, 'id_usuario', 'usuarios', 'telefone', $telefone);
                    $resultado6 = verificarDados($conexao, 'id_vendedor', 'vendedores', 'telefone', $telefone);
                }else{
                    ob_clean();
                    echo json_encode(['status' => 'erro5']);
                    exit;
                }
            }
            
            $cpfLimpo = preg_replace('/\D/', '', $cpf);

            if(strlen($cpfLimpo) != 11){
                die(json_encode(['status' => 'erro7']));
            }

            if(preg_match('/^(\d)\1{10}$/', $cpfLimpo)){
                ob_clean();
                die(json_encode(['status' => 'erro7']));
            }


            $resultado7 = verificarDados($conexao, 'id_usuario', 'usuarios', 'cpf', $cpfLimpo);
            $resultado8 = verificarDados($conexao, 'id_vendedor', 'vendedores', 'cpf', $cpfLimpo);
            $resultado3 = verificarDados($conexao, 'id_usuario', 'usuarios', 'email', $email);
            $resultado4 = verificarDados($conexao, 'id_vendedor', 'vendedores', 'email', $email);
            $resultado1 = verificarDados($conexao, 'id_usuario', 'usuarios', 'nome_usuario', $user);
            $resultado2 = verificarDados($conexao, 'id_vendedor', 'vendedores', 'nome_vendedor', $user);

            $pass = trim( $_POST['pass'] ?? '');

            if(strlen($pass) < 10){
                die(json_encode(['status' => 'erro9']));
            }

            if($resultado1->num_rows > 0 || $resultado2->num_rows > 0){
                ob_clean();
                die(json_encode(['status' => 'erro4']));
            }else if($resultado3->num_rows > 0 || $resultado4->num_rows > 0)
            {
                ob_clean();
                die(json_encode(['status' => 'erro3']));
                exit;
            }
            else if(isset($resultado5) && $resultado5->num_rows > 0 || isset($resultado6) && $resultado6->num_rows > 0){
                ob_clean();
                die(json_encode(['status' => 'erro6']));
            }else if($resultado7 -> num_rows > 0 || $resultado8 -> num_rows > 0){
                ob_clean();
                die(json_encode(['status' => 'erro8']));
            }else{
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    ob_clean();
                    die(json_encode(['status' => 'sucesso']));
                }else{
                    ob_clean();
                    die(json_encode(['status' => 'erro1']));
                }
            }
            
        }
        
    }
?>
