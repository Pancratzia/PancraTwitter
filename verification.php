<?php

require_once('backend/initialize.php');
if(isset($_SESSION['userLoggedIn'])){
    $user_id=$_SESSION['userLoggedIn'];
    $user = $loadFromUser->userData($user_id);
    $link = Verify::generateLink();
    $message = "".$user['firstName'].", tu cuenta ha sido creada con éxito y necesita ser verificada. Presiona el siguiente link para verificar tu cuenta: <a href='http://localhost/pancratwitter/verification/$link'>Verificación</a>";
    $subject="[PancraTwitter] Por favor verifica tu cuenta";
    $verify->sendToMail($user['email'], $message, $subject);
}else{
    redirect_to(url_for('index'));
}

?>

<?php $pageTitle='Verifica Tu Cuenta | PancraTwitter'?>
<?php require_once('backend/shared/header.php'); ?>

<body>
    <section class="sign-container">

        <?php require_once('backend/shared/sign_nav.php'); ?>
        <div class="form-container verificationPage">
            <div class="form-content">
                <div class="header-form-content">
                    <h2>Te hemos enviado un email de verificación a <?php echo $user['email'];?>. Sigue los pasos descritos en el correo para verificar tu cuenta</h2>
                </div>
            </div>

        </div>
    </section>

</body>

</html>