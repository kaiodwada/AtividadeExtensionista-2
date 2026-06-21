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
        <h1 class="">Seja bem vindo <?php echo $_SESSION['usuario_escola']['matr']; ?> <button id="btnLogout" class="logout-button">Logout</button></h1>
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
                    <h4><b>Materias disponiveis</b></h4>
                </div>
                <a href="#materias" class="manage-button">Gerenciar</a>
            </div>

        </section>
        <section class="p-active" id="comunicado">
            <h1>Meu Perfil</h1>
            <?php require_once __DIR__ . '/../templates/profile/updateUserForm.php' ?>
        </section>

        <section class="p-separator">
            <h1>Painel de comunicados</h1>
        </section>

        <section class="settings-form" id="comunicado-id">

        </section>
        <section class="p-separator" id="desempenho">
            <h1>Painel desempenho</h1>
        </section>

        <section class="p-active">
            <h1>Meu desempenho</h1>
            <?php require_once __DIR__ . '/../templates/tables/studentPerformance.php' ?>
        </section>

        <section class="p-separator" id="materias">
            <h1>Painel de materias</h1>
        </section>

        <section class="p-active">
            <h1>Materias disponiveis</h1>
            <?php require_once __DIR__ . '/../templates/tables/schoolSubjectsTable.php' ?>
        </section>

        <section class="p-separator">
            <p>Todos os direitos reservados</p>
        </section>
    </main>
    <script>
        const id_atual = document.getElementById('idPerfil').value
        async function logout() {
            event.preventDefault();
            const urlAPILogout = 'http://localhost/ProjetoFinal/api/logout'
            const urlAPiHome = 'http://localhost/ProjetoFinal/'
            try {
                // 1. Faz a requisição assíncrona (espera a resposta do servidor)
                const resposta = await fetch(urlAPILogout, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
                if (!resposta.ok) {
                    throw new Error('Erro ao buscar dados da API')
                } else {
                    window.location.href = urlAPiHome
                }
            } catch (erro) {
                console.error('Ops! Algo deu errado:', erro);
            }
        }
        document.getElementById("btnLogout").addEventListener("click", logout)
        
        // Função assíncrona para buscar as materias
        async function carregarPerfil() {
            const data = document.getElementById('idPerfil').value
            const tipo = document.getElementById('tipoUsuario').value
            const selectData = document.getElementById('select-status')

            const urlAPIPerfil = `http://localhost/ProjetoFinal/api/meuPerfil/${data}/${tipo}`

            try {
                // 1. Faz a requisição assíncrona (espera a resposta do servidor)
                const resposta = await fetch(urlAPIPerfil, {
                    method: 'GET'
                });

                // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
                if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

                // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
                const perfil = await resposta.json()
                // 3. Seleciona o corpo da tabela no HTML
                const tbody = document.getElementById('perfilInfo')
                tbody.innerHTML = '' // Limpa a tabela antes de preencher
                tbody.innerHTML += `
                     <div class="perfil-info" id="perfilInfo">
                         <h2 class="perfil-nome">${perfil.nome}</h2>
                         <p class="perfil-cargo">Matricula: ${perfil.matricula}</p>
                         <p class="perfil-cargo">Nível de acesso: ${perfil.nivelAcesso}</p>
                         <p class="perfil-cargo">${perfil.tipoEnsino}</p>
                         <p class="perfil-cargo">Idade: ${perfil.idade}</p>
                         <p class="perfil-cargo">${perfil.nomeTurma}</p>
                     </div>
                 `
            } catch (erro) {
                console.error('Erro ao carregar perfil :', erro)
                alert('Não foi possível carregar perfil.')
            };
        }
        // Função assíncrona para buscar as materias
        async function carregarComunicados() {
            const urlAPIComunicados = `http://localhost/ProjetoFinal/api/alunoComunicados/${id_atual}`
            try {
                // 1. Faz a requisição assíncrona (espera a resposta do servidor)
                const resposta = await fetch(urlAPIComunicados, {
                    method: 'GET'
                });

                // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
                if (!resposta.ok) {
                    throw new Error('Erro ao buscar comunicados')
                }
                // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
                const comunicados = await resposta.json()
                // 3. Seleciona o corpo da tabela no HTML

                const container = document.getElementById('comunicado-id');

                comunicados.forEach(c => {
                    const linha = `
                           <div class="card-comunicado">
                               <div class="comunicado-header">
                                   <span class="comunicado-autor">${c.nome}</span>
                                   <span class="comunicado-data">${c.data_envio}</span>
                               </div>
                   
                               <h3 class="comunicado-titulo">${c.titulo}</h3>
                   
                               <div class="comunicado-conteudo">
                                   <p>${c.texto_comunicado}</p>
                               </div>
                   
                               <div class="comunicado-footer">
                                   <span class="tag-status">${c.info_status}</span>
                               </div>
                           </div>
                       `;

                    // Insere a string HTML diretamente no final do container
                    container.insertAdjacentHTML('beforeend', linha);
                });

            } catch (erro) {
                console.error('Falha :', erro)
                alert('Não foi possível carregar a lista de comunicados.')
            }
        }

        async function carregarDesempenho() {
            const data = document.getElementById('idPerfil').value
            const urlAPIDesempenho = `http://localhost/ProjetoFinal/api/performance/${data}`
            try {
                // 1. Faz a requisição assíncrona (espera a resposta do servidor)
                const resposta = await fetch(urlAPIDesempenho, {
                    method: 'GET'
                });

                // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
                if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

                // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
                const desempenhoAluno = await resposta.json()
                // 3. Seleciona o corpo da tabela no HTML
                const tbody = document.getElementById('tabela-desempenho')
                tbody.innerHTML = '' // Limpa a tabela antes de preencher
                tbody.innerHTML += `
                            <tr class="header">
                                <th>Materia</th>
                                <th>Primeira prova</th>
                                <th>Segunda prova</th>
                                <th>Média</th>
                            </tr>
                        `
                // 4. Faz um loop no array de alunos e cria as linhas HTML

                desempenhoAluno.forEach(nota => {
                    const linha = `
                            <tr>
                                <td>${nota.nomeMateria}</td>
                                <td>${nota.nota_primeira_prova}</td>
                                <td>${nota.nota_segunda_prova}</td>
                                <td>${nota.Media}</td>
                            </tr>
                            `
                    tbody.innerHTML += linha
                })

            } catch (erro) {
                console.error('Falha :', erro)
                alert('Não foi possível carregar a lista de notas.')
            }
        }
        async function carregarMaterias() {
            const urlAPIMaterias = 'http://localhost/ProjetoFinal/api/materia'
            try {
                // 1. Faz a requisição assíncrona (espera a resposta do servidor)
                const resposta = await fetch(urlAPIMaterias, {
                    method: 'GET'
                });

                // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
                if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

                // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
                const materias = await resposta.json()
                // 3. Seleciona o corpo da tabela no HTML
                const tbody = document.getElementById('tabela-materias')
                tbody.innerHTML = '' // Limpa a tabela antes de preencher
                tbody.innerHTML += `
                            <tr class="header">
                                <th>Materia</th>
                                <th>Professor responsável</th>
                            </tr>
                        `
                // 4. Faz um loop no array de alunos e cria as linhas HTML

                materias.forEach(materia => {
                    const linha = `
                            <tr>
                                <td>${materia.nomeMateria}</td>
                                <td>${materia.nome}</td>
                            </tr>
                            `
                    tbody.innerHTML += linha
                })

            } catch (erro) {
                console.error('Falha :', erro)
                alert('Não foi possível carregar a lista de materias.')
            }
        }

        document.addEventListener('DOMContentLoaded', carregarPerfil)
        document.addEventListener('DOMContentLoaded', carregarComunicados)
        document.addEventListener('DOMContentLoaded', carregarDesempenho)
        document.addEventListener('DOMContentLoaded', carregarMaterias)
    </script>
</body>

</html>