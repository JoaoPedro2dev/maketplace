<?php 
    include_once"../conexao.php";

    $id_produto = $_GET['id_produto']; 

    $sql = $conexao->prepare(
        "
            SELECT produtos.*, vendedores.*
            FROM produtos
            INNER JOIN vendedores ON produtos.id_vendedor = vendedores.id_vendedor 
            WHERE produtos.id = ?; 
        "
    );
    $sql->bind_param("i", $id_produto);
    $sql->execute();
    $resultado = $sql->get_result();

    $sqlComentario = $conexao->prepare(
        "
            SELECT comentarios.*, usuarios.*
            FROM comentarios
            INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id_usuario 
            WHERE comentarios.id_produto = ?; 
        "
    );
    $sqlComentario->bind_param("i", $id_produto);
    $sqlComentario->execute();
    $resultadoComentarios = $sqlComentario->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script src="../script.js" defer></script>
    <title></title>
</head>
<body>
    <header>
        <!-- <button class="closeBtn backBtn" onclick="window.location.href='../index.php'">
            <i class="bi bi-arrow-left"></i>
        </button> -->
        <span onclick="window.location.href='../index.php'">Marketplace</span>
        <div id="searchBox">
            <input type="text" placeholder="Pesquise seu item" id="searchInput">
            <i class="bi bi-search" id="searchIcon"></i>
            <i class="bi bi-x-lg" id="clearSearch"></i>
        </div>
    </header>

    <div id="telaVenda">
        <div id="container">
            <?php 
                if($resultado->num_rows > 0){
                    while($dados = $resultado->fetch_assoc()){
                        echo '
                            <div id="produtoContainer">
                                <div class="produto-galeria">
                                    <img id="foto-principal" class="imagem-destaque" src="" alt="Imagem principal do produto">
                                    <div class="miniaturas">
                                        <img src="'.$dados["foto_1"].'" class="selectedImg" alt="Produto 1" onclick="alterarImagem(this)">
                                        <img src="'.$dados["foto_2"].'" alt="Produto 2" onclick="alterarImagem(this)">
                                        <img src="'.$dados["foto_3"].'" alt="Produto 3" onclick="alterarImagem(this)">
                                    </div>
                                </div>
                                <div id="produtoInfosBox">
                                    <div id="lojaBox">
                                        <img src="'.$dados['foto_vendedor'].'" alt="">
                                        <p>'.$dados['nome_vendedor'].'</p>
                                    </div>
                                    <div id="produtoInfos">
                                        <strong>'.$dados["produto_nome"].'</strong>
                                        <div id="valorBox">
                             ';
                                        if($dados['promocao']){
                                            echo '
                                                <p id="PreçoAnterior">R$ '.number_format($dados["preco"], 2, ',', '.').'</p>
                                                <p id="valor">R$ '.number_format($dados["promocao"], 2, ',', '.').'</p>
                                            ';
                                        }else{
                                            echo '
                                                <p id="valor">R$ '.number_format($dados["preco"], 2, ',', '.').'</p>
                                            ';
                                        }
                        echo '
                                        </div>
                                        <div id="colorBox">
                                            <p>Cores disponíveis</p>
                                            <select name="" id="">
                        ';
                                        $cores = explode(',', $dados['cores_disponiveis']);
                                        $i = 0;
                                        while($i < count($cores)){
                                            echo '
                                                <option value="'.$cores[$i].'">'.$cores[$i].'</option>
                                            ';
                                            $i++;
                                        }
                                            
                        echo '
                                            </select>
                                        </div>
                                        
                                        <div id="tamanhosBox">
                                            <p>Tamanhos disponíveis</p>
                                            <select name="" id="">
                        ';
                                        $tamanhos = explode(',',$dados['tamanhos_disponiveis']);
                                        $j = 0;
                                        while($j < count($tamanhos)){
                                            echo '<option value="'.$tamanhos[$j].'">'.$tamanhos[$j].'</option>';
                                            $j++;
                                        }
                        echo '
                                           </select>
                                        </div>

                                        <p id="descricao">
                                            '.$dados["descricao"].'
                                        </p>
                                        <p id="guiaTamanho">Guia de tamanhos</p>
                                    </div>
                                </div>
                                <div id="compraBox">
                                    <span id="contVendas">'.$dados['quantidade_vendas'].' vendidos</span>
                                    <div id="dataBox">
                        ';
                        
                                        
                                        date_default_timezone_set("America/Sao_paulo");

                                        $data_usuario = new DateTime();
                                        $data_usuario -> modify('+'.$dados['prazo_entrega'].'day');

                        echo '

                                        <p><span class="green">Chegará até o dia</span> <span>'.$data_usuario->format("d/m/Y").'</span></p>
                                        <p>Comprando dentro de 24 horas</p>
                                    </div>
                                    <div id="freteBox">
                        ';
            ?>
            <?php
                if($dados['frete'] > 0){
                    echo "<p><span class=\"green\">Frete de </span>R$".htmlspecialchars(number_format($dados['frete'], 2, ",", "."))."</p>";
                }else{
                    echo "<p><span class=\"green\">Frete Grátis</p>";
                }
            ?>
            <?php
                            
                        echo '
                                    </div>       
                                    <div id="quantidade">
                                        <p>Quantidade</p>
                                        <div class="contBox">
                                            <button class="moreBtn"><i class="bi bi-plus-lg"></i></button>
                                            <span class="qntDisplay qnt">1</span>
                                            <button class="lessBtn"><i class="bi bi-dash"></i></button>
                                        </div>  
                                    </div>
                                    <div id="buttonsBox">
                                        <button>Comprar agora</button>
                                        <button>Adicionar ao carrinho</button>
                                    </div>
                                    <div id="garantiaBox">
                                        <p><i class="bi bi-shield-check"></i>Garantia</p>
                                        <p>Devolva o produto em até 30 dias após o recebimento</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }else{
                    echo "Algo deu errado";
                }
            ?>
            
            <div id="comentariosContainer">
                <h3>Comentarios de quem comprou</h3>
                <?php       
                    if($resultadoComentarios->num_rows > 0){
                        while($dadosComentario = $resultadoComentarios->fetch_assoc()){
                            $dataComentario = new DateTime($dadosComentario['data_comentario']);

                            echo '
                                <div class="comentarioBox">
                                    <div class="usuarioInfos">
                                        <img src="'.$dadosComentario['foto'].'" alt="">
                                        <p>
                                            <strong>'.$dadosComentario['nome_usuario'].'</strong>
                                            <span>'.$dataComentario->format("d/m/Y").'</span>
                                        </p>
                                    </div>
                                    <div class="userText">
                                        <p>'.$dadosComentario['texto_comentario'].'</p>
                                    </div>
                                    <div class="likeBox">
                                        <button class="like"><i class="bi bi-hand-thumbs-up"></i></button>
                                        <p><span>'.$dadosComentario['likes'].'<span> likes</p>
                                        <i class="bi bi-flag"></i>
                                    </div>
                                </div> 
                            ';
                        }
                        echo "  ";   
                    }
                ?>
            </div>
            <p id="mostarComentariosBtn">Mostrar mais comentarios</p>
        </div>
    </div>

    <section class="produtos" id="maisComprados">
        <strong>Conheça itens semelhantes</strong>
        <button class="nav-controls prev-btn cinco"><i class="bi bi-arrow-left"></i></button>
        <div class="carousel-wrapper">
            <div class="carousel-track">
            <?php 
                $categoria = $_GET['categoria']; 

                $sqlCategoria = $conexao->prepare("SELECT * FROM produtos WHERE categoria = ?");
                $sqlCategoria->bind_param("s", $categoria);
                $sqlCategoria->execute();
                $resultadoCategoria = $sqlCategoria->get_result();

                if($resultadoCategoria->num_rows > 0){
                    while($dadosCategoria = $resultadoCategoria->fetch_assoc()){
                        echo "
                            <div class=\"carousel-element\" onclick='window.location.href=\"./index.php?id_produto=".$dadosCategoria["id"]."&categoria=".$dadosCategoria['categoria']."\"'>
                                <img src=\"".$dadosCategoria['foto_1']."\" alt=\"\">
                                <div class=\"produtoInfosz\">
                                    <p>".$dadosCategoria['produto_nome']."</p>
                                    <strong>R$".$dadosCategoria['preco']."</strong>
                                    <p>".$dadosCategoria['frete']."</p>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>
            </div>
        </div>
        <button class="nav-controls next-btn cinco"><i class="bi bi-arrow-right"></i></button>
    </section>

    <!-- <section class="produtos" id="maisComprados">
        <strong>Conheça os mais comprados</strong>
        <button class="nav-controls prev-btn seis"><i class="bi bi-arrow-left"></i></button>
        <div class="carousel-wrapper">
            <div class="carousel-track">
                <div class="carousel-element">
                    <img src="./img/foto1.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 1</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 2</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto1.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 1</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 2</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto1.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 122</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 2</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto1" alt="">
                    <div class="produtoInfos">
                        <p>Produto 1</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 2</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto1.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 1</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 10</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto1.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 1</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 10</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto1.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 1</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 10</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto1.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 1</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>

                <div class="carousel-element">
                    <img src="./img/foto2.jpg" alt="">
                    <div class="produtoInfos">
                        <p>Produto 22</p>
                        <strong>R$ 00,00</strong>
                        <p>Frete grátis</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="nav-controls next-btn seis"><i class="bi bi-arrow-right"></i></button>
    </section> -->

</body>
</html>