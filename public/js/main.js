
let objTurmasDashDiretor = []
let objProfessoresDashDiretor = []
let objMateriasDashDiretor = []
let objAlunosDashDiretor = []
//----------------------------------
let paginaAtualAluno = 1
let paginaAtualProfessor = 1
let paginaAtualMateria = 1
let paginaAtualTurma = 1
//----------------------------------
let registrosPorPaginaAluno = 10
let registrosPorPaginaProfessor = 10
let registrosPorPaginaMateria = 2
let registrosPorPaginaTurma = 10
//----------------------------------

document
    .getElementById('btnAnteriorAluno')
    .addEventListener('click', () => {

        if (paginaAtualAluno > 1) {
            paginaAtualAluno--
            renderizarPaginaAluno()
        }
    })

document
    .getElementById('btnProximaAluno')
    .addEventListener('click', () => {

        const totalPaginasAluno = Math.ceil(
            objAlunosDashDiretor.length /
            registrosPorPaginaAluno
        )

        if (paginaAtualAluno < totalPaginasAluno) {
            paginaAtualAluno++
            renderizarPaginaAluno()
        }
    })
//---------------------------------------
document
    .getElementById('btnAnteriorProfessor')
    .addEventListener('click', () => {

        if (paginaAtualProfessor > 1) {
            paginaAtualProfessor--
            renderizarPaginaProfessor()
        }
    })

document
    .getElementById('btnProximaProfessor')
    .addEventListener('click', () => {

        const totalPaginasProfessor = Math.ceil(
            objProfessoresDashDiretor.length /
            registrosPorPaginaProfessor
        )

        if (paginaAtualProfessor < totalPaginasProfessor) {
            paginaAtualProfessor++
            renderizarPaginaProfessor()
        }
    })
//----------------------------------------------------------
document
    .getElementById('btnAnteriorMateria')
    .addEventListener('click', () => {

        if (paginaAtualMateria > 1) {
            paginaAtualMateria--
            renderizarPaginaMateria()
        }
    })

document
    .getElementById('btnProximaMateria')
    .addEventListener('click', () => {

        const totalPaginasMateria = Math.ceil(
            objMateriasDashDiretor.length /
            registrosPorPaginaMateria
        )

        if (paginaAtualMateria < totalPaginasMateria) {
            paginaAtualMateria++
            renderizarPaginaMateria()
        }
    })
//-------------------------------------------------------------
document
    .getElementById('btnAnteriorTurma')
    .addEventListener('click', () => {

        if (paginaAtualTurma > 1) {
            paginaAtualTurma--
            renderizarPaginaTurma()
        }
    })

document
    .getElementById('btnProximaTurma')
    .addEventListener('click', () => {

        const totalPaginasTurma = Math.ceil(
            objTurmasDashDiretor.length /
            registrosPorPaginaTurma
        )

        if (paginaAtualTurma < totalPaginasTurma) {
            paginaAtualTurma++
            renderizarPaginaTurma()
        }
    })
//----------------------------------------------------------------
function atualizarIndicadorPaginaAluno() {
    const totalPaginasAluno = Math.ceil(
        objAlunosDashDiretor.length /
        registrosPorPaginaAluno
    )
    document.getElementById('paginaAluno').textContent =
        `${paginaAtualAluno} / ${totalPaginasAluno}`
}
//---------------------------------------------------------------
function atualizarIndicadorPaginaProfessor() {
    const totalPaginasProfessor = Math.ceil(
        objProfessoresDashDiretor.length /
        registrosPorPaginaProfessor
    )
    document.getElementById('paginaProfessor').textContent =
        `${paginaAtualProfessor} / ${totalPaginasProfessor}`
}
//---------------------------------------------------------------
function atualizarIndicadorPaginaMateria() {
    const totalPaginasMateria = Math.ceil(
        objMateriasDashDiretor.length /
        registrosPorPaginaMateria
    )
    document.getElementById('paginaMateria').textContent =
        `${paginaAtualMateria} / ${totalPaginasMateria}`
}
//---------------------------------------------------------------
function atualizarIndicadorPaginaTurma() {
    const totalPaginasTurma = Math.ceil(
        objTurmasDashDiretor.length /
        registrosPorPaginaTurma
    )
    document.getElementById('paginaTurma').textContent =
        `${paginaAtualTurma} / ${totalPaginasTurma}`
}
//---------------------------------------------------------------

