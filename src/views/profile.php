<?php 
$titlePage = "Profile";

require_once(realpath(__DIR__ . '/includes/header.php'));
?>
<div class="profile-container">
    <div class="card-profile">
        <div class="card-profile-section-title">
            <h1>Perfil</h1>
        </div>
        <div class="card-profile-section-name">
            <?php 
                echo "<h3>Nombre: ".$data_user["name"]."</h3>"
            ?> 
        </div>
        <div class="card-profile-section-lastname">
            <?php 
                echo "<h3>Apellidos: ".$data_user["last_name"]."</h3>"
            ?>
        </div>
        <div class="card-profile-section-email">
            <?php 
                echo "<h3>Email: ".$data_user["email"]."</h3>"
            ?>
        </div>
        <div class="card-profile-section-btns">
            <a href="index.php?route=/editprofile">Editar</a>
        </div>
    </div>
</div>
<?php
require_once(realpath(__DIR__ . '/includes/footer.php'));
?>