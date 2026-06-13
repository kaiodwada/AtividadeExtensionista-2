<div class="card-perfil">
    <div class="perfil-info">
        <h2 class="perfil-nome">João Silva</h2>
        <p class="perfil-cargo">Matricula</p>
        <p class="perfil-cargo">Idade</p>
        <p class="perfil-cargo">Tipo de ensino</p>
        <p class="perfil-cargo">Nivel de acesso</p>
        <p class="perfil-cargo">Turma</p>
    </div>

    <hr class="divisor">
    <form class="perfil-formulario">
        <label class="campo-label">Nome</label>
        <input type="text" class="input-estilizado" placeholder="Corrigir nome">

        <label class="campo-label">Senha</label>
        <input type="password" class="input-estilizado" placeholder="Digite nova senha">
        <button type="submit" class="botao-salvar">Salvar Alterações</button>
    </form>
</div>

<style>
    /* Container Principal do Card */
    .card-perfil {
        width: 350px;
        padding: 25px;
        background: #ffffff;
        border: 2px solid #000000;
        border-radius: 12px;
        /* Mantém a identidade da sombra rígida vermelha */
        box-shadow: 5px 5px 0px #ff2a2a;
        margin: 20px auto;
        box-sizing: border-box;
        font-family: sans-serif;
    }

    /* Informações do Usuário */
    .perfil-nome {
        margin: 0 0 5px 0;
        font-size: 22px;
        color: #1a1a1a;
    }

    .perfil-cargo {
        margin: 0;
        font-size: 14px;
        color: #777777;
    }

    .divisor {
        border: 0;
        border-top: 1px dashed #dddddd;
        margin: 20px 0;
    }

    /* Labels dos Campos */
    .campo-label {
        display: block;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        color: #333333;
        margin-bottom: 6px;
    }

    /* Estilização dos Inputs (Select e Textarea) */
    .select-estilizado,
    .textarea-estilizado {
        width: 100%;
        padding: 10px 12px;
        font-size: 15px;
        color: #557a95;
        background: #ffffff;
        border: 1px solid #000000;
        border-radius: 8px;
        box-shadow: 3px 3px 0px #ff2a2a;
        outline: none;
        margin-bottom: 18px;
        display: block;
    }

    .input-estilizado,
    .select-estilizado,
    .textarea-estilizado {
        width: 90%;
        padding: 10px 12px;
        font-size: 15px;
        color: #557a95;
        background: #ffffff;
        border: 1px solid #000000;
        border-radius: 8px;
        box-shadow: 3px 3px 0px #ff2a2a;
        /* Sombra igual ao print */
        outline: none;
        margin-bottom: 18px;
        display: block;
    }

    .textarea-estilizado {
        height: 80px;
        resize: vertical;
    }

    /* Botão de Ação seguindo o mesmo estilo */
    .botao-salvar {
        width: 100%;
        padding: 12px;
        font-size: 15px;
        font-weight: bold;
        color: #ffffff;
        background-color: #000000;
        border: 1px solid #000000;
        border-radius: 8px;
        box-shadow: 3px 3px 0px #ff2a2a;
        cursor: pointer;
        transition: transform 0.1s;
    }

    .botao-salvar:active {
        transform: translate(2px, 2px);
        box-shadow: 1px 1px 0px #ff2a2a;
    }

    /* Classes de Controle do JavaScript */
    .escondido {
        display: none;
    }
</style>

<script>
    function verificarOpcao(select) {
        const campoExtra = document.getElementById('campo-extra');
        if (select.value === 'outro') {
            campoExtra.classList.remove('escondido');
        } else {
            campoExtra.classList.add('escondido');
        }
    }
</script>