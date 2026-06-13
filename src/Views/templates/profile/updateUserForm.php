<div class="card-perfil">
    <div class="perfil-info">
        <h2 class="perfil-nome">João Silva</h2>
        <p class="perfil-cargo">Id</p>
        <p class="perfil-cargo">Matricula</p>
        <p class="perfil-cargo">Nivel de acesso</p>
    </div>

    <hr class="divisor">
    <form class="perfil-formulario">
        <label class="campo-label">Nome</label>
        <input type="text" class="input-estilizado" placeholder="Corrigir nome">

        <label class="campo-label">Senha</label>
        <input type="password" class="input-estilizado" placeholder="Digite nova senha">
        <select class="select-estilizado">
            <option value="" disabled>Status conta</option>
            <option value="1">Desativar</option>
            <option value="2" selected>Ativa</option>
        </select>
        <button type="submit" class="botao-salvar">Salvar Alterações</button>
    </form>
</div>