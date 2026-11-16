const expense = document.getElementById('expense');
const btnr = document.getElementById('btnr');
const x = document.getElementById('x');

if(btnr && x){
    btnr.addEventListener('click', () =>{
        for(const field of expense.querySelectorAll('input')){
            if(!field.reportValidity()){
                return;
            }
        }

        expense.hidden = false;
    })

    x.addEventListener('click', () =>{
        expense.hidden = true;
    })
}