function renderizarPaginaAluno() {
    const tbody = document.getElementById('tabela-alunos')
    tbody.innerHTML = ''
    tbody.innerHTML += `
                        <tr class="header">
                            <th>#Id</th>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Idade</th>
                            <th>Tipo de ensino</th>
                            <th>Nivel de acesso</th>
                            <th>Status</th>
                            <th>Manutenção</th>
                        </tr>
                        `
    const inicioAluno = (paginaAtualAluno - 1) * registrosPorPaginaAluno
    const fimAluno = inicioAluno + registrosPorPaginaAluno

    const dadosPaginaAluno = objAlunosDashDiretor.slice(inicioAluno, fimAluno)

    dadosPaginaAluno.forEach(aluno => {
        const linha = `
                <tr>
                    <td>${aluno.id_usuario}</td>
                    <td>${aluno.nome}</td>
                    <td>${aluno.matricula}</td>
                    <td>${aluno.idade}</td>
                    <td>${aluno.tipoEnsino}</td>
                    <td>${aluno.nivelAcesso}</td>
                    <td>${aluno.status_conta === 1 ? 'Ativado' : 'Desativado'}</td>
                    <td><button class="active btnDesativarAluno" data-id="${aluno.id_usuario}">${aluno.status_conta === 1 ? 'Desativar' : 'Ativar'}</button></td>
                </tr>
            `
        tbody.innerHTML += linha
    })
    atualizarIndicadorPaginaAluno()
}
//---------------------------------------------------------------
function renderizarPaginaProfessor() {
    const tbody = document.getElementById('tabela-professores')

    tbody.innerHTML = ''
    tbody.innerHTML += `
                   <tr class="header">
                       <th>#Id</th>
                       <th>Nome</th>
                       <th>Matricula</th>
                       <th>Nivel de acesso</th>
                       <th>Status</th>
                       <th>Manutenção</th>
                   </tr>
                 `
    const inicioProfessor = (paginaAtualProfessor - 1) * registrosPorPaginaProfessor
    const fimProfessor = inicioProfessor + registrosPorPaginaProfessor
    const dadosPaginaProfessor = objProfessoresDashDiretor.slice(inicioProfessor, fimProfessor)

    dadosPaginaProfessor.forEach(professor => {
        const linha = `
                <tr>
                    <td>${professor.id_professor}</td>
                    <td>${professor.nome}</td>
                    <td>${professor.matricula}</td>
                    <td>${professor.nivelAcesso}</td>
                    <td>${professor.status_conta === 1 ? 'Ativado' : 'Desativado'}</td>
                    <td><button class="active btnDesativarProfessor" data-id="${professor.id_professor}">${professor.status_conta === 1 ? 'Desativar' : 'Ativar'}</button></td>
                </tr>
            `
        tbody.innerHTML += linha
    })

    atualizarIndicadorPaginaProfessor()
}
//---------------------------------------------------------------
function renderizarPaginaMateria() {

    const tbody = document.getElementById('tabela-materias')
    tbody.innerHTML = ''
    tbody.innerHTML += `
            <tr class="header">
                <th>#Id</th>
                <th>Materia</th>
                <th>Professor responsável</th>
                <th>Alterar</th>
                <th>Deletar</th>
            </tr>
        `
    const inicioMateria = (paginaAtualMateria - 1) * registrosPorPaginaMateria
    const fimMateria = inicioMateria + registrosPorPaginaMateria
    const dadosPaginaMateria = objMateriasDashDiretor.slice(inicioMateria, fimMateria)

    dadosPaginaMateria.forEach(materia => {
        const linha = `
                <tr>
                    <td>${materia.id_materia}</td>
                    <td>${materia.nomeMateria}</td>
                    <td>${materia.nome}</td>
                    <td><button class="active btnUpdateMateria" data-id="${materia.id_materia}">Editar</button></td>
                    <td><button class="disabled btnDeleteMateria" data-id="${materia.id_materia}">Deletar</button></td>
                </tr>
            `
        tbody.innerHTML += linha
    })

    atualizarIndicadorPaginaMateria()
}
//---------------------------------------------------------------
function renderizarPaginaTurma() {
    const tbody = document.getElementById('tabela-turmas')
    const sbody = document.getElementById('select-turmas')
    tbody.innerHTML = ''
    sbody.innerHTML = ''
    tbody.innerHTML += `
            <tr class="header">
                <th>#Id</th>
                <th>Turma</th>
                <th>Professor responsável</th>
                <th>Alterar</th>
                <th>Deletar</th>
            </tr>
        `
    sbody.innerHTML += `
                    <option value="" disabled selected>Turma</option>
        `
    const inicioTurma = (paginaAtualTurma - 1) * registrosPorPaginaTurma
    const fimTurma = inicioTurma + registrosPorPaginaTurma

    const dadosPaginaTurma = objTurmasDashDiretor.slice(inicioTurma, fimTurma)

    dadosPaginaTurma.forEach(t => {
        const linha = `
                <tr>
                    <td>${t.id_turma}</td>
                    <td>${t.nomeTurma}</td>
                    <td>${t.nome}</td>
                    <td><button class="active   btnUpdateTurma" data-id="${t.id_turma}">Editar</button></td>
                    <td><button class="disabled btnDeleteTurma" data-id="${t.id_turma}">Deletar</button></td>
                </tr>
            `
        const option = `
                <option value="${t.id_turma}">${t.nomeTurma}</option>
            `
        tbody.innerHTML += linha
        sbody.innerHTML += option
    })
    atualizarIndicadorPaginaTurma()
}
//---------------------------------------------------------------

