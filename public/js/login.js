async function login() {
    event.preventDefault();
    
    let matricula = document.forms["loginForm"]["txtMatricula"].value
    let senha = document.forms["loginForm"]["txtPassword"].value
    const data = {matricula, senha}

    const urlAPILogin = 'http://localhost/ProjetoFinal/api/login'
    const urlAPIDashDirector = 'http://localhost/ProjetoFinal/src/Views/diretor/dashboard.php'
    const urlAPIDashStudent = 'http://localhost/ProjetoFinal/src/Views/aluno/dashboard.php'
    const urlAPIDashTeacher = 'http://localhost/ProjetoFinal/src/Views/professor/dashboard.php'

    try {
        const resposta = await fetch(urlAPILogin, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })

        if (!resposta.ok) {
            let mensagemErro = `Erro retornado: ${resposta.status}`
            const retornoServidor = await resposta.json()
            console.log("Retorno: ", retornoServidor)
            alert(retornoServidor.error)
            document.getElementById('loginForm').reset()
        }

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

