const etapa1 = document.getElementById("etapa1");
const etapa2 = document.getElementById("etapa2");
const btnN = document.getElementById("next");
const btnB = document.getElementById("back");

if (btnN && btnB){
    btnN.addEventListener('click', () =>{
        for(const field of etapa1.querySelectorAll('input')){
            if(!field.reportValidity()){
                return;
            }
        }

        etapa1.hidden = true;
        etapa2.hidden = false;

    })

    btnB.addEventListener('click', () =>{
        etapa2.hidden = true;
        etapa1.hidden = false;
    })
}
