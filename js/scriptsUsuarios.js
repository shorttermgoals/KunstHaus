// function ajax() {
//     try {
//         req = new XMLHttpRequest();
//     } catch(err1) {
//         try {
//             req = new ActiveXObject("Msxml2.XMLHTTP");
//         } catch (err2) {
//             try {
//                 req = new ActiveXObject("Microsoft.XMLHTTP");
//             } catch (err3) {
//                 req = false;
//             }
//         }
//     }
//     return req;
// }

// var borrar = new ajax();
// function borrarObjeto(id) {

//    if(confirm("¿Seguro que deseas eliminar la figura de la BD?")) {
//        var myurl = 'llamadas/borrarObjeto.php';
//        myRand = parseInt(Math.random() * 999999999999999);
//        modurl = myurl + '?rand=' + myRand + '&id=' + id;
//        borrar.open("GET", modurl, true);
//        borrar.onreadystatechange = borrarObjetoResponse;
//        borrar.send(null);
//    }

// }

// function borrarObjetoResponse() {

//     if (borrar.readyState == 4) {
//         if(borrar.status == 200) {

//            var listaFiguras = borrar.responseText;
//            //document.getElementsByClassName('lista')[0].innerHTML = listaFiguras;
//            document.getElementById('lista').innerHTML =  listaFiguras;
//         }
//     }
// }

// function coloresContrasenia(){
//     let pass = document.getElementById("pass");
//     let comment = document.getElementById("comment");
//     let c1 = document.getElementById("c1");
//     let c2 = document.getElementById("c2");
//     let c3 = document.getElementById("c3");
//     pass.addEventListener("input", function(){
//         let pass = this.value;

//         if (pass.length === 0){
//             comment.textContent = ""
//             comment.style.display = "hidden"
//         } else if (pass.length === 1){
//             comment.textContent = "La contraseña no es segura";
//         } else if (pass.length === 7){
//             comment.textContent = "La contraseña sigue siendo debil";
//         } else if (pass.length >= 13){
//             comment.textContent = "La contraseña es segura";
//         }
//         c1.style.backgroundColor = pass.length > 0 ? "red" : "grey";
//         c2.style.backgroundColor = pass.length < 7 ? "grey" : "yellow";
//         c3.style.backgroundColor = pass.length < 13 ? "grey" : "green";
//     });
// }

function cambiar(){
    let pass = document.getElementById("pass");
        let comment = document.getElementById("comment");
        let c1 = document.getElementById("c1");
        let c2 = document.getElementById("c2");
        let c3 = document.getElementById("c3");
        pass.addEventListener("input", function(){
            let pass = this.value;

            if (pass.length === 0){
                comment.textContent = ""
                comment.style.display = "hidden"
            } else if (pass.length === 1){
                comment.textContent = "La contraseña no es segura";
            } else if (pass.length === 7){
                comment.textContent = "La contraseña sigue siendo debil";
            } else if (pass.length >= 13){
                comment.textContent = "La contraseña es segura";
            }
            c1.style.backgroundColor = pass.length > 0 ? "red" : "grey";
            c2.style.backgroundColor = pass.length < 7 ? "grey" : "yellow";
            c3.style.backgroundColor = pass.length < 13 ? "grey" : "green";
    });
}

cambiar();
