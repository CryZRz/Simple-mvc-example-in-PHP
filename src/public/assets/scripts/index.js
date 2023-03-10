const getButtonFinished = document.querySelectorAll("#sendFinished");
const getButtonUnFinished = document.querySelectorAll("#sendUnFinished");
const getStatusTask = document.querySelectorAll("#status-task")
const loadder = document.getElementById("loding-mode")

const getBtnNavBarRes = document.getElementById("showNavBarRes")
const getNavBarRes = document.getElementById("navbar-rs")

let showNavBarRes = false

async function sendFinished(id, value, index){
    try {
        const formData = new FormData();
        formData.append("taskId", id);
        formData.append("finished", value);
        loadder.style.display = "flex"
        const requestFinished = await fetch(`index.php?route=/finishedtask`,{
            method: "POST",
            body:formData
        })
        const requestFinishedJson = await requestFinished.json()
        alert(requestFinishedJson.message)
        getStatusTask[index].innerHTML = value == 0 ? "Status: Pendiente" : "Status: Terminada"
        loadder.style.display = "none"
    } catch (e) {
        console.log(e)
        alert("error al actualizar")
        loadder.style.display = "none"
    }
}

getButtonFinished.forEach((b, i) => {
    b.addEventListener("click", e => {
        const idTask = e.target.attributes.taskid.value
        if (idTask == undefined || idTask == null) {
            return alert("No hay un id para marcar la tarea")
        }else{
            sendFinished(idTask, 1, i)
        }
    })
})

getButtonUnFinished.forEach((b, i) => {
    b.addEventListener("click", e => {
        const idTask = e.target.attributes.taskid.value
        if (idTask == undefined || idTask == null) {
            return alert("No hay un id para marcar la tarea")
        }else{
            sendFinished(idTask, 0, i)
        }
    })
})


getBtnNavBarRes.addEventListener("click", e => {
    if (!showNavBarRes) {
        getNavBarRes.style.display = "block"
        showNavBarRes = true
    }else{
        getNavBarRes.style.display = "none"
        showNavBarRes = false
    }
    
})