<?php $pageTitle='Iniciar de Sesión | PancraTwitter'?>
<?php require_once('backend/shared/header.php'); ?>

<body>
    <section class="sign-container">
        <?php require_once('backend/shared/sign_nav.php'); ?>
        <div class="form-container">
            <div class="form-content">
                <div class="header-form-content">
                    <h2>Inicia Sesión con tus Datos</h2>
                </div>
                <form action="sign.php" class="formfield">

                    <div class="form-group">
                        <label for="username">Usuario o Email</label>
                        <input type="text" name="username" id="username" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" id="pass" required autocomplete="off">
                    </div>
                    <div class="s-password">
                        <input type="checkbox" id="s-password" class="form-checkbox" onclick="showLoginPass()">
                        <span class="checkmark"></span>
                        <label for="s-password">Mostrar Contraseña</label>
                    </div>
                    <div class="form-btn-wrapper">
                        <button type="submit" class="btn-form">Iniciar Sesión</button>
                        <input type="checkbox" class="form-checkbox" name="remember" id="check">
                        <span class="checkmark"></span>
                        <label for="check">Recordar Usuario</label>
                    </div>

                </form>
            </div>
            <footer class="form-footer">
                <p>¿No tienes una cuenta? <a href="signup">Regístrate Aquí</a></p>
            </footer>
        </div>
        <div class="margin-bottom-div"></div>
    </section>

    <script src="frontend\assets\js\showPassword.js"></script>
</body>

</html>