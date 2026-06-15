async function logout() {
    event.preventDefault();
    const urlAPILogout = 'http://localhost/ProjetoFinal/api/logout'
    const urlAPiHome = 'http://localhost/ProjetoFinal/'
    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPILogout, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })

        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) {
            throw new Error('Erro ao buscar dados da API')
        } else {
            window.location.href = urlAPiHome
        }
    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro);
    }
}
document.getElementById("btnLogout").addEventListener("click", logout)