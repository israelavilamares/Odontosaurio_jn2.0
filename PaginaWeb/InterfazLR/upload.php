<?php
    // Define las variables de conexión
    $host = 'localhost';
    $BD = 'odontosaurio';
    $USER_BD = 'root';
    $PASS_BD = '';

    // Crea la conexión
    $con = new mysqli($host, $USER_BD, $PASS_BD, $BD);
    

    // Inicia la sesión
    session_start();

    // Recibe variables 
    $nombre = isset($_REQUEST['descripcion']) ? $_REQUEST['descripcion'] : '';
    $curp = $_SESSION['curp']; // Captura el CURP del usuario
    $archivo_n  = '';
    $archivo    = '';

    //archivo de foto
    $file_name  = $_FILES['archivo']['name'];
    if($file_name != ''){
            $file_tmp   = $_FILES['archivo']['tmp_name'];
            $cadena     = explode(".", $file_name);
            $ext        = $cadena[1];
            $dir        = "C:\\Data\\";
            $file_enc   = md5_file($file_tmp);
            //guarda foto si hay
            if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif' || $ext=='jfif'){
                $fileName1 = "$file_enc.$ext";
                copy($file_tmp, $dir.$fileName1);
                //actualiza los nombres de archivo a cargar en bd
                //$archivo_n  = $file_name;
                $archivo    = $fileName1;
            }
    }

    $sql = "INSERT INTO expediente (descripcion, archivo, curp)
            VALUES ('$nombre', '$archivo', '$curp') ";        
    $res = $con->query($sql);
    header("Location:  interfazPaciente.php");
?>