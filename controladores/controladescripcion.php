<?php

require_once('../modelos/descripcion.php');


class controladescripcion{

    public function listardescripcion(){
        $descripciones = new descripcion();
        return $descripciones -> listardescripcion();
    }


    public function buscardescripcion($idUsuario){
        //Crear un objeto de la clase categoria
        $descripciones = new descripcion();
        $descrip = new descripcion();
        $descrip->setidUsuario($idUsuario);
        //Buscar los datos de la categoria en la BD
        //var_dump($Categoria);
        $datosdescripcion = $descripciones->buscardescripcion($descrip);
        $descrip->setdescripcion($datosdescripcion['descripcion']);
        //var_dump($Categoria);
        return $descrip;
    }




    public function actualizardescripcion($idUsuario, $descripcion){
        
            $descripciones = new descripcion();
            $descrip = new descripcion();
            $descrip->setidUsuario($idUsuario);
            $descrip->setdescripcion($descripcion);
            //var_dump($descrip);
            $mensaje = $descripciones->actualizardescripcion($descrip);
            echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/ajustesPerfil.php';
            </script>";
        
    }

    public function eliminardescripcion($idUsuario){
        
        //Crear un objeto de la clase categoria
        $descripciones = new descripcion();
        $descrip = new descripcion();
        $descrip->setidUsuario($idUsuario);
        //var_dump($descrip);
        $mensaje = $descripciones->eliminardescripcion($descrip);
        echo "<script>
        alert('$mensaje');
        document.location.href='../vistas/ajustesPerfil.php';
        </script>";
    
    }



    public function eliminarFoto(){

        unlink("../assets/imgs/".$_SESSION['idUsuario'].".jpg");
        echo "<script>
            alert('¡Eliminacion exitosa!');
            document.location.href='../vistas/ajustesPerfil.php';
             </script>";
       

    
    }


    public function desplegarVista($pagina){
        header("Location:../".$pagina);
    }

   

}

session_start();

$rutaImagenes = "../assets/imgs/" . $_SESSION['idUsuario'] . ".jpg";
$controladescripcion = new controladescripcion();


if (isset($_POST['actualizar'])){ //Si la variable existe 
    //Recibir variables del formulario
    $idUsuario = $_POST['idUsuario'];
    $descripcion = $_POST['descripcion'];
    $controladescripcion->actualizardescripcion($idUsuario,$descripcion);


}else if(isset($_REQUEST['editarD'])){
    //Recibir variables desde el formulario
    $idUsuario = base64_encode($_REQUEST['idUsuario']);
    $idUsuario = base64_encode($idUsuario);
    //base_decode: función que encripta una variable
    //var_dump($categoria);
    $controladescripcion->desplegarVista('vistas/editardescripcion.php?idUsuario='.$idUsuario);


}else if (isset($_POST['eliminarD'])){ //Si la variable existe 
        //Recibir variables del formulario

        $idUsuario = $_SESSION['idUsuario'];
        $controladescripcion->eliminardescripcion($idUsuario);

}else if(isset($_REQUEST['editarF'])){
    //Recibir variables desde el formulario
    $idUsuario = base64_encode($_REQUEST['idUsuario']);
    $idUsuario = base64_encode($idUsuario);
    //base_decode: función que encripta una variable
    //var_dump($categoria);
    $controladescripcion->desplegarVista('vistas/registrarFoto.php?idUsuario='.$idUsuario);


}else if (isset($_POST['actualizarF'])){ 


    if(isset($_FILES['imagen'])){ //Verificar si la variale existe
        //echo $_FILES['imagen'];
        if($_FILES['imagen']['name'] != null){
            if (file_exists($rutaImagenes)){
                
                unlink($rutaImagenes);
        
                $file_name = $_SESSION['idUsuario'].'.jpg';//Determina el nombre del archivo
                $file_size = $_FILES['imagen']['size'];//Determina el tamaño del archivo.
                $file_tmp = $_FILES['imagen']['tmp_name'];//Determina el nombre temporal del archivo
                $file_type = $_FILES['imagen']['type']; //Determina el tipo del archivo
                $file_ext=strtolower($file_type);//Se convierte la extensión a minúsculas
    
                //Se almacena en un array las extensiones permitidas.
                $extensiones= array("image/jpeg","image/jpg","image/png");
                $errors=array(); //Array para los errores
    
                //Si la extensión es no permitida
                if(in_array($file_ext,$extensiones)=== false){
                    $errors[]="Extensión no permitida, por favor escoger JPEG, PNG o JPG.";
                }
    
                if($file_size > 2097152) { //Si el archivo supera los 2 MEGAS
                    $errors[]='El archivo no debe exceder de 2 MB';
                }
    
                if(empty($errors)==true) {//Si NO hay errores
                    move_uploaded_file($file_tmp,"../assets/imgs/".$file_name); //Cargar el archivo
            
                }else{
                    print_r($errors); //Imprimir errores.
                }
    
    
    
            }else{
                
                $file_name = $_SESSION['idUsuario'].'.jpg';//Determina el nombre del archivo
                $file_size = $_FILES['imagen']['size'];//Determina el tamaño del archivo.
                $file_tmp = $_FILES['imagen']['tmp_name'];//Determina el nombre temporal del archivo
                $file_type = $_FILES['imagen']['type']; //Determina el tipo del archivo
                $file_ext=strtolower($file_type);//Se convierte la extensión a minúsculas
    
                //Se almacena en un array las extensiones permitidas.
                $extensiones= array("image/jpeg","image/jpg","image/png");
                $errors=array(); //Array para los errores
    
                //Si la extensión es no permitida
                if(in_array($file_ext,$extensiones)=== false){
                    $errors[]="Extensión no permitida, por favor escoger JPEG, PNG o JPG.";
                }
    
                if($file_size > 2097152) { //Si el archivo supera los 2 MEGAS
                    $errors[]='El archivo no debe exceder de 2 MB';
                }
    
                if(empty($errors)==true) {//Si NO hay errores
                    move_uploaded_file($file_tmp,"../assets/imgs/".$file_name); //Cargar el archivo
           
                }else{
                    print_r($errors); //Imprimir errores.
                }
            }
        }
        
    }
    echo "<script>
            alert('¡Actualizacion exitosa!');
            document.location.href='../vistas/perfil.php';
        </script>";
    


}else if (isset($_POST['eliminarF'])){ //Si la variable existe 
    //Recibir variables del formulario

    
    $controladescripcion->eliminarFoto();
    


}else if(isset($_POST['mostrar'])){
    
    //Recibir variables desde el formulario
    $descripciones = new descripcion();
    $idUsuario = base64_encode($_POST['idUsuario']);
    $username = base64_encode($_POST['nombreDeUsuario']);
    $descripcion = base64_encode($_POST['descripcion']);
    $cantidad = base64_encode($_POST['cantidad']);
    //base_decode: función que encripta una variable
    //var_dump($categoria);
    $controladescripcion->desplegarVista('vistas/perfilOtros.php?idUsuario='.$idUsuario.'&username='.$username.'&descripcion='.$descripcion.'&cantidad='.$cantidad);
    //echo $idUsuario, $username, $descripcion;

}
else if(isset($_REQUEST['vistas'])){
    $controladescripcion->desplegarVista($_REQUEST['vistas']);
}



//isset: Esta establecida






?>