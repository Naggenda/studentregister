<?php
// Include config file
$conn = mysqli_connect("localhost", "root", "Joshua2@3", "mugongoadmin");
 
// Define variables and initialize with empty values
$id = $date = $name = $formerschool = $year = $aggregates = $age = $regno = $house = $class = $contact = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        $sql = "INSERT INTO admittedstudents (id, date, name, formerschool, year, aggregates, age, regno, house, class, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'sssssssssss', $id, $date, $name, $formerschool, $year, $aggregates, $age, $regno, $house, $class, $contact);
            
            // Get the form data 
$id = $_POST['id'];
$date = $_POST['date'];
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
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="./styles/styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><a href="home.php">Students Register</a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
        <div class="content">
            <form action="newuser.php" method="post" class="form">

                <label for="date">date:</label> 
                <input id="date" name="date" required="" type="date" />

                <label for="name">name:</label>
                <input id="name" name="name" required="" type="text" />

				<label for="formerschool">former school:</label>
                <input id="formerschool" name="formerschool" required="" type="text" />

                <label for="year">Year:</label>
                <input id="year" name="year" required="" type="text" />

				<label for="aggregates">Aggregates</label>
                <input id="aggregates" name="aggregates" required="" type="text" />

				<label for="age">Age:</label>
                <input id="age" name="age" required="" type="text" />

				<label for="regno">regno:</label>
                <input id="regno" name="regno" required="" type="text" />

				<label for="house">house:</label>
                <input id="house" name="house" required="" type="text" />

				<label for="class">class:</label>
                <input id="class" name="class" required="" type="text" />

				<label for="contact">contact:</label>
                <input id="contact" name="contact" required="" type="text" />

                <input name="register" type="submit" value="Add" />
            </form>
        </div>
</body>
</html>