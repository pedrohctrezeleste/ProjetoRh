<?php
session_start();

include_once(__DIR__ . "/conexao.php");

if (!isset($_SESSION['id_candidato'])) {
    die("Usuário não está logado.");
}

$id_candidato = $_SESSION['id_candidato'];

$nome = $_POST['nome'] ?? '';
$dt_nasc = $_POST['dt_nasc'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';

$cep = $_POST['cep'] ?? '';
$logradouro = $_POST['logradouro'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$estado = $_POST['estado'] ?? '';

$linkedin = $_POST['linkedin'] ?? '';


$sql = "UPDATE candidatos SET
            nome = ?,
            dt_nasc = ?,
            email = ?,
            telefone = ?,
            cep = ?,
            logradouro = ?,
            bairro = ?,
            cidade = ?,
            estado = ?,
            linkedin = ?
        WHERE id_candidato = ?";


$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro ao preparar atualização: " . mysqli_error($conn));
}


mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssi",
    $nome,
    $dt_nasc,
    $email,
    $telefone,
    $cep,
    $logradouro,
    $bairro,
    $cidade,
    $estado,
    $linkedin,
    $id_candidato
);


if (mysqli_stmt_execute($stmt)) {

    // Atualiza também o e-mail da sessão
    $_SESSION['email'] = $email;

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport"
              content="width=device-width, initial-scale=1.0">

        <title>Dados atualizados</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
              rel="stylesheet">

    </head>

    <body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-body text-center p-5">

                        <div class="display-3 mb-3">
                            ✅
                        </div>

                        <h2 class="text-success">
                            Dados atualizados!
                        </h2>

                        <p class="text-muted">
                            Seus dados foram atualizados com sucesso.
                        </p>

                        <a href="index.html"
                           class="btn btn-primary">
                            Voltar aos meus dados
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    </body>
    </html>

    <?php

} else {

    echo "Erro ao atualizar os dados: "
         . mysqli_stmt_error($stmt);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>