<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";  // Coloque seu usuário aqui
$password = "";  // Coloque sua senha aqui
$dbname = "hometec";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para pegar os dados dos clientes
$sql = "SELECT id, nome, email, telefone, endereco, imagem_lavadora FROM clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Cadastrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>

    <h1>Clientes Cadastrados</h1>
    
    <?php
    // Verificar se há resultados
    if ($result->num_rows > 0) {
        // Exibir os dados dos clientes em uma tabela
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Imagem Lavadora</th>
                </tr>";

        // Loop para exibir cada cliente
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nome"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["telefone"] . "</td>
                    <td>" . $row["endereco"] . "</td>
                    <td><img src='" . $row["imagem_lavadora"] . "' alt='Imagem Lavadora'></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Não há clientes cadastrados.</p>";
    }

    // Fechar conexão
    $conn->close();
    ?>

</body>
</html>
