<?php
    use TaskApp\Config\SessionManager;

    $titlePage = "Mis tareas";
    require_once(realpath(__DIR__ . '/includes/header.php'));
?>
<div class="tasks-container">
<div class="alerts-tasks-container">
    <?php 
        $get_succes_task = SessionManager::getSession("task_success");
        $get_delete_task = SessionManager::getSession("delete_task");

        if (isset($get_succes_task)) {
            echo "<strong class='alert-success'>{$get_succes_task}</strong>";
            SessionManager::unsetSession("task_success");
        }
        if (isset($get_delete_task)) {
            echo "<strong class='alert-success'>{$get_delete_task}</strong>";
            SessionManager::unsetSession("delete_task");
        }
    ?>
</div>
<div class="list-tasks-container">
    <?php 
        if (count($list_tasks) > 0) {
            foreach ($list_tasks as $task) {
                $id = $task["id"];
                $title = substr($task["title"], 0, 35);
                $title_points = strlen($task["title"]) > 35 ? "..." : "";
                $description = substr($task["description"], 0, 485);
                $desc_points = strlen($task["description"]) > 485 ? "..." : "";
                $created_at = $task["created_at"];
                $finished = $task["finished"] == 1 ? "Terminada" : "Pendiente";
                echo "<div class='task-card-container'>
                    <div class='task-card-section-title'>
                        <h3>Titulo: {$title}{$title_points}</h3>
                        <span>Fecha: {$created_at}</span>
                        <div>
                            <span id='status-task' class='task-card-section-state'>Status: {$finished}</span>
                        </div>
                    </div>
                    <div class='task-card-section-description'>
                        <span>{$description}{$desc_points}</span>
                    </div>
                    <div class='task-card-section-buttons'>
                        <div>
                            <a class='btn-remove m-small' href='index.php?route=/deletetask&id={$id}'>Eliminar tarea</a>
                            <a class='btn-remove m-small' href='index.php?route=/edittask&id={$id}'>Editar tarea</a>
                        </div>
                        <div>
                            <button class='btn-remove m-small' id='sendFinished' taskId={$id}>Finalizar</button>
                            <button class='btn-remove m-small' id='sendUnFinished' taskId={$id}>Pendiente</button>
                        </div>
                    </div>
                    <div class='task-card-section-button-view'>
                        <a class='btn-success' href='index.php?route=/task&id={$id}'>Ver tarea</a>
                    </div>
                </div>";
            }
        }else{
            echo "<h1>No tienes tareas :(</h1>";
        }
    ?>
</div>
</div>
<?php
    require_once(realpath(__DIR__ . '/includes/footer.php'));
?>