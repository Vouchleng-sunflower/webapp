<?php 
function categorySlugExists($slug)
{
    global $db;
    $query = $db->query("SELECT id_category FROM tbl_category WHERE slug = '$slug'");
    //$db->close();
    if ($query->num_rows) {
        return true;
    }
    return false;
}
function categoryNameExits($name)
{
    global $db;
    $query = $db->query("SELECT id_category FROM tbl_category WHERE slug = '$name'");
    if ($query->num_rows) {
        return true;
    }


    return false;
}
function createCategory($name, $slug)
{
    global $db;
    $query = $db->prepare("INSERT INTO tbl_category(name,slug) VALUES ('$name','$slug')");
    if ($query->execute()) {
        return true;
    }
    return false;
}
function getCategories()
{
    //admin // user
    global $db;
    $query = $db->query("SELECT * FROM tbl_category ");
    if ($query->num_rows) {
        return $query;
    }
}

function getCategoryByID($id)
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_category WHERE id_category= '$id'");
    if ($query->num_rows) {
        return $query->fetch_object();
    }
    return null;
}

function deleteCategory($id)
{
    global $db;
    $db->query("DELETE FROM tbl_category WHERE id_category = '$id'");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}

function updateCategory($id_category,$name, $slug)
{
    global $db;

    $db->query("UPDATE tbl_category SET name = '$name', slug = '$slug' WHERE id_category = '$id_category'");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}


?>