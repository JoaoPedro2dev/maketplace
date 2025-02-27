// console.log('olá');

const email = document.querySelector('#email');
const codigoBox = document.querySelector('#emailBox');
const inputs = document.querySelectorAll('.input');
const labels = document.querySelectorAll('.label');
const errorMsg = document.querySelector('#error');
const telInput = document.querySelector('#tel');
const telLabel = document.querySelector('label[for="tel"]');
const cpfInput = document.querySelector('#cpf');
const passInput = document.querySelector('#pass');

document.querySelector('#formulario').addEventListener('submit', function(event){
    event.preventDefault();

    let formData = new FormData(this);

    fetch('./enviarEmail.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status == 'sucesso'){
            console.log('olá');
        }else if(data.status == 'erro2'){
            inputs.forEach((input, index) => {
                if(input.value.trim() == ''){
                    input.style.borderColor = 'red';
                    labels[index].style.color = 'red';
                }
            })
            errorMsg.textContent = 'Preencha todos os campos corretamente';
            errorMsg.style.display = 'block';
            document.addEventListener('click', inputNormal, {once: true})
        }else if(data.status == 'erro1'){
            inputsError(1, 'Email, invalido');

        }else if(data.status == 'erro3'){
            inputsError(1, 'Este email já esta em uso');

        }else if(data.status == 'erro4'){
            inputsError(0, 'Este nome de usuario já esta em uso');
        }else if(data.status == 'erro5'){
            telInput.style.borderColor = 'red';
            telLabel.style.color = 'red';
            errorMsg.style.display = 'block';
            errorMsg.textContent = 'Telefone invalido';
            document.addEventListener('click', inputNormal, {once: true});
        }else if(data.status == 'erro6'){
            telInput.style.borderColor = 'red';
            telLabel.style.color = 'red';
            errorMsg.style.display = 'block';
            errorMsg.textContent = 'Este telefone já esta em uso';
            document.addEventListener('click', inputNormal, {once: true});
        }else if(data.status == 'erro7'){
            inputsError(2, 'Cpf inválido');
        }else if(data.status == 'erro8'){
            inputsError(2, 'Este CPF já está em uso');
        }else if(data.status == 'erro9'){
            inputsError(3, 'Sua senha é muito curta');
        }
        console.log(data)
    })
    .catch(error => {console.log(error);});
})

function inputsError(index, menssagem){
    inputs[index].style.borderColor = 'red';
    labels[index].style.color = 'red';
    errorMsg.textContent = menssagem;
    errorMsg.style.display = 'block';
    document.addEventListener('click', inputNormal, {once: true});
}

function inputNormal(){
    inputs.forEach((input, index) => {
        input.style.borderColor = '#ccc';
        labels[index].style.color = 'black';
        telInput.style.borderColor = '#ccc';
        telLabel.style.color = 'black';
    })
    errorMsg.style.display = 'none';
}

telInput.addEventListener('input', function(e){
    let telValue = e.target.value.replace(/\D/g, '');

    if(telValue.length > 11) telValue = telValue.slice(0, 11);

    if(telValue.length > 7){
        telValue = `(${telValue.slice(0, 2)})${telValue.slice(2, 7)}-${telValue.slice(7)}`;
    }else if(telValue.length > 2 && telValue.length < 8){
        telValue = `(${telValue.slice(0, 2)})${telValue.slice(2, 8)}`;
    }else if(telValue.length < 0){
        telValue = `(${telValue.slice(0, 2)})${telValue.slice(6)}`;
    }

    e.target.value = telValue;
})

// telInput.addEventListener('input', function(e) {
//     let telValue = e.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos

//     if (telValue.length > 11) telValue = telValue.slice(0, 11); // Limita a 11 dígitos

//     // Aplica a formatação progressiva conforme a quantidade de números digitados
//     if (telValue.length > 6) {
//         telValue = `(${telValue.slice(0, 2)}) ${telValue.slice(2, 7)}-${telValue.slice(7)}`;
//     } else if (telValue.length > 2) {
//         telValue = `(${telValue.slice(0, 2)}) ${telValue.slice(2)}`;
//     }

//     e.target.value = telValue; // Atualiza o campo de entrada
// });


cpfInput.addEventListener('input', function(e){
    document.querySelector('#cpfBox a').style.display = 'block';

    let cpf = e.target.value.replace(/\D/g, '');

    if(cpf.length > 11) cpf = cpf.slice(0, 11);

    if(cpf.length > 10){
        cpf = `${cpf.slice(0, 3)}.${cpf.slice(3, 6)}.${cpf.slice(6, 9)}-${cpf.slice(9, 11)}`;
    }else if(cpf.length > 6){
        cpf = `${cpf.slice(0, 3)}.${cpf.slice(3, 6)}.${cpf.slice(6)}`;
    }else if(cpf.length > 3){
        cpf = `${cpf.slice(0, 3)}.${cpf.slice(3)}`;
    }
    
    

    e.target.value = cpf;
})

passInput.addEventListener('click', function(){  
    const passBox = document.querySelector('#passContent');
    passBox.style.display = 'flex';

    passInput.addEventListener('input', function(e){
        let senha = e.target.value.trim();
        const passSpan = passBox.querySelectorAll('span');
        
        if(senha.length > 5 && senha.length < 11){
            passSpan[0].style.color = 'green';
        }else{
            passSpan[0].style.color = 'red';
        }
    })
    
})