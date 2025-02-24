<?php


if (!isset($_GET['id']) || !getCategoryById($_GET['id'])) {
    header('Location: ./?page=category/home');
}
$id_update = $_GET['id'];

$manage_category = getCategoryById($id_update);

$name_err = $slug_err = '';

if (
    isset($_POST['name']) && isset($_POST['slug'])) {
    $id_category = $_GET['id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];


    if (empty($name)) {
        $name_err = 'The name is required';
    } else {
        if ($name !== $manage_category->name && categoryNameExits($name)) {
            $name_err = 'name is already exits !';
        }
    }
    if (empty($slug)) {
        $slug_err = 'The slug is required';
    } else {
        if ($slug !== $manage_category->slug && categorySlugExists($slug)) {
            $slug_err = 'Slug is already exits !';
        }
    }



    if (empty($name_err) && empty($slug_err)) {

        if (updateCategory( $id_category,$name, $slug)) {
            echo '<div class="alert alert-success" role="alert">
                Categored update Success fully. <a href="./?page=category/home">Category Page ! </a>
                </div>';
                $name_err = $slug_err = '';
            unset($_POST['name']);
            unset($_POST['slug']);
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Category update failed !
                </div>';
        }
    }
}
$manage_category = getCategoryById($id_update);
?>

<!-- Login Form -->
<form action="./?page=category/update&id=<?php echo $manage_category->id_category ?>" method="post" style="max-width: 500px; margin-top: 50px;" class="mx-auto shadow p-4 rounded bg-light">
    <h1 class="text-center mb-4">Update Category <?php echo $manage_category->id_category ?></h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name"
            class="form-control <?php echo !empty($name_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars($_POST['name'] ?? $manage_category->name); ?>"
            placeholder="Enter your name">
        <div class="invalid-feedback">
            <?php echo $name_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug"
            class="form-control <?php echo !empty($slug_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars($_POST['slug'] ?? $manage_category->slug); ?>"
            placeholder="Enter your slug">
        <div class="invalid-feedback">
            <?php echo $slug_err; ?>
        </div>
    </div>
    <div class="d-flex justify-content-between">
    <button type="submit" class="btn btn-outline-success">Update</button>
    <a href="./?page=category/home" rule="button" class="btn btn-outline-danger">Cancel</a>
    </div>
</form>
