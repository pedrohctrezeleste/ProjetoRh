<?php

session_start();
include_once("conexao.php");

// ===============================
// DADOS DO CANDIDATO
// ===============================

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$senha = $_POST['senha'] ?? '';
$dt_nasc = $_POST['dt_nasc'] ?? '';
$linkedin = $_POST['linkedin'] ?? '';



// ===============================
// VERIFICAÇÃO DOS CAMPOS
// ===============================

if (empty($nome) || empty($email) || empty($senha)) {

    $_SESSION['msg'] = "";

    header("Location: cand_cad.php");
    exit();
}


// ===============================
// VERIFICA SE O E-MAIL JÁ EXISTE
// ===============================

$sql_verifica = "SELECT id_candidato 
                 FROM candidatos 
                 WHERE email = ?";

$stmt_verifica = mysqli_prepare($conn, $sql_verifica);

mysqli_stmt_bind_param($stmt_verifica, "s", $email);

mysqli_stmt_execute($stmt_verifica);

$resultado = mysqli_stmt_get_result($stmt_verifica);

if (mysqli_num_rows($resultado) > 0) {

    $_SESSION['msg'] = "Este e-mail já está cadastrado.";

    header("Location: cand_cad.php");
    exit();
}


// ===============================
// CRIPTOGRAFA A SENHA
// ===============================

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);


// ===============================
// DADOS DO ENDEREÇO
// ===============================

$cep = $_POST['cep'] ?? '';
$logradouro = $_POST['logradouro'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$estado = $_POST['estado'] ?? '';


// ===============================
// PASTA DOS ARQUIVOS
// ===============================

$pasta = "curriculos/";

// Cria a pasta caso ela não exista
if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}


// ===============================
// TRABALHO 1
// ===============================

$caminho_trabalho1 = '';

if (isset($_FILES['trabalho1']) && $_FILES['trabalho1']['error'] == 0) {

    $nome_trabalho1 = time() . "_" . basename($_FILES['trabalho1']['name']);

    $caminho_trabalho1 = $pasta . $nome_trabalho1;

    move_uploaded_file(
        $_FILES['trabalho1']['tmp_name'],
        $caminho_trabalho1
    );
}


// ===============================
// TRABALHO 2
// ===============================

$caminho_trabalho2 = '';

if (isset($_FILES['trabalho2']) && $_FILES['trabalho2']['error'] == 0) {

    $nome_trabalho2 = time() . "_2_" . basename($_FILES['trabalho2']['name']);

    $caminho_trabalho2 = $pasta . $nome_trabalho2;

    move_uploaded_file(
        $_FILES['trabalho2']['tmp_name'],
        $caminho_trabalho2
    );
}


// ===============================
// CURRÍCULO
// ===============================

$caminho_curriculo = '';

if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0) {

    $nome_curriculo = time() . "_curriculo_" . basename($_FILES['curriculo']['name']);

    $caminho_curriculo = $pasta . $nome_curriculo;

    move_uploaded_file(
        $_FILES['curriculo']['tmp_name'],
        $caminho_curriculo
    );
}


// ===============================
// INSERE O CANDIDATO NO BANCO
// ===============================

$sql = "INSERT INTO candidatos
(
    nome,
    dt_nasc,
    trabalho1,
    trabalho2,
    curriculo,
    linkedin,
    cep,
    logradouro,
    bairro,
    cidade,
    estado,
    email,
    telefone,
    senha
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    $_SESSION['msg'] = "Erro ao preparar cadastro: " . mysqli_error($conn);

    header("Location: cand_cad.php");
    exit();
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssss",
    $nome,
    $dt_nasc,
    $caminho_trabalho1,
    $caminho_trabalho2,
    $caminho_curriculo,
    $linkedin,
    $cep,
    $logradouro,
    $bairro,
    $cidade,
    $estado,
    $email,
    $telefone,
    $senhaHash
);


// ===============================
// EXECUTA O CADASTRO
// ===============================

if (mysqli_stmt_execute($stmt)) {

    $_SESSION['msg'] = "Candidato cadastrado com sucesso!";

    header("Location: registrosalvo.html");
    exit();

} else {

    $_SESSION['msg'] = "Erro ao cadastrar candidato: " . mysqli_stmt_error($stmt);

    header("Location: cand_cad.php");
    exit();
}

?>