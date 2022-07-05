
 <?php
if(isset($_REQUEST['errorEmail'])){ ?>
         <div class="alert show showAlert" style="color:#f44336;">
               <strong> ¡Ups! </strong>
               El correo no existe, por favor verifique.
        </div>
<?php }

if(isset($_REQUEST['emaiIncorrecto'])){ ?>
    <div class="alert show showAlert" style="color:#fff;">
          <strong> ¡Ups! </strong>
          Credenciales incorrectas, por favor verifique.
   </div>
<?php } 

if(isset($_REQUEST['email'])){ ?>
    <div class="alert show showAlert" style="color:#fff;">
          <strong> ¡Felicitaciones! </strong>
          Su contraseña temporal ha sido creada exitosamente, revise su correo.
   </div>
<?php } ?>