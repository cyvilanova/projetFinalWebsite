let addBtn = document.getElementById("add");
let editBtn = document.getElementById("edit");
let deleteBtn = document.getElementById("delete");

let products_container = document.getElementById("products");

//All the loaded products
let products = [];
let selected_prod;

let cancelBtn = document.getElementsByClassName("cancel-btn default");

let openedModal;

//All the select checkboxes
let selectBtn = document.getElementsByClassName("select");

let selected = false;

let modals_container = document.getElementById("modals-window");

let addModal = document.getElementById("modal-add");
let editModal = document.getElementById("modal-edit");
let deleteModal = document.getElementById("modal-delete");

addBtn.addEventListener("click", function(){openModal(this.id);});

editBtn.addEventListener("click", function(){
    if(this.classList.contains("disabled") == false)
    {
        openModal(this.id);

        //Get the fields to fill
        let txt_name = $(editModal).find("#product_name")[0];
        let txt_des = $(editModal).find("#product_desc")[0];
        let txt_image = $(editModal).find("#product_image")[0];
        let txt_category = $(editModal).find("#product_category")[0];
        let txt_qty = $(editModal).find("#product_qty")[0];
        let txt_price = $(editModal).find("#product_price")[0];
        let check_visible = $(editModal).find("#product_visible")[0];

        //Fill the fields
        txt_name.value = selected_prod['name'];
        txt_des.value = selected_prod['description'];
        txt_image.value = selected_prod['image_path'];
        txt_category.selectedValue = selected_prod['category'];
        txt_qty.value = selected_prod['quantity'];
        txt_price.value = selected_prod['price'].substr(0, selected_prod['price'].length - 1);
        check_visible.checked = selected_prod['visible'];
    }
});

deleteBtn.addEventListener("click", function(){openModal(this.id);});

//Get all loaded products in the array
for(let i = 0; i < products_container.childElementCount; i++)
{
    let element = products_container.children[i];
    let product = {
        id: element.id,
        name: element.children[1].innerText,
        description: element.children[2].innerText,
        image_path: element.children[3].children[0].getAttribute("src"),
        category: element.children[4].innerText,
        quantity: element.children[5].innerText,
        price: element.children[6].innerText,
        visible: element.children[7].children[0].checked
    };
    products.push(product);
}


//Makes the cancel buttons close the modals.
for(i = 0; i < cancelBtn.length; i++)
{
    cancelBtn[i].addEventListener("click", function(){closeModals();});
}


//Forces the user to select only 1 product, or none.
for(i = 0; i < selectBtn.length; i++)
{
    selectBtn[i].addEventListener("change", function(){
        if(this.checked == true)
        {
            unselectAll();
            this.checked = true;
            editBtn.classList.toggle("disabled", false);

            for(i = 0; i < products.length; i++)
            {
                if(products[i]["id"] == this.parentNode.parentNode.id)
                {
                    selected_prod = products[i];
                    break;
                }
            }

        }
        else
        {
            unselectAll();
            editBtn.classList.toggle("disabled", true);
        }
    });
}

//Event listener to close the modal when user clicks out of it
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

//Open modal
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

//Closes all the Modals
function closeModals(){
    addModal.classList.toggle("open", false);
    editModal.classList.toggle("open", false);
    deleteModal.classList.toggle("open", false);
}

//Toggles on the selected modal
function showModal(m){
    m.classList.toggle("open", true);
    openedModal = m;
}


//Uncheck all products in the table
function unselectAll(){
    for(i = 0; i < selectBtn.length; i++)
    {
        selectBtn[i].checked = false;
    }
}
