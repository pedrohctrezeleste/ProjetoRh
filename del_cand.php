<?php
session_start();
include_once("conexao.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VisionUp</title>
</head>
<body>
    
<hr><br> <br>

<?php

$cod = filter_input(INPUT_POST,'id_candidato',FILTER_SANITIZE_NUMBER_INT);
$result_cand = "DELETE FROM candidatos WHERE id_candidato = $cod";
$resultado= mysqli_query($conn,$result_cand);


if (mysqli_affected_rows($conn)){
echo" <font color='red'>EXCLUIDO COM SUCESSO</font>";
}else{
echo "NAO EXCLUIDO ";
};

?>

</body>
</html>