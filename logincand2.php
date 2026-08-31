<?php
session_start();

include_once(__DIR__ . "/conexao.php");

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    die("E-mail e senha são obrigatórios.");
}


// ========================================
// BUSCA O CANDIDATO PELO E-MAIL
// ========================================

$sql = "SELECT * FROM candidatos WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro ao preparar consulta: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);


// ========================================
// VERIFICA SE O E-MAIL EXISTE
// ========================================

if (mysqli_num_rows($resultado) > 0) {

    $dados = mysqli_fetch_assoc($resultado);


    // ========================================
    // VERIFICA A SENHA
    // ========================================

    if (password_verify($senha, $dados['senha'])) {

        // Login realizado com sucesso

        $_SESSION['candidato'] = $dados['nome'];
        $_SESSION['email'] = $dados['email'];
        $_SESSION['id_candidato'] = $dados['id_candidato'];

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dados do Usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-8">

            <div class="text-center mb-4">

                <div class="display-4 mb-2">👤</div>

                <h1 class="fw-bold text-primary">
                    DADOS DO USUÁRIO
                </h1>

                <p class="text-muted">
                    Informações cadastradas no sistema
                </p>

            </div>


            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-4 p-md-5">

                    <div class="row g-3">


                        <!-- ================================= -->
                        <!-- INFORMAÇÕES PESSOAIS -->
                        <!-- ================================= -->

                        <div class="col-12">

                            <div class="bg-primary text-white rounded-3 p-3">

                                <h5 class="mb-0">
                                    Informações pessoais
                                </h5>

                            </div>

                        </div>


                        <div class="col-12 col-md-6">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    Nome
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['nome']; ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-6">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    Data de nascimento
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['dt_nasc']; ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    E-mail
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['email']; ?>
                                </div>

                            </div>

                        </div>

                        <div class="col-12">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    Telefone
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['telefone']; ?>
                                </div>

                            </div>

                        </div>
                           


                        <!-- ================================= -->
                        <!-- ENDEREÇO -->
                        <!-- ================================= -->

                        <div class="col-12 mt-4">

                            <div class="bg-primary text-white rounded-3 p-3">

                                <h5 class="mb-0">
                                    Endereço
                                </h5>

                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    CEP
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['cep']; ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-8">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    Logradouro
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['logradouro']; ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-6">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    Bairro
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['bairro']; ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    Cidade
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['cidade']; ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-2">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    Estado
                                </small>

                                <div class="fw-semibold">
                                    <?php echo $dados['estado']; ?>
                                </div>

                            </div>

                        </div>


                        <!-- ================================= -->
                        <!-- TRABALHOS -->
                        <!-- ================================= -->

                        <div class="col-12 mt-4">

                            <div class="bg-primary text-white rounded-3 p-3">

                                <h5 class="mb-0">
                                    Trabalhos e currículo
                                </h5>

                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="card border-0 bg-light text-center h-100">

                                <div class="card-body">

                                    <div class="fs-2 mb-2">
                                        📄
                                    </div>

                                    <h6 class="fw-bold">
                                        Trabalho 1
                                    </h6>

                                    <a href="<?php echo $dados['trabalho1']; ?>"
                                       download
                                       class="btn btn-outline-primary btn-sm">

                                        Baixar arquivo

                                    </a>

                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="card border-0 bg-light text-center h-100">

                                <div class="card-body">

                                    <div class="fs-2 mb-2">
                                        📄
                                    </div>

                                    <h6 class="fw-bold">
                                        Trabalho 2
                                    </h6>

                                    <a href="<?php echo $dados['trabalho2']; ?>"
                                       download
                                       class="btn btn-outline-primary btn-sm">

                                        Baixar arquivo

                                    </a>

                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-md-4">

                            <div class="card border-0 bg-light text-center h-100">

                                <div class="card-body">

                                    <div class="fs-2 mb-2">
                                        📑
                                    </div>

                                    <h6 class="fw-bold">
                                        Currículo
                                    </h6>

                                    <a href="<?php echo $dados['curriculo']; ?>"
                                       download
                                       class="btn btn-outline-success btn-sm">

                                        Baixar arquivo

                                    </a>

                                </div>

                            </div>

                        </div>


                        <!-- ================================= -->
                        <!-- LINKEDIN -->
                        <!-- ================================= -->

                        <div class="col-12 mt-4">

                            <div class="bg-primary text-white rounded-3 p-3">

                                <h5 class="mb-0">
                                    Perfil profissional
                                </h5>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="border rounded-3 p-3 bg-white">

                                <small class="text-muted">
                                    LinkedIn
                                </small>

                                <div class="mt-1">

                                    <?php if (!empty($dados['linkedin'])) { ?>

                                        <a href="<?php echo $dados['linkedin']; ?>"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm">

                                            🔗 Acessar LinkedIn

                                        </a>

                                    <?php } else { ?>

                                        <span class="text-muted">
                                            LinkedIn não informado
                                        </span>

                                    <?php } ?>

                                </div>

                            </div>

                        </div>

                    </div>
<br>
                                        <center>
                    <a href="alt_cand.php"
                    class="btn btn-primary btn-lg px-5 rounded-3">
                     ATUALIZAR DADOS
                    </a>
                                        </center>
                    <div class="text-center mt-5">

                        <a href="index.html"
                           class="btn btn-secondary btn-lg px-5 rounded-3">

                            ← VOLTAR

                        </a>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>


<?php

    } else {

        // ========================================
        // SENHA ERRADA
        // ========================================

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Erro de Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg border-0 rounded-4 text-center"
         style="max-width: 450px; width: 100%;">

        <div class="card-body p-5">

            <div class="display-3 mb-3">
                ❌
            </div>

            <h2 class="fw-bold text-danger mb-3">
                Senha incorreta!
            </h2>

            <p class="text-muted mb-4">
                A senha informada não corresponde ao cadastro.
            </p>

            <a href="cand.html"
               class="btn btn-primary btn-lg rounded-3">

                ← Tentar novamente

            </a>

        </div>

    </div>

</div>

</body>

</html>

<?php

    }

} else {

    // ========================================
    // E-MAIL NÃO ENCONTRADO
    // ========================================

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Erro de Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg border-0 rounded-4 text-center"
         style="max-width: 450px; width: 100%;">

        <div class="card-body p-5">

            <div class="display-3 mb-3">
                ❌
            </div>

            <h2 class="fw-bold text-danger mb-3">
                E-mail ou senha incorretos!
            </h2>

            <p class="text-muted mb-4">
                Verifique seus dados e tente novamente.
            </p>

            <a href="cand.html"
               class="btn btn-primary btn-lg rounded-3">

                ← Tentar novamente

            </a>

        </div>

    </div>

</div>

</body>

</html>

<?php

}

mysqli_stmt_close($stmt);

?>