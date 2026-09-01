<?php
session_start();
include_once("conexao.php");
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/style.css">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<title>Candidatos</title>

</head>

<body class="bg-light">

<div class="container-fluid py-5">

<div class="text-center mb-5">

    <h1 class="fw-bold text-primary">
        Lista de Candidatos
    </h1>

    <p class="text-muted">
        Dados dos candidatos cadastrados
    </p>

</div>

<div class="card shadow-lg border-0 rounded-4">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-primary">

                    <tr>
                        
                        <th class="px-3">ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Data de Nascimento</th>
                        <th>Trabalho 1</th>
                        <th>Trabalho 2</th>
                        <th>Currículo</th>
                        <th>LinkedIn</th>
                        <th>CEP</th>
                        <th>Logradouro</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Ações</th>

                    </tr>

                </thead>

                <tbody>

<?php
$result_cand = "SELECT * FROM candidatos";

$resultado = mysqli_query($conn, $result_cand);

while($row_cand = mysqli_fetch_assoc($resultado)){
?>

                    <tr>

                        <td class="px-3 fw-semibold">
                            <?php echo $row_cand['id_candidato']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['nome']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['email']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['telefone']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['dt_nasc']; ?>
                        </td>

                        <td>
                            <a href="<?php echo $row_cand['trabalho1']; ?>"
                               download
                               class="btn btn-sm btn-outline-primary">
                                📄 Baixar
                            </a>
                        </td>

                        <td>
                            <a href="<?php echo $row_cand['trabalho2']; ?>"
                               download
                               class="btn btn-sm btn-outline-primary">
                                📄 Baixar
                            </a>
                        </td>

                        <td>
                            <a href="<?php echo $row_cand['curriculo']; ?>"
                               download
                               class="btn btn-sm btn-outline-success">
                                📑 Baixar
                            </a>
                        </td>

                        <td>
                            <?php if (!empty($row_cand['linkedin'])) { ?>

                                <a href="<?php echo $row_cand['linkedin']; ?>"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    🔗 LinkedIn
                                </a>

                            <?php } else { ?>

                                <span class="text-muted">
                                    Não informado
                                </span>

                            <?php } ?>
                        </td>

                        <td>
                            <?php echo $row_cand['cep']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['logradouro']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['bairro']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['cidade']; ?>
                        </td>

                        <td>
                            <?php echo $row_cand['estado']; ?>
                        </td>

                        <!-- BOTÃO EXCLUIR -->

                        <td>

                            <a href="excluir_candidato.php?id=<?php echo $row_cand['id_candidato']; ?>"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Tem certeza que deseja excluir este candidato?');">

                                🗑️ Excluir

                            </a>

                        </td>

                    </tr>

<?php
}
?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="text-center mt-4">

    <a href="./index.html"
       class="btn btn-outline-secondary px-4 rounded-3">
        ← Voltar
    </a>

</div>

</div>

</body>
</html>