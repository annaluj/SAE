const formConsulta = document.getElementById("formConsulta");
const mensagemConsulta = document.getElementById("mensagemConsulta");
const aviso = document.getElementById("aviso");

formConsulta.addEventListener("submit", function(event){
    event.preventDefault();

    const dados = {
        nome: document.getElementById("nome").value,
        data: document.getElementById("data").value,
        hora: document.getElementById("hora").value
    };

    fetch("agendar.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(dados)
    })
    .then(resposta => resposta.json())
    .then(resultado => {
        aviso.textContent = "Atenção: nossa equipe irá conferir se esse horário está disponível. Se não estiver, entraremos em contato para reagendar.";
        mensagemConsulta.textContent = resultado.mensagem;
    });
});