<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'Joshua2@3';
$DATABASE_NAME = 'mugongoadmin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$query = "SELECT * FROM `admittedstudents`;";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Home Page</title>
	<link href="./styles/styles.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
		integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
		crossorigin="anonymous" referrerpolicy="no-referrer">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
		integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
		crossorigin="anonymous"></script>

		

	<script>
		function printPage() {
			window.print();
		}

	</script>
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
		<h2>Home Page</h2>
		<p>
			Welcome back, <?= htmlspecialchars($_SESSION['name'], ENT_QUOTES) ?>!
			<button type="submit" id="print" onclick="printPage()">Print</button>

		</p>
		<div class="intro">
			<a href="newuser.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Student</a>
		</div>
		<table border="1" id="id" class="display" style="width:100%">
		<thead>
			<tr>
				<th>Date</th>
				<th>Student Name</th>
				<th>Former School</th>
				<th>Year</th>
				<th>Aggregates</th>
				<th>Age</th>
				<th>Regno</th>
				<th>House</th>
				<th>Class</th>
				<th>Contact</th>
				<th>Action</th>

			</tr>
			</thead>
			<tbody>
			<?php
			while ($row = mysqli_fetch_assoc($result)) { ?>
				<tr>
					<td><?php echo $row['date']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['formerschool']; ?></td>
					<td><?php echo $row['year']; ?></td>
					<td><?php echo $row['aggregates']; ?></td>
					<td><?php echo $row['age']; ?></td>
					<td><?php echo $row['regno']; ?></td>
					<td><?php echo $row['house']; ?></td>
					<td><?php echo $row['class']; ?></td>
					<td><?php echo $row['contact']; ?></td>
					<td><?php
					echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
					echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
					echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
					?> </td>
				</tr>
			<?php } ?>
			</tbody>

		</table>
	</div>

	<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.min.js"></script>

	<script>
		$(document).ready(function(){
			$('#id').DataTable();
		});
	</script>
</body>

</html>