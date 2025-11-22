<?php 

session_start();
$login_page = 'index.php'; 

if (!isset($_SESSION['email'])) {
    header("Location: " . $login_page);
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISM</title>
    <link rel="stylesheet" href="lista.css">
</head>

<body>

    <header>
        <h1>Sistema Integrado de Segurança e Monitoramento (SISM)</h1>

    </header>

    <nav class="navbar">
        <ul>
            <li><a href= "main.php">Cadastrar</a></li>
            <li><a href= "list.php">Ver Lista</a></li>
        </ul>
    </nav>

    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gênero</th>
                <th>Idade ou Estimativa</th>
                <th>Data de Nascimento</th>
                <th>Nacionalidade</th>
                <th>Ocupação</th>
                <th>Periculosidade</th>
                <th>Status</th>
                <th>Crime</th>
                <th>Data de Registro</th>
                <th>Aditar/Excluir</th>
            </tr>
            <?php
            include 'database.php';

            $sql = "SELECT * FROM suspects";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['age'] ." Anos" . "</td>";
                    echo "<td>" . date("d/m/Y", strtotime($row['birthdate'])) . "</td>";
                    echo "<td>" . $row['nationality'] . "</td>";
                    echo "<td>" . $row['occupation'] . "</td>";
                    echo "<td>" . $row['risk_level'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['motive'] . "</td>";
                    echo "<td>" . date("d/m/Y H:i:s", strtotime($row['reg_data'])) . "</td>";
                    
                    echo "<td>
                            <a class='btn btn-success' href='edit.php?id=$row[id]'>Editar</a>
                            <a class='btn btn-danger' href='delete.php?id=$row[id]'>Deletar</a>
                        </td>";
                        
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No suspects found.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </table>
    </main>
</body>

</html>