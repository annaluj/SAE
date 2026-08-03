<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

include("conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Sessão expirada. Faça login novamente.']);
    exit();
}

$raw_input = file_get_contents('php://input');
$dados = json_decode($raw_input, true);

if (isset($dados['emocao'])) {
    $emocao =$dados['emocao'];
} elseif (isset($_POST['emocao'])) {
    $emocao =$_POST['emocao'];
}

if ($emocao !== null &&$emocao !== '') {
    $usuario_id =$_SESSION['usuario_id'];
    $emocao_valor = (int)$emocao;

    if ($emocao_valor >= 1 && $emocao_valor <= 5) {$sql = "INSERT INTO registro_emocoes (usuario_id, emocao) VALUES ('$usuario_id', '$emocao_valor')";

        if (mysqli_query($conn,$sql)) {
            echo json_encode(['success' => true, 'message' => 'Emoção registrada com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Valor de emoção inválido (deve ser de 1 a 5).']);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Nenhum dado enviado.',
        'debug' => $raw_input // Mostra o que realmente chegou
    ]);
}
?>