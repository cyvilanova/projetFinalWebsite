<?php
require_once 'CtrlCategory.php';

//Check if the action is set
if (isset($_POST['action'])){
  switch ($_POST['action']){
    //Add a category to the datebase
    case 'add':
        $name = $_POST['name'];
        $description =$_POST['description'];

        $newCtrl = new CtrlCategory();

        $newCtrl->addCategory($name,$description);
      break;

    //Edit a ctegory from the database
    case 'edit':
      $id = $_POST['id'];
      $name = $_POST['name'];
      if($_POST['activity']=="active"){
        $activity = 1;
      }
      else{
        $activity = 0;
      }

      $description = $_POST['description'];

      $newCtrl = new CtrlCategory();

      $newCtrl->editCategory($id,$name,$activity,$description);
      break;
  }

  //Delete a category from the database
  case 'delete':
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $newCtrl = new CtrlCategory();

    $newCtrl->deleteCategory($id,$name,$description);
    break;
}
else{
  echo "Error in the requested action";
}

?>
