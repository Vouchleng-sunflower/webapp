<?php 
   if (!isset($_GET['id']) || (getUserByID($_GET['id']) === null)) {
    header('Location: ./?page=user/home');
}
if(deleteUser($_GET['id'])){
    echo '<div class="alert alert-success" role="alert">
    User deleted successfully. <a href="./?page=user/home">Go to User Page</a>
  </div>';
}else{
    echo '<div class="alert alert-danger" role="alert">
    User Can not Delete!!!<a href="./?page=user/home">Go to User Page</a>
  </div>';
}


?>