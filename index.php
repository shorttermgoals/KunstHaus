<?php
require "modelo/ConexionBBDD.php";
require "modelo/funciones.php";
require "modelo/Usuario.php";
if(isset($_POST) && !empty($_POST)){
    
    $pass = addslashes($_POST['pass']);

    $usuario = new Usuario();

    if(empty($_POST['mail1'])){
        $nombre = addslashes($_POST['nombre']);
        $username = addslashes($_POST['username']);
        $mail = addslashes($_POST['mail2']); 
        if($usuario->insertarRegistro($nombre,$username,$mail,$pass)){
            header("location:index.php#cerrar");
            $errorMensajeRegistro = "";  
        }else{
            $errorMensajeRegistro = "Hubo un error en el registro de usuario, el usuario o mail introducido ya está en uso.";
        }
        
    }else if(empty($_POST['mail2'])){
        $mailOrUsername = addslashes($_POST['mail1']);
        if($usuario->login($mailOrUsername,$pass)){
            header("location:verObjetos.php");
            $errorMensajeLogin = "";
         }else{
            $errorMensajeLogin = "Hubo un error en el inicio de sesión, el usuario o contraseña introducido no es correcto.";          
         }
    }
    






}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php 
        include "includes/head.php";
    ?>
</head>
<body>

    <div class="formDialog-login">
        <div class="formArea-login">
            <div class="contenedorForm-login">
                <div class="tituloForm-login">
                    <a class="descForm-login" style="font-size: 18px;"><strong>LOGIN</strong></a>
                </div>
                <?php if (isset($errorMensajeLogin)) : ?>
                            <div class="mensajeErrorForm">
                                <a style="color:white;" ><strong><?php echo $errorMensajeLogin; ?></strong></a>
                            </div>
                        <?php endif; ?>
                <form name="login" action="<?php  echo $_SERVER['PHP_SELF']?>" method="post">
                    <div class="datoForm-login">
                        <li><input type="text" name="mail1" placeholder="User" required></li>
                    </div>
                    <div class="datoForm-login">
                        <li><input type="password" name="pass" placeholder="Password" required></li>
                    </div>
                    <div class="botonPopupRegistroLogin">
                            <div class="botonPopupRegistroLogin-container">
                                    <a href="#popupRegistro" class="botonPopupRegistroLogin-container-dato-2" style="font-size: 13px;" >No tengo cuenta</a>                               
                            </div>
                    </div>
                    <div class="botonForm-login">
                        <li><input type="submit" value="Entrar"></li>
                    </div>
                    <div class="textoForm-login">
                        <div class="contenedorTextoForm">
                            <li><a style="opacity:0.6;">Al iniciar sesión aceptas nuestros </a><a href="#popupTerminos" class="datosHrefPoliticas">Términos de servicio</a><a style="opacity:0.6;"> y nuestra </a><a href="#popupPolitica" class="datosHrefPoliticas">Política de privacidad</a></li>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

        <div id="popupRegistro" class="popupDialog">
            <div id="popupArea" class="popupArea">
                
                <div class="contenedorPopup">
                    <div class="tituloPopup">
                        <div class="vacio"></div>
                        <a class="descPopup" style="font-size: 18px;"><strong>REGISTRO</strong></a>
                        <a href="#cerrarPopup" class="cerrarPopup" id="cerrarPopup"><img src="./images/icons/icon-close.png" style="width: 15px;"></a>      
                    </div>
                    <?php if (isset($errorMensajeRegistro)) : ?>
                        <div class="texto-warning">
                            <a class="mensajeErrorRegistro-texto" style="color:white;"><strong><?php echo $errorMensajeRegistro; ?></strong></a>
                        </div>
                    <?php endif; ?>
                    <form  id="formularioRegistro" name="usuarios" method="post" enctype="multipart/form-data">
                        <div class="dato-input">                            
                            <li><input type="text" name="nombre" placeholder="Name" maxlength="50" required></li>
                        </div>
                        <div class="dato-input">
                            <li><input type="text" name="username" placeholder="Username" maxlength="20" required></li>
                        </div>
                        <div class="dato-input">
                            <li><input type="email" name="mail2" placeholder="E-mail" maxlength="80" required></li>
                        </div>
                        <div class="dato-input">
                            <li><input id="pass" type="password" name="pass" minlength="7" placeholder="Password" required></li>
                        </div>
                        <div class="coloresRegistro">
                            <div class="textoPasswordColores">
                                <a id="comment" style="display: hidden;"></a>
                            </div>
                            <div class="coloresPasswordColores">
                                    <div id="c1" class="bloqueColor"></div>
                                    <div id="c2" class="bloqueColor"></div>
                                    <div id="c3" class="bloqueColor"></div>
                            </div>
                        </div>
                        <div class="botonRegistro">
                            <input type="submit" id="botonRegistro" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>

            <!-- <div class="popupFondo" id="popupFondo">
            
            </div> -->
            
        </div>

        <div id="popupTerminos" class="popupDialog">
            <div id="popupArea" class="popupArea">
                <div class="contenedorPopup">
                    <div class="tituloPopup">
                        <div class="vacio"></div>
                        <a class="descPopup" style="font-size: 18px;"><strong>TÉRMINOS Y CONDICIONES</strong></a>
                        <a href="#cerrarPopup" class="cerrarPopup" id="cerrarPopup"><img src="./images/icons/icon-close.png" style="width: 15px;"></a>      
                    </div>
                    <div class="textoForm-login">
                        <div class="contenedorTextoForm">
                            <li><a>Bienvenido
                                    Kunsthaus Labs, Inc. (“Kunsthaus,” “nosotros,” “nuestro”) proporciona su mercado y servicios (descritos a continuación) a usted (“usted” o “Usuario”) a través de su sitio web, plataforma y mercado ubicado en www.foundation.app (el “Plataforma”), sujeto a los siguientes Términos de servicio (según se enmienden de vez en cuando, los “Términos”). Al registrarse para obtener una cuenta en la Plataforma o utilizarla de otra manera, usted reconoce que ha leído y acepta estos Términos. La Política de privacidad y todos los términos adicionales, pautas y reglas establecidos en la Plataforma se incorporan por referencia en estos Términos y son expresamente aceptados y reconocidos por el Usuario.
                                    LEA ESTOS TÉRMINOS ATENTAMENTE, YA QUE CONTIENEN UN ACUERDO DE ARBITRAJE Y OTRA INFORMACIÓN IMPORTANTE SOBRE SUS DERECHOS LEGALES, RECURSOS Y OBLIGACIONES. EL ACUERDO DE ARBITRAJE REQUIERE (CON EXCEPCIONES LIMITADAS) QUE USTED PRESENTE RECLAMOS QUE TENGA CONTRA NOSOTROS A UN ARBITRAJE VINCULANTE Y FINAL, Y ADEMÁS (1) SOLO SE LE PERMITIRÁ PRESENTAR RECLAMOS CONTRA KUNSTHAUS DE FORMA INDIVIDUAL, NO COMO UN MIEMBRO DEL GRUPO EN UNA ACCIÓN O PROCEDIMIENTO COLECTIVO O REPRESENTATIVO, (2) SOLO SE LE PERMITIRÁ BUSCAR REPARACIÓN (INCLUYENDO REPARACIÓN MONETARIA, CAUTELAR Y DECLARATORIA) DE FORMA INDIVIDUAL, Y (3) ES POSIBLE QUE NO PUEDA RESOLVER CUALQUIER RECLAMO QUE TENGA CONTRA NOSOTROS EN UN TRIBUNAL DE JURADO O EN UN TRIBUNAL DE JUSTICIA.
                                    Nos reservamos el derecho, a nuestra entera discreción, de cambiar o modificar partes de estos Términos en cualquier momento. Si lo hacemos, publicaremos los cambios en esta página e indicaremos en la parte superior de esta página la fecha en que se revisaron por última vez estos Términos. También le notificaremos, ya sea a través de la interfaz de usuario de la Plataforma, mediante una notificación por correo electrónico o mediante otros medios razonables. Dichos cambios entrarán en vigencia no antes de catorce (14) días después de su publicación, excepto que los cambios relacionados con nuevas funciones de la Plataforma entrarán en vigencia de inmediato. Su uso continuado de la Plataforma después de la fecha en que dichos cambios entren en vigencia constituye su aceptación de los nuevos Términos de servicio.
                                    1) ¿Qué es KunstHaus?
                                    Foundation provides a platform for Users, including artists (“Creators”), collectors (“Collectors”), and curators (“Curators”) to sell, purchase, list for auction, make offers on, and bid on (each a “Transaction”) Digital Artwork (as defined below).
                                    a) Smart-Contract Enabled. “Digital Artwork” on the Platform refers to a non-fungible Ethereum-based token that uses smart contracts on the Ethereum blockchain (“Smart Contracts”). The Ethereum blockchain provides an immutable ledger of all transactions that occur on the blockchain. This means that all Digital Artwork is outside of the control of any one party, including Foundation, and is subject to many risks and uncertainties. We neither own nor control MetaMask, Coinbase, the Ethereum network, the smart contracts on which Collections (as defined below) are based (“Collection Smart Contracts”), your browser, or any other third party site, product, or service that you might access, visit, or use for the purpose of enabling you to use the various features of the Platform. We will not be liable for the acts or omissions of any such third parties, nor will we be liable for any damage that you may suffer as a result of your transactions or any other interaction with any such third parties. You understand that your Ethereum public address will be made publicly visible whenever you engage in a Transaction on the Platform.
                                    b) Noncustodial. While Foundation offers a marketplace for Digital Artwork, it does not buy, sell, or ever take custody or possession of any Digital Artwork. The Platform facilitates User collection of Digital Artwork, but neither Foundation nor the Platform are custodians of any Digital Artwork. The User understands and acknowledges that the Smart Contracts do not give Foundation custody, possession, or control of any Digital Artwork or cryptocurrency at any time for the purpose of facilitating Transactions on the Platform. You affirm that you are aware and acknowledge that Foundation is a non-custodial service provider and has designed the Platform to be directly accessible by the Users without any involvement or actions taken by Foundation or any third-party. Foundation facilitates Transactions between the Users on the Platform but is not a party to any agreement between any sellers, buyers, Creators, Collectors, and other Users. As a marketplace, Foundation cannot make any representation or guarantee that Creators or Users will achieve any particular outcome as the result of listing their Digital Artwork or engaging in any other Transaction on the Platform.
                                    c) No Securities. The digital assets about which information is provided on the Platform and any information provided in connection with the Platform provided to you are not viewed by the issuer or sponsor of any such digital assets, or those buying or selling the digital asset, as securities under U.S. laws or relevant applicable laws. As a result it is unlikely that fulsome disclosures from the issuer or sponsor, or any executive officer associated with the digital asset or related protocol have been provided, and others may have better or more information than the information made available to you via the Platform or any information provided in connection with the Platform provided to you, or to which you may independently have access.
                                    2) ¿Cómo uso KunstHaus?
                                    a) Tus Obligaciones de Registro: Cualquiera puede navegar por la Plataforma sin registrarse para obtener una cuenta. Es posible que se te solicite registrarte en KunstHaus para acceder y utilizar ciertas funciones en la Plataforma, como participar como Creador o Coleccionista. Si decides registrarte en la Plataforma, aceptas proporcionar y mantener información veraz, precisa, actual y completa sobre ti mismo, según lo indicado en nuestro formulario de registro. Los datos de registro y cierta otra información sobre ti están sujetos a nuestra Política de Privacidad. Debes tener al menos 13 años para registrarte en una cuenta como Creador, y al menos 18 años para realizar una oferta en cualquier Obra de Arte Digital. Si tienes entre 13 y 18 años, debes contar con el permiso expreso de un padre o tutor legal que pueda aceptar estos Términos en tu nombre. Eres responsable de todo lo que ocurra cuando alguien inicie sesión en tu cuenta, así como de la seguridad de la cuenta.
                                    b) Cuenta de Miembro, Contraseña y Seguridad: Eres responsable de mantener la confidencialidad de tu cuenta y contraseña, si la tienes, y eres totalmente responsable de cualquier actividad que ocurra bajo tu contraseña o cuenta. Aceptas (a) notificar inmediatamente a KunstHaus cualquier uso no autorizado de tu contraseña o cuenta o cualquier otra violación de seguridad, y (b) asegurarte de cerrar sesión en tu cuenta al final de cada sesión cuando accedas a la Plataforma. KunstHaus no será responsable de ninguna pérdida o daño que surja de tu falta de cumplimiento de esta sección.
                                    c) Conexión de tu Monedero: Para participar como Creador o Coleccionista en la Plataforma, debes conectar tu cuenta con tu monedero digital compatible con MetaMask, WalletConnect u otras extensiones o pasarelas de monedero permitidas en la Plataforma ("Monedero Digital"). Dichos monederos digitales te permiten comprar, almacenar y realizar transacciones utilizando la criptomoneda nativa de Ethereum, ETH. Todas las transacciones en la Plataforma se realizan en la criptomoneda nativa de Ethereum, ETH.
                                    d) Modificaciones a la Plataforma: KunstHaus se reserva el derecho de modificar o interrumpir, de forma temporal o permanente, la Plataforma (o cualquier parte de la misma) con o sin previo aviso. Aceptas que KunstHaus no será responsable ante ti ni ante ningún tercero por ninguna modificación, suspensión o interrupción de la Plataforma.
                                    3) Normas para usar KunstHaus
                                    b) Si utilizas la Plataforma para comunicarte o administrar sorteos, concursos y otras promociones (cada una, una "Promoción"), eres el único responsable de cumplir y te asegurarás de que tu Promoción, incluyendo sus reglas, términos y requisitos ("Reglas de la Promoción"), cumpla con todas las leyes y regulaciones aplicables y estos Términos. Las Reglas de la Promoción deben contener, como mínimo, un conjunto de reglas oficiales que sean consistentes con estos Términos y que incluyan (i) una liberación completa de Kunsthaus por cada participante de dicha Promoción, y (ii) un reconocimiento que indique que la Promoción no está patrocinada, respaldada, administrada ni asociada de ninguna otra manera con Kunsthaus o nuestras Afiliadas (según se define a continuación). Aceptas que tu Promoción se llevará a cabo completamente de acuerdo con las Reglas de la Promoción. Kunsthaus no te ayudará con la administración u operación de tu Promoción, ni te proporcionará ningún consejo relacionado con la misma. Asumes todos los riesgos asociados con el uso de la Plataforma para administrar tu Promoción. Kunsthaus se reserva el derecho, a su sola discreción, de restringir, limitar o negar cualquier Promoción y ventas o subastas asociadas por cualquier motivo, en cualquier momento.
                                    c) Si vendes, prometes, administras o proporcionas de alguna otra manera beneficios especiales, obras de arte físicas, descuentos, cupones, experiencias u oportunidades ("Beneficios") en relación con la venta o subasta de Obras de Arte Digital en la Plataforma, eres el único responsable de cumplir y te asegurarás de que tus Beneficios cumplan con todas las leyes y regulaciones aplicables y estos Términos. Si haces una oferta o intentas comprar, o compras, una Obra de Arte Digital asociada con cualquier Beneficio, reconoces que Kunsthaus no ofrece ninguna garantía, representación, garantía o recomendación y no brinda asesoramiento de inversión u otro tipo de asesoramiento en relación con ningún Beneficio ni como resultado de tener o poseer la Obra de Arte Digital asociada con cualquier Beneficio.
                                    Kunsthaus no te ayudará con la administración, operación, redención, ejercicio, cumplimiento u otro uso de los Beneficios, ni te proporcionará ningún consejo relacionado con los mismos. Asumes todos los riesgos asociados con los Beneficios, incluido tu uso de la Plataforma en relación con los Beneficios. Kunsthaus se reserva el derecho, a su sola discreción, de restringir, limitar o negar cualquier venta o subasta de Obras de Arte Digital asociada con Beneficios por cualquier motivo, en cualquier momento.
                                </a></li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="popupPolitica" class="popupDialog">
            <div id="popupArea" class="popupArea">
                <div class="contenedorPopup">
                    <div class="tituloPopup">
                        <div class="vacio"></div>
                        <a class="descPopup" style="font-size: 18px;"><strong>POLÍTICA DE PRIVACIDAD</strong></a>
                        <a href="#cerrarPopup" class="cerrarPopup" id="cerrarPopup"><img src="./images/icons/icon-close.png" style="width: 15px;"></a>      
                    </div>
                    <div class="textoForm-login">
                        <div class="contenedorTextoForm">
                            <li><a>Bienvenido
                                    Bienvenido al sitio web de KunstHaus. KunstHaus proporciona una plataforma para administrar y navegar obras de arte digitales (en conjunto, incluyendo el Sitio, el "Servicio").
                                    Esta Política de Privacidad explica qué información personal recopilamos, cómo utilizamos y compartimos esa información, y sus opciones con respecto a nuestras prácticas de información.
                                    Antes de utilizar el Servicio o enviar cualquier información personal a KunstHaus, revise esta Política de Privacidad detenidamente y contáctenos si tiene alguna pregunta. Al utilizar el Servicio, acepta las prácticas descritas en esta Política de Privacidad. Si no está de acuerdo con esta Política de Privacidad, no acceda al Sitio ni utilice el Servicio. Esta Política de Privacidad se incorpora y forma parte de nuestros Términos de Servicio, que se encuentran en https://kunsthaus./terminos. Los términos en mayúscula no definidos en esta Política de Privacidad tienen los significados asignados a ellos en los Términos de Servicio.
                                    1. Recopilación de información personal
                                    Información personal que usted proporciona: Recopilamos las siguientes categorías de información de usted:
                                    Información de identificación: Recopilamos su nombre, dirección de correo electrónico, dirección de billetera digital y cualquier otra información que nos proporcione directamente a través de los Servicios.
                                    Información de comunicación: Podemos recopilar información cuando nos contacta con preguntas o inquietudes, y cuando responde voluntariamente a cuestionarios, encuestas o solicitudes de investigación de mercado para obtener su opinión y comentarios.
                                    Información comercial: Podemos mantener un historial de las obras de arte digitales o contenido artístico que navega, vende y/o compra utilizando el Servicio.
                                    Información de redes sociales: Mantenemos presencia en redes sociales en plataformas como Instagram, Twitter y LinkedIn. Cuando interactúa con nosotros en las redes sociales, podemos recibir información personal que usted proporciona o pone a nuestra disposición en función de su configuración, como su información de perfil. También recopilamos cualquier información de perfil de redes sociales que nos proporcione directamente.
                                    Información de actividad en Internet: Cuando visita, utiliza e interactúa con el Servicio, podemos registrar automáticamente la siguiente información:
                                    Información del dispositivo: El fabricante y modelo, sistema operativo, tipo de navegador, dirección IP e identificadores únicos del dispositivo que utiliza para acceder al Servicio. La información que recopilamos puede variar según el tipo y la configuración de su dispositivo.
                                    Información de uso: Información sobre cómo utiliza nuestro Servicio, como los tipos de contenido que ve o con los que interactúa, las funciones que utiliza, las acciones que realiza y la hora, frecuencia y duración de sus actividades. Utilizamos Google Analytics, un servicio de análisis web proporcionado por Google LLC ("Google"), para ayudar a recopilar y analizar la información de uso. Para obtener más información sobre cómo Google utiliza esta información, haga clic aquí.
                                    Información de ubicación: Podemos obtener una estimación aproximada de su ubicación a partir de su dirección IP cuando visita el Sitio.
                                    Información de apertura y clics de correo electrónico: Podemos utilizar píxeles u otras tecnologías en nuestras campañas de correo electrónico que nos permiten recopilar su dirección de correo electrónico y dirección IP, así como la fecha y hora en que abre un correo electrónico o hace clic en enlaces en los correos electrónicos.
                                    Podemos utilizar las siguientes tecnologías para recopilar información sobre la actividad en Internet:
                                    Cookies, que son archivos de texto almacenados en su dispositivo para identificar de manera única su navegador o para almacenar información o configuraciones en el navegador para ayudarlo a navegar entre páginas de manera eficiente, recordar sus preferencias, habilitar la funcionalidad, ayudarnos a comprender la actividad y los patrones de los usuarios, y facilitar la publicidad en línea.
                                    Tecnologías de almacenamiento local, como HTML5, que proporcionan funcionalidad similar a las cookies pero pueden almacenar cantidades mayores de datos, incluso en su dispositivo fuera de su navegador, en relación con aplicaciones específicas.
                                    Balizas web, también conocidas como etiquetas de píxeles o GIF transparentes, que se utilizan para demostrar que se accedió u abrió una página web o correo electrónico, o que se visualizó o hizo clic en cierto contenido.
                                    Información personal que recopilamos de fuentes de acceso público: Podemos recopilar información de identificación sobre usted de redes blockchain de acceso público, como la cadena de bloques de Ethereum.
                                    2. Uso de la información personal
                                    Utilizamos tu información personal para los siguientes fines:
                                    Prestación del servicio, incluyendo:
                                    - Proporcionar, operar, mantener y asegurar el Servicio.
                                    - Crear, mantener y autenticar tu cuenta.
                                    - Procesar transacciones.
                                    Comunicación contigo, incluyendo para:
                                    - Enviarte actualizaciones sobre asuntos administrativos, como cambios en nuestros términos o políticas.
                                    - Brindar soporte al usuario y responder a tus solicitudes, preguntas y comentarios.
                                    Mejora del servicio, incluyendo para:
                                    - Mejorar el Servicio y crear nuevas características.
                                    - Personalizar tu experiencia.
                                    - Crear y derivar información desidentificada y agregada.
                                    Marketing y publicidad, incluyendo para:
                                    - Marketing directo: Enviarte comunicaciones de marketing, incluyendo notificaciones sobre promociones especiales, ofertas y eventos por correo electrónico y otros medios.
                                    Cumplimiento y protección, incluyendo para:
                                    - Cumplir con las leyes aplicables, solicitudes legales y procesos legales, como responder a citaciones o solicitudes de autoridades gubernamentales.
                                    - Proteger nuestros derechos, tu derechos o los derechos de terceros, la privacidad, seguridad o propiedad (incluyendo hacer y defender reclamaciones legales).
                                    - Auditar nuestro cumplimiento de requisitos legales y contractuales y políticas internas.
                                    - Prevenir, identificar, investigar y disuadir actividades fraudulentas, dañinas, no autorizadas, no éticas o ilegales, incluyendo ataques cibernéticos y robo de identidad.
                                    3. Compartir información personal
                                    Nuestro compartimiento: Podemos compartir información personal con:
                                    Proveedores de servicios, incluyendo servicios de alojamiento, servicios de correo electrónico, servicios de publicidad y marketing, procesadores de pagos, servicios de atención al cliente y servicios de análisis.
                                    Asesores profesionales, como abogados y contadores, cuando sea necesario para facilitar los servicios que nos prestan.
                                    Destinatarios de transacciones comerciales, como contrapartes y otros que ayudan en una fusión, adquisición, financiamiento, reorganización, quiebra, liquidación, venta de activos o transacción similar, y con sucesores o afiliados como parte de esa transacción o después de la misma.
                                    Autoridades gubernamentales, cuando se requiera para los fines de cumplimiento y protección descritos anteriormente.
                                    Afiliados: Podemos compartir información personal con nuestros afiliados actuales y futuros, lo que significa una entidad que controla, es controlada por, o está bajo el control común con Foundation. Nuestros afiliados pueden utilizar la información personal que compartimos de manera coherente con esta Política de privacidad.
                                    Denunciantes: Si eres un creador, podemos, a nuestra entera discreción, compartir tu información personal con personas que afirmen que tu Obra de arte digital o contenido de arte puede infringir sus derechos de propiedad intelectual y otros derechos de propiedad.
                                    Tu compartimiento: Tus transacciones a través del Servicio se registrarán en la cadena de bloques y se asociarán con tu identificación de billetera.
                                    4. Niños
                                    Nuestro Servicio no está dirigido a niños menores de 16 años. Foundation no recopila intencionalmente información personal de niños menores de 16 años. Si nos enteramos de que hemos recopilado información personal de un niño menor de 16 años sin el consentimiento del padre o tutor del niño según lo requerido por la ley, eliminaremos esa información.
                                    5. Enlaces a otros sitios web
                                    El Servicio puede contener enlaces a otros sitios web no operados o controlados por Foundation, incluyendo servicios de redes sociales ("Sitios de terceros"). La información que compartas con los Sitios de terceros estará sujeta a las políticas de privacidad y los términos de servicio específicos de los Sitios de terceros y no a esta Política de privacidad. Al proporcionar estos enlaces, no implicamos que respaldemos o hayamos revisado estos sitios. Por favor, ponte en contacto directamente con los Sitios de terceros para obtener información sobre sus prácticas y políticas de privacidad.
                                    6. Seguridad
                                    Empleamos una serie de salvaguardias técnicas, organizativas y físicas diseñadas para proteger la información personal que recopilamos. Sin embargo, ninguna medida de seguridad es infalible y no podemos garantizar la seguridad de tu información personal, por lo que utilizas el Servicio bajo tu propio riesgo.
                                    7. Tus opciones
                                    Actualización o corrección de la información personal: Puedes ponerte en contacto con nosotros y solicitar cualquier actualización o corrección necesaria para mantener tu información personal precisa, actualizada y completa.
                                    Cancelar la suscripción a comunicaciones de marketing: Puedes cancelar la suscripción a las comunicaciones de marketing siguiendo las instrucciones de cancelación de suscripción en cualquier correo electrónico de marketing que te enviemos. Sin embargo, ten en cuenta que es posible que sigas recibiendo comunicaciones según se describe en la sección "Comunicación contigo" después de cancelar la suscripción a las comunicaciones de marketing.
                                    8. Cambios en la Política de privacidad
                                    El Servicio y nuestro negocio pueden cambiar de vez en cuando. Como resultado, podemos cambiar esta Política de privacidad en cualquier momento. Cuando lo hagamos, publicaremos una versión actualizada en esta página, a menos que la ley aplicable requiera otro tipo de aviso. Al continuar utilizando nuestro Servicio o proporcionarnos información personal después de que hayamos publicado una Política de privacidad actualizada o te hayamos notificado de otra manera si corresponde, aceptas la Política de privacidad revisada y las prácticas descritas en ella.
                                </a></li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
        let pass = document.getElementById("pass");
        let comment = document.getElementById("comment");
        let c1 = document.getElementById("c1");
        let c2 = document.getElementById("c2");
        let c3 = document.getElementById("c3");
        let popupBackground = document.getElementById("popupArea");
        let cerrarPopup = document.getElementById("cerrarPopup");
        let formularioRegistro = document.getElementById("formularioRegistro");
        let btnRegistro = document.getElementById("botonRegistro");
        

        // const eventoClic = new MouseEvent('click', {
        //     bubbles: true, 
        //     cancelable: true, 
        //     view: window 
        // });
        pass.addEventListener("input", function(){
            let pass = this.value;

            if (pass.length === 0){
                comment.textContent = ""
                comment.style.display = "hidden"
            } else if (pass.length === 1){
                comment.textContent = "The chosen password is not safe";
            } else if (pass.length === 7){
                comment.textContent = "The chosen password is still not safe";
            } else if (pass.length >= 13){
                comment.textContent = "The chosen password is safe";
            }
            c1.style.backgroundColor = pass.length > 0 ? "rgb(200, 0, 0, 1)" : "rgba(0, 0, 0, 0.062)";
            c2.style.backgroundColor = pass.length < 7 ? "rgba(0, 0, 0, 0.062)" : "rgba(255, 199, 0, 1)";
            c3.style.backgroundColor = pass.length < 13 ? "rgba(0, 0, 0, 0.062)" : "green";
        });


        cerrarPopup.addEventListener('click', function() {
            vaciarCampos();
        });

        function vaciarCampos(){
            var campos = formularioRegistro.getElementsByTagName('input');

            c1.style.backgroundColor = "rgba(0, 0, 0, 0.062)";
            c2.style.backgroundColor = "rgba(0, 0, 0, 0.062)";
            c3.style.backgroundColor = "rgba(0, 0, 0, 0.062)";

            for (var i = 0; i < campos.length; i++) {
                campos[i].value = '';
                btnRegistro.value = 'Guardar';
            }
        }

       
        // popupBackground.addEventListener("click", function(){
        //     console.log("HOla");
        //     cerrarPopup.click();
        // });

    
    </script>

</body>
</html>
