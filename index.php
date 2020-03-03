<?php 
    session_start();
    require 'database.php';
    //Verifica la existencia de la variable
    if (isset($_SESSION['user_id'])) {
        //Se consutará a la base de datos
        $records = $conn->prepare('SELECT log_id, log_username, log_pass FROM log_user WHERE log_id = :ids');
        //Vinculando
        $records->bindParam(':ids', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        

       # $user = null;

        if (count($results) > 0) {
            $user = $results;
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- UTF-16 para que acepte caracteres especiales -->
    <meta charset="utf-8">
    <!-- Nombre de pestaña-->
    <title>Document</title>
    <!-- Fuentes desde Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Girassol&display=swap" rel="stylesheet">
    <!-- Llamando al CSS-->
    <link rel="stylesheet" href="Assets/CSS/log.css">
</head>
<body>
    <?php require 'Partials/header.php' ?>



    <?php if (!empty($user)): ?>
        <br> Welcome <?= $user['log_username'] ?>
        <br> You are Sucessfully Loging in 
        <a href="/Password_Manager/Login/logout.php"> 
        Logout
        </a>
    <?php else:?>
        <h1>Password Manager</h1>
        <h2>Please Login o SignUp</h2>

        <!-- Texto con Hipervinculo para Loggearse o Crear cuenta nueva -->
        <a href="Login/login.php">Login</a> or 
        <a href="Login/signup.php">Signup</a>
    <?php endif; ?>

</body>
</html>