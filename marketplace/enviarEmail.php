<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        header('Content-Type: application/json');
        error_reporting(E_ALL);
ini_set('display_errors', 1);


        include_once"../conexao.php";
        $email = 'joao@gmail.com';
        $user = 'joao';
        $tel = '119876543';

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
                echo json_encode(['status' => 'erro5']);
                exit;
            }
        }

        $resultado3 = verificarDados($conexao, 'id_usuario', 'usuarios', 'email', $email);
        $resultado4 = verificarDados($conexao, 'id_vendedor', 'vendedores', 'email', $email);
        $resultado1 = verificarDados($conexao, 'id_usuario', 'usuarios', 'nome_usuario', $user);
        $resultado2 = verificarDados($conexao, 'id_vendedor', 'vendedores', 'nome_vendedor', $user);

        if(empty($_POST['user']) || empty($_POST['email']) || empty($_POST['cpf']) || empty($_POST['pass'])){
            ob_clean();
            echo json_encode(['status' => 'erro2']);
        }else{
            if($resultado1->num_rows > 0 || $resultado2->num_rows > 0){
                echo json_encode(['status' => 'erro4']);
            }else if($resultado3->num_rows > 0 || $resultado4->num_rows > 0)
            {
                echo json_encode(['status' => 'erro3']);
            }
            else if(isset($resultado5) || isset($resultado6)){
                if($resultado5->num_rows > 0 || $resultado6->num_rows > 0){
                    echo json_encode(['status' => 'erro6']);
                }
            }else{
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    ob_clean();
                    echo json_encode(['status' => 'sucesso']);
                }else{
                    echo json_encode(['status' => 'erro1']);
                }
            }
            
        }
        
    }
?>
