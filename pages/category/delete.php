<?php
if (!isset($_GET['id']) || getCategoryByID($_GET['id']) === null) {
    header('Location: ./?page=user/home');
}
if (deleteCategory($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">
    Category deleted successfully ! <a href="./?page=category/home">Category Page ! </a>
    </div>';
} else {
    echo '<div class="alert alert-danger" role="alert">
    Can not delete Category! <a href="./?page=category/home">Category Page ! </a>
    </div>';
}
?>
