<?php 
    include_once"conexao.php";

    $sql = "SELECT * FROM produtos";

    $resultado = $conexao->query($sql);
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
            <button id="userLogin">
                <i class="bi bi-person-circle"></i>
                <p>Entrar</p>
            </button>

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
        <a href="#maisComprados">Mais comprados</a>
        <a href="#acessorios">Acessorios</a>
        <a href="#mais">Descubra mais</a>
    </nav>

    <div id="sectionContainers">
        <section class="produtos" id="ofertas">
            <strong>Conheça ofertas do dia</strong>
            <button class="nav-controls prev-btn"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                    <?php 
                        while($dados = $resultado->fetch_assoc()){
                            echo "
                                <div class='carousel-element' onclick='window.location.href=\"./venda?id_produto=".$dados["id"]."\"'>
                                    <img src='./img/ice-falling-brown-drink.jpg' alt=''>
                                    <div class='produtoInfos'>
                                        <p>".htmlspecialchars($dados['produto_nome'])."</p>
                                        <strong>R$".htmlspecialchars($dados['preco'])."</strong>
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

        <section class="produtos" id="maisComprados">
            <strong>Conheça os mais comprados</strong>
            <button class="nav-controls prev-btn dois"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 122</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 10</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 10</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 10</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 22</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="nav-controls next-btn dois"><i class="bi bi-arrow-right"></i></button>
        </section>
        
        <section class="produtos" id="acessorios">
            <strong>Está procurando acessorios?</strong>
            <button class="nav-controls prev-btn tres"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 122</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 10</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="nav-controls next-btn tres"><i class="bi bi-arrow-right"></i></button>
        </section>

        <section class="produtos" id="mais">
            <strong>Produtos que talvez você goste</strong>
            <button class="nav-controls prev-btn quarto"><i class="bi bi-arrow-left"></i></button>
            <div class="carousel-wrapper">
                <div class="carousel-track">
                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 122</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 2</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/ice-falling-brown-drink.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 1</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>

                    <div class="carousel-element">
                        <img src="./img/side-view-chocolate-ice-cream-with-nuts-wafer-rolls.jpg" alt="">
                        <div class="produtoInfos">
                            <p>Produto 10</p>
                            <strong>R$ 00,00</strong>
                            <p>Frete grátis</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="nav-controls next-btn quarto"><i class="bi bi-arrow-right"></i></button>
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