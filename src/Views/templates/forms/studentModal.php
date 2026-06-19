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


    <div id="StudentModal" class="modal-overlay">
        <div class="modal-box">
            <button id="closeStudentBtn" class="modal-close">×</button>

            <form id="updDesempenho" name="updDesempenho" class="login-form createform">
                <h1>Painel de desempenho</h1>
                <hr class="divisor">
                <input type="hidden" id="updIDcomu" value="">
                <input type="hidden" id="updIDProfessor" value="">
                <input type="text" id="updTxtTituloComu" value="">
                <select class="select-form" id="update-turmas">
                </select>
                <select class="select-form" id="update-urgencia">

                </select>
                <textarea class="textareaForm" id="updateTxtTexto"></textarea>
                <button id="btnAlterarComu" class="botao-salvar">Adicionar notas comunicado</button>
            </form>

        </div>
    </div>


    <script>
        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("btn-desempenho")) {
                const id = Number(e.target.dataset.id)
                console.log(id)
                const objAluno = objAlunosDashProfessor.find(u => u.id_aluno === id)
                constroiStudentModal(objAluno)
            }
        })

        function constroiStudentModal(data) {
            openStudentModal()
            
        }

/*
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
                closeModal()
                carregarComunicados()
            }).catch(erro => {
                console.log("Erro: ", erro)
            })
        })
*/
        const studentModal = document.getElementById("StudentModal")
        const openStudentBtn = document.getElementById("openStudentModal")
        const closeStudentBtn = document.getElementById("closeStudentBtn")

        async function alterarDesempenho(id,values) {
            const urlAPIUpdate = `http://localhost/ProjetoFinal/api/updateDesempenho/${id_aluno}`
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

        function openStudentModal() {
            studentModal.classList.add("show")
        }

        function closeStudentModal() {
            studentModal.classList.remove("show")
        }

        closeStudentBtn.addEventListener("click", closeStudentModal)
    </script>

</body>

</html>