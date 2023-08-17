<?php
require_once "Tools/PDO.php";
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153495598-1"></script>
<script data-ad-client="ca-pub-5621850021649474" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153495598-1');
</script>

  <meta charset="UTF-8">
  <title>ArengApp | Las mejores arengas para la lucha en las calles</title>
  <meta name="description" content="Escucha las mejores arengas y contenido para las marchas de todo tipo en épocas de crisis e inconformidad.">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"><link rel="stylesheet" href="./style.css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
  crossorigin="anonymous"></script>

</head>
<body>

<audio id="reproductor" style="display: none;" src="" controls>  
  Tu navegador no soporta el elemento <code>audio</code>.  
</audio>
 
<script type="text/javascript">
  var arengas = ["labatuta","duquechao","apararparaavanzar","noqueremosprivatizacion","soyestudiante","takitaki","vivalau","duquerarara"];
  $( document ).ready(function() {
    
    aleatorio = Math.floor(Math.random()*(arengas.length));
  seleccion = arengas[aleatorio];
    play(seleccion);

    TweenMax.to(".dim", 0.5, {opacity: 1, display: 'block', ease: Power2.easeInOut});
  TweenMax.fromTo("#player", 0.5, {xPercent: 100}, 
                  {xPercent: 0, display: 'block', ease: Expo.easeOut});
  TweenMax.to(".mini-player", 0.5, {x: 50, ease: Expo.easeOut});
});
  
  function play(song)
  {
    var sound = false;
    
    //var v = document.getElementById("duquechao");
    /*
    for (var i = 0; i <= arengas.length; i++) {
      var v = document.getElementById(arengas[i]);
      v.pause();
    }*/

    var v = document.getElementById("reproductor");
    v.pause();
    v.src="Songs/"+song+".mp3";
  if (!sound) {
    v.play();
    
    sound = true;
  } else {
    v.pause();
    
    sound = false;
  }

  }
  function pause()
  {
    var v = document.getElementById("reproductor");
    v.pause();
  }
</script>
<!-- partial:index.partial.html -->
<div class="wrapper">
  <!-- Wave bg-->
  <div class="wave-container">
    <div class="wave -one"></div>
    <div class="wave -two"></div>
    <div class="wave -three"></div>
  </div>
  <div class="line"></div>
  <div class="text-wrap">
    <br><br>
    <br><br>
    <p>POLÍTICA DE PRIVACIDAD
 
