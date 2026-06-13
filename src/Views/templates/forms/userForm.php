<form id="createForm" name="createForm" class="login-form">
    <h1>Inserir dados</h1>
    <input type="text" id="txtMatricula" placeholder="Matricula">
    <input type="text" name="" id="txtPassword" placeholder="Senha">
    <!-- Dados dos alunos -->
    <div id="studentsClassData" class="invisible createForm">
        <input type="text" id="studentsNameData" placeholder="Nome">
        <input type="text" id="studentsAgeData" placeholder="Idade">
        <input type="text" id="studentsTpData" placeholder="Tipo de ensino" >
        <input type="text" id="studentsAccessData" placeholder="Nivel de acesso">
        <select class="select-form">
            <option value="" disabled selected>Turma</option>
            <option value="1">7ºB</option>
            <option value="2">8ºA</option>
            <option value="2">6ºC</option>
        </select>
    </div>
    <!-- Fim Dados dos alunos -->

    <select class="select-form" onchange="addForms(this)">
        <option value="" disabled selected>Tipo de usuario</option>
        <option value="Aluno">Aluno</option>
        <option value="Professor">Professor</option>
        <option value="Diretor">Diretor</option>
    </select>

    <select class="select-form">
        <option value="" disabled selected>Status da conta</option>
        <option value="1">Ativado</option>
        <option value="0">Desativado</option>
    </select>

    <button id="btnLogin">Criar novo usuário</button>
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