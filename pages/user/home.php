<div class="container mt-5">
    <div class="d-flex justify-content-between">
   <h3>User List</h3>
    <div><a href="./?page=user/create" class="btn btn-success" >Add User</a></div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>User_Label</th>
                    <th>Level</th>
                </tr>
                <?php
                $manage_users = getUsers();
                if ($manage_users !== null) {
                    while ($row = $manage_users->fetch_object()) {
                        echo '    <tr>
                                <td>' . $row->id_user . '</td>
                                <td>' . $row->user_label . '</td>
                                <td>' . $row->level . '</td>
                                </tr>';
                    }
                }

                ?>
            </table>
        </div>
    </div>
</div>