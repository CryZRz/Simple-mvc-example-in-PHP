<?php
    use TaskApp\Config\SessionManager;
    $titlePage =  $edit_task ? "Ediatr Tarea" : "Crear Tarea";

    require_once(realpath(__DIR__ . '/includes/header.php'));
?>
<div>
    <?php 
        $get_err_task = SessionManager::getSession("err_task");
        if (isset($get_err_task)) {
            echo "<strong class='alert-warring'>{$get_err_task}</strong>";
            SessionManager::unsetSession("err_task");
        }
    ?>
</div>
<div class="create-task-container">
    <form 
        action=<?php 
            if ($edit_task) {
                echo "index.php?route=/edittask&id=".$get_task["id"];
            }else{
                echo "index.php?route=/createtask";
            }
        ?>
        method="post"
        class="create-task-form"
        >
        <div>
            <h1>
                <?php 
                    if ($edit_task) {
                        echo "Ediatr tarea";
                    }else{
                        echo "Crear tarea";
                    }
                ?>
            </h1>
        </div>
        <div>
            <span>Titulo</span>
            <input 
                type="text" 
                placeholder="Ingresa un titulo" 
                value='<?php 
                    if ($edit_task) {
                        echo $get_task["title"];
                    }
                ?>'
                name="title"
                required
            >
        </div>
        <div>
            <span>Descripcion</span>
            <textarea 
                name="description" 
                cols="30" 
                rows="10"
                required
            >
            <?php 
                if ($edit_task) {
                    echo $get_task["description"];
                }
            ?>
            </textarea>
        </div>
        <?php
            if ($edit_task) {
                $id = $get_task["id"];
                echo "<input type='hidden' value='{$id}' name='task_id'>";
            }
        ?>
        <div>
            <button type="submit">
                <?php 
                    if ($edit_task) {
                        echo "Ediatr tarea";
                    }else{
                        echo "Crear tarea";
                    }
                ?>
            </button>
        </div>
    </form>
</div>
<?php
    require_once(realpath(__DIR__ . '/includes/footer.php'));
?>