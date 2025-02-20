let inputSearch = document.querySelector('#searchInput');
const iconSearch = document.querySelector('#searchIcon');
const iconClear = document.querySelector('#clearSearch');

inputSearch.addEventListener('input', inputVerification)

function inputVerification(){
    if(inputSearch.value.trim() != ""){
        iconClear.style.display = "block";
        iconClear.addEventListener('click', clearSearchInput);
        iconSearch.style.display = "none";
    }else{
        iconClear.style.display = "none";
        iconSearch.style.display = "block";
    }
    inputSearch.focus();
}

function clearSearchInput(){
    inputSearch.value = "";
    inputVerification();
}

iconSearch.addEventListener('click', function(){
    inputSearch.focus();
})

const cartIcon = document.querySelector('#carrinhoIcon');
const cartBox = document.querySelector('#cartBox');
const closeBtn = document.querySelectorAll('.closeBtn');

if(cartIcon){
    cartIcon.addEventListener('click', function(){
        cartBox.classList.remove('hidden');
        cartBox.classList.add('open'); 
    })
}

if(cartBox){
    cartBox.addEventListener('click', (event) =>{
        if(event.target === cartBox){
            closeCart();
        }
    })
}

if(closeBtn[0]){
    closeBtn[0].addEventListener('click', function(){
        closeCart();
    })
}

function closeCart(){
    cartBox.classList.remove('open');
    cartBox.classList.add('hidden');
}

//carrinho
const moreBtn = document.querySelectorAll('.moreBtn');
const lessBtn = document.querySelectorAll('.lessBtn');
const qntDisplay = document.querySelectorAll('.qntDisplay');

moreBtn.forEach((btn, index) => {
    btn.addEventListener('click', function(){
        more(qntDisplay[index]);
    })
})

lessBtn.forEach((btn, index) => {
    btn.addEventListener('click', function(){
        less(qntDisplay[index]);
    });
})

function more(display){
    const qnt = Number(display.textContent);
    if(qnt < 100){
        display.textContent = qnt + 1; 
    }
}

function less(display){
    const qnt = Number(display.textContent);
    if(qnt > 1){
        display.textContent = qnt - 1;
    }
}

//carousel
const carousel = document.querySelector('.carousel');

if(carousel){
    const slides = document.querySelectorAll('.slide');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const indicators = document.querySelectorAll('.indicators input');

let index = 0;
const totalSlides = slides.length;
let autoSlideInterval;

// Atualiza a posição do carrossel
function updateCarousel() {
    carousel.style.transform = `translateX(-${index * 100}vw)`;
    indicators[index].checked = true;
}

// Avança para o próximo slide
function nextSlide() {
    index = (index + 1) % totalSlides;
    updateCarousel();
}

// Volta para o slide anterior
function prevSlide() {
    index = (index - 1 + totalSlides) % totalSlides;
    updateCarousel();
}

// Inicia o carrossel automático
function startAutoSlide() {
    stopAutoSlide(); // Para evitar múltiplos intervalos
    autoSlideInterval = setInterval(nextSlide, 4000);
}

// Para o carrossel automático
function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

// Eventos dos botões
nextButton.addEventListener('click', () => {
    nextSlide();
    startAutoSlide(); // Reinicia o temporizador
});

prevButton.addEventListener('click', () => {
    prevSlide();
    startAutoSlide(); // Reinicia o temporizador
});

// Eventos dos indicadores
indicators.forEach((indicator, i) => {
    indicator.addEventListener('click', () => {
        // index = i;
        updateCarousel();
        startAutoSlide(); // Reinicia o temporizador
    });
});

// Inicia o carrossel automaticamente ao carregar a página
startAutoSlide();
}


//carousel produtos
const carouselTrack = document.querySelectorAll(".carousel-track");
const prevBtn = document.querySelectorAll(".prev-btn");
const nextBtn = document.querySelectorAll(".next-btn");

const cardWidth = 220 + 45; // Largura do card + gap
const visibleCards = 3;
const scrollAmount = cardWidth * visibleCards;

nextBtn.forEach((btn, index) => {
    btn.addEventListener("click", () => {
        carouselTrack[index].scrollBy({ left: scrollAmount, behavior: "smooth" });
    
        if((carouselTrack[index].scrollLeft + carouselTrack[index].clientWidth) > (carouselTrack[index].scrollWidth - 200)){
            btn.style.display = "none";
        }
    
        prevBtn[index].style.display = "block";

    });
})

prevBtn.forEach((btn, index) => {
    btn.addEventListener("click", () => {
        carouselTrack[index].scrollBy({ left: -scrollAmount, behavior: "smooth" });

        if((carouselTrack[index].scrollLeft - 800) <= 0 ){
            btn.style.display = "none";
        }
    
        nextBtn[index].style.display = "block";
    });
})

//carroussel de venda
// let imagemExibida = document.getElementById("foto-principal");
// imagemExibida.src = document.querySelector('.selectedImg').src;

// function alterarImagem(elemento) {
//     const miniaturas = document.querySelectorAll('.selectedImg');

//     miniaturas.forEach(img => img.classList.remove("selectedImg"));

//     elemento.classList.add('selectedImg');
//     imagemExibida.src = elemento.src;
// }