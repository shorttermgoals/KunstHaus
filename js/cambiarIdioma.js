function cambiarIdioma(idioma) {
    let portada = $('#portada');
    let menu_home = $('#menu-home');
    let menu_objetos = $('#menu-obj');
    let menu_usuarios = $('#menu-usr');
    let menu_ver_objetos = $('#menu-v-obj');
    let menu_contacto = $('#menu-contacto');
    let menu_salir = $('#menu-salir');
    if (idioma == 1){
        portada.text("Esta sería la portada");
        menu_home.text("Inicio");
        menu_objetos.text("Gestionar Objetos");
        menu_usuarios.text("Administrar usuarios");
        menu_ver_objetos.text("Ver objetos");
        menu_contacto.text("Contacto");
        menu_salir.text("Cerrar sesión");

    } else {
        portada.text("This would be the front page");
        menu_home.text("Home");
        menu_objetos.text("Object managment");
        menu_usuarios.text("User administration");
        menu_ver_objetos.text("See objects");
        menu_contacto.text("Contact");
        menu_salir.text("Log out");
    }
}