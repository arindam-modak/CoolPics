<?php
    session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Upload Pics</title>
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
<div class="container">
  <h2>Upload Form</h2>
  <p>Upload Your own cool pics!!!</p>
  <form class="form" id="FileUploadForm" action="FileUpload.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
          <label for="email">Pic Name:</label>
          <input type="text" name="txtNameUpload" class="form-control" placeholder="Enter Pic Name (optional)">
      </div>
     <div class="form-group">
          <input type="file" class="form-control" name="UploadFileField" id="UploadFileField">
     </div>
     <center><input type="submit" class="btn btn-default" value="Upload" id="UploadFileButton"></center>
    
</form>
</div>
<?php
     if (isset($_SESSION['username']))
        {
               
        }
        else { $_SESSION['username']=""; }
    if($_SESSION['username']==""){
         header("Location: https://iit2016036.000webhostapp.com/pics.php?"); /* Redirect browser */
        exit();
    }
	if(isset($_FILES['UploadFileField'])) {
            echo "<center><h2>";
             $UploadName = $_FILES['UploadFileField']['name'];
             $UploadTmp = $_FILES['UploadFileField']['tmp_name'];
             $UploadType = $_FILES['UploadFileField']['type'];
             
             $UploadName = preg_replace("#[^a-z0-9.]#i","", $UploadName);
             
             if(!$UploadTmp) {
                    die("No File Selected, Please Upload Again");
             }else{
                  move_uploaded_file($UploadTmp, "Upload/$UploadName");
                  $id = "";
	if(isset($_REQUEST['txtNameUpload']))
	{
		$name = $_REQUEST['txtNameUpload'];
	}
	else
	{
		$name = "";
	}
	
	$uname = $_SESSION['username'];
        $con = mysqli_connect("localhost", "root", "");
	
	mysqli_select_db($con, "");
		$sql = "Insert into tblpics(colId,colName,colUrl) values('$id', '$uname', 'Upload/$UploadName')";

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
                 mysqli_close($con);
	
              }
         }
         


?>
</body>
</html>
