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

    <main>

        <section class="p-active">
            <h1>Professores ativos <button>Voltar</button></h1>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
            <table class="p-table" id="myTable">
                <tr class="header">
                    <th>#Id</th>
                    <th>Nome</th>
                    <th>Matricula</th>
                    <th>Nivel de acesso</th>
                    <th>Status</th>
                    <th>Materia</th>
                    <th>Alterar</th>
                    <th>Deletar</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ricardo Amado</td>
                    <td>P324234</td>
                    <td>1</td>
                    <td class="active">Ativo</td>
                    <td>Educação Física</td>
                    <th><button class="active">Editar</button></th>
                    <th><button class="disabled">Deletar</button></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Jessica Amado</td>
                    <td>P324234</td>
                    <td>1</td>
                    <td class="active">Ativo</td>
                    <td>Educação Física</td>
                    <th><button class="active">Editar</button></th>
                    <th><button class="disabled">Deletar</button></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Marcia Amado</td>
                    <td>P324234</td>
                    <td>1</td>
                    <td class="active">Ativo</td>
                    <td>Educação Física</td>
                    <th><button class="active">Editar</button></th>
                    <th><button class="disabled">Deletar</button></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Luix Amado</td>
                    <td>P324234</td>
                    <td>1</td>
                    <td class="disabled">Desativado</td>
                    <td>Educação Física</td>
                    <th><button class="active">Editar</button></th>
                    <th><button class="disabled">Deletar</button></th>
                </tr>
            </table>
        </section>
        <section class="p-separator"></section>
        <section class="p-active">
            <h1>Criar novo professor</h1>
            <form id="loginForm" name="loginForm" class="login-form">
                <input type="text" id="txtMatricula" placeholder="Nome">
                <input type="text" id="txtMatricula" placeholder="Matricula">
                <input type="password" name="" id="txtPassword" placeholder="Senha">
                <input type="text" id="txtMatricula" placeholder="Tipo de usuario">
                <input type="text" id="txtMatricula" placeholder="Nivel Acesso">
                <input type="text" id="txtMatricula" placeholder="Status da conta">
                <button id="btnLogin">Criar novo professor </button>
            </form>
        </section>

        <section class="settings-form" id="meuPerfil">
            <p>Diretor não cria comunicados apenas gerencia acessos</p>
            <?php require_once __DIR__ . '/../templates/forms/announcementForm.php' ?>
            <?php require_once __DIR__ . '/../templates/table3.php' ?>
        </section>
        <section class="p-separator"></section>
    </main>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput")
            filter = input.value.toUpperCase()
            table = document.getElementById("myTable")
            tr = table.getElementsByTagName("tr")
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = ""
                    } else {
                        tr[i].style.display = "none"
                    }
                }
            }
        }
    </script>
</body>

</html>