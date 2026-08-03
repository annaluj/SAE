<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    include("conexao.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $senha = $_POST['senha'];

        if (empty($email) || empty($senha)) {
            die("Por favor, preencha todos os campos.");
        }

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conn, $sql);

        if (!$resultado) {
            die("Erro na consulta: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($resultado) == 1) {
            $usuario = mysqli_fetch_assoc($resultado);

            if (password_verify($senha, $usuario['senha_hash'])) {
    
                $_SESSION['usuario_id'] = $usuario['usuario_id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                header("Location: pagina-principal.php");
                exit();

            } else {
                echo "<h3>Senha incorreta!</h3>";
                echo "<a href='login.html'>Tentar novamente</a>";
            }
        } else {
            echo "<h3>E-mail incorreto!</h3>";
            echo "<a href='login.html'>Tentar novamente</a>";
        }

    } else {
        header("Location: login.html");
        exit();
    }
?>