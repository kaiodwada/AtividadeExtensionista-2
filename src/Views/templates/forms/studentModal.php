<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://localhost/ProjetoFinal/public/css/main.css">
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
                <input type="text" id="alunoNome" value="" disabled>
                <input type="text" id="alunoTpEnsino" value="" disabled>
                <input type="text" id="alunoTurma" value="" disabled>

                <input type="text" id="alunoNota1" value="">
                <input type="text" id="alunoNota2" value="">
                <button id="btnAlterarComu" class="botao-salvar">Adicionar notas comunicado</button>
            </form>

        </div>
    </div>


    <script>
        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("btn-desempenho")) {
                const id = Number(e.target.dataset.id)
                console.log("Teste id: ", id)
                console.log("teste de objeto: ", objAlunosDashProfessor)
                const objAluno = objAlunosDashProfessor.find(u => u.id_desempenho === id)
                console.log(objAluno)
                constroiStudentModal(objAluno)
            }
        })

        function constroiStudentModal(data) {
            let nome = document.getElementById('alunoNome')
            let ensino = document.getElementById('alunoTpEnsino')
            let turma = document.getElementById('alunoTurma')
            let nota1 = document.getElementById('alunoNota1')
            let nota2 = document.getElementById('alunoNota2')

            nome.value = ''
            ensino.value = ''
            turma.value = ''
            nota1.value = ''
            nota2.value = ''

            nome.value = data.nome
            ensino.value = data.tipoEnsino
            turma.value = data.nomeTurma
            nota1.value = data.nota_primeira_prova
            nota2.value = data.nota_segunda_prova

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

        async function alterarDesempenho(id, values) {
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