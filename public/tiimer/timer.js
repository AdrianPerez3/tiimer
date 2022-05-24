const descForm = document.querySelector('.desc-form')
const myBtns = document.querySelector('.my-btns');
const errorMessage = document.querySelector('.error')
const remTime = document.querySelector('.remTime');
const tiempoTitulo = document.getElementById('tiempo');
const notice = document.querySelector('.noticeBoard')
let liElements = 0;

const completed = document.querySelector('.completed-list')

document.getElementById('tiimer_date').valueAsDate = new Date();
document.getElementById('tiimer_date').setAttribute("readonly", "true");
document.getElementById('tiimer_startTime').setAttribute("readonly", "true");
document.getElementById('tiimer_endTime').setAttribute("readonly", "true");
document.getElementById('tiimer_checked').setAttribute("readonly", "true");
document.getElementById('tiimer_unchecked').setAttribute("readonly", "true");


let workDuration = descForm.workTime.value;
let shortDesc = descForm.shortDesc.value;
let timeRatio_of_progress = ((workDuration * 60)/100) * 1000;

descForm.workTime.addEventListener('keyup',e=>{
    errorMessage.classList.add('d-none')
    workDuration = e.target.value;
    workMinutes = workDuration - 1;
    timeRatio_of_progress = ((workDuration * 60)/100) * 1000;
   
})

descForm.shortDesc.addEventListener('keyup',e=>{
    errorMessage.classList.add('d-none')
    shortDesc = e.target.value;    
})



//Variables
let workMinutes  = workDuration -1;
let timer1 = undefined
let timer2 = undefined
let breakcount = 0;
let seconds = 60;
let currentTime = undefined;
let EndTime = undefined;
let width = 0;




myBtns.addEventListener('click',async (e) => {
    if (e.target.classList.contains('start')) {
        if (workDuration !== '0' && workDuration !== '') {
            if (shortDesc !== '') {
                myIntervals();
                disabling();
                myBtns.children[1].classList.remove('d-none')
                myBtns.children[2].classList.add('d-none')
                const checkCurrtime = new moment();
                // currentTime = checkCurrtime.toLocaleTimeString('es-ES', { timeZone: 'Europe/Madrid' });
                currentTime = checkCurrtime.format("HH:mm:ss");
            } else {
                errorMessage.classList.remove('d-none')
            }

        } else {
            errorMessage.classList.remove('d-none')
        }

    } else if (e.target.classList.contains('pause')) {
        clearInterval(timer1);
        clearInterval(timer2)
        myBtns.children[1].classList.add('d-none')
        myBtns.children[0].classList.remove('d-none')
    } else if (e.target.classList.contains('resume')) {
        myIntervals();
        myBtns.children[0].classList.add('d-none')
        myBtns.children[1].classList.remove('d-none')
    } else if (e.target.classList.contains('stop')&& workDuration > 0) {
        myBtns.children[0].classList.add('d-none')
        myBtns.children[1].classList.add('d-none')
        myBtns.children[2].classList.remove('d-none')



        document.getElementById('tasks').innerHTML = "";

        const checkEndtime = new moment();
        // EndTime = checkEndtime.toLocaleTimeString('es-ES', { hour12: true });
        EndTime = checkEndtime.format("HH:mm:ss");

        if (document.querySelectorAll('input[type="checkbox"]').length > 0){
            clearAll();

            const {value: formValues} = await Swal.fire({
                title: 'Select you objectives',
                html:'<ol>' +  document.getElementById('tasksForm').innerHTML + '</ol>',
                focusConfirm: false,


            })
            checked = document.querySelectorAll('input[type="checkbox"]:checked').length;
            unchecked = document.querySelectorAll('input[type="checkbox"]').length - liElements -1;


        }




        document.querySelector(".popup").style.display = "block";
        document.getElementById("tiimer_startTime").value = currentTime;
        document.getElementById("tiimer_endTime").value = EndTime;
        document.getElementById("tiimer_description").value = shortDesc;
        document.getElementById("tiimer_checked").value = checked;
        document.getElementById("tiimer_unchecked").value = unchecked;


        clearAll();
    }

})




//fucntion, which is for showing the remaining time to user
let timeReamaining = async () => {
    seconds = seconds - 1;
    if (seconds === 0) {
        workMinutes = workMinutes - 1;
        if (workMinutes === -1) {
            myBtns.children[0].classList.add('d-none')
            myBtns.children[1].classList.add('d-none')
            myBtns.children[2].classList.remove('d-none')



            const checkEndtime = new moment();
            // EndTime = checkEndtime.toLocaleTimeString('es-ES', { timeZone: 'Europe/Madrid' });
            EndTime = checkEndtime.format("HH:mm:ss");

            if (document.querySelectorAll('input[type="checkbox"]').length > 0){
                clearAll();

                const {value: formValues} = await Swal.fire({
                    title: 'Select you objectives',
                    html:'<ol>' +  document.getElementById('tasksForm').innerHTML + '</ol>',
                    focusConfirm: false,


                })
                checked = document.querySelectorAll('input[type="checkbox"]:checked').length;
                unchecked = document.querySelectorAll('input[type="checkbox"]').length - liElements -1;

            }


            document.querySelector(".popup").style.display = "block";
            document.getElementById("tiimer_startTime").value = currentTime;
            document.getElementById("tiimer_endTime").value = EndTime;
            document.getElementById("tiimer_description").value = shortDesc;
            document.getElementById("tiimer_checked").value = checked;
            document.getElementById("tiimer_unchecked").value = unchecked;

            clearAll();
        }
        seconds = 59;
    }
//Here we are rendring the change in time on the timer screen       
    let time = `${workMinutes < 10 ? `0${workMinutes}` : workMinutes}:${seconds < 10 ? `0${seconds}` : seconds}`
    remTime.innerText = time;
    tiempoTitulo.innerText = time;
}


