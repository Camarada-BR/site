<?php
// 1. INCLUSÃO DA CONEXÃO E SEGURANÇA
include 'database.php';
session_start();
$login_page = 'index.php'; // Ajuste conforme seu login

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: " . $login_page);
    exit();
}

// Lista de motivos (usada para o campo select)
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

$id = $name = $age = $gender = $birthdate = $nationality = $occupation = $risk_level = $status = $motive = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
    $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_SPECIAL_CHARS);
    $nationality = filter_input(INPUT_POST, "nationality", FILTER_SANITIZE_SPECIAL_CHARS);
    $occupation = filter_input(INPUT_POST, "occupation", FILTER_SANITIZE_SPECIAL_CHARS);
    $risk_level = filter_input(INPUT_POST, "risk_level", FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_SPECIAL_CHARS);
    $motive = filter_input(INPUT_POST, "motive", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($id) || empty($name) || empty($age)) {
        $error = "Erro: Campos obrigatórios (ID, Nome, Idade) não podem estar vazios.";
    } else {
        $sql = "UPDATE suspects SET name=?, age=?, gender=?, birthdate=?, nationality=?, occupation=?, risk_level=?, status=?, motive=? WHERE id=?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "sisssssssi",
                $name,
                $age,
                $gender,
                $birthdate,
                $nationality,
                $occupation,
                $risk_level,
                $status,
                $motive,
                $id
            );

            if (mysqli_stmt_execute($stmt)) {
                $success = "Registro atualizado com sucesso! 

[Image of a checkmark symbol]
";
                header('location: list.php?success=1');
                exit;
            } else {
                $error = "Erro ao atualizar registro: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Erro na preparação da consulta: " . mysqli_error($conn);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: list.php");
        exit;
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM suspects WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            header("location: list.php?error=notfound");
            exit;
        }

        $name = $row["name"];
        $age = $row["age"];
        $gender = $row["gender"];
        $birthdate = $row["birthdate"];
        $nationality = $row["nationality"];
        $occupation = $row["occupation"];
        $risk_level = $row["risk_level"];
        $status = $row["status"];
        $motivo = $row["motive"];

        mysqli_stmt_close($stmt);
    } else {
        $error = "Erro ao carregar dados: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISM - Editar Suspeito #<?php echo htmlspecialchars($id); ?></title>
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
            <li><a href="#">Visite Nossa Paroquia</a></li>
            <li><a href="#">Saiba Mais</a></li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <?php if (!empty($error)): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php elseif (!empty($success)): ?>
                <div class="alert success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <h2>Atualizar Suspeito (ID: <?php echo htmlspecialchars($id); ?>)</h2>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <div class="form-box">
                    <input type="text" name="name" placeholder="Nome" value="<?php echo htmlspecialchars($name); ?>" required>
                    <input type="number" name="age" placeholder="Idade" value="<?php echo htmlspecialchars($age); ?>" required>

                    <select name="gender" id="Gênero">
                        <option value="">Gênero...</option>
                        <option value="Masculino" <?php if ($gender == 'Masculino') echo 'selected'; ?>>Masculino</option>
                        <option value="Feminino" <?php if ($gender == 'Feminino') echo 'selected'; ?>>Feminino</option>
                    </select>

                    <input type="date" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>">
                    <input type="text" name="nationality" placeholder="Nacionalidade" value="<?php echo htmlspecialchars($nationality); ?>">
                    <input type="text" name="occupation" placeholder="Ocupação" value="<?php echo htmlspecialchars($occupation); ?>">
                </div>

                <div class="form-box">
                    <select name="risk_level" id="risk_level">
                        <option value="">Periculosidade</option>
                        <option value="Baixo" <?php if ($risk_level == 'Baixo') echo 'selected'; ?>>Baixo</option>
                        <option value="Médio" <?php if ($risk_level == 'Médio') echo 'selected'; ?>>Médio</option>
                        <option value="Alto" <?php if ($risk_level == 'Alto') echo 'selected'; ?>>Alto</option>
                        <option value="Crítico" <?php if ($risk_level == 'Crítico') echo 'selected'; ?>>Crítico</option>
                        <option value="Desconhecido" <?php if ($risk_level == 'Desconhecido') echo 'selected'; ?>>Desconhecido</option>
                    </select>

                    <select name="status" id="status">
                        <option value="">Situação atual</option>
                        <option value="Suspeito" <?php if ($status == 'Suspeito') echo 'selected'; ?>>Suspeito</option>
                        <option value="Detido" <?php if ($status == 'Detido') echo 'selected'; ?>>Detido</option>
                        <option value="Procurado" <?php if ($status == 'Procurado') echo 'selected'; ?>>Procurado</option>
                        <option value="Observação" <?php if ($status == 'Observação') echo 'selected'; ?>>Observação</option>
                        <option value="Falecido" <?php if ($status == 'Falecido') echo 'selected'; ?>>Falecido</option>
                        <option value="Desconhecido" <?php if ($status == 'Desconhecido') echo 'selected'; ?>>Desconhecido</option>
                    </select>

                    <select name="motive" id="motivo" required>
                        <option value="">Motivo...</option>
                        <?php foreach ($motivos as $m): ?>
                            <option value="<?= htmlspecialchars($m) ?>"
                                <?php
                                if ($motivo == $m) {
                                    echo 'selected';
                                }
                                ?>>
                                <?= htmlspecialchars($m) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="submit">Atualizar Registro</button>
                <a class="btn-cancel" href="list.php">Cancelar</a>
            </form>
        </div>
    </main>
    <script src="script.js"></script>
</body>

</html>