let addBtn = document.getElementById("add");
let editBtn = document.getElementById("edit");
let deleteBtn = document.getElementById("delete");

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
        console.log(selected_prod_id);

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
        console.log(txt_name);
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
    let product = {
        id: element.id,
        name: element.children[0].innerText,
        description: element.children[1].innerText,
        image_path: element.children[2].children[0].getAttribute("src"),
        category: element.children[3].innerText,
        quantity: element.children[4].innerText,
        price: element.children[5].innerText,
        visible: element.children[6].children[0].checked
    };
    products.push(product);
}


//Makes the cancel buttons close the modals.
for(i = 0; i < cancelBtn.length; i++)
{
    cancelBtn[i].addEventListener("click", function(){closeModals();});
    $(deleteModal).find(".cancel-btn")[0].addEventListener("click", function(){closeModals();});
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
            deleteBtn.classList.toggle("disabled", false);
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
            deleteBtn.classList.toggle("disabled", true);
        }
    });
}
