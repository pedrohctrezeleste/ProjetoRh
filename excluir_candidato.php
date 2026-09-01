<?php

session_start();
include_once("conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VisionUp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg border-0 rounded-4 text-center"
         style="max-width: 500px; width: 100%;">

        <div class="card-body p-5">

<?php

$cod = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($cod)) {

    echo "
        <div class='display-3 mb-3'>❌</div>

        <h2 class='text-danger fw-bold'>
            Candidato não informado
        </h2>

        <p class='text-muted'>
            Não foi possível identificar o candidato.
        </p>

        <a href='cons_cand.php'
           class='btn btn-secondary'>
            ← Voltar
        </a>
    ";

} else {

    $result_cand = "DELETE FROM candidatos WHERE id_candidato = ?";

    $stmt = mysqli_prepare($conn, $result_cand);

    mysqli_stmt_bind_param($stmt, "i", $cod);

    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {

        echo "
            <div class='display-3 mb-3'>✅</div>

            <h2 class='text-success fw-bold'>
                EXCLUÍDO COM SUCESSO!
            </h2>

            <p class='text-muted'>
                O candidato foi removido do sistema.
            </p>

            <a href='cons_cand.php'
               class='btn btn-primary'>
                ← Voltar para candidatos
            </a>
        ";

    } else {

        echo "
            <div class='display-3 mb-3'>❌</div>

            <h2 class='text-danger fw-bold'>
                NÃO EXCLUÍDO
            </h2>

            <p class='text-muted'>
                O candidato não foi encontrado ou já foi excluído.
            </p>

            <a href='cons_cand.php'
               class='btn btn-secondary'>
                ← Voltar
            </a>
        ";
    }

    mysqli_stmt_close($stmt);
}

?>

        </div>

    </div>

</div>

</body>
</html>