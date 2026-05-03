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

// Función para mostrar la alerta al cargar la página de login
function mostrarAlerta() {
    alert("No tienes acceso al área de administradores. Por favor, póngase en contacto con su administrador para más información.");
}

// Verificar si estamos en la página de login
if (window.location.pathname.endsWith('loginadmin.php')) {
    window.onload = function() {
        mostrarAlerta(); // Llama a la función de alerta solo en la página de login
    }
}