<?php include('header.php'); ?>

<div class="content" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="dialog-box">
        <h2>Admin - Manage Users</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'webuser', 'password', 'webapp');
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    // Handle user update
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
                        $user_id = $conn->real_escape_string($_POST['user_id']);
                        $username = $conn->real_escape_string($_POST['username']);
                        $email = $conn->real_escape_string($_POST['email']);
                        $role = $conn->real_escape_string($_POST['role']);

                        $sql = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id='$user_id'";
                        if ($conn->query($sql) !== TRUE) {
                            echo "Error updating record: " . $conn->error;
                        }
                    }

                    // Handle user delete
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
                        $user_id = $conn->real_escape_string($_POST['user_id']);

                        $sql = "DELETE FROM users WHERE id='$user_id'";
                        if ($conn->query($sql) !== TRUE) {
                            echo "Error deleting record: " . $conn->error;
                        }
                    }

                    // Fetch users
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td><form method='POST' action='admin.php'><input type='hidden' name='user_id' value='{$row['id']}'><input type='text' name='username' value='{$row['username']}'></td>
                                    <td><input type='email' name='email' value='{$row['email']}'></td>
                                    <td>
                                        <select name='role'>
                                            <option value='user'" . ($row['role'] == 'user' ? ' selected' : '') . ">User</option>
                                            <option value='admin'" . ($row['role'] == 'admin' ? ' selected' : '') . ">Admin</option>
                                        </select>
                                    </td>
                                    <td><button type='submit' name='update' class='update-btn'>Update</button></form></td>
                                    <td><button class='delete-btn' onclick='confirmDelete({$row['id']})'>&#128465;</button></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <p>Manage the user accounts from this admin panel.</p>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Confirm deletion</p>
        <form id="deleteForm" method="POST" action="admin.php">
            <input type="hidden" name="user_id" id="user_id">
            <button type="submit" name="delete" class="delete-confirm-btn">Delete</button>
        </form>
    </div>
</div>

<?php include('tail.php'); ?>

<script>
function confirmDelete(userId) {
    document.getElementById('user_id').value = userId;
    document.getElementById('deleteModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
</script>

