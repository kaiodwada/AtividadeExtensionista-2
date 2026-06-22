<?php
$statusDaConta = $_SESSION['usuario_escola']['status_atividade'];
$statusAtual = 'Vazio';

if ($statusDaConta === 1) {
    $statusAtual = 'Ativado';
} else {
    $statusAtual = 'Desativado';
}
?>

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
        <input type="hidden" id="tipoUsuario" value="<?php echo $_SESSION['usuario_escola']['tipo']; ?>">
        <input type="hidden" id="matrUsuario" value="<?php echo $_SESSION['usuario_escola']['matr']; ?>">
        <label class="campo-label">Nome</label>
        <input type="text" class="input-estilizado" id="updName" value="" disabled>

        <label class="campo-label">Senha</label>
        <input type="password" class="input-estilizado" id="updPass1" placeholder="Digite senha para alterar">

        <label class="campo-label">Nova senha</label>
        <input type="password" class="input-estilizado" id="updPass2" placeholder="Repita a senha">

        <label class="campo-label">Status da conta:</label>
        <select class="select-estilizado" id="select-status">
            <option value="<?php echo $statusDaConta; ?>" disabled selected>
                <?php
                echo $statusAtual;
                ?></option>
        </select>
        <button id="btnUpdPerfil" type="submit" class="botao-salvar">Salvar Alterações</button>
    </form>
</div>

<script>
    let btnUpdate = document.getElementById('btnUpdPerfil')

    btnUpdate.addEventListener("click", (e) => {
        e.preventDefault()
        let senha_hash = null
        let updPass1 = document.getElementById('updPass1').value.trim()
        let updPass2 = document.getElementById('updPass2').value.trim()
        let tipo = document.getElementById('tipoUsuario').value
        let id = document.getElementById('idPerfil').value

        if (updPass1 === '' || updPass2 === '') {
            alert('Ambos os campos de senha devem ser preenchidos!')
        } else if (updPass1.length >= 8) {
            alert('A senha deve ter no máximo 8 caracteres!')
        } else if (updPass1 !== updPass2) {
            alert('As senhas não coincidem!')
        } else {
            alert('Senhas válidas e iguais.')
            senha_hash = updPass2
        }

        const data = {
            senha_hash,
            id,
            tipo
        }
        alterarPerfil(data).then( retorno =>{
            alert(retorno.message)
            updPass1.value = ''
            updPass2.value = ''
        }).catch(erro => {
            alert("Erro: ", erro)
        })
    })

    async function alterarPerfil(data) {
        const urlAPIUpdate = `http://localhost/ProjetoFinal/api/meuPerfil/${data.id}`

        try {
            const response = await fetch(urlAPIUpdate, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })

            if (!response.ok) {
                let mensagemErro = `Erro retornado: ${response.status}`
                const retornoServidor = await response.json()
                console.log("Retorno: ", retornoServidor)
                alert(retornoServidor.error)
            }
            const updateOK = await response.json()
            return updateOK
        } catch (error) {
            alert('Problema ao atualizar: ', error)
        }
    }
</script>