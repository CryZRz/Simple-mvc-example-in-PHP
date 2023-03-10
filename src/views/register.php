<?php
    use TaskApp\Config\SessionManager;

    $errors_register = new SessionManager();
    $get_errs_register = $errors_register->getSession("errs_login");
    $errors_register->unsetSession("errs_login");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/public/assets/styles/utilitis.css">
    <link rel="stylesheet" href="./src/public/assets/styles/register.css">
    <title>Registrar</title>
</head>
<body>
    <div class="register-container">
        <section class="register-section-form">
            <form class="register-form" action="index.php?route=/register" method="POST">
                <div>
                    <div class="register-section-form-title">
                        <h1>Register</h1>
                    </div>
                    <div class="register-section-form-name">
                        <span>Nombre</span>
                        <input type="text" required placeholder="Name" name="name">
                    </div>
                    <div class="register-section-form-alert">
                        <?php
                            if (isset($get_errs_register["name"])) {
                                echo "<strong>".$get_errs_register["name"]."</strong>";
                            }
                        ?>
                    </div>
                    <div class="register-section-form-btn-lastname">
                        <span>Apellido</span>
                        <input type="text" required placeholder="LastName" name="last_name">
                    </div>
                    <div class="register-section-form-alert">
                        <?php
                            if (isset($get_errs_register["last_name"])) {
                                echo "<strong>".$get_errs_register["last_name"]."</strong>";
                            }
                        ?>
                    </div>
                    <div class="register-section-form-btn-email">
                        <span>Email</span>
                        <input type="email" required placeholder="Email" name="email">
                    </div>
                    <div class="register-section-form-alert">
                        <?php
                            if (isset($get_errs_register["email"])) {
                                echo "<strong>".$get_errs_register["email"]."</strong>";
                            }
                        ?>
                    </div>
                    <div class="register-section-form-password">
                        <span>Password</span>
                        <input type="password" required placeholder="Password" name="password">
                    </div>
                    <div class="register-section-form-alert">
                        <?php
                            if (isset($get_errs_register["password"])) {
                                echo "<strong>".$get_errs_register["password"]."</strong>";
                            }
                        ?>
                    </div>
                    <div class="register-section-form-btn-login">
                        <button type="submit">Registrar</button>
                    </div>
                    <div class="register-section-form-btn-register">
                        <a href="index.php?route=/login">Iniciar sesion</a>
                    </div>
                </div>
            </form>
        </section>
        <section class="register-section-image-bg">
        </section>
    </div>
</body>
</html>