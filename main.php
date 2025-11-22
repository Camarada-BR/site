<?php

include 'database.php'; 

session_start();
$login_page = 'index.php'; 

if (!isset($_SESSION['email'])) {
    header("Location: " . $login_page);
    exit();
}

?>

<?php
$motivos = [
    'Amizade Inimiga Pública',
    'Apoio a Inimigo',
    'Assassinato Político',
    'Ataque Químico',
    'Ataques a Figuras Públicas',
    'Bioterrorismo',
    'Coleta Ilícita de Dados',
    'Colaboração Estrangeira',
    'Conluio com Setor Privado',
    'Contrabando Estratégico',
    'Corrupção Pública',
    'Crime Econômico Estratégico',
    'Deserção em Tempo de Guerra',
    'Desinformação Organizada',
    'Desobediência Civil Organizada',
    'Divulgação de Segredos Estatais',
    'Espionagem',
    'Espionagem Interna',
    'Evasão de Sanções',
    'Facilitação Logística',
    'Falsificação de Documentos',
    'Financiamento do Terrorismo',
    'Greve Ilegal em Setores Críticos',
    'Hacker por Contratação',
    'Hoarding Estratégico',
    'Incitamento à Violência',
    'Insurreição Armada',
    'Interpretação Pública de Normas',
    'Intrusão Cibernética',
    'Lavagem de Dinheiro',
    'Manipulação Eleitoral',
    'Malware Estatal',
    'Milícias Privadas',
    'Monopólio Crítico Ilegal',
    'Obstrução de Justiça',
    'Peculato',
    'Produção Nuclear Ilegal',
    'Propaganda Hostil',
    'Recusa de Obediência Militar',
    'Recrutamento Insurgente',
    'Refúgio a Subversivos',
    'Roubo de Recursos Nacionais',
    'Sabotagem de Infraestrutura',
    'Subversão Política',
    'Terrorismo',
    'Terrorismo Cibernético',
    'Tentativa de Golpe',
    'Traição',
    'Tráfico de Armas',
    'Tráfico de Informação Secreta',
    'Uso de Meios Financeiros para Desestabilizar',
    'Uso Ilegal de Vigilância',
    'Violação de Controles de Exportação',
    'Violação de Sigilo Judicial'
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISM</title>
    <link rel="stylesheet" href="mainCopia.css">
</head>

<body>

    <header>
        <h1>Sistema Integrado de Segurança e Monitoramento (SISM)</h1>

    </header>

    <nav class="navbar">
        <ul>
            <li><a href="main.php">Cadastrar</a></li>
            <li><a href="list.php">Ver Lista</a></li>
            <li><a href="">Visite Nossa Paroquia</a></li>
            <li><a href="">Saiba Mais</a></li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div class="form-box">
                    <input type="text" name="name" placeholder="Nome" required>
                    <input type="number" name="age" placeholder="Idade" required>

                    <select name="gender" id="Gênero">
                        <option value="">Gênero...</option>
                        <option value="Marculino">Marculino</option>
                        <option value="Feminino">Feminino</option>          
                    </select>      

                    <input type="date" name="birthdate">
                    <input type="text" name="nationality" placeholder="Nacionalidade">
                    <input type="text" name="occupation" placeholder="Ocupação">

                </div>

                <div class="form-box">
                    <select name="risk_level" id="risk_level">
                        <option value="">Periculosidade</option>
                        <option value="Baixo">Baixo</option>
                        <option value="Médio">Médio</option>
                        <option value="Alto">Alto</option>
                        <option value="Crítico">Crítico</option>
                        <option value="Desconhecido">Desconhecido</option>
                    </select>

                    <select name="status" id="status">
                        <option value="">Situação atual</option>
                        <option value="Suspeito">Suspeito</option>
                        <option value="Detido">Detido</option>
                        <option value="Procurado">Procurado</option>
                        <option value="Observação">Observação</option>
                        <option value="Falecido">Falecido</option>
                        <option value="Desconhecido">Desconhecido</option>
                    </select>

                    <select name="motivo" id="motivo" required>
                        <option value="">Motivo...</option>
                        <?php foreach ($motivos as $motivo): ?>
                            <option value="<?= htmlspecialchars($motivo) ?>"><?= htmlspecialchars($motivo) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="login">Registrar</button>
            </form>
        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_SPECIAL_CHARS);
    $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_SPECIAL_CHARS);
    $nationality = filter_input(INPUT_POST, "nationality", FILTER_SANITIZE_SPECIAL_CHARS);
    $occupation = filter_input(INPUT_POST, "occupation", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($name)) {
        echo "Por favor, seu nome.";
    } elseif (empty($age)) {
        echo "Por favor, sua senha.";
    } else {
        $sql = "INSERT INTO suspects (name, age, birthdate, nationality, occupation) 
                VALUES ('$name', '$age', '$birthdate', '$nationality', '$occupation')";
        mysqli_query($conn, $sql);
        echo "Registro realizado com sucesso!";
    }
}

mysqli_close($conn);

?>