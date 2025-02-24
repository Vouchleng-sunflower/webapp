<?php
$name_err = $slug_err = '';

if (
    isset($_POST['slug'])
    && isset($_POST['name'])
) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];

    if (empty($name)) {
        $name_err = 'Name is required';
    } else {
        if (categoryNameExits($name)) {
            $name_err = 'Name is already exits !';
        }
        if (empty($slug)) {
            $slug_err = 'The Slug is required';
        } else {
            if (categorySlugExists($slug)) {
                $slug_err = 'Slug is already exits !';
            }
        }

        if (empty($name_err) && empty($slug_err)) {
            if (createCategory($name, $slug)) {
                echo '<div class="alert alert-success" role="alert">
                Category create Successfully. <a href="./?page=category/home">Category Page ! </a>
                </div>';
                $name = $slug = '';
                unset($_POST['slug']);
                unset($_POST['name']);
            } else {
                echo '<div class="alert alert-danger" role="alert">
               Category createed faill.
                </div>';
            }
        }
    }
}
?>

<!-- Login Form -->
<form action="./?page=category/create" method="post" style="max-width: 500px; margin-top: 50px;" class="mx-auto p-4">
    <h1 class="text-center mb-4">Add Category</h1>
    <div class="mb-3">
        <label for="name" class="form-label"><U></U>Name</label>
        <input type="text" name="name"
            class="form-control <?php echo !empty($name_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" placeholder="Enter your name">
        <div class="invalid-feedback">
            <?php echo $name_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control <?php echo !empty($slug_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>"
            placeholder="Enter your slug">
        <div class="invalid-feedback">
            <?php echo $slug_err; ?>
        </div>
    </div>

    <div class="d-flex justify-content-between">

        <a href="./?page=category/home" rule="button" class="btn btn-outline-danger">Cancel</a>
        <button type="submit" class="btn btn-outline-success">Create</button>
    </div>
</form>