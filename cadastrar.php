<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("conexao.php");


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $senha = $_POST['senha'];
        
        $rua = mysqli_real_escape_string($conn, $_POST['rua']);
        $cep = mysqli_real_escape_string($conn, $_POST['cep']);
        $numero = mysqli_real_escape_string($conn, $_POST['numero']);
        $bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
        $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);

        if (empty($nome) || empty($email) || empty($senha)) {
            die("Por favor, preencha todos os campos obrigatórios (Nome, Email e Senha).");
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql_verificar = "SELECT usuario_id FROM usuarios WHERE email = '$email'";
        $resultado_verificar = mysqli_query($conn, $sql_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            die("Este e-mail já está cadastrado! Tente outro.");
        }

        $sql_inserir = "INSERT INTO usuarios (nome, email, senha_hash, rua, cep, numero_casa, bairro, cidade) 
                        VALUES ('$nome', '$email', '$senha_hash', '$rua', '$cep', '$numero', '$bairro', '$cidade')";

        if (mysqli_query($conn, $sql_inserir)) {
            echo "<h3>Cadastro realizado com sucesso!</h3>";
            echo "<a href='login.html'>Clique aqui para fazer login</a>"; 
        } else {
            echo "Erro ao cadastrar no banco de dados: " . mysqli_error($conn);
        }
    } else {
        header("Location: cadastro.html");
        exit();
    }
?>