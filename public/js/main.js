// Função assíncrona para buscar os diretores
async function carregarDiretores() {
    const urlAPI = 'http://localhost/ProjetoFinal/api/diretor';
    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPI);
        
        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) throw new Error('Erro ao buscar dados da API');

        // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
        const diretores = await resposta.json();

        // 3. Seleciona o corpo da tabela no HTML
        const tbody = document.getElementById('tabela-diretores');
        tbody.innerHTML = ''; // Limpa a tabela antes de preencher

        // 4. Faz um loop no array de diretores e cria as linhas HTML
        diretores.forEach(diretor => {
            const linha = `
                <tr>
                    <td>${diretor.id_diretor}</td>
                    <td>${diretor.matricula}</td>
                    <td>${diretor.nome}</td>
                    <td>${diretor.nivelAcesso}</td>
                </tr>
            `;
            tbody.innerHTML += linha; // Injeta a linha na tabela
        });

    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro);
        alert('Não foi possível carregar a lista de diretores.');
    }
}
// Função assíncrona para buscar as materias
async function carregarMaterias() {
    const urlAPI = 'http://localhost/ProjetoFinal/api/materia';
    try {
        // 1. Faz a requisição assíncrona (espera a resposta do servidor)
        const resposta = await fetch(urlAPI);
        
        // Se a API der erro (ex: 404 ou 500), joga para o bloco catch
        if (!resposta.ok) throw new Error('Erro ao buscar dados da API');

        // 2. Transforma a resposta bruta do servidor em um Objeto/Array Javascript
        const materias = await resposta.json();

        // 3. Seleciona o corpo da tabela no HTML
        const tbody = document.getElementById('tabela-materias');
        tbody.innerHTML = ''; // Limpa a tabela antes de preencher

        // 4. Faz um loop no array de materias e cria as linhas HTML
        materias.forEach(materia => {
            const linha = `
                <tr>
                    <td>${materia.id_materia}</td>
                    <td>${materia.nomeMateria}</td>
                    <td>${materia.nome}</td>
                </tr>
            `
            tbody.innerHTML += linha; // Injeta a linha na tabela
            console.log(linha)
        })
        
    } catch (erro) {
        console.error('Ops! Algo deu errado:', erro);
        alert('Não foi possível carregar a lista de materias.')
    }
}
// Executa a função assim que a página terminar de carregar
document.addEventListener('DOMContentLoaded', carregarDiretores)
document.addEventListener('DOMContentLoaded', carregarMaterias)
