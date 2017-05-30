<?php
    session_start();
?>

<html>
<head>
	<title>Add Pics</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="icon" href="Penguins.jpg">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
	<link rel="stylesheet" type="text/css" href="style.css" />

</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#topNavBar">
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.html">CoolPics</a>
	</div>
	
    <!-- items -->
	<div class="collapse navbar-collapse" id="topNavBar">
		
		<ul class="nav navbar-nav">
			<li class="active">
				<a href="pics.php">	
					<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>&nbsp;
					Pics
				</a>
			</li>
		</ul>

		<form class="navbar-form navbar-left" role="search" method="get" action="search.php">
			<div class="form-group">
				<input type="text" class="form-control" name="q" placeholder="Images by Username">
			</div>
			<button type="submit" class="btn btn-default">Search</button>
		
		</form>

		<ul class="nav navbar-nav navbar-right">
			<li class="">
                               <a href="https://github.com/arindam-modak" style="text-decoration:none;"><i class="fa fa-github" aria-hidden="true"></i> ADM</a>
                        </li>
			<li class="">
				<a href="addpic.php">	
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
					Add Pic
				</a>
			</li>
                        <li class="">
				<a href="FileUpload.php">	
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
					Upload Pic
				</a>
			</li>
                        <li class="">
				<a href="register.php">	
					<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>&nbsp;
					Register
				</a>
			</li>
                        <li class="">
				<a href="login.php">	
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;
					login
				</a>
			</li>
			<li class="">
				<a href="logout.php">	
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;
					Logout
				</a>
			</li>
		</ul>

	</div>
    </div>
</nav>
<br><br>
<div class="container">
  <h2>Add Pics Form</h2>
  <p>Add Cool Pics from Web or Social Networking Sites!!!</p>
  <form class="form" action="addpic.php" method="POST">
      <div class="form-group">
          <label for="email">Pic Name:</label>
          <input type="text" name="txtName" class="form-control" placeholder="Enter Pic Name (optional)">
      </div>
     <div class="form-group">
          <label for="email">URL:</label>
          <input type="text" name="txtUrl" class="form-control" placeholder="Enter url of Pic">
     </div>
     <center><input type="submit" name="btnAdd" class="btn btn-default" value="Add Pic"></center>
    
</form>
</div>

<?php
        /*if(isset($_REQUEST['txtId']))
	{
		$id = $_REQUEST['txtId'];
	}
	else
	{
		$id = "";
	}*/
        if (isset($_SESSION['username']))
        {
               
        }
        else { $_SESSION['username']=""; }
    if($_SESSION['username']==""){
         header("Location: https://iit2016036.000webhostapp.com/pics.php?"); /* Redirect browser */
        exit();
    }
        $id = "";
	if(isset($_REQUEST['txtName']))
	{
		$name = $_REQUEST['txtName'];
	}
	else
	{
		$name = "";
	}
        
	if(isset($_REQUEST['txtUrl']))
	{
		$url = $_REQUEST['txtUrl'];
	}
	else
	{
		$url = "";
	}
        $uname = $_SESSION['username'];
	//Add button
	if(isset($_REQUEST['btnAdd']))
	{
$con = mysqli_connect("localhost", "root", "");
	
	mysqli_select_db($con, "");
		$sql = "Insert into tblpics(colId,colName,colUrl) values('$id', '$uname', '$url')";
		echo "<center><h2>";
		if($url=="")
		{
			echo "Error! some of  the required fields are empty!!";
		}
		else
		{
			if(mysqli_query($con, $sql)===true)
			{
				if(mysqli_affected_rows($con)>0)
				{
					echo "Your Pic is Added successfully";
				}
				else
				{
					echo "Record could not be addeded!!";
				}
			}
			else
			{
				echo "Error! Query could not be run!!";
			}
                        echo "</h2></center>";
		}mysqli_close($con);
	}
	
		
?>
</body>
</html>
