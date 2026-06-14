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
        <h1 class="">Seja bem vindo <?php echo $_SESSION['usuario_escola']['matr']; ?> <button id="btnLogout" class="logout-button" >Logout</button></h1>
        <section class="info-tables">
            <div class="card">
                <div class="card-container">
                    <h4><b>Meus alunos</b></h4>
                </div>
                <a href="#professores" class="manage-button">Gerenciar</a>
            </div>

            <div class="card">
                <div class="card-container">
                    <h4><b>Minhas turmas</b></h4>
                </div>
                <a href="#alunos" class="manage-button">Gerenciar</a>
            </div>
            <div class="card">
                <div class="card-container">
                    <h4><b>Comunicados</b></h4>
                </div>
                <a href="#materias" class="manage-button">Gerenciar</a>
            </div>
            <div class="card">
                <div class="card-container">
                    <h4><b>Meu perfil</b></h4>
                </div>
                <a href="#meuPerfil" class="manage-button">Gerenciar</a>
            </div>
        </section>

        <section class="p-separator" id="aluno">
            <h1>Painel de alunos</h1>
        </section>

        <section class="p-active">
            <h1>Meus alunos</h1>
            <?php require_once __DIR__ . '/../templates/tables/studentTable.php' ?>
        </section>
        <section class="p-separator" id="turma">
            <h1>Painel de turmas</h1>
        </section>
        <section class="p-active" id="turmas">
            <h1>Minhas turmas</h1>
            <?php require_once __DIR__ . '/../templates/tables/classTable.php' ?>
        </section>
        <section class="p-separator" id="meuPerfil">
            <h1>Meu perfil</h1>
        </section>
        <section class="settings-form">
            <?php require_once __DIR__ . '/../templates/profile/updateUserForm.php' ?>
        </section>
        <section class="p-separator" id="comunicado">
            <h1>Painel de comunicados</h1>
        </section>
        <section class="settings-form">
            <?php require_once __DIR__ . '/../templates/forms/announcementForm.php' ?>
            <div>
                <h1>Comunicados cadastrados</h1>
                <?php require_once __DIR__ . '/../templates/tables/announcementTable.php' ?>
            </div>
        </section>
        <section class="p-separator"><p>Todos os direitos reservados</p></section>
    </main>
    <script src="http://localhost/ProjetoFinal/public/js/login.js"></script>



</body>

</html>