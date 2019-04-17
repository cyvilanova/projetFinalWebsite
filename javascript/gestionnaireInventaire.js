var document;

var addBtn = document.getElementById("add");
var editBtn = document.getElementById("edit");
var deleteBtn = document.getElementById("delete");

var addModal = document.getElementById("modal-add");
var editModal = document.getElementById("modal-edit");
var deleteModal = document.getElementById("modal-delete");

addBtn.addEventListener("click", function(){openModal(this.id)});
editBtn.addEventListener("click", function(){openModal(this.id)});
deleteBtn.addEventListener("click", function(){openModal(this.id)});

function openModal(btnId){
    console.log(btnId);
    switch(btnId){
        case "add":
            addModal.classList.toggle("open", true);
            editModal.classList.toggle("open", false);
            deleteModal.classList.toggle("open", false);
            break;
        case "edit":
            editModal.classList.toggle("open", true);
            addModal.classList.toggle("open", false);
            deleteModal.classList.toggle("open", false);
            break;
        case "delete":
            deleteModal.classList.toggle("open", true);
            addModal.classList.toggle("open", false);
            editModal.classList.toggle("open", false);
            break;
    }
}