const progressBar1 = document.querySelector('.p1')
const progressBar2 = document.querySelector('.p2')
let increaseProgress = () =>{
    if(width === 100){
        progressBar1.style.width = 1 + '%'
        progressBar2.style.width = 1 + '%'
    }else{
        width ++;
        progressBar1.style.width = width + '%';
        progressBar2.style.width = width + '%';
    
    }
    
}

//fucntion to start time intervals
let myIntervals = () =>{
    timer1 = setInterval(timeReamaining,1000);
    timer2 = setInterval(increaseProgress,timeRatio_of_progress)
}

let disabling = () =>{
   descForm.workTime.disabled = true
   descForm.shortDesc.disabled = true
}
let enabling = () =>{
    descForm.workTime.disabled = false;
    descForm.shortDesc.disabled = false;
    descForm.reset();
}

//function to reset all values
let clearAll = () =>{
    enabling();
    clearInterval(timer1)
    clearInterval(timer2)
    workMinutes = workDuration - 1;
    seconds = 60;
    shortDesc = ''
    progressBar1.style.width = 1 + '%'
    progressBar2.style.width = 1 + '%'
    remTime.textContent = `00:00`
    tiempoTitulo.textContent = '00:00'
    notice.textContent = '';
    width = 1

}

//fuction to show the starting and ending time 
let sessionTime = () =>{
    return `Session was started at ${currentTime} and ended at ${EndTime}`
}


//Task Functionality


const addTaskBtn = document.getElementById('add-task-btn')
const addTaskForm = document.getElementById('task-form')
const cancelBtn = document.getElementById('cancel')
const taskNameInput = document.getElementById('text')
const saveBtn = document.getElementById('save')
const tasksList = document.getElementById('tasks')
const tasksListForm = document.getElementById('tasksForm')
const template = document.getElementById('list-item-template')
const templateForm = document.getElementById('list-item-template-form')
const selectedTask = document.getElementById('selected-task')
let tasks = []
let selectedTaskElement

var checked = 0;
var unchecked = 0;

// show/hide task form
addTaskBtn.addEventListener('click', () => {
    addTaskForm.classList.toggle('hide')
})

// cancel task and close task form
cancelBtn.addEventListener('click', () => {
    taskNameInput.value = ""
    addTaskForm.classList.add('hide')
})

// save task and add to the task object to the array and list
saveBtn.addEventListener('click', e => {
    e.preventDefault()

    // get the inputs
    const taskName = taskNameInput.value

    // don't add task if a form element is blank or estimated pomodoros is <=0
    if (taskName === "") return

    // create new object
    const newTask = {
        name: taskName,
        complete: false,
        id: new Date().valueOf().toString()
    }
    // add task to array
    tasks.push(newTask)

    // render task
    addTask(newTask)

    // clear inputs
    taskNameInput.value = ""
})

// event listener for the list item, checkbox and delete button
document.addEventListener('click', e => {
    // if a delete button is selected
    if(e.target.matches('.delete-btn')) {
        // find the list item associaited with the delete button and remove it
        const listItem = e.target.closest('.list-item')
        const listItemForm = e.target.closest('.list-item-form')
        listItem.remove()
        listItemForm.remove()

        // find the id of the task to remove the task object from the array
        const taskId = listItem.dataset.taskId
        tasks = tasks.filter(task => task.id !== taskId )

        // remove title when selected task is deleted
        if (listItem === selectedTaskElement) {
            selectedTask.innerHTML = ""
        }
    }
    // if a list item is selected
    if(e.target.matches('.list-item')) {
        // set the task as the selected element and put title in selected-task div
        selectedTaskElement = e.target
    }
    // checked = document.querySelectorAll('input[type="checkbox"]:checked').length;
    // unchecked = document.querySelectorAll('input[type="checkbox"]').length;




    // if a checkbox is selected
    if(e.target.matches('input[type=checkbox]')) {
        // ge the list item and the id of the item
        const listItem = e.target.closest('.list-item')
        // const taskId = listItem.dataset.taskId
        // find the task object in the array
        // const checkedTask = tasks.find(task => task.id === taskId)
        // if set to true, change to false, and if set to false, set to true
        // if(checkedTask.complete) checkedTask.complete = false
        // else if(!checkedTask.complete)checkedTask.complete = true
    }
})

// add task as list item
function addTask(task) {
    const templateClone = template.content.cloneNode(true)
    const templateCloneForm = templateForm.content.cloneNode(true)
    const listItem = templateClone.querySelector('.list-item')
    const listItemForm = templateCloneForm.querySelector('.list-item-form')
    listItem.dataset.taskId = task.id
    listItemForm.dataset.taskId = task.id

    const taskName = templateClone.querySelector('.task-name')
    const taskNameForm = templateCloneForm.querySelector('.task-name-form')

    taskName.innerHTML = task.name
    taskNameForm.innerHTML = task.name

    tasksList.appendChild(templateClone)
    tasksListForm.appendChild(templateCloneForm)
    liElements = document.getElementById("tasks").getElementsByTagName("li").length;


}







