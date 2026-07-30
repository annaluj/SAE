const menu = document.getElementById("menu");
const sidebar = document.getElementById("sidebar");
const contato = document.getElementById("contato");
const telefone = document.getElementById("telefone");
const fechar = document.getElementById("fechar");
const emojis = document.querySelectorAll(".emoji");
const mensagem = document.getElementById("mensagem");

if(menu && sidebar){
    menu.addEventListener("click", function(){
        sidebar.classList.toggle("abrir");
    });
}

if(contato && telefone){
    contato.addEventListener("click", function(event){
        event.preventDefault();
        telefone.classList.toggle("mostrar");
    });
}

if(fechar && sidebar){
    fechar.addEventListener("click",function(){
        sidebar.classList.remove("abrir");
    });
}

if(emojis.length > 0 && mensagem){
    emojis.forEach((emoji) => {
        emoji.addEventListener("click", () => {

            emojis.forEach(e => {
                e.classList.remove("ativo");
            });

            emoji.classList.add("ativo");

            mensagem.textContent = "✅ Emoção registrada com sucesso!";
            mensagem.classList.add("mostrar");

            setTimeout(() => {
                mensagem.classList.remove("mostrar");
                mensagem.textContent = "";
            }, 3000);
        });
    });
}