let listElements = document.querySelectorAll('.list__button--click');

listElements.forEach(listElement => {
    listElement.addEventListener('click',()=>{

        listElement.classList.toggle('arrow');

        let height=0;
        let menu= listElement.nextElementSibling;
        if(menu.clientHeight =="0"){
            height=menu.scrollHeight;
        }

        menu.style.height= `${height}px`;
    })
    
});


document.addEventListener('click', function(e){
    if(subMenu.classList.contains('show')
        && !subMenu.contains(e.target)
        &&!openSubMenu.contains(e.target)){

        subMenu.classList.remove('show')
        }

});


// 
/*document.getElementById('adminLink').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el enlace se abra inmediatamente

    // Solicitar la contraseña al usuario
    let password = prompt('Por favor, introduce la contraseña de administrador:');

    // Comprobar si la contraseña es correcta
    if (password === 'bucleAdmin') {  // Aquí puedes cambiar la contraseña
        // Si la contraseña es correcta, redirige a la página de administración
        window.location.href = 'vista_bolsa_admin.php';
    } else {
        // Si la contraseña es incorrecta, muestra un mensaje de error
        alert('Contraseña incorrecta. Acceso denegado.');
    }
});*/