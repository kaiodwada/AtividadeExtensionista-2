<form id="newClass">
    <h1>Criar novas Turmas</h1>
    <input type="text" id="nomeNovaTurmaDiretor" name="fclass" placeholder="Nome turma">

    <select class="select-form" id="classFormsDiretor">
        <option value="" disabled selected>Selecionar professor</option>
    </select>
    <button id="btnCriarTurmaDiretor" class="btnCriarTurmaDiretor">Criar</button>
</form>

<script>
    async function criarNovaTurma(data) {
        const urlAPINewClass = 'http://localhost/ProjetoFinal/api/turma'

        try {
            const response = await fetch(urlAPINewClass, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            if (!response.ok) {
                let mensagemErro = `Erro retornado: ${resposta.status}`
                const retornoServidor = await response.json()
                console.log("Retorno: ", retornoServidor)
                aler(retornoServidor)
            }
            document.getElementById('newClass').reset()
            return await response.json()
        } catch (erro) {
            console.error('Falha ao criar turma: ', erro)
        }
    }


    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("btnCriarTurmaDiretor")) {
            event.preventDefault()
            let nomeTurma = document.getElementById('nomeNovaTurmaDiretor').value
            let id_professor = document.getElementById('classFormsDiretor').value

            const data = {
                nomeTurma,
                id_professor
            }
            criarNovaTurma(data).then(retorno => {
                alert(retorno.message)
                carregarTurmas()
            }).catch(erro => {
                console.log("Falha", erro)
            })

        }
    })
</script>