<?php 
require "includes/protec.php";
//Todos los datos del usuario que ha iniciado sesión, puedo especificar el tipo de datos despues del SESSION
var_dump($_SESSION);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KunstHaus</title>
    <?php 
        include "includes/head.php";
    ?>
</head>
<body>
<?php 
    include "includes/header.php";
    include "includes/menu.php";
?>

    <section>

        <h1>Esta sería la portada</h1>

    </section>

<?php 

    include "includes/footer.php"

?>
    

</body>
</html>