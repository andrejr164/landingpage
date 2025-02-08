<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";  // Coloque seu usuário aqui
$password = "";  // Coloque sua senha aqui
$dbname = "hometec";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter dados do formulário e validar
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email inválido.");
}

// Validar telefone (simplesmente verificando se tem 10 ou 11 dígitos)
if (!preg_match('/^\d{10,11}$/', $telefone)) {
    die("Telefone inválido.");
}

// Processar imagem
$imagem_lavadora = '';
if (isset($_FILES['imagem_lavadora']) && $_FILES['imagem_lavadora']['error'] == 0) {
    $imagem_lavadora = 'uploads/' . basename($_FILES['imagem_lavadora']['name']);
    
    // Verificar se o arquivo é uma imagem (opcional, você pode adicionar mais verificações aqui)
    if (getimagesize($_FILES['imagem_lavadora']['tmp_name'])) {
        move_uploaded_file($_FILES['imagem_lavadora']['tmp_name'], $imagem_lavadora);
    } else {
        die("O arquivo enviado não é uma imagem.");
    }
}

// Usar prepared statement para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO clientes (nome, email, telefone, endereco, imagem_lavadora) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome, $email, $telefone, $endereco, $imagem_lavadora);

// Executar a consulta
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
