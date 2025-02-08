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

// Consultar os dados da tabela de clientes
$sql = "SELECT id, nome, email, telefone, endereco, imagem_lavadora FROM clientes";
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Exibir os dados
    echo "<h1>Clientes Cadastrados</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Imagem Lavadora</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["telefone"] . "</td>
                <td>" . $row["endereco"] . "</td>
                <td><img src='" . $row["imagem_lavadora"] . "' alt='Imagem Lavadora' width='100'></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum cliente encontrado.";
}

// Fechar conexão
$conn->close();
?>
