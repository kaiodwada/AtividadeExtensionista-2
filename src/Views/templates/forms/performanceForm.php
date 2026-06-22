<form id="addDesempenho" class="login-form">
    <h1>Adicionar</h1>
    <select class="select-form" id="select-alunosP">
        <option value="" disabled selected>Selecionar aluno</option>
    </select>
    <select class="select-form" id="select-turmaP">
        <option value="" disabled selected>Selecionar turma</option>
    </select>

    <select class="select-form" id="select-materiaP">
        <option value="" disabled selected>Selecionar Materia</option>
    </select>
    <input type="number" id="alunoDesempenhoNota1" placeholder="Nota 1" class="input-estilizado">
    <input type="number" id="alunoDesempenhoNota2" placeholder="Nota 2" class="input-estilizado">

    <button id="btnAdicionarNotaS" class="botao-salvar AddnotasPerformance">Adicionar notas</button>
</form>

<script>
    let objAlunosDashDiretor = []
    document.addEventListener('DOMContentLoaded', carregarAlunos().then(objAlunosDashDiretor => {}).catch(erro => {
        console.log("falha", erro)
    }))

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

            return objAlunosDashDiretor
        } catch (erro) {
            console.error('Falha :', erro)
            alert('Não foi possível carregar a lista de alunos.')
        }
    }

    let btnAdicionarNota = document.getElementById('btnAdicionarNotaS')

    function carregarInfoDesempenho() {
        let alunosSelect = document.getElementById('select-alunosP')
        alunosSelect.innerHTML = ''
        alunosSelect.innerHTML = `<option value="" disabled selected>Selecionar Aluno</option>`
        objAlunosDashDiretor.forEach(e => {
            alunosSelect.innerHTML += `<option value="${e.id_aluno}">${e.nome}</option>`
        })
    }

    async function adicionarNotas() {
        event.preventDefault()
        const urlAPIAddNota = 'http://localhost/ProjetoFinal/api/addNotas'

        let id_aluno = document.getElementById('select-alunosP').value
        let id_turma = document.getElementById('select-turmaP').value
        let id_materia = document.getElementById('select-materiaP').value
        let nota_primeira_prova = document.getElementById('alunoDesempenhoNota1').value
        let nota_segunda_prova = document.getElementById('alunoDesempenhoNota2').value

        const data = {
            id_aluno,
            id_turma,
            id_materia,
            nota_primeira_prova,
            nota_segunda_prova
        }

        try {
            const response = await fetch(urlAPIAddNota, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            if (!response.ok) {
                let mensagemErro = `Erro retornado: ${response.status}`
                const retornoServidor = await response.json()
                console.log("Retorno: ", retornoServidor)
            }
            document.getElementById('addDesempenho').reset()
            retornoOk = await response.json()
            return retornoOk

        } catch (erro) {
            console.error('Falha ao adicionar notas: ', erro)
        }
    }

    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("AddnotasPerformance")) {
            event.preventDefault()
            adicionarNotas().then(retornoNotas => {
                carregarDAlunos(id_atual)
                alert(retornoNotas.message)
            }).catch(erro => {
                alert("Falha", erro)
            })

        }
    })
</script>