document.addEventListener("click", (e) => {
    if (e.target.classList.contains("btnDesativarProfessor")) {
        const id = Number(e.target.dataset.id)
        const objProfessor = objProfessoresDashDiretor.find(u => u.id_professor === id)
        let desativar = confirm("Você deseja continuar?")

        if (desativar == true) {
            desativarUsuario(objProfessor).then(retorno => {
                alert('Desativação concluida')
                carregarProfessores()
            }).catch(erro => {
                console.log("falha", erro)
            })
        }
    }
})

document.addEventListener("click", (e) => {
    if (e.target.classList.contains("btnDesativarAluno")) {
        const id = Number(e.target.dataset.id)
        const objAluno = objAlunosDashDiretor.find(u => u.id_usuario === id)
        let desativar = confirm("Você deseja continuar?")

        if (desativar == true) {
            desativarUsuario(objAluno).then(retorno => {
                alert('Desativação concluida')
                carregarAlunos()
            }).catch(erro => {
                console.log("falha", erro)
            })
        }
    }
})


async function desativarUsuario(data) {
    const urlAPIDesativar = `http://localhost/ProjetoFinal/api/desativarUsuario/${data.id_usuario}`

    try {
        const response = await fetch(urlAPIDesativar, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })

        if (!response.ok) {
            let mensagemErro = `Erro retornado: ${resposta.status}`
            const retornoServidor = await resposta.json()
            console.log("Retorno: ", retornoServidor)
            throw new Error(retornoServidor)
        }
        retorno = await response.json()
        return retorno
    } catch (error) {
        console.error('Ops! Algo deu errado:', erro)
    }
}


async function carregarTurmas() {
    const urlAPITurmas = 'http://localhost/ProjetoFinal/api/turma'
    try {
        const resposta = await fetch(urlAPITurmas, {
            method: 'GET'
        })

        if (!resposta.ok) {
            let mensagemErro = `Erro retornado: ${resposta.status}`
            const retornoServidor = await resposta.json()
            console.log("Retorno: ", retornoServidor)
            throw new Error(retornoServidor)
        }

        objTurmasDashDiretor = await resposta.json()
        paginaAtualTurma = 1
        renderizarPaginaTurma()
        return objTurmasDashDiretor
    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro)
        alert('Não foi possível carregar a lista de turmas.')
    }
}
async function carregarMaterias() {
    const urlAPIschoolSubject = 'http://localhost/ProjetoFinal/api/materia'
    try {
        const resposta = await fetch(urlAPIschoolSubject, {
            method: 'GET'
        })

        if (!resposta.ok) {
            let mensagemErro = `Erro retornado: ${resposta.status}`
            const retornoServidor = await resposta.json()
            console.log("Retorno: ", retornoServidor)
            throw new Error(retornoServidor)
        }

        objMateriasDashDiretor = await resposta.json()
        paginaAtualMateria = 1
        renderizarPaginaMateria()

        return objMateriasDashDiretor
    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro)
        alert('Não foi possível carregar a lista de materias.')
    }
}

