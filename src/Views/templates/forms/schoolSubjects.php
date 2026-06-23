<form id="materiaCreateForm">
    <h1>Criar novas Materias</h1>
    <input type="text" id="nomeNovaMateriaDiretor" placeholder="Nome da materia" autocomplete="off">
    <select class="select-form" id="select-profsForm">
        <option value="" disabled selected>Selecionar professor</option>
    </select>
    <button id="btnCreateMateria" class="btnCreateMateriaDiretor">Criar</button>
</form>

<script>
    async function criarNovaMateria(data) {
        const urlAPINewMateria = 'http://localhost/ProjetoFinal/api/materia'

        try {
            const response = await fetch(urlAPINewMateria, {
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
            document.getElementById('materiaCreateForm').reset()
            return await response.json()
        } catch (erro) {
            console.error('Falha ao criar materia: ', erro)
        }
    }


    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("btnCreateMateriaDiretor")) {
            event.preventDefault()
            let nomeMateria = document.getElementById('nomeNovaMateriaDiretor').value
            let id_professor = document.getElementById('select-profsForm').value

            const data = {
                nomeMateria,
                id_professor
            }
            console.log(data)
            criarNovaMateria(data).then(retorno => {
                alert(retorno.message)
                carregarMaterias()
            }).catch(erro => {
                console.log("Falha", erro)
            })
        }
    })
</script>