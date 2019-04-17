var document;

var addBtn = document.getElementById("add");
var editBtn = document.getElementById("edit");
var deleteBtn = document.getElementById("delete");

var openedModal;

var modals_container = document.getElementById("modals-window");

var addModal = document.getElementById("modal-add");
var editModal = document.getElementById("modal-edit");
var deleteModal = document.getElementById("modal-delete");

addBtn.addEventListener("click", function(){openModal(this.id)});
editBtn.addEventListener("click", function(){openModal(this.id)});
deleteBtn.addEventListener("click", function(){openModal(this.id)});

modals_container.addEventListener("click", function(){

    //modals_container.classList.toggle("open");

    var min_x = openedModal.offsetLeft;
    var max_x = openedModal.offsetLeft + openedModal.offsetWidth;
    var min_y = openedModal.offsetTop;
    var max_y = openedModal.offsetTop + openedModal.offsetHeight;

    var x = event.clientX;
    var y = event.clientY;

    if((x < min_x || x > max_x) || (y < min_y || y > max_y))
    {
        modals_container.classList.toggle("open", false);
    }

})

function openModal(btnId){
    console.log(btnId);
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
