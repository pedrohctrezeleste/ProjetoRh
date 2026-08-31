<?php

session_start();

include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: cand.html");
    exit();
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {

    echo "<center>";
    echo "<h2 style='color:red;'>❌ Informe o e-mail e a senha!</h2>";
    echo "<br>";
    echo "<a href='cand.html'>Voltar</a>";
    echo "</center>";

    exit();
}

$sql = "SELECT id_candidato, email, senha
        FROM candidatos
        WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro na consulta: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 1) {

    $candidato = mysqli_fetch_assoc($resultado);

    if (password_verify($senha, $candidato['senha'])) {

        $_SESSION['email'] = $candidato['email'];
        $_SESSION['id_candidato'] = $candidato['id_candidato'];

        header("Location: cli_cad_pro.php");
        exit();

    } else {

        echo "<center>";
        echo "<h2 style='color:red;'>❌ E-mail ou senha incorretos!</h2>";
        echo "<br>";
        echo "<a href='cand.html'>Tentar novamente</a>";
        echo "</center>";
    }

}

?>