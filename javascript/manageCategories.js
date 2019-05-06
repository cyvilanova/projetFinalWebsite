var currentCategory;

/**Adds the event listenenr to the add, edit and delete buttons*/
function addListeners(){
  var addBtn=document.getElementById("addCategorySaveBtn");
  addBtn.addEventListener ("click", function(e){
    addCategory();
  });

  var saveBtn=document.getElementById("editCategorySaveBtn");
  saveBtn.addEventListener ("click", function(e){
    modifyCategory();
  });

  var deleteBtn=document.getElementById("deleteCategoryBtn");
  deleteBtn.addEventListener ("click", function(e){
    deleteCategory();
  });
}

/**Modal to edit the category*/
function editCategory(id, name, activity, description){
  disableForm(true);
  currentCategory = {cId: id, cName:name, cActivity:activity, cDesctription:description};
  let index;
  index = ++activity;

  $('#edit-category-name').val(name);
  $('#edit-category-description').val(description);
  $("#edit-category-activity :nth-child("+index+")").prop('selected', true); // To select via index
}

/** Enable editing in the modal */
function enableEditing() {
  disableForm(false);
}

/** Disable editing in the modal */
function disableEditing() {
  disableForm(true);
}

/** Changes the state of the editable areas */
function disableForm(disabled) {
  $("#editModal input").prop("disabled", disabled);
  $("#editModal textarea").prop("disabled", disabled);
  $("#edit-category-activity").prop("disabled", disabled);
}

/**Adds a category in the database*/
function addCategory(){

    $.ajax({
      type: "POST",
      data: {
        action: "add",
        name: $('#add-category-name').val(),
        description:$('#add-category-description').val(),
      },
      url: "phpScripts/Category/categoryHandler.php",
      success: function(data){
          console.log(data);
        $('#addModal').modal('hide');
      },
    });


	}

/** Modifies an existing class with the updated information*/
function modifyCategory(){

  $.ajax({
    type: "POST",
    data: {
      action: "edit",
      id: currentCategory.cId,
      name: $('#edit-category-name').val(),
      activity: $('#edit-category-activity').val(),
      description:$('#edit-category-description').val(),
    },
    url: "phpScripts/Category/categoryHandler.php",
    success: function(data){
      $('#editModal').modal('hide');
        console.log(data);
    },
  });
  }

/** Deletes an existing class with the updated information*/
function deleteCategory(){

  $.ajax({
    type: "POST",
    data: {
      action: "delete",
      id: currentCategory.cId,
      name: $('#edit-category-name').val(),
      activity: $('#edit-category-activity').val(),
      description:$('#edit-category-description').val(),
    },
    url: "phpScripts/Category/categoryHandler.php",
    success: function(data){
      console.log(data);
      $('#editModal').modal('hide');
    },
  });

}
