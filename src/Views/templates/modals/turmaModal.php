<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://localhost/ProjetoFinal/public/css/main.css">
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-overlay.show {
            display: block;
        }

        .modal-box {
            background: white;
            width: 90%;
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            position: relative;
        }

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


    <div id="ClassModal" class="modal-overlay">
        <div class="modal-box">
            <button id="closeClassBtn" class="modal-close">×</button>

            <form id="updTurma" name="updTurma" class="login-form createform">
                <h1>Painel de alteracao</h1>
                <hr class="divisor">
                <label for="id-turma">Corrigir nome da turma:</label>
                <input type="hidden" id="id-turma" value="">
                <input type="text" id="nomeTurma" value="" class="input-estilizado">
                
                <label for="select-teachers">Trocar professor:</label>
                <select class="select-form" id="select-teachers">
                </select>
                <button id="btnAlterarTurma" class="botao-salvar">Fazer manutenção</button>
            </form>

        </div>
    </div>


    <script>
        let id_turma = document.getElementById('id-turma')
        let nome_turma = document.getElementById('nomeTurma')
        let btnAlterarTurma = document.getElementById('btnAlterarTurma')
        let selectTurma = document.getElementById('select-teachers')

        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("btnUpdateTurma")) {
                const id = Number(e.target.dataset.id)
                const objTurma = objTurmasDashDiretor.find(u => u.id_turma === id)
                constroiClassModal(objTurma)
            }
        })

        function constroiClassModal(data) {
            nome_turma.value = ''
            selectTurma.innerHTML = ''

            nome_turma.value = data.nomeTurma 
            selectTurma.innerHTML += `<option value="${data.id_professor}">${data.nome}</option>`

            objProfessoresDashDiretor.forEach(p => {
                const option = `<option value="${p.id_professor}">${p.nome}</option>`

                selectTurma.innerHTML += option
            })

            openClassModal()
        }

        const classModal = document.getElementById("ClassModal")
        const openClassBtn = document.getElementById("openClassModal")
        const closeClassBtn = document.getElementById("closeClassBtn")

        function openClassModal() {
            classModal.classList.add("show")
        }

        function closeClassModal() {
            classModal.classList.remove("show")
        }

        closeClassBtn.addEventListener("click", closeClassModal)
    </script>

</body>

</html>