
/** Opens the editrecipe page with the recipe clicked */
function editRecipe(recipe) {
  document.getElementById('recipe-name').value = recipe.name;
  document.getElementById('recipe-steps').value = recipe.steps;

  displayIngredients(recipe.ingredients);
}

$('#myModal').on('shown.bs.modal', function () {
  $('#recipe-name').trigger('focus')
});

/** Enables the editing in the modal to edit the recipe */
function enableEditing() {
  $("#recipe-name").prop('disabled',false);
  $("#recipe-ingredients").prop('disabled',false);
  $("#recipe-steps").prop('disabled',false);
  $("#recipe-product").prop('disabled',false);
  $("#recipe-description").prop('disabled',false);
  $("#product-categories").prop('disabled',false);
  $('#recipe-name').trigger('focus')
}


/** Update the list of ingredients used for the recipe in the modal. */
function addIngredient(select) {
  let ingredientId = ($($('#recipe-ingredients').find("option")[select.selectedIndex]).attr("id"));
  let html1 = '<div class=\"ingredient-item\" id="ingredient-item-' + ingredientId + '"></div>';
  let html2 = '<label for=\"ingredient\" class=\"col-form-label\">' + $('#recipe-ingredients').val() + '</label>';
  let html4 = '<input type=\"number\" step=\"0.01\" min=\"0\" lang=\"en\" class=\"form-control input-volume\" id=\"recipe-ingredient\">';
  let html5 = '<label class=\"col-form-label label-volume\"> mL </label>';
  let deleteBtn = '<button type="button" class="btn btn-light btn-remove" onclick="removeIngredient(' + ingredientId +')">X</button>';

  html1 = $(html1).append(html2, html4, html5, deleteBtn);
  $('#ingredients').append(html1);
}

/** Removes an ingredient from the list when clicking on the X */
function removeIngredient(ingredientId) {
  $('#ingredient-item-' + ingredientId).remove();
}

function displayIngredients(ingredients) {
  
  for (let i = 0; i < ingredients.length; i++) { 
    console.log(ingredients[i]);
    /*let html1 = '<div class=\"ingredient-item\" id="ingredient-item-' + ingredientId + '"></div>';
    let html2 = '<label for=\"ingredient\" class=\"col-form-label\">' + $('#recipe-ingredients').val() + '</label>';
    let html4 = '<input type=\"number\" step=\"0.01\" min=\"0\" lang=\"en\" class=\"form-control input-volume\" id=\"recipe-ingredient\">';
    let html5 = '<label class=\"col-form-label label-volume\"> mL </label>';
    let deleteBtn = '<button type="button" class="btn btn-light btn-remove" onclick="removeIngredient(' + ingredientId +')">X</button>';
  
    html1 = $(html1).append(html2, html4, html5, deleteBtn);
    $('#ingredients').append(html1);*/
  }
}
