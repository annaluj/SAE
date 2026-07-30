const formConsulta = document.getElementById("formConsulta");

if (formConsulta) {
    formConsulta.addEventListener("submit", function(event){
        event.preventDefault();

        const dados = {
            nome: document.getElementById("nome").value,
            data: document.getElementById("data").value,
            hora: document.getElementById("hora").value
        };

        fetch("processar_agendamento.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(dados)
        })
        .then(resposta => resposta.json())
        .then(resultado => {
            if (resultado.status === "sucesso") {
                alert("✅ " + resultado.mensagem + "\n\nAtenção: nossa equipe irá conferir se esse horário está disponível.");
                
                window.location.href = "pagina-principal.php";
            } else {
                alert("⚠️ " + resultado.mensagem);
            }
        })
        .catch(erro => {
            console.error("Erro no envio:", erro);
            alert("❌ Erro ao enviar o agendamento. Verifique sua conexão.");
        });
    });
}
