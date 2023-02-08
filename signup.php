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
                <form action="sign.php" class="formfield">

                    <div class="form-group">
                        <label for="firstName">Nombre</label>
                        <input type="text" name="firstName" id="firstName" required autocomplete="off">
                    </div>
                    <div class="form-group">
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
                        <input type="checkbox" id="s-password" class="form-checkbox" >
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
</body>

</html>