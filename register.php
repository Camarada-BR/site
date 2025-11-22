<?php

include 'database.php'; 

// ----------------------------------------------------------------------
// 🔐 BLOCO DE REGISTRO 
// ----------------------------------------------------------------------
if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT); 

    $checkSql = "SELECT email FROM users WHERE email = ?";
    $stmt_check = mysqli_prepare($conn, $checkSql);
    
    mysqli_stmt_bind_param($stmt_check, "s", $email); 
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if($result_check->num_rows > 0) {
        echo "Email já cadastrado!";
        mysqli_stmt_close($stmt_check); 
        exit();
    }

    mysqli_stmt_close($stmt_check);

    $insertSql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"; 
    $stmt_insert = mysqli_prepare($conn, $insertSql);
    
    mysqli_stmt_bind_param($stmt_insert, "sss", $username, $email, $password_hash);
    
    if(mysqli_stmt_execute($stmt_insert)) {
        header("location: main.php");
        exit();
    } else {
        echo "Erro ao registrar: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt_insert);
}

// ----------------------------------------------------------------------
// 🔑 BLOCO DE LOGIN 
// ----------------------------------------------------------------------
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $senha_digitada = $_POST['password'];

    $sql = "SELECT password, email FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $hash_armazenado = $row['password'];

        if(password_verify($senha_digitada, $hash_armazenado)){
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: main.php");
            exit();
        } else {
            echo "Not Found, Incorrect Email or Password";
        }
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
    
    mysqli_stmt_close($stmt);
}

?>