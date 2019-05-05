let addBtn = document.getElementById("add");
let editBtn = document.getElementById("edit");
let deleteBtn = document.getElementById("deleteBtn");
let cancelDeleteBtn = document.getElementById("cancelDeleteBtn");

let deleteTxt = document.getElementById("deleteTxt");

let body = document.getElementById("body");

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

let addModal = document.getElementById("addModal");
let editModal = document.getElementById("editModal");
let deleteModal = document.getElementById("deleteModal");


//Open the Delete Menu
deleteBtn.addEventListener("click", function() {
   editModal.classList.toggle("show", false);

    //We write which product is about to be deleted.
    deleteTxt.innerText = deleteTxt.innerText.replace("|*|", selected_prod['name']);

    //We set the hiddenValue of the selected item for the delete form.

    let selected_prod_id = $(deleteModal).find("#selected_prod_id")[0];
    selected_prod_id.value = selected_prod['id'];
});

cancelDeleteBtn.addEventListener("click", function () {
    deleteModal.classList.toggle("show", false);
    editModal.classList.toggle("show", true);
    deleteTxt.innerText = deleteTxt.innerText.replace(selected_prod['name'], "|*|");
});

for(let i = 0; i < products_container.childElementCount; i++)
{
    var row = products_container.children[i];

    row.addEventListener("click", function() {

        for(let j = 0; j < products.length; j++)
        {
            if(products[j]["id"] == this.id)
            {
                selected_prod = products[j];
                break;
            }
        }

        //Get the fields to fill
        let selected_prod_id = $(editModal).find("#selected_prod_id")[0];

        selected_prod_id.value = selected_prod['id'];

        let txt_name = $(editModal).find("#product_name")[0];
        let txt_des = $(editModal).find("#product_desc")[0];
        let txt_image = $(editModal).find("#product_image_text")[0];
        let txt_category = $(editModal).find("#product_category")[0];
        let txt_qty = $(editModal).find("#product_qty")[0];
        let txt_price = $(editModal).find("#product_price")[0];
        let check_visible = $(editModal).find("#product_visible")[0];

        let image_input = $(editModal).find("#product_image")[0];

        image_input.addEventListener("change", function(){
           let txt_image = $(editModal).find("#product_image_text")[0];
            txt_image.value = this.value;
        });

        //Fill the fields
        txt_name.value = selected_prod['name'];
        txt_des.value = selected_prod['description'];
        txt_image.value = selected_prod['image_path'];
        txt_category.selectedValue = selected_prod['category'];
        txt_qty.value = selected_prod['quantity'];
        txt_price.value = selected_prod['price'].substr(0, selected_prod['price'].length - 1);
        check_visible.checked = selected_prod['visible'];
    });
}

addBtn.addEventListener("click", function(){
    //openModal(this.id);

    let image_input = $(addModal).find("#product_image")[0];

    image_input.addEventListener("change", function(){
        let txt_image = $(addModal).find("#product_image_text")[0];
        txt_image.value = this.value;
    });

});

//Get all loaded products in the array
for(i = 0; i < products_container.childElementCount; i++)
{
    let element = products_container.children[i];

    let prod = new Product(element.id,
                           element.children[0].innerText,
                           element.children[1].innerText,
                           element.children[2].children[0].getAttribute("src"),
                           element.children[3].innerText,element.children[4].innerText,
                           element.children[5].innerText,element.children[6].children[0].checked
                          );
    products.push(prod);
}


//Product object
function Product(id, name, description, image_path, category, quantity, price, visible)
{
    this.id = id;
    this.name = name;
    this.description = description;
    this.image_path = image_path;
    this.category = category;
    this.quantity = quantity;
    this.price = price;
    this.visible = visible;
}
