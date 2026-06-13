<?php
require_once __DIR__ . '/../../Middlewares/AuthMiddleware.php';
AuthMiddleware::check();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/ProjetoFinal/public/css/main.css">
    <link rel="stylesheet" href="http://localhost/ProjetoFinal/public/css/admin.css">
    <title>Dashboard: <?php echo $_SESSION['usuario_escola']['matr']; ?></title>
</head>

<body class="dashboard-admin">
    <?php require_once __DIR__ . '/../templates/header.php' ?>

    <main class="director-main">
        <h1 class="">Seja bem vindo <?php echo $_SESSION['usuario_escola']['matr']; ?> <button class="logout-button">Logout</button></h1>
        <section class="info-tables">
            <div class="card">
                <div class="card-container">
                    <h4><b>Meu desempenho</b></h4>
                </div>
                <a href="#desempenho" class="manage-button">Gerenciar</a>
            </div>
            <div class="card">
                <div class="card-container">
                    <h4><b>Comunicados</b></h4>
                </div>
                <a href="#comunicados" class="manage-button">Verificar</a>
            </div>
            <div class="card">
                <div class="card-container">
                    <h4><b>Materias disponíveis</b></h4>
                </div>
                <a href="#materias" class="manage-button">Gerenciar</a>
            </div>

        </section>
        <section class="p-active" id="comunicado">
            <h1>Meu Perfil</h1>
            <?php require_once __DIR__ . '/../templates/profile/student.php' ?>
        </section>

        <section class="p-separator">
            <h1>Painel de comunicados</h1>
        </section>

        <section class="settings-form">
            <div class="card-comunicado">
                <div class="comunicado-header">
                    <span class="comunicado-autor">Por: João Silva</span>
                    <span class="comunicado-data">13 Jun 2026</span>
                </div>

                <h3 class="comunicado-titulo">Atualização do Sistema de Matrículas</h3>

                <div class="comunicado-conteudo">
                    <p>
                        O novo módulo de matrículas já está ativo. Todos os administradores devem atualizar suas credenciais de acesso até o fim do dia. Caso encontre instabilidades no preenchimento dos campos, reporte imediatamente ao setor de TI.
                    </p>
                </div>

                <div class="comunicado-footer">
                    <span class="tag-status">Importante</span>
                </div>
            </div>


        </section>
        <section class="p-separator" id="desempenho">
            <h1>Painel desempenho</h1>
        </section>

        <section class="p-active">
            <h1>Meu desempenho</h1>
            <?php require_once __DIR__ . '/../templates/tables/studentPerformance.php' ?>
        </section>

        <section class="p-separator" id="materias">
            <h1>Painel desempenho</h1>
        </section>

        <section class="p-active">
            <h1>Materias disponíveis</h1>
            <table class="p-table" id="myTable">
                <tr class="header">
                    <th>Matéria</th>
                    <th>Professor responsável</th>
                </tr>
                <tr>
                    <td>Biologia</td>
                    <td>Ricardo Amado</td>
                </tr>
                <tr>
                    <td>Física</td>
                    <td>Maximiliano Amadeu</td>
                </tr>
            </table>
        </section>

        <section class="p-separator">
            <p>Todos os direitos reservados</p>
        </section>
    </main>
</body>

</html>