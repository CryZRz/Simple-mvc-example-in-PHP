<?php
use TaskApp\Config\SessionManager;

$titlePage = "Profile";

$get_errs_edit = SessionManager::getSession("errs_edit");
$get_err_task = SessionManager::getSession("err_edit");
$get_task_success = SessionManager::getSession("edit_seccess");

require_once(realpath(__DIR__ . '/includes/header.php'));
?>

<div>
    <?php 
        if (isset($get_err_task)) {
            echo "<strong class='alert-warring'>{$get_err_task}</strong>";
            SessionManager::unsetSession("err_edit");
        }
        if (isset($get_task_success)) {
            echo "<strong class='alert-success'>{$get_task_success}</strong>";
            SessionManager::unsetSession("edit_seccess");
        }
    ?>
</div>

<div class="editprofile-container">
    <form action="index.php?route=/editprofile" method="POST" class="card-editprofile">
        <div class="card-editprofile-section-title">
            <h1>Editar Perfil</h1>
        </div>
        <div class="card-editprofile-section-name">
            <span>Nombre</span>
            <input 
                type="text"
                name="name"
                value="<?php 
                    echo $data_user["name"];
                ?>"
                required
            >
        </div>
        <div class="login-section-form-alert">
            <?php
                if (isset($get_errs_edit["name"])) {
                    echo "<strong>".$get_errs_edit["name"]."</strong>";
                }
            ?>
        </div>
        <div class="card-editprofile-section-lastname">
            <span>Apellidos</span>
            <input 
                type="text"
                name="last_name"
                value="<?php 
                    echo $data_user["last_name"];
                ?>"
                required
            >
        </div>
        <div class="login-section-form-alert">
            <?php
                if (isset($get_errs_edit["last_name"])) {
                    echo "<strong>".$get_errs_edit["last_name"]."</strong>";
                }
            ?>
        </div>
        <div class="card-editprofile-section-email">
            <span>Email</span>
            <input 
                type="email" 
                name="email" 
                value="<?php 
                    echo $data_user["email"];
                ?>"
                required
            >
        </div>
        <div class="login-section-form-alert">
            <?php
                if (isset($get_errs_edit["email"])) {
                    echo "<strong>".$get_errs_edit["email"]."</strong>";
                }
            ?>
        </div>
        <div class="card-editprofile-section-btns">
            <button type="submit">Guardar</submit>
        </div>
    </form>
</div>
<?php
require_once(realpath(__DIR__ . '/includes/footer.php'));
?>