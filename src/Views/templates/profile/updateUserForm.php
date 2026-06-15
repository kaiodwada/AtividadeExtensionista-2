<div class="card-perfil">
    <div class="perfil-info" id="perfilInfo">
        <h2 class="perfil-nome">Loading....</h2>
        <p class="perfil-cargo">Loading....</p>
        <p class="perfil-cargo">Loading....</p>
        <p class="perfil-cargo">Loading....</p>
    </div>

    <hr class="divisor">
    <form id="perfilForm" class="perfil-formulario">
        <input type="hidden" id="idPerfil" value="<?php echo $_SESSION['usuario_escola']['id']; ?>">
        <input type="hidden" id="tipoUsuario" value="<?php echo $_SESSION['usuario_escola']['tipo'] ?>">
        <label class="campo-label">Nome</label>
        <input type="text" class="input-estilizado" placeholder="Corrigir nome">

        <label class="campo-label">Senha</label>
        <input type="password" class="input-estilizado" placeholder="Digite nova senha">
        <select class="select-estilizado" id="select-status">
            <option value="" disabled selected>Status conta</option>
            <option value="0">Desativar</option>
        </select>
        <button type="submit" class="botao-salvar">Salvar Alterações</button>
    </form>
</div>