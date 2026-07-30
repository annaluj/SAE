<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

include("conexao.php");
$usuario_id = $_SESSION['usuario_id'];
$sql_agendamentos = "SELECT * FROM agendamentos WHERE usuario_id = '$usuario_id' ORDER BY data_consulta ASC, horario_consulta ASC";
$resultado_agendamentos = mysqli_query($conn, $sql_agendamentos);
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
            <a href="agendar.php"><button type="button">Agendar agora</button></a>
        </div>

        <div class="card">
            <h2>Meus agendamentos</h2>
            
            <?php if (mysqli_num_rows($resultado_agendamentos) > 0): ?>
                <ul style="list-style: none; padding: 0; text-align: left;">
                    <?php while ($agendamento = mysqli_fetch_assoc($resultado_agendamentos)): ?>
                        <?php 
                            $data_formatada = date('d/m/Y', strtotime($agendamento['data_consulta']));
                            $hora_formatada = date('H:i', strtotime($agendamento['horario_consulta']));
                        ?>
                        <li style="margin-bottom: 10px; padding: 8px; background-color: #f0f4f8; border-radius: 6px; border-left: 4px solid #0056b3;">
                            📅 <strong>Data:</strong> <?php echo $data_formatada; ?><br>
                            ⏰ <strong>Horário:</strong> <?php echo $hora_formatada; ?><br>
                            📌 <strong>Status:</strong> Aguardando confirmação
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Você ainda não possui atendimentos marcados.</p>
            <?php endif; ?>
        </div>

        <div class="card">
            <h2>Meu Perfil</h2>
            <p>Confira ou atualize suas informações</p>
            <button type="button">Conferir</button>
            <button type="button">Atualizar</button>
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
