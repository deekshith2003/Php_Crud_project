<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Details</title>
    <link rel="stylesheet" href="viewstyle.css">
</head>
<body>
<div class="viewtable">
    <div class="viewtable-features">
    <h2>View Details</h2>
    <form class="searchsort" action="view_details.php" method="get">
        <div class="search">
        Search<input type="text" name="query">
        <input type="submit" class="searchbtn btn" value="Search">
        </div>
        <div class="sort">
        Sort by<input type="text" name="sort">
        <input type="submit" class="sortbtn btn" value="Sort">
        </div>
    </form>
</div>
    <!-- Display Records -->
    <table class="table">
        <tr>
            <th>Name</th>
            <th>USN</th>
            <th>Phone Number</th>
            <th>Delete Record</th>
            <th>Update Record</th>
        </tr>

        <?php
        $conn = new mysqli('localhost', 'root', '', 'wshop');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $search_query = "";
        if (isset($_GET['query'])) {
            $search_query = $conn->real_escape_string($_GET['query']);
        }

        $sort_by = "name";
        if (isset($_GET['sort'])) {
            $sort_by = $conn->real_escape_string($_GET['sort']);
        }

        $sql = "SELECT * FROM students";

        if (!empty($search_query)) {
            $sql .= " WHERE name LIKE '%$search_query%' OR usn LIKE '%$search_query%' OR phone LIKE '%$search_query%'";
        }

        if (!empty($sort_by)) {
            $sql .= " ORDER BY $sort_by";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["usn"]) . "</td>
                        <td>" . htmlspecialchars($row["phone"]) . "</td>
                        <td>
                            <form action='delete.php' class='delete-form' method='post' style='display:inline-block;'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <input type='submit' class='del-btn' value='Delete'>
                            </form>
                        </td>
                        <td>
                            <form action='update.php' class='update-form' method='post' style='display:inline-block;'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <input type='submit' class='up-btn' value='Update'>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>
</body>

</html>