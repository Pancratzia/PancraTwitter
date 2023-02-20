<?php

require_once('backend/initialize.php');
if(is_post_request()){
    $firstName = formSanitizer::formSanitizerName($_POST['firstName']);
    $lastName = formSanitizer::formSanitizerName($_POST['lastName']);
    $email = formSanitizer::formSanitizerString($_POST['email']);
    $pass = formSanitizer::formSanitizerString($_POST['pass']);
    $cpass = formSanitizer::formSanitizerString($_POST['cpass']);

    $username = $account->generateUsername($firstName, $lastName);
    echo $username;
    
    $account ->register($firstName, $lastName, $username, $email, $pass, $cpass);
}

?>

<?php $pageTitle='SignUp | PancraTwitter'?>
<?php require_once('backend/shared/header.php'); ?>

<body>
    <section class="sign-container">

        <?php require_once('backend/shared/sign_nav.php'); ?>
        <div class="form-container">
            <div class="form-content">
                <div class="header-form-content">
                    <h2>Crea tu cuenta</h2>
                </div>
                <form action="signup.php" class="formfield" method="POST">

                    <div class="form-group">
                        <?php echo $account->getErrorMessage(Constant::$firstNameCharacters)?>
                        <label for="firstName">Nombre</label>
                        <input type="text" name="firstName" id="firstName" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <?php echo $account->getErrorMessage(Constant::$lastNameCharacters)?>
                        <label for="lastName">Apellido</label>
                        <input type="text" name="lastName" id="lastName" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" name="email" id="email" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" id="pass" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="cpass">Confirma tu Contraseña</label>
                        <input type="password" name="cpass" id="cpass" required autocomplete="off">
                    </div>

                    <div class="s-password">
                        <input type="checkbox" id="s-password" class="form-checkbox" onclick="showPassword()">
                        <span class="checkmark"></span>
                        <label for="s-password">Mostrar Contraseña</label>
                    </div>
                    <div class="form-btn-wrapper">
                        <button type="submit" class="btn-form">Registrarse</button>
                        <input type="checkbox" class="form-checkbox" name="remember" id="check">
                        <span class="checkmark"></span>
                        <label for="check">Recordar Usuario</label>
                    </div>

                </form>
            </div>
            <footer class="form-footer">
                <p>¿Ya tienes una cuenta? <a href="login.php">Ingresa Aquí</a></p>
            </footer>
        </div>
        <div class="margin-bottom-div"></div>
    </section>
    <script src="frontend\assets\js\showPassword.js"></script>

</body>

</html>