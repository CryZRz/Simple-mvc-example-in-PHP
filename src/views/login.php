<?php
    use TaskApp\Config\SessionManager;
    
    $session = new SessionManager();
    $get_errs_login = $session->getSession("err_login");
    $session->unsetSession("err_login");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/public/assets/styles/utilitis.css">
    <link rel="stylesheet" href="./src/public/assets/styles/login.css">
    <title>Iniciar sesion</title>
</head>
<body>
    <div class="login-container">
        <section class="login-section-form">
            <form class="login-form" action="index.php?route=/login" method="post">
                <div>
                    <div class="login-section-form-title">
                        <h1>Login</h1>
                    </div>
                    <div class="login-section-form-email">
                        <span>Email</span>
                        <input type="email" required placeholder="Ingresa tu email" name="email">
                    </div>
                    <div class="login-section-form-password">
                        <span>Password</span>
                        <input type="password" required placeholder="Ingresa tu contraseña" name="password">
                    </div>
                    <div class="login-section-form-alert">
                        <?php
                            if (isset($get_errs_login)) {
                                echo "<strong class='alert-login'>{$get_errs_login}</strong>";
                            }
                        ?>
                    </div>
                    <div class="login-section-form-btn-login">
                        <button type="submit">Ingresar</button>
                    </div>
                    <div class="login-section-form-btn-register">
                        <a href="index.php?route=/register">Registrate</a>
                    </div>
                </div>
            </form>
        </section>
        <section class="login-section-image-bg"></section>
    </div>
</body>
</html>