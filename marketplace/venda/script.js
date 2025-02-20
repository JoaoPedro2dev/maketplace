let imagemExibida = document.getElementById("foto-principal");
imagemExibida.src = document.querySelector('.selectedImg').src;

function alterarImagem(elemento) {
    const miniaturas = document.querySelectorAll('.selectedImg');

    miniaturas.forEach(img => img.classList.remove("selectedImg"));

    elemento.classList.add('selectedImg');
    imagemExibida.src = elemento.src;
}

//CONTROLE DE UNIDADES
const addBtn = document.querySelector('.moreBtn');
const removeBtn = document.querySelector('.lessBtn');
const qntdisplay = document.querySelector('.qnt');

addBtn.addEventListener('click', function(){
    moreItem(qntdisplay);
})

removeBtn.addEventListener('click', function(){
    lessItem(qntdisplay);
});

let i = 1;

function moreItem(display){
    if(qnt < 100){
        display.textContent = i++; 
    }
}

function lessItem(display){
    if(qnt > 1){
        display.textContent = i--;
    }
}

//carousel produtos
const carouseltrack = document.querySelectorAll(".carousel-track");
const prevbtn = document.querySelectorAll(".prev-btn");
const nextbtn = document.querySelectorAll(".next-btn");

const cardwidth = 220 + 45; // Largura do card + gap
const visiblecards = 3;
const scrollamount = cardwidth * visiblecards;

nextbtn.forEach((btn, index) => {
    btn.addEventListener("click", () => {
        carouseltrack[index].scrollBy({ left: scrollamount, behavior: "smooth" });
    
        if((carouseltrack[index].scrollLeft + carouseltrack[index].clientWidth) > (carouseltrack[index].scrollWidth - 200)){
            btn.style.display = "none";
        }
    
        prevbtn[index].style.display = "block";

        console.log([index] + "olá");
    });
})

prevbtn.forEach((btn, index) => {
    btn.addEventListener("click", () => {
        carouseltrack[index].scrollBy({ left: -scrollamount, behavior: "smooth" });

        if((carouseltrack[index].scrollLeft - 800) <= 0 ){
            btn.style.display = "none";
        }
    
        nextbtn[index].style.display = "block";
    });
})

//CONTROLE DE COMENTARIOS
const comentariosShow = document.querySelector('#mostarComentariosBtn');
const comentarioContainer =  document.querySelector('#comentariosContainer');

if(comentariosShow && comentarioContainer){
    comentariosShow.addEventListener('click', function(){
        if(comentarioContainer.style.maxHeight === "300px"){
          comentarioContainer.style.maxHeight = "max-content"
          comentariosShow.textContent = "Mostrar menos comentarios";
        }else{
          comentarioContainer.style.maxHeight = "300px"
          comentariosShow.textContent = "Mostrar mais comentarios";
        }
      })
}