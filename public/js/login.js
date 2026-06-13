/*
const form = document.getElementById('loginForm')

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o recarregamento da página

    // Aqui você pode pegar os dados e enviá-los via AJAX/Fetch
    console.log('Formulário enviado sem refresh!')
    login()
})*/

async function login() {
    event.preventDefault();
    /*
    let matr = document.forms["loginForm"]["txtMatricula"].value
    let pass = document.forms["loginForm"]["txtPassword"].value
    console.log("Matricula", matr)
    console.log("Senha", pass)
    */
    const data = {matricula : "D4545", senha: "iasASDADbdaisud"} //Diretor
    //const data = {matricula : "P23232", senha: "3sdada3333iasASDADbdaisud"} //Professor
    //const data = {matricula : "A3445", senha: "iasbdaisud"} //Aluno

    const urlAPILogin = 'http://localhost/ProjetoFinal/api/login'
    const urlAPIDashDirector = 'http://localhost/ProjetoFinal/src/Views/diretor/dashboard.php'
    const urlAPIDashStudent = 'http://localhost/ProjetoFinal/src/Views/aluno/dashboard.php'
    const urlAPIDashTeacher = 'http://localhost/ProjetoFinal/src/Views/professor/dashboard.php'

    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPILogin, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        
        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) throw new Error('Erro ao buscar dados da API');

        // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
        const acessarDashboard = await resposta.json();
        switch (acessarDashboard.redirect) {
            case "Diretor":
                window.location.href = urlAPIDashDirector
                break
            case "Aluno":
                window.location.href = urlAPIDashStudent
                break
            case "Professor":
                window.location.href = urlAPIDashTeacher 
        }

    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro);
    }
        
}

document.getElementById("btnLogin").addEventListener("click", login)

