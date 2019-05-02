let currentCategory;

function editCategory(category){
  currentCategory = category;
  disableForm(true);

  $('#category-name').val(category.name);
  $('#category-activity').val(category.active);
  $('#category-name').val(category.description);
}

/** Enable editing in the modal */
function enableEditing() {
  disableForm(false);
}

/** Changes the state of the editable areas */
function disableForm(disabled) {
  $("#editModal input").prop("disabled", disabled);
  $("#editModal textarea").prop("disabled", disabled);
  $("#category-activity").prop("disabled", disabled);
}

function addCategory(){

}