El presente Política de Privacidad establece los términos en que ArengApp usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.
Información que es recogida
Nuestro sitio web podrá recoger información personal por ejemplo: Nombre,  información de contacto como  su dirección de correo electrónica e información demográfica. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.
Uso de la información recogida
Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios.  Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.
ArengApp está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.
Cookies
Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.
Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente, visitas a una web . Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.
Enlaces a Terceros
Este sitio web pudiera contener en laces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.
Control de su información personal
En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web.  Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico.  En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.
Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.
ArengApp Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.</p>
  </div>
  <div class="header">
    <div class="burger-wrapper">
      <div class="burger"></div>
    </div>
    <div class="logo-text">Info</div>
    <div class="back_btn">
      <div class="circle"></div>
      <div class="text">Atrás</div>
    </div>
  </div>
  <div class="nav">
    <ul class="nav_main">
      <!--<li> <a class="nav_link">Home </a></li>
      <li> <a class="nav_link">Listeners</a></li>
      <li> <a class="nav_link">Compilations</a></li>
      <li> <a class="nav_link">LP. Mix</a></li>-->
      <li>Una persona tiene derecho a protestar y el Estado debe protegerle la vida, sea cual fuere la naturaleza de la protesta, merecemos un país mejor.</li>

    </ul>
    <div class="nav_divider"></div>
    <ul class="nav_sub">
      <li><a class="nav_link"  href="privacidad.php">Politicas de privacidad</a></li>
      <li><a class="nav_link" target="_BLANK" href="https://wa.me/573185563342">Msj</a></li>
      <li><a class="nav_link" target="_BLANK" href="https://www.facebook.com/KevinAndrey96">Contacto</a></li>
      <li><a class="nav_link" target="_BLANK" href="https://instanceshape.com">Software, Desarrollo y Hosting</a></li>
      <li><center><a target="_BLANK" href="https://www.instagram.com/kevinandrey96/"><i class="fa fa-instagram"></i></a> <a target="_BLANK" href="https://www.facebook.com/KevinAndrey96"><i class="fa fa-facebook"></i></a></center></li>
    </ul>
  </div>
  <div class="mini-player">
    <?php
        $Q="SELECT * from Songs where Category='Nacional' || Category='Estudiantes' order by RAND()";
        foreach ($db->query($Q) as $Row) {
          $Category=$Row["Category"];
          $Route=$Row["Route"];
          ?>
          <div class="track_info_wrapper">
            <div class="track_info">

              <div class="thumb" style="background-image: url('Covers/<?=$Category?>.png');"></div>
              <div class="info">
                <div class="title"><?=$Row["Name"]?></div>
                <div class="artist"><?=$Row["Category"]?></div>
              </div>
            </div>
          </div>
          <div class="mini-player_btn_wrapper"><i class="btn-prev fa fa-step-backward" aria-hidden="true"></i>
            <div class="btn-switch"><div onclick="play('<?=$Route?>')"><i class="btn-play fa fa-play" id="boton" aria-hidden="true"></i></div><div  onclick="pause()"><i class="btn-pause fa fa-pause" aria-hidden="true"></i></div></div><i class="btn-next fa fa-step-forward" aria-hidden="true"></i><i class="btn-open-player fa fa-list" aria-hidden="true"></i>
          </div>
          <?php
          break;
        }
    ?>
    



  </div>
  <div class="dim"></div>
  <div class="player" id="player">
    <div class="playback_wrapper">
      
      <?php
        $Q="SELECT * from Songs where Category='Nacional' || Category='Estudiantes' order by RAND()";
        foreach ($db->query($Q) as $Row) {
          $Category=$Row["Category"];
          $Route=$Row["Route"];
          ?>
          <div class="playback_blur"></div>
          <div class="playback_thumb" style="background-image: url('Covers/<?=$Category?>.png');"></div>
          <div class="playback_info">
            <div class="title"><?=$Row["Name"]?></div>
            <div class="artist"><?=$Category?></div>
          </div>
          
          <div class="playback_btn_wrapper"><i class="btn-prev fa fa-step-backward" aria-hidden="true"></i>
            <div class="btn-switch"><div onclick="play('<?=$Route?>')"><i class="btn-play fa fa-play" aria-hidden="true"></i></div><div onclick="pause()"><i class="btn-pause fa fa-pause" aria-hidden="true"></i></div></div><i class="btn-next fa fa-step-forward" aria-hidden="true"></i>
          </div>
          <?php
          break;
        }
      ?>
      
      <div class="playback_timeline">
        <div class="playback_timeline_start-time">00:31</div>
        <div class="playback_timeline_slider">
          <div class="slider_base"></div>
          <div class="slider_progress"></div>
          <div class="slider_handle"></div>
        </div>
        <div class="playback_timeline_end-time">03:11</div>
      </div>
    </div>
    <div class="list_wrapper">
      <ul class="list"> 
        <?php
        $Q="SELECT * from Songs where Category!='Feministas' order by Category";
        foreach ($db->query($Q) as $Row) {
          $Route=$Row["Route"];
          $Category=$Row["Category"];
          ?>
          <li class="list_item"> 
            <div  onclick="play('<?=$Route?>')" style="background-image: url('Covers/<?=$Category?>.png')" class="thumb"> </div>
            <div  onclick="play('<?=$Route?>')" class="info"> 
              <div class="title"><?=$Row["Name"]?></div>
              <div class="artist"><?=$Row["Category"]?></div>
            </div>
          </li>
          <?php
        }
        ?>
        <?php
        $Q="SELECT * from Songs where Category='Feministas' ";
        foreach ($db->query($Q) as $Row) {
          $Route=$Row["Route"];
          $Category=$Row["Category"];
          ?>
          <li class="list_item"> 
            <div  onclick="play('<?=$Route?>')" style="background-image: url('Covers/<?=$Category?>.png')" class="thumb"> </div>
            <div  onclick="play('<?=$Route?>')" class="info"> 
              <div class="title"><?=$Row["Name"]?></div>
              <div class="artist"><?=$Row["Category"]?></div>
            </div>
          </li>
          <?php
        }
        ?>
        <!--<li class="list_item selected"> 
          <div  onclick="play('duquechao')" class="thumb"> </div>
          <div  onclick="play('duquechao')" class="info"> 
            <div class="title">Duque Chao!</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>
        <li class="list_item selected"> 
          <div  onclick="play('soyestudiante')" class="thumb"> </div>
          <div  onclick="play('soyestudiante')" class="info"> 
            <div class="title">Soy estudiante</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>
        <li class="list_item"> 
          <div  onclick="play('apararparaavanzar')" class="thumb"> </div>
          <div  onclick="play('apararparaavanzar')" class="info"> 
            <div class="title">A parar para avanzar</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>
        <li class="list_item"> 
          <div  onclick="play('noqueremosprivatizacion')" class="thumb"> </div>
          <div  onclick="play('noqueremosprivatizacion')" class="info"> 
            <div class="title">No queremos privatización</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>
        <li class="list_item"> 
          <div  onclick="play('vivalau')" class="thumb"> </div>
          <div  onclick="play('vivalau')" class="info"> 
            <div class="title">Viva la U</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>-->
        <!--<li class="list_item"> 
          <div  onclick="play('labatuta')" class="thumb"> </div>
          <div  onclick="play('labatuta')" class="info"> 
            <div class="title">La Batuta</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>
        <li class="list_item"> 
          <div  onclick="play('takitaki')" class="thumb"> </div>
          <div  onclick="play('takitaki')" class="info"> 
            <div class="title">Taki Taki</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>-->
        <!--<li class="list_item"> 
          <div  onclick="play('takitaki')" class class="thumb"> </div>
          <div  onclick="play('takitaki')" class class="info"> 
            <div class="title">Taki Taki</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>--><!--
        <li class="list_item"> 
          <div  onclick="play('')" class class="thumb"> </div>
          <div  onclick="play('')" class class="info"> 
            <div="title">Friday Comes</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>
        <li class="list_item"> 
          <div  onclick="play('')" class class="thumb"> </div>
          <div  onclick="play('')" class class="info"> 
            <div="title">Friday Comes</div>
            <div class="artist">El pueblo</div>
          </div>
        </li>-->
      </ul>
    </div>
  </div>
  <div class="page" id="curator">
    <div class="curator_title_wrapper"><span>♪♫</span>
      <div class="curator_line"></div>
      <div class="curator_title">Viva el paro nacional !!</div>
      <div class="curator_line"></div><span>♫♪</span>
    </div>
    <div style="display: none;" class="curator_list">
      <div style="display: none;"  class="curator_list_content">
        <div class="connect_btn_wrapper item">
          <div class="connect_btn">
            <div class="connect_btn_text">Connect <br/>SoundCloud</div>
          </div>
        </div>
        <div class="curator_list_content_desc">Or Select <br/>a Listener of <br/>L.P.     </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
  <center>Desarrollado por Kevin Andrey Herrera Silva 2019 - Todos los derechoos reservados</center>
</footer>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TimelineMax.min.js'></script><script  src="./script.js"></script>

</body>
</html>