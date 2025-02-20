<?php 
    include_once"../conexao.php";

    $id_produto = $_GET['id_produto'];  

    //$sql = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");

    $sql = $conexao->prepare(
        "
            SELECT produtos.*, vendedores.*, GROUP_CONCAT(comentarios.texto_comentario SEPARATOR ' , ') AS comentarios
            FROM produtos
            INNER JOIN vendedores ON produtos.id_vendedor = vendedores.id_vendedor
            LEFT JOIN comentarios ON comentarios.id_produto = produtos.id 
            WHERE produtos.id = ?; 
        "
    );
    $sql->bind_param("i", $id_produto);
    $sql->execute();
    $resultado = $sql->get_result();
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
        <button class="closeBtn backBtn" onclick="window.location.href='../index.php'">
            <i class="bi bi-arrow-left"></i>
        </button>
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
                <?php       
                    if($dados['comentarios']){
                        $i = 0;

                        while($i < count($dados['comentarios'])){
                            echo '
                            <div id="comentariosContainer">
                                <h3>Comentarios de quem comprou</h3>

                                <div class="comentarioBox">
                                    <div class="usuarioInfos">
                                        <img src="../img/foto1.jpg" alt="">
                                        <p>
                                            <strong>'.$dados['comentarios'][0].'</strong>
                                            <span>17/02/2024</span>
                                        </p>
                                    </div>
                                    <div class="userText">
                                        <p>"Produto excelente! A qualidade superou minhas expectativas, material resistente e acabamento impecável. Chegou antes do prazo e bem embalado. Recomendo para quem está em dúvida! ⭐⭐⭐⭐⭐"</p>
                                    </div>
                                    <div class="likeBox">
                                        <button class="like"><i class="bi bi-hand-thumbs-up"></i></button>
                                        <button class="deslike"><i class="bi bi-hand-thumbs-down"></i></button>
                                        <i class="bi bi-flag"></i>
                                    </div>
                                </div> 
                            ';
                            $i++;
                        }

                        echo "  <p id=\"mostarComentariosBtn\">
                                        Mostrar mais comentarios
                                </p>";
                    }
                ?>
                
                <!-- <div class="comentarioBox">
                    <div class="usuarioInfos">
                        <img src="" alt="">
                        <p>
                            <strong>Usuario 2</strong>
                            <span>16/02/2024</span>
                        </p>
                    </div>
                    <div class="userText">
                        <p>"Comprei esse tênis há duas semanas e estou simplesmente apaixonado! 😍 Super confortável, leve e perfeito para corridas. O tamanho ficou certinho, e a qualidade do material é excelente. Além disso, a entrega foi super rápida, chegou antes do prazo! Recomendo demais! 👏🔥"</p>
                    </div>
                    <div class="likeBox">
                        <button class="like"><i class="bi bi-hand-thumbs-up"></i></button>
                        <button class="deslike"><i class="bi bi-hand-thumbs-down"></i></button>
                        <i class="bi bi-flag"></i>
                    </div>
                </div>  -->
                <!-- <div class="comentarioBox">
                    <div class="usuarioInfos">
                        <img src="../img/foto1.jpg" alt="">
                        <p>
                            <strong>Usuario 1</strong>
                            <span>17/02/2024</span>
                        </p>
                    </div>
                    <div class="userText">
                        <p>"Produto excelente! A qualidade superou minhas expectativas, material resistente e acabamento impecável. Chegou antes do prazo e bem embalado. Recomendo para quem está em dúvida! ⭐⭐⭐⭐⭐"</p>
                    </div>
                    <div class="likeBox">
                        <button class="like"><i class="bi bi-hand-thumbs-up"></i></button>
                        <button class="deslike"><i class="bi bi-hand-thumbs-down"></i></button>
                        <i class="bi bi-flag"></i>
                    </div>
                </div> 
                <div class="comentarioBox">
                    <div class="usuarioInfos">
                        <img src="" alt="">
                        <p>
                            <strong>Usuario 2</strong>
                            <span>16/02/2024</span>
                        </p>
                    </div>
                    <div class="userText">
                        <p>"Comprei esse tênis há duas semanas e estou simplesmente apaixonado! 😍 Super confortável, leve e perfeito para corridas. O tamanho ficou certinho, e a qualidade do material é excelente. Além disso, a entrega foi super rápida, chegou antes do prazo! Recomendo demais! 👏🔥"</p>
                    </div>
                    <div class="likeBox">
                        <button class="like"><i class="bi bi-hand-thumbs-up"></i></button>
                        <button class="deslike"><i class="bi bi-hand-thumbs-down"></i></button>
                        <i class="bi bi-flag"></i>
                    </div>
                </div> 
                <div class="comentarioBox">
                    <div class="usuarioInfos">
                        <img src="../img/foto1.jpg" alt="">
                        <p>
                            <strong>Usuario 1</strong>
                            <span>17/02/2024</span>
                        </p>
                    </div>
                    <div class="userText">
                        <p>"Produto excelente! A qualidade superou minhas expectativas, material resistente e acabamento impecável. Chegou antes do prazo e bem embalado. Recomendo para quem está em dúvida! ⭐⭐⭐⭐⭐"</p>
                    </div>
                    <div class="likeBox">
                        <button class="like"><i class="bi bi-hand-thumbs-up"></i></button>
                        <button class="deslike"><i class="bi bi-hand-thumbs-down"></i></button>
                        <i class="bi bi-flag"></i>
                    </div>
                </div> 
                <div class="comentarioBox">
                    <div class="usuarioInfos">
                        <img src="" alt="">
                        <p>
                            <strong>Usuario 2</strong>
                            <span>16/02/2024</span>
                        </p>
                    </div>
                    <div class="userText">
                        <p>"Comprei esse tênis há duas semanas e estou simplesmente apaixonado! 😍 Super confortável, leve e perfeito para corridas. O tamanho ficou certinho, e a qualidade do material é excelente. Além disso, a entrega foi super rápida, chegou antes do prazo! Recomendo demais! 👏🔥"</p>
                    </div>
                    <div class="likeBox">
                        <button class="like"><i class="bi bi-hand-thumbs-up"></i></button>
                        <button class="deslike"><i class="bi bi-hand-thumbs-down"></i></button>
                        <i class="bi bi-flag"></i>
                    </div>
                </div>  -->
            </div>
           
        </div>
    </div>

    <section class="produtos" id="maisComprados">
        <strong>Conheça os mais comprados</strong>
        <button class="nav-controls prev-btn cinco"><i class="bi bi-arrow-left"></i></button>
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
        <button class="nav-controls next-btn cinco"><i class="bi bi-arrow-right"></i></button>
    </section>

    <section class="produtos" id="maisComprados">
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
    </section>

</body>
</html>