async function carregarPerfil() {
    const data = document.getElementById('idPerfil').value
    const tipo = document.getElementById('tipoUsuario').value
    const nome = document.getElementById('updName')
    const selectData = document.getElementById('select-status')

    const urlAPIPerfil = `http://localhost/ProjetoFinal/api/meuPerfil/${data}/${tipo}`

    try {
        const resposta = await fetch(urlAPIPerfil, {
            method: 'GET'
        })

        if (!resposta.ok) {
            let mensagemErro = `Erro retornado: ${resposta.status}`
            const retornoServidor = await resposta.json()
            console.log("Retorno: ", retornoServidor)
            throw new Error(retornoServidor)
        }

        const perfil = await resposta.json()
        nome.value = ''
        const tbody = document.getElementById('perfilInfo')
        tbody.innerHTML = ''
        tbody.innerHTML += `
            <div class="perfil-info" id="perfilInfo">
                <h2 class="perfil-nome">${perfil.nome}</h2>
                <p class="perfil-cargo">Matricula: ${perfil.matricula}</p>
                <p class="perfil-cargo">Nível de acesso: ${perfil.nivelAcesso}</p>
            </div>
        `
        nome.value = perfil.nome
    } catch (erro) {
        console.error('Erro ao carregar perfil :', erro)
        alert('Não foi possível carregar perfil.')
    }

}
async function carregarProfessores() {
    const urlAPIProfessor = 'http://localhost/ProjetoFinal/api/professor'
    try {
        const resposta = await fetch(urlAPIProfessor, {
            method: 'GET'
        })

        if (!resposta.ok) {
            let mensagemErro = `Erro retornado: ${response.status}`
            const retornoServidor = await response.json()
            console.log("Retorno: ", retornoServidor)
            throw new Error(retornoServidor)
        }
        objProfessoresDashDiretor = await resposta.json()

        paginaAtualProfessor = 1
        renderizarPaginaProfessor()
        return objProfessoresDashDiretor
    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro)
        alert('Não foi possível carregar a lista de professores.')
    }
}

async function carregarAlunos() {
    const urlAPIAlunos = 'http://localhost/ProjetoFinal/api/aluno'
    try {
        const response = await fetch(urlAPIAlunos, {
            method: 'GET'
        })

        if (!response.ok) {
            let mensagemErro = `Erro retornado: ${response.status}`
            const retornoServidor = await response.json()
            console.log("Retorno: ", retornoServidor)
            throw new Error(retornoServidor)
        }

        objAlunosDashDiretor = await response.json()
        paginaAtualAluno = 1
        renderizarPaginaAluno()
        return objAlunosDashDiretor
    } catch (erro) {
        console.error('Falha :', erro)
        alert('Não foi possível carregar a lista de alunos.')
    }
}


document.addEventListener('DOMContentLoaded', carregarMaterias().then(objMateriasDashDiretor => { }).catch(erro => {
    console.log("falha", erro)
}))
document.addEventListener('DOMContentLoaded', carregarTurmas().then(objTurmasDashDiretor => { }).catch(erro => {
    console.log("falha", erro)
}))
document.addEventListener('DOMContentLoaded', carregarPerfil)
document.addEventListener('DOMContentLoaded', carregarProfessores().then(objProfessoresDashDiretor => { }).catch(erro => {
    console.log("falha", erro)
}))
document.addEventListener('DOMContentLoaded', carregarAlunos().then(objAlunosDashDiretor => { }).catch(erro => {
    console.log("falha", erro)
}))


//Cadastrar usuario

async function criarUsuario() {
    event.preventDefault();
    const urlAPICreate = 'http://localhost/ProjetoFinal/api/usuario'
    let nome = document.getElementById('txtNome').value
    let matricula_usuario = document.getElementById('txtMatriculaUsuario').value
    let senha_hash = document.getElementById('txtPassword').value
    let tipo_usuario = document.getElementById('select-tipo').value
    let status_conta = document.getElementById('select-statusConta').value
    let idade = document.getElementById('studentsAgeData').value
    let tipoEnsino = document.getElementById('studentsTpData').value
    let id_turma = document.getElementById('select-turmas').value
    let nivelAcesso = document.getElementById('select-nivel').value
    let matricula = matricula_usuario

    const form = { nome, matricula_usuario, senha_hash, tipo_usuario, status_conta, idade, tipoEnsino, id_turma, nivelAcesso, matricula }
    const data = Object.fromEntries(Object.entries(form).filter(([_, value]) => value !== "" && value !== null && value !== undefined))

    try {
        const resposta = await fetch(urlAPICreate, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        if (!resposta.ok) {
            throw new Error('Erro ao Criar usuario ', resposta)
        }
        alert("Usuário criado com sucesso!")
        document.getElementById('createForm').reset()
        const studentsClassData = document.getElementById('studentsClassData')
        studentsClassData.classList.add('invisible')
    } catch (erro) {
        console.error('Falha ao criar usuario: ', erro)
    }

}

document.getElementById("btnCriar").addEventListener("click", criarUsuario)
