
const descForm = document.querySelector('.desc-form')
const myBtns = document.querySelector('.my-btns');
const errorMessage = document.querySelector('.error')
const remTime = document.querySelector('.remTime');
const notice = document.querySelector('.noticeBoard')

const completed = document.querySelector('.completed-list')

document.getElementById('tiimer_date').valueAsDate = new Date();
document.getElementById('tiimer_date').setAttribute("readonly", "true");
document.getElementById('tiimer_startTime').setAttribute("readonly", "true");
document.getElementById('tiimer_endTime').setAttribute("readonly", "true");


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




myBtns.addEventListener('click',(e)=>{
    if(e.target.classList.contains('start')){
        if(workDuration !== '0' && workDuration !==''){
                if(shortDesc !== ''){
                    myIntervals();
                    disabling();
                    console.log(1)
                    myBtns.children[1].classList.remove('d-none')
                    myBtns.children[2].classList.add('d-none')
                    const checkCurrtime = new moment();
                    // currentTime = checkCurrtime.toLocaleTimeString('es-ES', { timeZone: 'Europe/Madrid' });
                    currentTime = checkCurrtime.format("HH:mm:ss");
                }
                else{
                errorMessage.classList.remove('d-none')
                }

        }
        else{
            errorMessage.classList.remove('d-none')
        }
            
        }
    else if(e.target.classList.contains('pause')){
        clearInterval(timer1);
        clearInterval(timer2)
        myBtns.children[1].classList.add('d-none')
        myBtns.children[0].classList.remove('d-none')
    }
    else if(e.target.classList.contains('resume')){
        myIntervals();
        myBtns.children[0].classList.add('d-none')
        myBtns.children[1].classList.remove('d-none')
    }
    else if(e.target.classList.contains('stop')){
        myBtns.children[0].classList.add('d-none')
        myBtns.children[1].classList.add('d-none')
        myBtns.children[2].classList.remove('d-none')

        const checkEndtime = new moment();
        // EndTime = checkEndtime.toLocaleTimeString('es-ES', { hour12: true });
        EndTime = checkEndtime.format("HH:mm:ss");

        document.querySelector(".popup").style.display = "block";
        document.getElementById("tiimer_startTime").value = currentTime;
        document.getElementById("tiimer_endTime").value = EndTime;
        document.getElementById("tiimer_description").value = shortDesc;


        let html = `
        <div class="item my-4">
            <h5 class="px-4 mb-2 pt-3" style="color: green;">${shortDesc}</h5>
            <p class="px-4 fw-normal">${sessionTime()}</p>
        </div>     `
        completed.innerHTML += html
        clearAll();
    }

})




//fucntion, which is for showing the remaining time to user
let timeReamaining = () =>{
    seconds = seconds - 1;
    if(seconds === 0){
        workMinutes = workMinutes - 1;
        if(workMinutes === -1){
        //     if(breakcount % 2 === 0){
        //         workMinutes = breakMinutes;
        //         breakcount = breakcount + 1;
        //         notice.innerText = `(Break Time)`
        //
        //     }else{
        //         width = 1;
        //         workMinutes = workDuration - 1;
        //         breakcount = breakcount + 1;
        //         notice.innerText = ' ';
        //
        // }
            myBtns.children[0].classList.add('d-none')
            myBtns.children[1].classList.add('d-none')
            myBtns.children[2].classList.remove('d-none')

            const checkEndtime = new moment();
            // EndTime = checkEndtime.toLocaleTimeString('es-ES', { timeZone: 'Europe/Madrid' });
            EndTime = checkEndtime.format("HH:mm:ss");

            document.querySelector(".popup").style.display = "block";
            document.getElementById("tiimer_startTime").value = currentTime;
            document.getElementById("tiimer_endTime").value = EndTime;
            document.getElementById("tiimer_description").value = shortDesc;


            let html = `
        <div class="item my-4">
            <h5 class="px-4 mb-2 pt-3" style="color: green;">${shortDesc}</h5>
            <p class="px-4 fw-normal">${sessionTime()}</p>
        </div>     `
            completed.innerHTML += html
            clearAll();
    }
        seconds = 60;
    }
//Here we are rendring the change in time on the timer screen       
let time = `${workMinutes<10? `0${workMinutes}`:workMinutes}:${seconds<10? `0${seconds}`:seconds}`
remTime.innerText = time;
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
    notice.textContent = '';
    width = 1

}

//fuction to show the starting and ending time 
let sessionTime = () =>{
    return `Session was started at ${currentTime} and ended at ${EndTime}`
}


//Add item checkbox
// function addItem(){
//     var ul = document.getElementById('ul');
//     var label = document.createElement('label');
//
//     var text = document.getElementById('texto');
//
//     var checkbox = document.createElement('input');
//     checkbox.type = "checkbox";
//     checkbox.value = 1;
//     checkbox.name = text.value;
//
//     label.appendChild(checkbox);
//
//     label.appendChild(document.createTextNode(text.value));
//     ul.appendChild(label);
// }
// var button = document.getElementById('btn');
// button.onclick = addItem



