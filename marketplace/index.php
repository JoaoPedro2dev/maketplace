<?php 
    include_once"conexao.php";

    $sql = "SELECT * FROM produtos";

    $resultado = $conexao->query($sql);

    session_start();

    echo $_SESSION['nome'] . " " . " " . $_SESSION['id'] . "<a href='login/deslogar.php'>Deslogar</a>";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Marketplace</title>
</head>
<body>
    <header>
        <span>Marketplace</span>
        <div id="searchBox">
            <input type="text" placeholder="Pesquise seu item" id="searchInput">
            <i class="bi bi-search" id="searchIcon"></i>
            <i class="bi bi-x-lg" id="clearSearch"></i>
        </div>
        <div id="userBox">
            <?php 
                if(!isset($_SESSION['id'])){
                    echo '
                        <button id="userLogin" onclick="window.location.href=\'./login\'">
                            <i class="bi bi-person-circle"></i>
                            <p>Entrar</p>
                        </button>      
                    ';
                }else{
                    echo '
                        <button class="logado" onclick="">
                            <img src="'.$_SESSION['foto'].'"/>
                        </button>      
                    ';
                }
            ?>

            <i class="bi bi-bag" id="carrinhoIcon"></i>
        </div>
    </header>

    <div id="cartBox" class="hidden">
        <button class="closeBtn">
            <i class="bi bi-x-lg"></i>
        </button>

        <ul id="cartItensBox">
            <li class="cartIten">
                <img src="./img/ice-falling-brown-drink.jpg" alt="">
                <div class="itenInfos">
                    <p>Nome</p>
                    <strong>R$00,00</strong>
                </div>
                <div class="contBox">
                    <button class="moreBtn"><i class="bi bi-plus-lg"></i></button>
                    <span class="qntDisplay">1</span>
                    <button class="lessBtn"><i class="bi bi-dash"></i></button>
                </div>
                <p class="itemRemoveBtn">
                    <i class="bi bi-trash"></i>
                </p>
            </li>

            <li class="cartIten">
                <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                <div class="itenInfos">
                    <p>Nome 2</p>
                    <strong>R$00,00</strong>
                </div>
                <div class="contBox">
                    <button class="moreBtn"><i class="bi bi-plus-lg"></i></button>
                    <span class="qntDisplay">2</span>
                    <button class="lessBtn"><i class="bi bi-dash"></i></button>
                </div>
                <p class="itemRemoveBtn">
                    <i class="bi bi-trash"></i>
                </p>
            </li>

            <div id="buyBox">
                <div id="buyInfos">
                    <p>Total</p>
                    <strong>R$00,00</strong>
                </div>
                <button id="buyBtn">
                    Comprar tudo
                </button>
            </div>
        </ul>
    </div>

    <div class="carousel-container">
        <div class="carousel">
            <div class="slide"><img src="../e-commerce/img/6750864b3190e.jpg" alt="Oferta 1"></div>
            <div class="slide"><img src="../e-commerce/img/675787489dd7f.png" alt="Oferta 2"></div>
            <div class="slide"><img src="../e-commerce/img/67578772b94da.png" alt="Oferta 3"></div>
        </div>

        <!-- Botões de navegação -->
        <button class="carouselBtn prev">&#10094;</button>
        <button class="carouselBtn next">&#10095;</button>

        <!-- Indicadores -->
        <div class="indicators">
            <input type="radio" name="indicator" id="ind0" checked>
            <input type="radio" name="indicator" id="ind1">
            <input type="radio" name="indicator" id="ind2">
        </div>
    </div>

    <nav>
        <a href="#ofertas">Ofertas do dia</a>
        <a href="#masculino">Masculino</a>
        <a href="#feminino">Feminino</a>
        <a href="#infantil">Infantil</a>
        <a href="#acessorios">Acessorios</a>
        <a href="#calçados">Calçados</a>
    </nav>

    <div id="sectionContainers">
        <section class="produtos" id="ofertas">
            <strong>Conheça ofertas do dia</strong>
            <button class="nav-controls prev-btn"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                    <?php 
                        $data = new DateTime();

                        $sqlOferta = "SELECT * FROM produtos WHERE data_inicio_promocao = '".$data->format('Y-m-d')."'";

                        $resultadoOferta = $conexao->query($sqlOferta);

                        while($dadosOferta = $resultadoOferta->fetch_assoc()){
                            echo "
                                <div class='carousel-element' onclick='window.location.href=\"./venda?id_produto=".$dadosOferta["id"]."&categoria=".$dadosOferta['categoria']."\"'>
                                    <img src='".$dadosOferta['foto_1']."' alt=''>
                                    <div class='produtoInfos'>
                                        <p>".htmlspecialchars($dadosOferta['produto_nome'])."</p>
                                        <strong>R$".htmlspecialchars($dadosOferta['preco'])."</strong>
                                        <p>Frete grátis</p>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>
            <button class="nav-controls next-btn"><i class="bi bi-arrow-right"></i></button>
        </section>

        <section class="produtos" id="masculino">
            <strong>Conheça itens masculinos</strong>
            <button class="nav-controls prev-btn dois"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                <?php 
                    $sqlMasculino = "SELECT * FROM produtos WHERE categoria = 'Masculino'";

                    $resultadoMasculino = $conexao->query($sqlMasculino);

                    while($dadosMasculino = $resultadoMasculino->fetch_assoc()){
                        echo "
                            <div class='carousel-element' onclick='window.location.href=\"./venda?id_produto=".$dadosMasculino["id"]."&categoria=".$dadosMasculino['categoria']."\"'>
                                <img src='".$dadosMasculino['foto_1']."' alt=''>
                                <div class='produtoInfos'>
                                    <p>".htmlspecialchars($dadosMasculino['produto_nome'])."</p>
                                    <strong>R$".htmlspecialchars($dadosMasculino['preco'])."</strong>
                                    <p>Frete grátis</p>
                                </div>
                            </div>
                        ";
                    }
                ?>
                </div>
            </div>
            <button class="nav-controls next-btn dois"><i class="bi bi-arrow-right"></i></button>
        </section>
        
        <section class="produtos" id="feminino">
            <strong>Conheça itens femininos</strong>
            <button class="nav-controls prev-btn tres"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                <?php 
                    $sqlFeminino = "SELECT * FROM produtos WHERE categoria = 'Feminino'";

                    $resultadoFeminino = $conexao->query($sqlFeminino);

                    while($dadosFeminino = $resultadoFeminino->fetch_assoc()){
                        echo "
                            <div class='carousel-element' onclick='window.location.href=\"./venda?id_produto=".$dadosFeminino["id"]."&categoria=".$dadosFeminino['categoria']."\"'>
                                <img src='".$dadosFeminino['foto_1']."' alt=''>
                                <div class='produtoInfos'>
                                    <p>".htmlspecialchars($dadosFeminino['produto_nome'])."</p>
                                    <strong>R$".htmlspecialchars($dadosFeminino['preco'])."</strong>
                                    <p>Frete grátis</p>
                                </div>
                            </div>
                        ";
                    }
                ?>
                </div>
            </div>
            <button class="nav-controls next-btn tres"><i class="bi bi-arrow-right"></i></button>
        </section>

        <section class="produtos" id="infantil">
            <strong>Conheça itens infantis</strong>
            <button class="nav-controls prev-btn quarto sete"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                <?php 
                    $sqlInfantil = "SELECT * FROM produtos WHERE categoria = 'Infantil'";

                    $resultadoInfantil = $conexao->query($sqlInfantil);

                    while($dadosInfantil = $resultadoInfantil->fetch_assoc()){
                        echo "
                            <div class='carousel-element' onclick='window.location.href=\"./venda?id_produto=".$dadosInfantil["id"]."&categoria=".$dadosInfantil['categoria']."\"'>
                                <img src='".$dadosInfantil['foto_1']."' alt=''>
                                <div class='produtoInfos'>
                                    <p>".htmlspecialchars($dadosInfantil['produto_nome'])."</p>
                                    <strong>R$".htmlspecialchars($dadosInfantil['preco'])."</strong>
                                    <p>Frete grátis</p>
                                </div>
                            </div>
                        ";
                    }
                ?>
                </div>
            </div>
            <button class="nav-controls next-btn quarto sete"><i class="bi bi-arrow-right"></i></button>
        </section>
        
        <section class="produtos" id="acessorios">
            <strong>Esta procurando acessórios?</strong>
            <button class="nav-controls prev-btn oito"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                <?php 
                    $sqlAcessorio = "SELECT * FROM produtos WHERE categoria = 'Acessorio'";

                    $resultadoAcessorio = $conexao->query($sqlAcessorio);

                    while($dadosAcessorio = $resultadoAcessorio->fetch_assoc()){
                        echo "
                            <div class='carousel-element' onclick='window.location.href=\"./venda?id_produto=".$dadosAcessorio["id"]."&categoria=".$dadosAcessorio['categoria']."\"'>
                                <img src='".$dadosAcessorio['foto_1']."' alt=''>
                                <div class='produtoInfos'>
                                    <p>".htmlspecialchars($dadosAcessorio['produto_nome'])."</p>
                                    <strong>R$".htmlspecialchars($dadosAcessorio['preco'])."</strong>
                                    <p>Frete grátis</p>
                                </div>
                            </div>
                        ";
                    }
                ?>
                </div>
            </div>
            <button class="nav-controls next-btn oito"><i class="bi bi-arrow-right"></i></button>
        </section>

        <section class="produtos" id="calçados">
            <strong>Esta procurando calçados?</strong>
            <button class="nav-controls prev-btn nove"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                <?php 
                    $sqlCalcado = "SELECT * FROM produtos WHERE categoria = 'Calcado'";

                    $resultadoCalcado = $conexao->query($sqlCalcado);

                    while($dadosCalcado = $resultadoCalcado->fetch_assoc()){
                        echo "
                            <div class='carousel-element' onclick='window.location.href=\"./venda?id_produto=".$dadosCalcado["id"]."&categoria=".$dadosCalcado['categoria']."\"'>
                                <img src='".$dadosCalcado['foto_1']."' alt=''>
                                <div class='produtoInfos'>
                                    <p>".htmlspecialchars($dadosCalcado['produto_nome'])."</p>
                                    <strong>R$".htmlspecialchars($dadosCalcado['preco'])."</strong>
                                    <p>Frete grátis</p>
                                </div>
                            </div>
                        ";
                    }
                ?>
                </div>
            </div>
            <button class="nav-controls next-btn nove"><i class="bi bi-arrow-right"></i></button>
        </section>
    </div>

    <footer>
        <h2>SOBRE NOSSO SITE</h2>
        <p>  
            <span id="textoSite">
                Este marktplace é um TCC (Trabalho de conclusão de curso). iniciado por 4 alunos do curso técnico de Desenvolvimento de Sistemas na escola ETEC Joaquim Ferreira do Amaral na cidade de jaú, por enquanto a ideia permanece como um projeto escolar, mas aceitamos feedbacks que nos ajudem a ter ideia de como o público reagiu ao site, isso será usado caso o site venha a se tornar algo mais profissional.

                caso queira nos ajudar, seu feedback serão ben-vindos, e com certeza serão de grande ajuda.
            </span>
        </p>

        <form action="" method="">
            <p>
                <label for="">Email</label>
                <input type="email" placeholder="Digite um e-mail" required>
            </p>

            <p>
                <label for="">Feedbacks</label>
                <textarea name="" id="" placeholder="Deixe seu feedback" required></textarea>
            </p>

            <input type="submit" value="Enviar feedback">

            <a href="#">Porque pedimos seu e-mail</a>
        </form>
    </footer>
</body>
</html>