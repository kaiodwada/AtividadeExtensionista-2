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
    <title>Dashboard: <?php echo $_SESSION['usuario_escola']['matr']; ?></title>
</head>

<body class="dashboard-body">
    <?php require_once __DIR__ . '/../templates/header.php' ?>

    <main class="director-main">
        <h1 class="">Seja bem vindo <?php echo $_SESSION['usuario_escola']['matr']; ?> <button class="logout-button">Logout</button></h1>
        <section class="info-tables">
            <div class="card">
                <div class="card-container">
                    <h4><b>Professores</b></h4>
                </div>
                <a href="#professores" class="manage-button">Gerenciar</a>
            </div>

            <div class="card">
                <div class="card-container">
                    <h4><b>Alunos</b></h4>
                </div>
                <a href="#alunos" class="manage-button">Gerenciar</a>
            </div>
            <div class="card">
                <div class="card-container">
                    <h4><b>Materias</b></h4>
                </div>
                <a href="#materias" class="manage-button">Gerenciar</a>
            </div>
            <div class="card">
                <div class="card-container">
                    <h4><b>Meu perfil</b></h4>
                </div>
                <a href="#meuPerfil" class="manage-button">Gerenciar</a>
            </div>
            <div class="card">
                <div class="card-container">
                    <h4><b>Usuarios</b></h4>
                </div>
                <a href="#usuarios" class="manage-button">Gerenciar</a>
            </div>
        </section>

        <section class="settings-form" id="alunos">
            <?php require_once __DIR__ . '/../templates/forms/classForm.php' ?>
            <?php require_once __DIR__ . '/../templates/table.php' ?>
        </section>
        <section class="p-separator" id="materias"></section>
        <section class="settings-form">
            <?php require_once __DIR__ . '/../templates/forms/schoolSubjects.php' ?>
            <?php require_once __DIR__ . '/../templates/table2.php' ?>
        </section>
        <section class="p-separator" id="meuPerfil">
            <h1>Meu perfil</h1>
        </section>
        <section class="settings-form">
            <?php require_once __DIR__ . '/../templates/forms/directorForm.php' ?>
        </section>
        <section class="p-separator" id="usuarios"">
            <h1>Criar novo usuario</h1>
        </section>
        <section class="settings-form">
            <?php require_once __DIR__ . '/../templates/forms/userForm.php' ?>
            <div>
                <h2>Padrão de criação de novos usuários</h2>
                <ul>
                    <li>Usuários professores devem ter no inicio da matricula a letra P maiúscula</li>
                    <li>Usuários alunos devem ter no inicio da matricula a letra A maiúscula</li>
                    <li>Usuários diretores devem ter no inicio da matricula a letra D maiúscula</li>
                    <li>A senha padrão dos usuários é a própria matricula</li>
                </ul>
            </div>
        </section>
        <section class="p-separator" id="professores">
            <h1>Painel de professores</h1>
        </section>

        <section class="p-active">
            <h1>Professores cadastrados</h1>
            <?php require_once __DIR__ . '/../templates/tables/frontTable.php' ?>
        </section>

        <section class="p-separator">
            <h1>Painel de alunos</h1>
        </section>

        <section class="p-active">
            <h1>Alunos cadastrados</h1>
            <?php require_once __DIR__ . '/../templates/tables/sFrontTable.php' ?>
        </section>


        <section class="p-separator">
            <p>Todos os direitos reservados</p>
        </section>
    </main>
</body>

</html>