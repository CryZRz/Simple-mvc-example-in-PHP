<?php
$titlePage = "Profile";

$id = $find_task["id"];
$title = $find_task["title"];
$created_at = $find_task["created_at"];
$finished = $task["finished"] == 1 ? "Terminada" : "Pendiente";
$description = $find_task["description"];

require_once(realpath(__DIR__ . '/includes/header.php'));
?>
<div class="list-tasks-container">
    <div class='task-card-container' style="width: 90%;">
        <div class='task-card-section-title'>
            <h3>
                Titulo: <?php echo $title?>
            </h3>
            <span>Fecha: <?php echo $created_at?></span>
            <div>
                <span id='status-task' class='task-card-section-state'>Status: <?php echo $finished?></span>
            </div>
        </div>
        <div class='task-card-section-description' style="height: auto; min-height: 300px;">
            <span>
                <?php 
                    echo $description;
                ?>
            </span>
        </div>
        <div class='task-card-section-buttons'>
            <div>
                <a class='btn-remove m-small' href='<?php echo "index.php?route=/deletetask&id={$id}"?>'>
                    Eliminar tarea
                </a>
                <a class='btn-remove m-small' href='<?php echo "index.php?route=/edittask&id={$id}"?>'>
                    Editar tarea
                </a>
            </div>
            <div>
                <button class='btn-remove m-small' id='sendFinished' taskId='<?php echo $id?>'>
                    Finalizar
                </button>
                <button class='btn-remove m-small' id='sendUnFinished' taskId='<?php echo $id?>'>
                    Pendiente
                </button>
            </div>
        </div>
    </div>
</div>
<?php
require_once(realpath(__DIR__ . '/includes/footer.php'));
?>