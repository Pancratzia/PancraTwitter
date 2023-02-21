<?php

require_once('backend/initialize.php');
if(is_post_request()){
    $firstName = formSanitizer::formSanitizerName($_POST['firstName']);
    $lastName = formSanitizer::formSanitizerName($_POST['lastName']);
    $email = formSanitizer::formSanitizerString($_POST['email']);
    $pass = formSanitizer::formSanitizerString($_POST['pass']);
    $cpass = formSanitizer::formSanitizerString($_POST['cpass']);

    $username = $account->generateUsername($firstName, $lastName);
    
    $success = $account ->register($firstName, $lastName, $username, $email, $pass, $cpass);
    if($success){
        session_regenerate_id();
        $_SESSION['userLoggedIn'] = $success;
        if(isset($_POST['remember'])){
            $_SESSION['rememberMe'] = $_POST['remember'];
        }
        redirect_to(url_for('verification'));
    }
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
                        <label for="firstName">Nombre</label>
                        <input type="text" name="firstName" value="<?php getInputValue("firstName")?>" id="firstName" required autocomplete="off">
                        <?php echo $account->getErrorMessage(Constant::$firstNameCharacters)?>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Apellido</label>
                        <input type="text" name="lastName" value="<?php getInputValue("lastName")?>"  id="lastName" required autocomplete="off">
                        <?php echo $account->getErrorMessage(Constant::$lastNameCharacters)?>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" name="email" id="email" required autocomplete="off" value="<?php getInputValue("email")?>" >
                        <?php echo $account->getErrorMessage(Constant::$emailInUse)?>
                        <?php echo $account->getErrorMessage(Constant::$emailInvalid)?>
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" id="pass" required autocomplete="off">
                        <?php echo $account->getErrorMessage(Constant::$passNotMatch)?>
                        <?php echo $account->getErrorMessage(Constant::$passwordNotAlphanumeric)?>
                        <?php echo $account->getErrorMessage(Constant::$passwordLength)?>
                    </div>
                    <div class="form-group">
                        <label for="cpass">Confirma tu Contraseña</label>
                        <input type="password" name="cpass" id="cpass" required autocomplete="off">
                        <?php echo $account->getErrorMessage(Constant::$passNotMatch)?>
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