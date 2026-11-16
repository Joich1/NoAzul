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


const input = document.getElementById('fInput')

const previewPhoto = () => {
    const file = input.files;
    if(file.length > 0){
        const fReader = new FileReader();
        const preview = document.getElementById('fPreview');
        fReader.onload = function (event) {
            preview.setAttribute('src', event.target.result);
        }
        fReader.readAsDataURL(file[0])
    }
}

if(input){
    input.addEventListener("change", previewPhoto)
}