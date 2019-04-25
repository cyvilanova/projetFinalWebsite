
/** Opens the editrecipe page with the recipe clicked */
function editRecipe(recipe) {
  $('.ingredient-item').remove();
  disableForm(true);

  document.getElementById('recipe-name').value = recipe.name;
  document.getElementById('recipe-steps').value = recipe.steps;

  console.log(recipe);
  displayIngredients(recipe.ingredients);
}

$('#myModal').on('shown.bs.modal', function () {
  $('#recipe-name').trigger('focus')
});

/** Enables the editing in the modal to edit the recipe */
function enableEditing() {
  disableForm(false);
}

/** Changes the state of the editable areas */
function disableForm(disabled) {
  $("#editModal input").prop("disabled", disabled);
  $("#recipe-steps").prop("disabled", disabled);
  $("#product-categories").prop("disabled", disabled);
  $("#recipe-ingredients").prop("disabled", disabled);
  $("#removeIngredient").prop("disabled", disabled);
}

/** Update the list of ingredients used for the recipe in the modal. */
function addIngredient(select) {

  const ingredientId = ($($('#recipe-ingredients').find("option")[select.selectedIndex]).attr("id"));
  let html1 = '<div class=\"ingredient-item\" id="ingredient-item-' + ingredientId + '"></div>';
  const html2 = '<label for=\"ingredient\" class=\"col-form-label\">' + $('#recipe-ingredients').val() + '</label>';
  const html4 = '<input type=\"number\" step=\"0.01\" min=\"0\" lang=\"en\" class=\"form-control input-volume\" id=\"recipe-ingredient\" value=0>';
  const html5 = '<label class=\"col-form-label label-volume\"> mL </label>';
  const deleteBtn = '<button type="button" class="btn btn-light btn-remove" id="removeIngredient" onclick="removeIngredient(' + ingredientId +')">X</button>';

  html1 = $(html1).append(html2, html4, html5, deleteBtn);
  $('#ingredients').append(html1);
}

/** Removes an ingredient from the list when clicking on the X */
function removeIngredient(ingredientId) {
  $('#ingredient-item-' + ingredientId).remove();
}

function displayIngredients(ingredients) {
  
  for (let i = 0; i < ingredients.length; i++) { 

    let html1 = '<div class=\"ingredient-item\" id="ingredient-item-' + ingredients[i].id + '"></div>';
    const html2 = '<label for=\"ingredient\" class=\"col-form-label\">' + ingredients[i].name + '</label>';
    const html4 = '<input type=\"number\" step=\"0.01\" min=\"0\" lang=\"en\" class=\"form-control input-volume\"' +
                  'id=\"recipe-ingredient\" value=\"' + Number(ingredients[i].volumeUsed) + '\" disabled>';
    const html5 = '<label class=\"col-form-label label-volume\"> mL </label>';
    const deleteBtn = '<button type="button" class="btn btn-light btn-remove" onclick="removeIngredient(' + ingredients[i].id +')" disabled>X</button>';
  
    html1 = $(html1).append(html2, html4, html5, deleteBtn);
    $('#ingredients').append(html1);
  }
}
