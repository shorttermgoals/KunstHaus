var ejecutado = false; // Variable de bandera


window.addEventListener('load',function(){
    var anchoPagina = window.innerWidth;
    if (anchoPagina <= 1024 && !ejecutado){
        ejecutado = true;
        cambiarMenu();
    } else if(anchoPagina >1024 && ejecutado){
        ejecutado = false;
        descambiarMenu();
    }
});

window.addEventListener('resize', function() {
    var anchoPagina = window.innerWidth;
    if (anchoPagina <= 1024 && !ejecutado){
        ejecutado = true;
        cambiarMenu();
    } else if(anchoPagina >1024 && ejecutado){
        ejecutado = false;
        descambiarMenu();
    }
});
  
function cambiarMenu() {
    var menu_objetos = document.getElementById('menu-obj');
    var menu_usuarios = document.getElementById('menu-usr');
    var menu_ver_objetos = document.getElementById('menu-v-obj');
    var menu_contacto = document.getElementById('menu-contacto');
    var menu_salir = document.getElementById('menu-salir');
    var menu_saludo = document.getElementById('menu-saludo');
    var menu_popup = document.getElementById('menu-popup');
    if (menu_objetos) {
        menu_objetos.style.display = 'none';
    }
    if (menu_usuarios) {
        menu_usuarios.style.display = 'none';
    }
    menu_ver_objetos.style.display = 'none';
    menu_contacto.style.display = 'none';
    menu_salir.style.display = 'none';
    menu_saludo.style.display = 'none';
    menu_popup.style.display = 'block';
}

function descambiarMenu() {
    var menu_objetos = document.getElementById('menu-obj');
    var menu_usuarios = document.getElementById('menu-usr');
    var menu_ver_objetos = document.getElementById('menu-v-obj');
    var menu_contacto = document.getElementById('menu-contacto');
    var menu_salir = document.getElementById('menu-salir');
    var menu_saludo = document.getElementById('menu-saludo');
    var menu_popup = document.getElementById('menu-popup');
    if (menu_objetos) {
        menu_objetos.style.display = 'block';
    }
    if (menu_usuarios) {
        menu_usuarios.style.display = 'block';
    }
    menu_ver_objetos.style.display = 'block';
    menu_contacto.style.display = 'block';
    menu_salir.style.display = 'block';
    menu_saludo.style.display = 'block';
    menu_popup.style.display = 'none';
}
