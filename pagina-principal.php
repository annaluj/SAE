<?php
    session_start();

    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link rel="stylesheet" href="pagina-principal.css">
</head>
<body>
    <main class="fundo">
    <header class="inicio">
        <h1>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></h1>
        <p>Bem-vindo ao SAE (serviço de apoio estudantil)</p>
       
        <a href="logout.php" style="color: red; text-decoration: none; font-size: 0.9rem;">Sair da conta</a>
    </header>
   
    <section class="cards">


        <div class="card">
            <h2>Agendar atendimento</h2>
            <p>Escolha um dia e horário disponível para conversar</p>
            <a href="agendar.php"><button>Agendar agora</button></a>
        </div>


        <div class="card">
            <h2>Meus agendamentos</h2>
            <p>Você ainda não possui atendimentos marcados</p>
        </div>


        <div class="card">
            <h2>Meu Perfil</h2>
            <p>Confira ou atualize suas informações</p>
            <button type="button" >Conferir</button>
            <button type="button" >Atualizar</button>
        </div>


        <section class="emojis">
            <h2>Como você está se sentindo hoje?</h2>
            <div class="emojis">
                <button type="button" class="emoji">😁</button>
                <button type="button" class="emoji">🙂</button>
                <button type="button" class="emoji">😐</button>
                <button type="button" class="emoji">😔</button>
                <button type="button" class="emoji">😢</button>
            </div>
            <p id="mensagem"></p>
        </section>
    </section>
    </main>

    <script src="pagina01.js"></script>
</body>
</html>
