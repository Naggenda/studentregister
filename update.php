<?php
// Include config file

$conn = mysqli_connect("localhost", "root", "Joshua2@3", "mugongoadmin");

// Define variables and initialize with empty values
$name = $address = $salary = "";


// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

        $sql = "UPDATE admittedstudents SET date=?, name=?, formerschool=?, year=?, aggregates=?, age=?, regno=?, house=?, class=?, contact=? WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'sssssssssss', $id, $param_date, $name, $formerschool, $year, $aggregates, $age, $regno, $house, $class, $contact);

            // Set parameters
            $id = $_POST['id'];
            $param_date = $_POST['date'];
            $name = $_POST['name'];
            $formerschool = $_POST['formerschool'];
            $year = $_POST['year'];
            $aggregates = $_POST['aggregates'];
            $age = $_POST['age'];
            $regno = $_POST['regno'];
            $house = $_POST['house'];
            $class = $_POST['class'];
            $contact = $_POST['contact'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: home.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM admittedstudents WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $date = $row['date'];
                    $name = $row['name'];
                    $formerschool = $row['formerschool'];
                    $year = $row['year'];
                    $aggregates = $row['aggregates'];
                    $age = $row['age'];
                    $regno = $row['regno'];
                    $house = $row['house'];
                    $class = $row['class'];
                    $contact = $row['contact'];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>date</label>
                            <textarea name="address" class="form-control"><?php echo $date; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Former School</label>
                            <input type="text" name="formerschool" class="form-control"
                                value="<?php echo $formerschool; ?>">
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $year; ?>">
                        </div>
                        <div class="form-group">
                            <label>Aggregates</label>
                            <input type="text" name="aggregates" class="form-control"
                                value="<?php echo $aggregates; ?>">
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control" value="<?php echo $age; ?>">
                        </div>
                        <div class="form-group">
                            <label>Reg number</label>
                            <input type="text" name="regno" class="form-control" value="<?php echo $regno; ?>">
                        </div>
                        <div class="form-group">
                            <label>House</label>
                            <input type="text" name="house" class="form-control" value="<?php echo $house; ?>">

                        </div>
                        <div class="form-group">
                            <label>Class</label>
                            <input type="text" name="class" class="form-control" value="<?php echo $class; ?>">
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="home.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>