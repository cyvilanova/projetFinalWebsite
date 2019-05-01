let currentRecipe;

/** Opens the editrecipe page with the recipe clicked */
function editRecipe(recipe) {
  currentRecipe = recipe;
  $('.ingredient-item').remove();
  disableForm(true);

  $('#recipe-name').val(recipe.name);
  $('#recipe-steps').val(recipe.steps);
  $('#recipe-product').val(recipe.finalProduct.name);
  $('#product-description').val(recipe.finalProduct.description);

  if(recipe.custom == 1) {
    $('#switch-custom-recipe').prop('checked', true);  // Checks the box
    $('#custom-recipe-title').html('Personnalisée');
  }
  else {
    $('#switch-custom-recipe').prop('checked', false); // Unchecks the box
    $('#custom-recipe-title').html('Standard');
  }

  displayIngredients(recipe.ingredients);
}

/** Enables the editing in the modal to edit the recipe */
function enableEditing() {
  disableForm(false);
}

/** Changes the state of the editable areas */
function disableForm(disabled) {
  $("#removeIng").prop("disabled", disabled);
  $("#editModal input").prop("disabled", disabled);
  $("#editModal textarea").prop("disabled", disabled);
  $("#product-categories").prop("disabled", disabled);
  $("#recipe-ingredients").prop("disabled", disabled);
}

function addRecipeAddIngredientModal(select) {
  addIngredient(select, '#addModal');
}

function editRecipeAddIngredientModal(select) {
  addIngredient(select, '#editModal');
}

/** Update the list of ingredients used for the recipe in the modal. */
function addIngredient(select, modalId) {

  const ingredientId = $($('#recipe-ingredients').find("option")[select.selectedIndex]).attr("id");
  let html1 = '<div class=\"ingredient-item\" data-ingredient-id=\"' + ingredientId + '\" id="ingredient-item-' + ingredientId + '"></div>';
  const html2 = '<label for=\"ingredient\" class=\"col-form-label\">' + $(modalId).find('#recipe-ingredients').val() + '</label>';
  const html4 = '<input type=\"number\" step=\"0.1\" min=\"0\" lang=\"en\" class=\"form-control input-volume\" value=0>';
  const html5 = '<label class=\"col-form-label label-volume\"> mL </label>';
  const deleteBtn = '<button type="button" class="btn btn-light btn-remove" id="removeIng" onclick="removeIngredient(' + ingredientId + ')">X</button>';

  html1 = $(html1).append(html2, html4, html5, deleteBtn);
  $(modalId).find('#ingredients').append(html1);
}

/** Removes an ingredient from the list when clicking on the X */
function removeIngredient(ingredientId) {
  $('#ingredient-item-' + ingredientId).remove();
}

function displayIngredients(ingredients) {

  for (let i = 0; i < ingredients.length; i++) {

    let html1 = '<div class=\"ingredient-item\" data-ingredient-id=\"' + ingredients[i].id + '\" id="ingredient-item-' + ingredients[i].id + '"></div>';
    const html2 = '<label for=\"ingredient\" class=\"col-form-label\">' + ingredients[i].name + '</label>';
    const html4 = '<input type=\"number\" step=\"0.1\" min=\"0\" lang=\"en\" class=\"form-control input-volume\"' +
      'value=\"' + Number(ingredients[i].volumeUsed) + '\" disabled>';
    const html5 = '<label class=\"col-form-label label-volume\"> mL </label>';
    const deleteBtn = '<button type="button" class="btn btn-light btn-remove" onclick="removeIngredient(' + ingredients[i].id + ')">X</button>';

    html1 = $(html1).append(html2, html4, html5, deleteBtn);
    $('#editModal').find('#ingredients').append(html1);
  }
}

/** Gets all the informations entered and sends it to a php file with ajax */
function getRecipeInformations(modalId) {
  $.ajax({
    type: "POST",
    data: {
      id: currentRecipe ? currentRecipe.id : 0,
      name: $(modalId).find('#recipe-name').val(),
      isCustom: isCustomRecipeChecked(modalId) ? 1 : 0,
      steps: $(modalId).find('#recipe-steps').val(),
      ingredients: getIngredients(modalId),
      productName: $(modalId).find('#recipe-product').val(),
      productDesc: $(modalId).find('#product-description').val(),
      categories: JSON.stringify($(modalId).find('#product-categories').val()),
      isNew: modalId === '#editModal' ? false : true
    },
    url: "phpScripts/Recipe/recipeHandler.php",
    dataType: "html",
    success: () => {
      $(modalId).modal('hide');
    },
    async: true
  });
}

/** Gets all the ingredients and their volume for the recipe */
function getIngredients(modalId) {
  const ingredients = [];

  $(modalId).find('.ingredient-item').each((_, value) => {
    ingredients.push([parseInt($(value).attr('data-ingredient-id')), parseFloat($(value).find('input').val())]);
  });

  return JSON.stringify(ingredients);
}

/** Changes the label of the toggle */
function changeLabelCheckBox(modalId) {
  if(isCustomRecipeChecked(modalId)) {
    $(modalId).find('#custom-recipe-title').html('Personnalisée');
  }
  else {
    $(modalId).find('#custom-recipe-title').html('Standard');
  }
}

/** Checks if the toggle is checked or not */
function isCustomRecipeChecked(modalId) {
  return $(modalId).find('#switch-custom-recipe').is(':checked');
}