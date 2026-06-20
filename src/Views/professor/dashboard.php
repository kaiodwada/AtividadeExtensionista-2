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
            <table class="p-table" id="tabela-dAlunos">
                <tr class="header">
                    <th>#Id</th>
                    <th>Nome</th>
                    <th>Matricula</th>
                    <th>Idade</th>
                    <th>Tipo de ensino</th>
                    <th>Nivel de acesso</th>
                    <th>Presente na turma</th>
                    <th>Status da conta</th>
                    <th>Desempenho</th>
                </tr>
                <tr>
                    <td>Loading.....</td>
                    <td>Loading.....</td>
                    <td>Loading.....</td>
                    <td>Loading.....</td>
                    <td>Loading.....</td>
                    <td>Loading.....</td>
                    <td>Loading.....</td>
                    <td class="active">Loading.....</td>
                    <th><button class="active">Loading.....</button></th>
                </tr>
                <?php require_once __DIR__ . '/../templates/forms/studentModal.php' ?>
            </table>
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
            <?php require_once __DIR__ . '/../templates/forms/announcementModal.php' ?>
            <div>
                <h1>Comunicados cadastrados</h1>
                <?php require_once __DIR__ . '/../templates/tables/announcementTable.php' ?>
            </div>
        </section>
        <section class="p-separator">
            <p>Todos os direitos reservados</p>
        </section>
    </main>
    <script src="http://localhost/ProjetoFinal/public/js/logout.js"></script>
    <script>
        // Variávies globais
        let objTurmasDashProfessor = []
        let objAlunosDashProfessor = []
        let objPerfilDashProfessor = []
        let objComunicadosDashProfessor = []
        let id_atual = document.getElementById('idPerfil').value
        
        async function carregarDAlunos(id_atual) {
            const urlAPIDAlunos = `http://localhost/ProjetoFinal/api/updateDesempenho/${id_atual}`
            try {
                const resposta = await fetch(urlAPIDAlunos, {
                    method: 'GET'
                })

                if (!resposta.ok) {
                    let mensagemErro = `Erro retornado: ${resposta.status}`
                    const retornoServidor = await resposta.json()
                    console.log("Retorno: ", retornoServidor)
                    throw new Error(retornoServidor)
                }

                objAlunosDashProfessor = await resposta.json()
                const tbody = document.getElementById('tabela-dAlunos')
                tbody.innerHTML = '' 
                tbody.innerHTML += `
                        <tr class="header">
                            <th>Nome</th>
                            <th>Tipo de ensino</th>
                            <th>Turma</th>
                            <th>Matéria</th>
                            <th>Nota 1</th>
                            <th>Nota 2</th>
                            <th>Média</th>
                            <th>Desempenho</th>
                        </tr>
                        `

                objAlunosDashProfessor.forEach((d) => {
                    const linha = `
                <tr>
                    <td>${d.nome}</td>
                    <td>${d.tipoEnsino}</td>
                    <td>${d.nomeTurma}</td>
                    <td>${d.nomeMateria}</td>
                    <td>${d.nota_primeira_prova}</td>
                    <td>${d.nota_segunda_prova}</td>
                    <td>${d.media_atual}</td>
                    <td><button id="openStudentModal" data-id="${d.id_desempenho}" class="active btn-desempenho">Verificar</button></td>
                </tr>
            `
                    tbody.innerHTML += linha
                })
                return objAlunosDashProfessor
            } catch (erro) {
                console.error('Falha :', erro)
                alert('Não foi possível carregar a lista de alunos.')
            }
        }
        async function carregarTurmaSelect() {
            const urlAPITurmas = 'http://localhost/ProjetoFinal/api/turma'
            try {
                // 1. Faz a requisição assíncrona (espera a resposta do servidor)
                const resposta = await fetch(urlAPITurmas, {
                    method: 'GET'
                })

                // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
                if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

                // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
                const objTurmasDashProfessor = await resposta.json()

                // 3. Seleciona o corpo da tabela no HTML
                const sbody = document.getElementById('select-turmas')
                sbody.innerHTML = ''
                sbody.innerHTML += `<option value="" disabled selected>Turma</option>`

                objTurmasDashProfessor.forEach(turma => {
                    const option = `
                        <option value="${turma.id_turma}">${turma.nomeTurma}</option>
                     `
                    sbody.innerHTML += option
                });

            } catch (erro) {
                console.error('Ops! Algo deu errado:', erro)
                alert('Não foi possível carregar a lista de turmas.')
            }
        }

        // Função assíncrona para buscar as materias
        async function carregarPerfil() {
            const data = document.getElementById('idPerfil').value
            const tipo = document.getElementById('tipoUsuario').value
            const selectData = document.getElementById('select-status')
            const nameProf = document.getElementById('updName')
            const urlAPIPerfil = `http://localhost/ProjetoFinal/api/meuPerfil/${data}/${tipo}`

            try {
                // 1. Faz a requisição assíncrona (espera a resposta do servidor)
                const resposta = await fetch(urlAPIPerfil, {
                    method: 'GET'
                });

                // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
                if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

                // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
                const objPerfilDashProfessor = await resposta.json()

                // 3. Seleciona o corpo da tabela no HTML
                const tbody = document.getElementById('perfilInfo')
                tbody.innerHTML = '' // Limpa a tabela antes de preencher
                tbody.innerHTML += `
                        <div class="perfil-info" id="perfilInfo">
                            <h2 class="perfil-nome">${objPerfilDashProfessor.nome}</h2>
                            <p class="perfil-cargo">Matricula: ${objPerfilDashProfessor.matricula}</p>
                            <p class="perfil-cargo">Nível de acesso: ${objPerfilDashProfessor.nivelAcesso}</p>
                        </div>
                    `
                nameProf.value = objPerfilDashProfessor.nome
            } catch (erro) {
                console.error('Erro ao carregar perfil :', erro)
                alert('Não foi possível carregar perfil.')
            };
        }

        // Função assíncrona para buscar as materias
        async function carregarComunicados() {
            const urlAPIComunicados = 'http://localhost/ProjetoFinal/api/comunicado'
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
                objComunicadosDashProfessor = await resposta.json()

                // 3. Seleciona o corpo da tabela no HTML

                const container = document.getElementById('tabela-comunicados')
                container.innerHTML = ''
                container.innerHTML += `
                                         <tr class="header">
                                             <th>#Id</th>
                                             <th>Turma</th>
                                             <th>Titulo</th>
                                             <th>Status</th>
                                             <th>Data</th> 
                                             <th>Texto</th>
                                         </tr>
                                     `
                objComunicadosDashProfessor.forEach(c => {
                    const linha = `
                        <tr>
                            <td>${c.id_comunicado}</td>
                            <td>${c.nomeTurma}</td>
                            <td>${c.titulo}</td>
                            <td>${c.info_status}</td>
                            <td>${c.data_envio}</td>   
                            <td><button  data-id="${c.id_comunicado}" id="openModal" class="active btn-detalhes">Verificar</button></td>
                        </tr>
                       `

                    // Insere a string HTML diretamente no final do container
                    container.insertAdjacentHTML('beforeend', linha)
                })


            } catch (erro) {
                console.error('Falha :', erro)
                alert('Não foi possível carregar a lista de comunicados.')
            }
        }
        async function criarComunicado() {
            event.preventDefault();
            const id_professor = document.getElementById('idPerfil').value
            const urlAPICCreate = 'http://localhost/ProjetoFinal/api/comunicado'
            let titulo = document.getElementById('txtTituloComu').value
            let id_turma = document.getElementById('select-turmas').value
            let texto_comunicado = document.getElementById('txtTexto').value
            let info_status = document.getElementById('urgencia').value

            const data = {
                id_professor,
                id_turma,
                texto_comunicado,
                info_status,
                titulo
            }
            try {
                const resposta = await fetch(urlAPICCreate, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                if (!resposta.ok) {
                    throw new Error('Erro ao Criar comunicado ', resposta)
                }
                alert("Comunicado criado com sucesso!")
                document.getElementById('CreateComuForm').reset()
                carregarComunicados()
            } catch (erro) {
                console.error('Falha ao criar comunicado: ', erro)
            }
        }

        document.addEventListener('DOMContentLoaded', carregarPerfil)
        document.addEventListener('DOMContentLoaded', carregarDAlunos(id_atual).then(objAlunosDashProfessor => {
            console.log("Sucesso: ", objAlunosDashProfessor)
        }).catch(erro => {
            console.log("Falha: ", erro)
        }))
        document.addEventListener('DOMContentLoaded', carregarTurmaSelect)
        document.addEventListener('DOMContentLoaded', carregarComunicados)
        document.getElementById("btnCriar").addEventListener("click", criarComunicado)
    </script>

</body>

</html>