<?php 


function verifAdmin($vfNombreAdm)
{
            require "conecta.php";
           //hacemos unna consulta a la base de datos de adminstrador 
           //que busca los nmbres
            $queryadm = "SELECT * FROM administrador where nombre= ?";
            //para evitar ataques
            $stmt2 = $con->prepare($queryadm);
            $stmt2->bind_param("s", $vfNombreAdm);
            $stmt2->execute();
            $result = $stmt2->get_result();
            //devolver los resultados
            return $result;
}

function verifPaciente($vfNomPac)
{
    //conxion DB
    require "conecta.php";
    //verificar la curp
    $query = "SELECT * FROM paciente where curp_usuario	= ?";
    $query = $con->prepare($query);
    $query->bind_param("s", $vfNomPac);
    $query->execute();
    $resul = $query->get_result();

    return $resul;
}

function verifDoctor($vfNomDoc)
{
    //conxion DB
    require "conecta.php";
    //verificar la curp
    $query = "SELECT * FROM doctor where nombre	= ?";
    $query = $con->prepare($query);
    $query->bind_param("s", $vfNomDoc);
    $query->execute();
    $resul = $query->get_result();

    return $resul;
}

?>