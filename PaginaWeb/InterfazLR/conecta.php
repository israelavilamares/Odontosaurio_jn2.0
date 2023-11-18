<?php
    // ubicacion del archivo:
    // ./funciones/conecta.php
    $host = 'localhost';
   // define("HOST",'localhost');
    //define("BD",'odontosaurio');
    $BD = 'odontosaurio';
    $USER_BD = 'root';
    $PASS_BD = '';
    //define("USER_BD",'root');
    //define("PASS_BD",'');

   //function conecta(){
        $con = new mysqli($host, $USER_BD, $PASS_BD, $BD);


       
   // mysqli_close($con); 

    // return $con;
    //}







    /*        if(conecta()){
            echo "conectado";
        }else{
            echo "no conctado";
        }
*/
  
    
   //esto se pone siempre que se quiera acceder a la BD (Visualizar datos, mandar datos,todo)
   //despues del require, entre parentesis, se pone la ruta del archivo en el proyecto y es indispensable poner debajo el $con=  conecta();
   //require "conecta.php";
   //$con = conecta();
?>


