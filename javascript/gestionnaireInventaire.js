let addBtn = document.getElementById("add");    //Button to open the Add Modal
let deleteBtn = document.getElementById("deleteBtn");   //Button to open the Delete Modal
let cancelDeleteBtn = document.getElementById("cancelDeleteBtn"); //Cancel button in the delete Modal.

//The text in the delete modal.
let deleteTxt = document.getElementById("deleteTxt");

//The table body
let products_container = document.getElementById("products");

//All the loaded products
let products = [];

//Product currently selected
let selected_prod;

//Modals
let addModal = document.getElementById("addModal");
let editModal = document.getElementById("editModal");
let deleteModal = document.getElementById("deleteModal");


//Open the Delete Menu
deleteBtn.addEventListener("click", function() {
    //Hide the edit modal
    editModal.classList.toggle("show", false);

    //We write which product is about to be deleted.
    deleteTxt.innerText = deleteTxt.innerText.replace("|*|", selected_prod['name']);

    //We set the hiddenValue of the selected item for the delete form.
    let selected_prod_id = $(deleteModal).find("#selected_prod_id")[0];
    selected_prod_id.value = selected_prod['id'];

});

//Click event when clicking cancel in the delete form
cancelDeleteBtn.addEventListener("click", function () {

    //Close the delete Modal
    deleteModal.classList.toggle("show", false);

    //Show the edit modal
    editModal.classList.toggle("show", true);

    //Set the text, in the delete modal, back to the placeholder |*|
    deleteTxt.innerText = deleteTxt.innerText.replace(selected_prod['name'], "|*|");
});

//Loop to add click event handler to each table row. Opens the edit modal.
for(let i = 0; i < products_container.childElementCount; i++)
{
    var row = products_container.children[i];

    //Click event handler for each row
    row.addEventListener("click", function() {

        //Loop to set the selected_prod
        for(let j = 0; j < products.length; j++)
        {
            if(products[j]["id"] == this.id)
            {
                selected_prod = products[j];
                break;
            }
        }

        //Open the edit modal
        openEdit();
    });
}


//Open edit modal with the product's data
function openEdit()
{
        //Get the fields to fill
        let selected_prod_id = $(editModal).find("#selected_prod_id")[0];
        let txt_name = $(editModal).find("#product_name")[0];
        let txt_des = $(editModal).find("#product_desc")[0];
        let txt_image = $(editModal).find("#product_image_text")[0];
        let txt_category = $(editModal).find("#product_category")[0];
        let txt_qty = $(editModal).find("#product_qty")[0];
        let txt_price = $(editModal).find("#product_price")[0];
        let check_visible = $(editModal).find("#product_visible")[0];
        let image_input = $(editModal).find("#product_image")[0];


        //Fill the fields
        selected_prod_id.value = selected_prod['id'];
        txt_name.value = selected_prod['name'];
        txt_des.value = selected_prod['description'];
        txt_image.value = selected_prod['image_path'];
        txt_category.selectedValue = selected_prod['category'];
        txt_qty.value = selected_prod['quantity'];
        txt_price.value = selected_prod['price'].substr(0, selected_prod['price'].length - 1);
        check_visible.checked = selected_prod['visible'];
}

style_file_input(editModal);
style_file_input(addModal);

//Fake file input styling. Takes the value of the invisible file input and puts it in a textbox
function style_file_input(modal)
{
    let image_input = $(modal).find("#product_image")[0];

    image_input.addEventListener("change", function(){
        let txt_image = $(modal).find("#product_image_text")[0];
        txt_image.value = this.value;
    });
}


//Get all loaded products in the array
for(i = 0; i < products_container.childElementCount; i++)
{
    let element = products_container.children[i];

    //Create a product object
    let prod = new Product(element.id,
                           element.children[0].innerText,
                           element.children[1].innerText,
                           element.children[2].children[0].getAttribute("src"),
                           element.children[3].innerText,element.children[4].innerText,
                           element.children[5].innerText,element.children[6].children[0].checked
                          );

    //Push the product in the products array
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
