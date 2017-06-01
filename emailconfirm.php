<?php
     session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Confirm</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="icon" href="Penguins.jpg">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<style>
	.fileuploader{
		width:400px;
		height:200px;
		margin: 60px auto 0px auto;
		background=color:#FFF;
		border: 1px solid #CCC;
		padding :6px;
	}
        </style>
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


<?php
        if (isset($_SESSION['username']))
        {
               
        }
        else { $_SESSION['username']=""; }
 
        $id="";
	
		$username = $_GET['username'];
		$code = $_GET['code'];
       echo "<center><h2><u><b> Email confirmation </b></u><center><h2><br>";
       $con = mysqli_connect("localhost", "root", "");
	mysqli_select_db($con, "");
                    $sql1 = "Select * from tbluser where colUName='" . $username . "'";
                    $rs1 = mysqli_query($con, $sql1);
		    $flag2=0;
                 $db_code = "";
		while($row1 = mysqli_fetch_array($rs1))
		{ 
                      $db_code = $row1['colConfirmCode'];
                }
                 if($code == $db_code){
                       echo "<center><h2>email confirmed " . $username . "";
                       echo " Now <a href='login.php'>Login </a> to enter CoolPics </h2></center>";
                       $sql1 = "Update tbluser set colConfirm='1' where colUName='" . $username . "'";
                       $rs1 = mysqli_query($con, $sql1);
                       $sql1 = "Update tbluser set colConfirmCode='0' where colUName='" . $username . "'";
                       $rs1 = mysqli_query($con, $sql1);
		}
                else { echo "<center><h2>username and code do not match</h2></center>"; }  
                mysqli_close($con);
	
         

?>

</body>
</html>
