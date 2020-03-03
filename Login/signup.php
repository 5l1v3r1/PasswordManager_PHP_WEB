<?php require '../database.php'?>
<?php 
    //Verifica que los campos no estén vacios
    $message = '';
    if (!empty($_POST['Username'])  && !empty($_POST['Password']) && !empty($_POST['Email'])){
       
            $sql  = "INSERT INTO log_user (log_username, log_email, log_pass) VALUES (:log_username, :log_email, :log_password)";  //Estos datos Values "pueden tener cualquier nombre"
            //Prepara consulta
            $stmt = $conn->prepare($sql);
            //Relacionando variables
            $stmt->bindParam(':log_username',$_POST['Username']);
            $stmt->bindParam(':log_email',$_POST['Email']);
            //Método para cifrar la contraseña
            $passwordCifrado = password_hash($_POST['Password'], PASSWORD_BCRYPT);  //En la base de datos el password debe tener más de 75 caracteres
            $stmt->bindParam(':log_password', $passwordCifrado);


        if ($stmt->execute()) {
            $message = 'Successfully created new user';
        }else{
            $message = 'Sorry there moust have been an issue creating your account';
        }
    }
?>
    

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SingUp</title>
     <!-- Fuentes desde Google Fonts-->
     <link href="https://fonts.googleapis.com/css?family=Girassol&display=swap" rel="stylesheet">
    <!-- Llamando al CSS-->
    <link rel="stylesheet" href="../Assets/CSS/log.css">
</head>
<body>
    <?php require '../Partials/header.php' ?>

    <!--Si $message no está vació , mostrará el texto dentro de message -->
    <?php if (!empty($message)): ?>
        <p> <?= $message ?></p>
    <?php endif;  ?>


    <h1>Registry "SingUP"</h1>
    <span> or <a href="login.php">Login</a></span>

    <!-- Formulario para registrarse -->
    <form action="signup.php" method= "POST">
        <input type="text"      name="Username"  placeholder="Enter Your Username">
        <input type="email"     name="Email"     placeholder="Enter Your Email">
        <input type="password"  name="Password"  placeholder="Enter your Password">
        <input type="submit"    value="Submit">
    </form> 
</body>
</html>