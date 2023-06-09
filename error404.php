<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR</title>
    <?php
        include "includes/head.php";
    ?>
</head>
<body>
<section>
    <div class="formDialog-wide">
        <div class="formArea-wide">
            <div class="elementosError">
                <div class="letraErr" onmouseover="cambiarColor(this)" onmouseout="restaurarColor(this)">E</div>
                <div class="letraErr" onmouseover="cambiarColor(this)" onmouseout="restaurarColor(this)">R</div>
                <div class="letraErr" onmouseover="cambiarColor(this)" onmouseout="restaurarColor(this)">R</div>
                <div class="numErr" >0</div>
                <div class="letraErr" onmouseover="cambiarColor(this)" onmouseout="restaurarColor(this)">R</div>
                <div class="numErr"></div>
                <div class="numErr"></div>
                <div class="numErr">4</div>
                <div class="letraErr" onmouseover="cambiarColor(this)" onmouseout="restaurarColor(this)">O</div>
                <div class="numErr">4</div>
            </div>
            <div>
                <div class="botonError404">
                        <button onclick="volverAtras()">< < <</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    function cambiarColor(elemento) {
    var letrasErr = document.getElementsByClassName('letraErr');
    var numsErr = document.getElementsByClassName('numErr');

    for (var i = 0; i < letrasErr.length; i++) {
        letrasErr[i].style.backgroundColor = 'transparent'; 
        letrasErr[i].style.color = 'transparent'; 
    }

    for (var i = 0; i < numsErr.length; i++) {
        numsErr[i].style.backgroundColor = 'black'; 
        numsErr[i].style.color = 'white'; 
    }
    }

    function restaurarColor(elemento) {
    var letrasErr = document.getElementsByClassName('letraErr');
    var numsErr = document.getElementsByClassName('numErr');

    for (var i = 0; i < letrasErr.length; i++) {
        letrasErr[i].style.backgroundColor = ''; 
        letrasErr[i].style.color = ''; 
    }

    for (var i = 0; i < numsErr.length; i++) {
        numsErr[i].style.backgroundColor = ''; 
        numsErr[i].style.color = ''; 
    }
    }


    function volverAtras(){
        history.back();
    }
</script>
</body>
</html>