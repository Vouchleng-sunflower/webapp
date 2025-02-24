<?php
function getProducts()
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_product");
    if ($query->num_rows) {
        return $query;
    };

    return null;
}
function productSlugExit($slug)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE slug = '$slug'");
    if ($query->num_rows) {
        return true;
    };

    return false;
}
function productNameExit($name)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE slug = '$name'");
    if ($query->num_rows) {
        return true;
    }


    return false;
}
function createProduct($name, $slug,$price,$short_des,$long_des,$id_categories) 
{
    global $db;
    $db->begin_transaction();
    try{
        $query = $db->prepare("INSERT INTO tbl_product(name,slug,price,qty,short_des,long_des) VALUES ('$name','$slug','$price',0,'$short_des','$long_des')");
        if ($query->execute()) {
            $id_product = $db->insert_id;
            foreach ($id_categories as $id_category) {
                $query1 = $db->prepare("INSERT INTO tbl_product_category(id_product,id_category) VALUES ('$id_product','$id_category')");
                $query1->execute();
            }
            $db->commit();
            return true;
        } 
        return false;
    } catch (Exception $e) {
        $db->rollback();
       
    }
}
