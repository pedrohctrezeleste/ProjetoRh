<?php
session_start();
include_once(__DIR__ . "/conexao.php");

if (!isset($_SESSION['id_candidato'])) {
    die("Usuário não está logado.");
}

$id_candidato = $_SESSION['id_candidato'];

$sql = "SELECT * FROM candidatos WHERE id_candidato = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro ao preparar consulta: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id_candidato);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 0) {
    die("Candidato não encontrado.");
}

$dados = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Atualizar Dados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h2>Atualizar Dados do Candidato</h2>
                </div>

                <div class="card-body">
                    
                    <form action="salvar_cand.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Nome</label>

                            <input type="text"
                                   name="nome"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['nome']); ?>"
                                   required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Data de nascimento</label>

                            <input type="date"
                                   name="dt_nasc"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['dt_nasc']); ?>"
                                   required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">E-mail</label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['email']); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefone</label>

                            <input type="tel"
                                   name="telefone"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['telefone']); ?>"
                                   required>
                        </div>


                        <hr>

                        <h5 class="text-primary">Endereço</h5>


                        <div class="mb-3">
                            <label class="form-label">CEP</label>

                            <input type="text"
                                   name="cep"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['cep']); ?>">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Logradouro</label>

                            <input type="text"
                                   name="logradouro"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['logradouro']); ?>">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Bairro</label>

                            <input type="text"
                                   name="bairro"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['bairro']); ?>">
                        </div>


                        <div class="row">

                            <div class="col-md-8 mb-3">

                                <label class="form-label">Cidade</label>

                                <input type="text"
                                       name="cidade"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($dados['cidade']); ?>">

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">Estado</label>

                                <input type="text"
                                       name="estado"
                                       class="form-control"
                                       value="<?php echo htmlspecialchars($dados['estado']); ?>">

                            </div>

                        </div>


                        <hr>

                        <h5 class="text-primary">Perfil profissional</h5>


                        <div class="mb-3">

                            <label class="form-label">LinkedIn</label>

                            <input type="url"
                                   name="linkedin"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($dados['linkedin']); ?>">

                        </div>


                        <div class="d-flex justify-content-between mt-4">

                            <a href="index.html"
                               class="btn btn-secondary">
                                Voltar
                            </a>

                            <button type="submit"
                                    class="btn btn-success">
                                Salvar alterações
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>