<?php
// Start the session
session_start();
?>

<html>
<head>
	<title>Pics</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="icon" href="Penguins.jpg">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
	<link rel="stylesheet" type="text/css" href="style.css" />
        <style>
            .scrollable {
             height: 80px; /* or any value */
             overflow-y: auto;
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
				<a href="#">	
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

<?php
     if (isset($_SESSION['username']))
        {
               
        }
        else { $_SESSION['username']=""; }
    if($_SESSION['username']!=""){
         echo '<pre style="opacity: 0.7;margin-left:20px;margin-right:20px;">            <i><h1>      <font color="teal">Hello! </font></i><b>'.$_SESSION['username'].'</b></h1></pre><hr>';
    }
     else { header("Location: https://iit2016036.000webhostapp.com/register.php"); /* Redirect browser */
        exit(); }
$con = mysqli_connect("localhost", "root", "");
	
	mysqli_select_db($con, "");
              
		$sql = "Select * from tblpics";
		
		$rs = mysqli_query($con, $sql);
                $flag1 = 0;
		echo '<div class="container"><div class="row">';
		while($row = mysqli_fetch_array($rs))
		{
                        if($row['colHitLike']==1)
                        {
                            $sql1 = "UPDATE tblpics SET colLike = colLike + 1 WHERE colId =" . $row['colId'] . "";
                             $rt = mysqli_query($con, $sql1);
                        }
                        $sql1 = "UPDATE tblpics SET colHitLike = 1 WHERE colId =" . $row['colId'] . "";
                        $rt = mysqli_query($con, $sql1);
                         
			echo '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><center>';
			echo '<div class="thumbnail" style="margin-left:20px;margin-right:20px;">';
			echo '<img src="'.$row['colUrl'].'" style="height:200px;width:280px;">';
			echo '<b><a href="https://iit2016036.000webhostapp.com/search.php?q='.$row['colName'].'" style="text-decoration: none">'.$row['colName'].'</a></b><br>';
			echo '<div class="row"><div class="col-md-4"></div> <div class="col-md-2"><div class="thumbnail" style="height:32px;width:40px;"><form action="likes.php"><input type="hidden" name="txtLike" value="'.$row['colId'].'"> 
<button type="submit"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button></form>'.$row['colLike'].'</div></div>
								&nbsp;&nbsp; <div class="col-md-2"><div class="thumbnail" style="height:32px;width:40px;"><form action="delete.php"><input type="hidden" name="txtDelete" value="'.$row['colId'].'"> 
<button type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></form></div></div>
</div><h3><br><hr><u><b><i>Comments: </u></b></i></h3>


							</center>';
						
                $sql1 = "Select * from tblcomment Where colId =" . $row['colId'] . "";
		$rs1 = mysqli_query($con, $sql1);
                echo '<div class="scrollable"><ul type="square">';
                $flag1 = $flag1 + 1;
                $flag2=0;
		while($row1 = mysqli_fetch_array($rs1))
		{
                          echo '<li><b>'.$row1['colCommentName'].'</b> : '.$row1['colComment'].'</li>';
                          
                          $flag2 = 1;
                }
                 echo '</ul></div><hr>';
                 echo '<form action="comment.php" style="margin-left:20px"><input type="hidden" name="txtComId" value="'.$row['colId'].'">
                                Comment : <input type="text" name="txtComment" style="width:200px"><button type="submit" value="comment">ADD</button></form></div>';
                          if(($flag1)%3==0)
                          {  echo '</div></div><div class="container"><div class="row">'; }
                 
                      $sql1 = "UPDATE tblpics SET colHitLike = 0 WHERE colId =" . $row['colId'] . "";
                        $rt = mysqli_query($con, $sql1);
		}
		echo '</div></div>';
	mysqli_close($con);
?>

</body>
</html>
