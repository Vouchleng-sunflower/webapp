<?php
function getUsers()
{
    //admin // user
    global $db;
    $query = $db->query("SELECT id_user,user_label,level FROM tbl_user WHERE level = 'User'");
    if ($query->num_rows) {
        return $query;
    }
    return null;
}

function createUser($user_label, $username, $passwd)
{
    global $db;
    $query = $db->prepare("INSERT INTO tbl_user(user_label,username,passwd,level) VALUES ('$user_label','$username','$passwd','User')");
    if ($query->execute()) {
        return true;
    }
    return false;
}

function getUserByID($id)
{
    global $db;
    $query = $db->query("SELECT id_user,user_label,level FROM tbl_user WHERE id_user= '$id' AND level = 'User'");
    if ($query->num_rows) {
        return $query->fetch_object();
    }
    return null;
}
//functiion update user
function updateUser($id, $user_label, $username, $passwd)
{
    global $db;

   $username_query = empty($username) ? "" : ", username = '$username'";
    if (empty($passwd)) {
        $passwd_query = "";
    } else {
        $passwd_query = ", passwd = '$passwd'";
    }

    $db->query("UPDATE tbl_user SET user_label = '$user_label'" . $username_query . $passwd_query . " WHERE id_user = '$id'");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}

function deleteUser($id)
{
    global $db;
    $db->query("DELETE FROM tbl_user WHERE id_user = '$id'");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}
