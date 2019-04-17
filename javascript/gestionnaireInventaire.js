let addBtn = document.getElementById("add");
let editBtn = document.getElementById("edit");
let deleteBtn = document.getElementById("delete");

let cancelBtn = document.getElementsByClassName("cancel-btn default");

let openedModal;

let modals_container = document.getElementById("modals-window");

let addModal = document.getElementById("modal-add");
let editModal = document.getElementById("modal-edit");
let deleteModal = document.getElementById("modal-delete");

addBtn.addEventListener("click", function(){openModal(this.id);});
editBtn.addEventListener("click", function(){openModal(this.id);});
deleteBtn.addEventListener("click", function(){openModal(this.id);});

for(let i = 0; i < cancelBtn.length; i++)
{
    cancelBtn[i].addEventListener("click", function(){closeModals();});
}

modals_container.addEventListener("click", function(){

    let min_x = openedModal.offsetLeft;
    let max_x = openedModal.offsetLeft + openedModal.offsetWidth;
    let min_y = openedModal.offsetTop;
    let max_y = openedModal.offsetTop + openedModal.offsetHeight;

    let x = event.clientX;
    let y = event.clientY;

    if((x < min_x || x > max_x) || (y < min_y || y > max_y))
    {
        closeModals();
        modals_container.classList.toggle("open", false);

    }

})

function openModal(btnId){
    switch(btnId){
        case "add":
            closeModals();
            showModal(addModal);
            break;
        case "edit":
            closeModals();
            showModal(editModal);
            break;
        case "delete":
            closeModals();
            showModal(deleteModal);
            break;
    }
    modals_container.classList.toggle("open", true);
}


function closeModals(){
    addModal.classList.toggle("open", false);
    editModal.classList.toggle("open", false);
    deleteModal.classList.toggle("open", false);
}

function showModal(m){
    m.classList.toggle("open", true);
    openedModal = m;
}
