<?php
session_start();
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<link rel="stylesheet" href="../style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<title>Cadastro de Candidato</title>


</head>

<body class="bg-light">

<?php

if(isset($_SESSION['msg'])){
 echo $_SESSION['msg'];
 unset($_SESSION['msg']);

}

?>

<div class="container py-5">


<div class="row justify-content-center">

    <div class="col-12 col-lg-9 col-xl-8">

        <div class="text-center mb-4">

            <div class="display-4 mb-2">👤</div>

            <h1 class="fw-bold text-primary">
                CADASTRO DE CANDIDATOS
            </h1>

            <p class="text-muted">
                Preencha seus dados para realizar o cadastro
            </p>

        </div>

        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-body p-4 p-md-5">

                <div class="mb-4">

                    <h4 class="fw-bold text-dark">
                        Dados pessoais
                    </h4>

                    <hr>

                </div>

                <div class="formCont">

                    <div id="formcad">

                        <form class="row g-3" method="POST" action="cli_cad_pro.php" enctype="multipart/form-data">

                            <div class="col-12">

                                <label for="nome" class="form-label fw-semibold">
                                    NOME
                                </label>

                                <input
                                    type="text"
                                    id="nome"
                                    name="nome"
                                    class="form-control form-control-lg"
                                    placeholder="Digite seu nome"
                                    required>

                            </div>

                            <div class="col-12 col-md-6">

                                <label for="email" class="form-label fw-semibold">
                                    E-MAIL
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Digite seu e-mail"
                                    required>

                            </div>

                            <div class="col-12 col-md-6">

                                <label for="telefone" class="form-label fw-semibold">
                                    Telefone
                                </label>

                                <input
                                    type="tel"
                                    id="telefone"
                                    name="telefone"
                                    class="form-control"
                                    placeholder="Digite seu telefone"
                                    required>

                            </div>

                            <div class="col-12 col-md-6">

                                <label for="senha" class="form-label fw-semibold">
                                    SENHA
                                </label>

                                <input
                                    type="password"
                                    id="senha"
                                    name="senha"
                                    class="form-control"
                                    placeholder="Digite sua senha"
                                    required>

                            </div>

                            <div class="col-12 col-md-6">

                                <label for="dt_nasc" class="form-label fw-semibold">
                                    DATA DE NASCIMENTO
                                </label>

                                <input
                                    type="date"
                                    id="dt_nasc"
                                    name="dt_nasc"
                                    class="form-control">

                            </div>

                            <div class="col-12 mt-4">

                                <fieldset id="form" class="border rounded-3 p-4">

                                    <legend class="float-none w-auto px-3 fw-bold text-primary">
                                        ENDEREÇO
                                    </legend>

                                    <div class="row g-3">

                                        <div class="col-12 col-md-4">

                                            <label for="cep" class="form-label fw-semibold">
                                                CEP
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="cep"
                                                id="cep"
                                                placeholder="00000-000">

                                        </div>

                                        <div class="col-12 col-md-8">

                                            <label for="logradouro" class="form-label fw-semibold">
                                                LOGRADOURO
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="logradouro"
                                                id="logradouro"
                                                placeholder="Rua, avenida, etc.">

                                        </div>

                                        <div class="col-12 col-md-6">

                                            <label for="bairro" class="form-label fw-semibold">
                                                BAIRRO
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="bairro"
                                                id="bairro"
                                                placeholder="Digite o bairro">

                                        </div>

                                        <div class="col-12 col-md-4">

                                            <label for="cidade" class="form-label fw-semibold">
                                                CIDADE
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="cidade"
                                                id="cidade"
                                                placeholder="Digite a cidade">

                                        </div>

                                        <div class="col-12 col-md-2">

                                            <label for="estado" class="form-label fw-semibold">
                                                ESTADO
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="estado"
                                                id="estado"
                                                placeholder="UF">

                                        </div>

                                    </div>

                                </fieldset>

                            </div>

                            <div class="col-12 mt-4">

                                <h4 class="fw-bold text-dark">
                                    Documentos e trabalhos
                                </h4>

                                <hr>

                            </div>

                            <div class="col-12">

                                <label for="trabalho1" class="form-label fw-semibold">
                                    TRABALHO 1
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="trabalho1"
                                    name="trabalho1"
                                    accept=".pdf,.doc,.docx">

                                <div class="form-text">
                                    Formatos permitidos: PDF, DOC ou DOCX.
                                </div>

                            </div>

                            <div class="col-12">

                                <label for="trabalho2" class="form-label fw-semibold">
                                    TRABALHO 2
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="trabalho2"
                                    name="trabalho2"
                                    accept=".pdf,.doc,.docx">

                                <div class="form-text">
                                    Formatos permitidos: PDF, DOC ou DOCX.
                                </div>

                            </div>

                            <div class="col-12">

                                <label for="curriculo" class="form-label fw-semibold">
                                    CURRÍCULO
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="curriculo"
                                    name="curriculo"
                                    accept=".pdf,.doc,.docx">

                                <div class="form-text">
                                    Formatos permitidos: PDF, DOC ou DOCX.
                                </div>

                            </div>

                            <div class="col-12 mt-4">

                                <label for="linkedin" class="form-label fw-semibold">
                                    LINK DO LINKEDIN
                                </label>

                                <input
                                    type="url"
                                    name="linkedin"
                                    id="linkedin"
                                    class="form-control"
                                    placeholder="https://www.linkedin.com/in/">

                            </div>

                            <div class="col-12 mt-4">

                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">

                                    <button
                                        type="submit"
                                        id="salvar"
                                        class="btn btn-primary btn-lg px-5 rounded-3">
                                        SALVAR
                                    </button>

                                    <a
                                        href="index.html"
                                        class="btn btn-outline-secondary btn-lg px-4 rounded-3">
                                        VOLTAR
                                    </a>

                                </div>

                            </div>

                            <br>

                            <script>
                              // consulta cep via: https://viacep.com.br/ws/01001000/json/
                              document.getElementById("cep").addEventListener("keyup",function(){

                            let cep = this.value.replace(/\D/g,'');
                            if(cep.length != 8){
                            return;
                            }

                            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                            .then(response => response.json())
                            .then(dados => {
                            if(dados.erro){
                            alert("cep nao encontrado");
                            document.getElementById("logradouro").value = "";
                            document.getElementById("bairro").value = "";
                            document.getElementById("cidade").value = "";
                            document.getElementById("estado").value = "";

                            return;
                            }

                            document.getElementById("logradouro").value = dados.logradouro;
                            document.getElementById("bairro").value = dados.bairro;
                            document.getElementById("cidade").value = dados.localidade;
                            document.getElementById("estado").value = dados.uf;


                            })

                            .catch(function(){
                            alert("erro ao acessar API")

                            });

                              });
                            </script>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
