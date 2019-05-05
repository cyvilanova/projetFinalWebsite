let currentRecipe;

/** Reset the borders color of editModal */
$('#editModal').on('hidden.bs.modal', function (e) {
  const modalId = '#editModal';
  resetSelectedCategories();
  applyInvalidStyle(modalId, 'recipe-name', '', '#ced4da');
  applyInvalidStyle(modalId, 'recipe-ingredients', '', '#ced4da');
  applyInvalidStyle(modalId, 'recipe-steps', '', '#ced4da');
  applyInvalidStyle(modalId, 'recipe-product', '', '#ced4da');
  applyInvalidStyle(modalId, 'product-description', '', '#ced4da');
  
})

/** Reset the borders color of addModal */
$('#addModal').on('hidden.bs.modal', function (e) {
  const modalId = '#addModal';
  applyInvalidStyle(modalId, 'recipe-name', '', '#ced4da');
  applyInvalidStyle(modalId, 'recipe-ingredients', '', '#ced4da');
  applyInvalidStyle(modalId, 'recipe-steps', '', '#ced4da');
  applyInvalidStyle(modalId, 'recipe-product', '', '#ced4da');
  applyInvalidStyle(modalId, 'product-description', '', '#ced4da');
})

/** Unselects all categories to reset the select */
function resetSelectedCategories() {
  $('#editModal').find('.product-category').each((_, value) => {
      $(value).prop("selected", false);
  });
}

/** Opens the editrecipe page with the recipe clicked and the correct informations*/
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
    $('#custom-recipe-title').html('Recette personnalisée');
  }
  else {
    $('#switch-custom-recipe').prop('checked', false); // Unchecks the box
    $('#custom-recipe-title').html('Recette standard');
  }

  displayIngredients(recipe.ingredients);
  selectCategories(recipe.finalProduct.categories);
}

/** Initializes the list of ingredients of an existing recipe */
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

/** Selects the categories in which the final product is */
function selectCategories(categories) {
  
  $('#editModal').find('.product-category').each((_, value) => {
    for (let i = 0; i < categories.length; i++) {
      if ($(value).attr('id') == categories[i].id) {
        $(value).prop("selected", true);
      }
    }
  });
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

/** Changes the label of the toggle */
function changeLabelCheckBox(modalId) {
  if(isCustomRecipeChecked(modalId)) {
    $(modalId).find('#custom-recipe-title').html('Recette personnalisée');
  }
  else {
    $(modalId).find('#custom-recipe-title').html('Recette standard');
  }
}

/** Checks if the toggle is checked or not */
function isCustomRecipeChecked(modalId) {
  return $(modalId).find('#switch-custom-recipe').is(':checked');
}

/** Calls the method to add new ingredient in the create new recipe modal */
function addRecipeAddIngredientModal(select) {
  addIngredient(select, '#addModal');
}

/** Calls the method to add new ingredient in the edit recipe modal */
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

/** Validates all the fields in form */
function validateForm(modalId) {
  let invalidAreas = 5; // Counter of the invalid areas in form

  invalidAreas = validateInput(modalId, 'recipe-name', invalidAreas);
  invalidAreas = validateTextArea(modalId, 'recipe-steps', invalidAreas);
  invalidAreas = validateInput(modalId, 'recipe-product', invalidAreas);
  invalidAreas = validateTextArea(modalId, 'product-description', invalidAreas);
  invalidAreas = validateIngredients(modalId, invalidAreas);

  // If all areas are valid, sends informations to recipeHandler.php
  if(invalidAreas == 0) {
    getRecipeInformations(modalId);
  }
}

/** Validates the input areas of the form and apply style if valid */
function validateInput(modalId, inputId, invalidAreas) {
  if($(modalId).find('#'+ inputId).val() == '') {
    applyInvalidStyle(modalId, inputId, 'Ce champ ne peut pas être vide.', '#dc3545');
  }
  else {
    applyInvalidStyle(modalId, inputId, '', '#ced4da');
    invalidAreas--;
  }
  return invalidAreas;
}

/** Validates the textareas of the form and apply style if valid */
function validateTextArea(modalId, inputId, invalidAreas) {
  if(!$.trim($(modalId).find('#' + inputId).val())) {
    applyInvalidStyle(modalId, inputId, 'Ce champ ne peut pas être vide.', '#dc3545');
  }
  else {
    applyInvalidStyle(modalId, inputId, '', '#ced4da');
    invalidAreas--;
  }
  return invalidAreas;
}

/** Validates that the recipe has ingredients and that their volume used is > 0 */
function validateIngredients(modalId, invalidAreas) {
  let ingredients = getIngredients(modalId);
  if(ingredients.length == 0) {
    applyInvalidStyle(modalId, 'recipe-ingredients', 'Une recette doit avoir au moins un ingrédient.', '#dc3545');
  }
  else {
    applyInvalidStyle(modalId, 'recipe-ingredients', '', '#ced4da');
    
    if(findVolumeZero(modalId)) {
      invalidAreas--;
    }

  }
  return invalidAreas;
}

/** Validates the volume used for each ingredients and return true if they're all valid */
function findVolumeZero(modalId) {
  let validVolumeCount = 0;

  let volumeInputs = $(modalId).find('.input-volume').each((_, value) => {
    if($(value).val() == 0) {
      $(value).attr('style', 'border-color: #dc3545');
      $(modalId).find('#invalid-recipe-ingredients').html('Le volume utilisé doit être un nombre plus grand que 0 mL.');
    }
    else {
      $(value).attr('style', 'border-color: #ced4da');
      $(modalId).find('#invalid-recipe-ingredients').html('');
      validVolumeCount++;
    }
  });

  // If all the volume inputs are valid, both values are equal, therefore the inputs are valid
  if(volumeInputs.length == validVolumeCount) {
    return true;
  }
  else {
    return false;
  }
}

/** Validates that the product has at least one category */
function validateIngredients(modalId, invalidAreas) {
  let ingredients = getIngredients(modalId);
  if(ingredients.length == 0) {
    applyInvalidStyle(modalId, 'recipe-ingredients', 'Une recette doit avoir au moins un ingrédient.', '#dc3545');
  }
  else {
    applyInvalidStyle(modalId, 'recipe-ingredients', '', '#ced4da');
    
    if(findVolumeZero(modalId)) {
      invalidAreas--;
    }

  }
  return invalidAreas;
}

/** Applies the valid or invalid style on the elements */
function applyInvalidStyle(modalId, inputId, messageError, color) {
  $(modalId).find('#invalid-' + inputId).html(messageError);
  $(modalId).find('#' + inputId).css("border-color", color);
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
      ingredients: JSON.stringify(getIngredients(modalId)),
      productId: currentRecipe.finalProduct.id ? currentRecipe.finalProduct.id : 0,
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

  return ingredients;
}
