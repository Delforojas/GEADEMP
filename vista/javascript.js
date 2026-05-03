console.log("El archivo app.js se ha cargado correctamente");
document.addEventListener('DOMContentLoaded', () => {
    const tituloVacaciones = document.getElementById('h1p');  // Selecciona el <h1> por su id "h1p"

    if (tituloVacaciones) {  // Verifica que el elemento existe
        console.log("Elemento con id 'h1p' encontrado.");

        // Agregar eventos de mouseover y mouseout
        tituloVacaciones.addEventListener('mouseover', function() {
            this.style.backgroundColor = 'black';
            this.style.color = '#FF6500';  // Cambia el color del texto al pasar el ratón
        });

        tituloVacaciones.addEventListener('mouseout', function() {
            this.style.backgroundColor = '#FF6500';
            this.style.color = 'black';  // Cambia el color del texto de vuelta al original
        });
    } else {
        console.error("El elemento con id 'h1p' no se encontró en el DOM.");
    }
});


let listElements = document.querySelectorAll('.list__button--click');

listElements.forEach(listElement =>{
    listElement.addEventListener('click', ()=>{
        
        listElement.classList.toggle('arrow')


        let height =0;
        let menu= listElement.nextElementSibling;
        if (menu.clientHeight =="0"){
            height=menu.scrollHeight;
        }

        menu.style.height =`${height}px`;

    })
});