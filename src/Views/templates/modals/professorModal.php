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


    <div id="ProfessorModal" class="modal-overlay">
        <div class="modal-box">
            <button id="closeProfessorBtn" class="modal-close">×</button>

            <form id="updProfessor" name="updProfessor" class="login-form createform">
                <h1>Painel de alteracao de professor</h1>
                <hr class="divisor">
                <input type="hidden" id="id-professor" name="">
                <input type="text" name="txtNomeP" id="txtNomeP" placeholder="Nome">
                <label for="select-teachers">Trocar professor:</label>
                <select class="select-form" id="select-nivel">
                    <option value="" disabled selected>Alterar nível</option>
                    <option value="1">1 - Basico</option>
                    <option value="2">2 - Basico/Elementar</option>
                    <option value="3">3 - Intermediário</option>
                    <option value="4">4 - Intermediário/Superior</option>
                    <option value="5">5 - Avançado</option>
                </select>
                <select class="select-form" id="updStatusConta">
                    <option value="" disabled selected>Status da conta</option>
                    <option value="1">Ativado</option>
                    <option value="0">Desativado</option>
                </select>
                <button id="btnAlterarProfessor" class="botao-salvar">Fazer manutenção</button>
            </form>

        </div>
    </div>


    <script>
        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("btnDesativarProfessor")) {
                const id = Number(e.target.dataset.id)
                const objProfessor = objProfessoresDashDiretor.find(u => u.id_professor === id)
                let desativar = confirm("Você deseja continuar?")

                if (desativar == true) {
                    console.log("O usuário escolheu SIM (ou OK).")
                    console.log("Professor desativado: ", objProfessor)
                } else {
                    console.log("O usuário escolheu NÃO (ou Cancelar).")
                }

                //constroiProfessorModal(objProfessor)
            }
        })


        /*
        async function alterarDesempenho(id, notas) {
            const urlAPIUpdate = `http://localhost/ProjetoFinal/api/performance/${id}`
            try {
                const response = await fetch(urlAPIUpdate, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(notas)
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
                alert("Erro ao atualizar desempenho: ", error)
            }
        }
*/
    </script>

</body>

</html>