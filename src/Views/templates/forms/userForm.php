<form id="createForm" name="createForm" class="login-form">
    <h1>Inserir dados</h1>
    <input type="text" name="txtNome" id="txtNome" placeholder="Nome">
    <input type="text" name="txtMatricula" id="txtMatriculaUsuario" placeholder="Matricula">
    <input type="text" name="txtPassword" id="txtPassword" placeholder="Senha">
    <!-- Dados dos alunos -->
    <div id="studentsClassData" class="invisible createForm">
        <input type="text" id="studentsAgeData" placeholder="Idade">
        <select class="select-form" id="studentsTpData">
            <option value="" disabled selected>Tipo de ensino</option>
            <option value="Ensino médio">Ensino médio</option>
            <option value="Ensino médio">Ensino fundamental</option>
        </select>        
        <select class="select-form" id="select-turmas">
            <option value="" disabled selected>Turma</option>
            <option value="">Loading.....</option>
        </select>
    </div>
    <!-- Fim Dados dos alunos -->

    <select class="select-form" onchange="addForms(this)" id="select-tipo">
        <option value="" disabled selected>Tipo de usuario</option>
        <option value="Aluno">Aluno</option>
        <option value="Professor">Professor</option>
        <option value="Diretor">Diretor</option>
    </select>

    <select class="select-form" id="select-statusConta">
        <option value="" disabled selected>Status da conta</option>
        <option value="1">Ativado</option>
        <option value="0">Desativado</option>
    </select>
    <select class="select-form" id="select-nivel">
        <option value="" disabled selected>Nível usuário</option>
        <option value="1">1 - Basico</option>
        <option value="2">2 - Basico/Elementar</option>
        <option value="3">3 - Intermediário</option>
        <option value="4">4 - Intermediário/Superior</option>
        <option value="5">5 - Avançado</option>
    </select>
    <button id="btnCriar">Criar novo usuário</button>
</form>

<script>
    function addForms(select) {
        const studentsClassData = document.getElementById('studentsClassData')

        if (select.value === 'Aluno') {
            studentsClassData.classList.remove('invisible')
        } else {
            studentsClassData.classList.add('invisible')
        }
    }
</script>