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

            <form id="updateComuForm" name="loginForm" class="login-form createform">
                <h1>Alterar comunicado</h1>
                <input type="text" id="updTxtTituloComu" placeholder="Titulo Comunicado">
                <select class="select-form" id="select-turmas">
                    <option value="" disabled selected>Turma</option>
                    <option value="">Loading.....</option>
                </select>
                <select class="select-form" id="urgencia">
                    <option value="" disabled selected>Selecionar urgência</option>
                    <option value="informativo">Informativo</option>
                    <option value="Informativo">Importante</option>
                </select>
                <textarea class="textareaForm" id="updTxtTexto" placeholder="......."></textarea>
                <button id="btnCriar">Alterar comunicado</button>
            </form>

        </div>
    </div>


    <script>
        /*
        const tbody = document.querySelector("#tabela tbody");

        usuarios.forEach(usuario => {
            const tr = document.createElement("tr");

            tr.innerHTML = `
        <td>${usuario.id}</td>
        <td>${usuario.nome}</td>
        <td>${usuario.idade}</td>
        <td>
            <button class="btn-detalhes" data-id="${usuario.id}">
                Detalhes
            </button>
        </td>
    `;

            tbody.appendChild(tr);
        });
*/
        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("btn-detalhes")) {
                const id = Number(e.target.dataset.id)

                console.log("ID BTN: ", id)
                const objComunicado = objComunicadosDashProfessor.find(u => u.id_comunicado === id)
                constroiModal(objComunicado)
            }

            if (e.target === modal) {
                closeModal();
            }
        })

        function constroiModal(data) {
            console.log("ola")
            openModal()
        }

        const modal = document.getElementById("modal");
        const openBtn = document.getElementById("openModal");
        const closeBtn = document.getElementById("closeBtn");

        function openModal() {
            modal.classList.add("show");
        }

        function closeModal() {
            modal.classList.remove("show");
        }

        closeBtn.addEventListener("click", closeModal);
    </script>

</body>

</html>