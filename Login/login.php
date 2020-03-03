<?php 
    require '../database.php'; 
    session_start();

    // Verifica si los datos ingresados no estén vacíos
    if (!empty($_POST['vuser']) && !empty($_POST['vpass'])){
        $record = $conn->prepare('SELECT log_id, log_username, log_pass FROM log_user WHERE log_username=:user');
        // Relacionado Variable
        $record->bindParam(':user',$_POST['vuser']);
        //Ejecutando
        $record->execute();
        $results = $record->fetch(PDO::FETCH_ASSOC);
        $message = '';
        //$message = 'se insertaron datos';
            if (count($results) > 0 && password_verify($_POST['vpass'], $results['log_pass'])) {
                $_SESSION['user_id'] = $results['log_id'];
                header("Location: /Password_Manager");
                $message = 'Se ingresó correctamente';
            } else {
                $message = 'Sorry, those credentials do not match';
            }

    } else {
        $message = '';
    }

?>
<!DOCTYPE html>
<head>
    <!-- UTF-16, para aceptar Caracteres Especiales-->
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/CSS/log.css">
</head>
<body>
    <div>
        <?php require '../Partials/header.php' ?>
        
        <?php   if (!empty($message)): ?>
        <p> <?= $message ?> </p>           
        <?php endif; ?>

        
        <h1>login</h1>
        <span> or <a href="signup.php">SingUp</a></span>
        <!-- Formulario que llevará a está misma página && se envíará mediante el método post -->
        <!-- El mormulario es creado para identificar  -->

        <form action="login.php" method="POST">
            <!-- Se insertará Text ,  el ID es v_user -->
            <input type="text"      name="vuser"            placeholder= "Enter your Username">   <!-- TextField para Usuario -->
            <input type="password"  name="vpass"       placeholder= "Enter your Password">   <!-- TextField para Contraseña -->
            <input type="submit"    value="Submit">    
        </form>
    </div>
</body>
</html>