<form id="CreateComuForm" name="loginForm" class="login-form">
    <h1>Criar novo comunicado</h1>
    <input type="text" id="txtTituloComu" placeholder="Titulo Comunicado">
    <select class="select-form" id="select-turmas">
        <option value="" disabled selected>Turma</option>
        <option value="">Loading.....</option>
    </select>
    <select class="select-form" id="urgencia">
        <option value="" disabled selected>Selecionar urgência</option>
        <option value="informativo">Informativo</option>
        <option value="Informativo">Importante</option>
    </select>
    <textarea class="textareaForm" id="txtTexto" placeholder="......."></textarea>
    <button id="btnCriar">Criar</button>
</form>