// Função assíncrona para buscar os diretores
async function carregarTurmas() {
    const urlAPITurmas = 'http://localhost/ProjetoFinal/api/turma';
    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPITurmas, {
            method: 'GET'
        });

        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) throw new Error('Erro ao buscar dados da API');

        // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
        const turmas = await resposta.json();
        console.log(turmas)
        // 3. Seleciona o corpo da tabela no HTML
        const tbody = document.getElementById('tabela-turmas');
        tbody.innerHTML = ''; // Limpa a tabela antes de preencher
        tbody.innerHTML += `
            <tr class="header">
                <th>#Id</th>
                <th>Turma</th>
                <th>Professor responsável</th>
                <th>Alterar</th>
                <th>Deletar</th>
            </tr>
        `
        // 4. Faz um loop no array de turmas e cria as linhas HTML
        turmas.forEach(turmas => {
            const linha = `
                <tr>
                    <td>${turmas.id_turma}</td>
                    <td>${turmas.nomeTurma}</td>
                    <td>${turmas.nome}</td>
                    <td><button class="active">Editar</button></td>
                    <td><button class="disabled">Deletar</button></td>
                </tr>
            `;
            tbody.innerHTML += linha; // Injeta a linha na tabela
        });

    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro);
        alert('Não foi possível carregar a lista de turmas.');
    }
}
// Função assíncrona para buscar as materias
async function carregarMaterias() {
    const urlAPIschoolSubject = 'http://localhost/ProjetoFinal/api/materia'
    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPIschoolSubject, {
            method: 'GET'
        });

        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

        // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
        const materias = await resposta.json()
        console.log(materias)
        // 3. Seleciona o corpo da tabela no HTML
        const tbody = document.getElementById('tabela-materias')
        tbody.innerHTML = '' // Limpa a tabela antes de preencher
        tbody.innerHTML += `
            <tr class="header">
                <th>#Id</th>
                <th>Materia</th>
                <th>Professor responsável</th>
                <th>Alterar</th>
                <th>Deletar</th>
            </tr>
        `
        // 4. Faz um loop no array de materias e cria as linhas HTML

        materias.forEach(materia => {
            const linha = `
                <tr>
                    <td>${materia.id_materia}</td>
                    <td>${materia.nomeMateria}</td>
                    <td>${materia.nome}</td>
                    <td><button class="active">Editar</button></td>
                    <td><button class="disabled">Deletar</button></td>
                </tr>
            `
            tbody.innerHTML += linha
        })

    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro)
        alert('Não foi possível carregar a lista de materias.')
    }
}

// Função assíncrona para buscar as materias
async function carregarPerfil() {
    const data = document.getElementById('idPerfil').value
    const selectData = document.getElementById('select-status')
    const urlAPIPerfil = `http://localhost/ProjetoFinal/api/meuPerfil/${data}`

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
            </div>
        `
    } catch (erro) {
        console.error('Erro ao carregar perfil :', erro)
        alert('Não foi possível carregar perfil.')
    }
    ;
}
// Função assíncrona para buscar as materias
async function carregarProfessores() {
    const urlAPIProfessor = 'http://localhost/ProjetoFinal/api/professor'
    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPIProfessor, {
            method: 'GET'
        });

        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

        // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
        const professores = await resposta.json()
        console.log(professores)
        // 3. Seleciona o corpo da tabela no HTML
        const tbody = document.getElementById('tabela-professores')
        tbody.innerHTML = '' // Limpa a tabela antes de preencher
        tbody.innerHTML += `
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
        `
        // 4. Faz um loop no array de professores e cria as linhas HTML

        professores.forEach(professor => {
            const linha = `
                <tr>
                    <td>${professor.id_professor}</td>
                    <td>${professor.nome}</td>
                    <td>${professor.matricula}</td>
                    <td>${professor.nivelAcesso}</td>
                    <td>Status</td>
                    <td>Materia</td>
                    <td><button class="active">Editar</button></td>
                    <td><button class="disabled">Deletar</button></td>
                </tr>
            `
            tbody.innerHTML += linha
        })

    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro)
        alert('Não foi possível carregar a lista de professores.')
    }
}

// Função assíncrona para buscar as materias
async function carregarAlunos() {
    const urlAPIAlunos = 'http://localhost/ProjetoFinal/api/aluno'
    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPIAlunos, {
            method: 'GET'
        });

        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) throw new Error('Erro ao buscar dados da API')

        // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
        const alunos = await resposta.json()
        console.log(alunos)
        // 3. Seleciona o corpo da tabela no HTML
        const tbody = document.getElementById('tabela-alunos')
        tbody.innerHTML = '' // Limpa a tabela antes de preencher
        tbody.innerHTML += `
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
        `
        // 4. Faz um loop no array de alunos e cria as linhas HTML

        alunos.forEach(aluno => {
            const linha = `
                <tr>
                    <td>${aluno.id_aluno}</td>
                    <td>${aluno.matricula}</td>
                    <td>${aluno.idade}</td>
                    <td>${aluno.tipoEnsino}</td>
                    <td>${aluno.nivelAcesso}</td>
                    <td>Turma</td>
                    <td>Status conta</td>
                    <td>Desempenho</td>
                    <td><button class="active">Editar</button></td>
                    <td><button class="disabled">Deletar</button></td>
                </tr>
            `
            tbody.innerHTML += linha
        })

    } catch (erro) {
        console.error('Falha :', erro)
        alert('Não foi possível carregar a lista de alunos.')
    }
}


document.addEventListener('DOMContentLoaded', carregarMaterias)
document.addEventListener('DOMContentLoaded', carregarTurmas)
document.addEventListener('DOMContentLoaded', carregarPerfil)
document.addEventListener('DOMContentLoaded', carregarProfessores)
document.addEventListener('DOMContentLoaded', carregarAlunos)