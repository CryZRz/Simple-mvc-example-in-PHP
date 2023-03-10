<?php
$titlePage = "Inicio";
require_once(realpath(__DIR__ . '/includes/header.php'));
?>
<div>
    <div class="header-bg-container">
        <section class="header-bg-section-title">
            <h1>Una sencilla aplicacion de tareas</h1>
            <h3>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas,
                quaerat! Non ipsum itaque temporibus numquam placeat odit
                delectus dignissimos, est voluptates assumenda nostrum repellat iure,
                eius perspiciatis fugiat tempora? Cumque.
            </h3>
        </section>
        <section class="header-bg-section-image">

        </section>
    </div>
    <div class="home-section-about">
        <div class="home-section-about-title">
            <h1>¡Comieza a crear tus tareas!</h1>
        </div>
        <div class="home-section-about-description">
            <h3>
                Crea una cuenta y comienza a crear tus tareas y
                Lorem ipsum dolor sit amet consectetur adipisicing 
                elit. Accusamus, ea mollitia officia debitis 
            </h3>
        </div>
        <div class="home-section-about-cards">
            <a href="index.php?route=/register">
                <div class="card-about-container">
                    <div class="card-about-title">
                        <h3>Registrate</h3>
                    </div>
                    <div class="card-about-image">
                        <img src="./src/public/assets/images/loginIcon.jpg" alt="Login icon">
                    </div>
                    <div class="card-about-go">
                        <a href="index.php?route=/register">Ir</a>
                    </div>
                </div>
            </a>
            <a href="index.php?route=/login">
                <div class="card-about-container">
                    <div class="card-about-title">
                        <h3>Iniciar sesion</h3>
                    </div>
                    <div class="card-about-image">
                        <img src="./src/public/assets/images/registerIcon.jpg" alt="Login icon">
                    </div>
                    <div class="card-about-go">
                        <a href="index.php?route=/login">Ir</a>
                    </div>
                </div>
            </a>
            <a href="index.php?route=/tasks">
                <div class="card-about-container">
                    <div class="card-about-title">
                        <h3>Mis tareas</h3>
                    </div>
                    <div class="card-about-image">
                        <img src="./src/public/assets/images/tasksIcon.jpg" alt="Login icon">
                    </div>
                    <div class="card-about-go">
                        <a href="index.php?route=/tasks">Ir</a>
                    </div>
                </div>
            </a>
            <a href="index.php?route=/profile">
                <div class="card-about-container">
                    <div class="card-about-title">
                        <h3>Mi perfil</h3>
                    </div>
                    <div class="card-about-image">
                        <img src="./src/public/assets/images/profileIcon.jpg" alt="Login icon">
                    </div>
                    <div class="card-about-go">
                        <a href="index.php?route=/profile">Ir</a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="home-section-about-two">
        <section class="home-section-about-two-bg"></section>
        <section class="home-section-about-two-text">
            <h1 class="home-section-about-two-title">Lorem ipsum, dolor sit amet consectetur adipisicing</h1>
            <h3 class="home-section-about-two-description">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam similique 
                voluptates incidunt recusandae quae dolorum reiciendis optio eos ea vel eum 
                sint iure velit et impedit eligendi, cupiditate facilis tempore.
            </h3>
        </section>
    </div>
</div>
<?php
require_once(realpath(__DIR__ . '/includes/footer.php'));
?>