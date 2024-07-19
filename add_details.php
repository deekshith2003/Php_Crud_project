<!DOCTYPE html>
<html>
<head>
    <title>Add Details</title>
</head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="viewstyle.css">

<body>
    
<div class="form-page">
        <div class="form-page-content">
            <h2>Add Details</h2>
            <form class="form-form" action="add_details.php" method="post">
                Name: <input type="text" name="name" required><br>
                USN: <input type="text" name="usn" required><br>
                Phone Number: <input type="text" name="phone" required><br>
                <input type="submit" class="submit btn" name="submit" value="Submit">
            </form>
            <form action="view_details.php" class="form-form" method="get">
                <input type="submit" class="submit btn" value="View Details">
            </form>
        </div>
    </div>


    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $usn = $_POST['usn'];
        $phone = $_POST['phone'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'wshop');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data
        $sql = "INSERT INTO students (name, usn, phone) VALUES ('$name', '$usn', '$phone')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>