<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* The overlay (background) */
        .modal-overlay {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        /* Show the modal */
        .modal-overlay.show {
            display: block;
        }

        /* The modal box */
        .modal-box {
            background: white;
            width: 90%;
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            position: relative;
        }

        /* Close button */
        .modal-close {
            position: absolute;
            right: 12px;
            top: 8px;
            font-size: 24px;
            border: none;
            background: none;
            cursor: pointer;
        }
    </style>
</head>

<body>


    <div id="modal" class="modal-overlay">
        <div class="modal-box">
            <button id="closeBtn" class="modal-close">×</button>

            <form id="updateComuForm" name="updateComuForm" class="login-form createform">
                <h1>Alterar comunicado</h1>
                <hr class="divisor">
                <input type="hidden" id="updIDcomu" value="">
                <input type="hidden" id="updIDProfessor" value="">
                <input type="text" id="updTxtTituloComu" value="" class="input-estilizado">
                <select class="select-form" id="update-turmas">
                </select>
                <select class="select-form" id="update-urgencia">

                </select>
                <textarea class="textareaForm" id="updateTxtTexto"></textarea>
                <button id="btnAlterarComu" class="botao-salvar">Alterar comunicado</button>
            </form>

        </div>
    </div>


    <script>
        let tituloComu = document.getElementById('updTxtTituloComu')
        let turmaComu = document.getElementById('update-turmas')
        let textoComu = document.getElementById('updateTxtTexto')
        let btnUpdComu = document.getElementById('btnAlterarComu')
        let statusComu = document.getElementById('update-urgencia')
        let id_comunicado = document.getElementById('updIDcomu')
        let id_professor = document.getElementById('updIDProfessor')
        const id_profUser = document.getElementById('idPerfil').value

        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("btn-detalhes")) {
                const id = Number(e.target.dataset.id)
                const objComunicado = objComunicadosDashProfessor.find(u => u.id_comunicado === id)
                constroiModal(objComunicado)
            }
        })

        function constroiModal(data) {
            //
            tituloComu.innerHTML = ''
            turmaComu.innerHTML = ''
            textoComu.innerHTML = ''
            statusComu.innerHTML = ''
            id_professor.value = ''
            //
            tituloComu.value = data.titulo
            turmaComu.innerHTML += `
                                     <option value="${data.id_turma}" disabled selected>${data.nomeTurma}</option>
                                     `
            statusComu.innerHTML += `
                                     <option value="${data.info_status}" selected>${data.info_status}</option>
                                    <option value="informativo">Informativo</option>
                                    <option value="Importante">Importante</option>
                                     `
            textoComu.innerHTML = data.texto_comunicado
            id_comunicado = data.id_comunicado
            id_professor = data.id_professor
            openModal()
        }


        btnUpdComu.addEventListener("click", (e) => {
            e.preventDefault()

            let titulo = tituloComu.value
            let id_turma = Number(turmaComu.value)
            let info_status = statusComu.value
            let texto_comunicado = textoComu.value

            const values = {
                id_turma,
                titulo,
                info_status,
                id_professor,
                texto_comunicado
            }

            alterarComunicado(values).then(retorno => {
                alert("Alteração realizada com sucesso")
                carregarComunicados(id_profUser)
                closeModal()
            }).catch(erro => {
                console.log("Erro: ", erro)
            })

        })

        const modal = document.getElementById("modal")
        const openBtn = document.getElementById("openModal")
        const closeBtn = document.getElementById("closeBtn")

        async function alterarComunicado(values) {
            const urlAPIUpdate = `http://localhost/ProjetoFinal/api/comunicado/${id_comunicado}`
            try {
                const response = await fetch(urlAPIUpdate, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(values)
                })
                if (!response.ok) {
                    let mensagemErro = `Erro retornado: ${response.status}`
                    const retornoServidor = await response.json()
                    console.log("Retorno: ", retornoServidor)
                    throw new Error(retornoServidor)
                }
                const updateOK = await response.json()
                return updateOK
            } catch (error) {
                console.log(error)
                alert("Erro ao atualizar comunicado: ", error)
            }

        }

        function openModal() {
            modal.classList.add("show")
        }

        function closeModal() {
            modal.classList.remove("show")
        }

        closeBtn.addEventListener("click", closeModal)
    </script>

</body>

</html>