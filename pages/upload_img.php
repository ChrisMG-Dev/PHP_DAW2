<?php

    if (!isset ($_POST['subir'])) {
        if ($_SESSION['historial']
                [count ($_SESSION['historial']) -1]
                != "HTTP_REFERER no disponible") {
            
            $pos = strpos($_SESSION['historial']
                    [count ($_SESSION['historial']) -1]
                , "index.php?");
            
            $redirect = substr($_SESSION['historial']
                [count ($_SESSION['historial']) -1]
                , $pos);
            
            header ("Location: " . $redirect);
        }
        
        header ("Location: index.php?page=principal");
    }
    
    $output_dir = "datos/fotos/";
    $output_file = $output_dir . basename (md5(time()) 
            . $_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo ($output_file,PATHINFO_EXTENSION);
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "El archivo es una imagen - " . $check["mime"] . ". <br />";
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.<br />";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($output_file)) {
        echo "Ya existe este archivo.<br />";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 3145728) {
        echo "El archivo es demasiado grande. Máximo 3MB.<br />";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" 
            && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Solo se permiten las extensiones JPG, JPEG, PNG y GIF.<br />";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Su archivo no se ha podido subir.<br />";
        
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
                $output_file)) {
            echo "La imagen ". basename( $_FILES["fileToUpload"]["name"])
                    . " se ha subido.<br />";
        } else {
            echo "ha habido un error subiendo la imagen, intente de nuevo"
            . " mas tarde.<br />";
        }
    }
    
    echo "<br />";
    echo "<h3>Será redireccionado dentro de unos segundos...</h3>";
    echo "<script>"
     . "setTimeout(function(){"
     .      "location.href = document.referrer; return false;"
     . "}, 5000);"
     . "</script>";

?> 
