<html>
<head>
	<title>CoolPics</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
				<a href="#">	
					<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>&nbsp;
					Pics
				</a>
			</li>
		</ul>

		<form class="navbar-form navbar-left" role="search" method="get" action="#">
			<div class="form-group">
				<input type="text" class="form-control" name="q" value="">
			</div>
			<button type="submit" class="btn btn-default">Search</button>
		
		</form>

		<ul class="nav navbar-nav navbar-right">
			<li class="">
				<a href="addpic.html">	
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;
					Add Pic
				</a>
			</li>
			<li class="">
				<a href="https://github.com/arindam-modak">	
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;
					Logout
				</a>
			</li>
		</ul>

	</div>
    </div>
</nav>

<?php

$con = mysqli_connect("localhost", "root", "");
	
	mysqli_select_db($con, "");
              
		$sql = "Select * from tblpics";
		
		$rs = mysqli_query($con, $sql);
		echo '<div class="row">';
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
			echo '<div class="thumbnail" style="height:300px;width:300px;">';
			echo '<img src="'.$row['colUrl'].'" style="height:200px;width:280px;">';
			echo '<b><a href="#" style="text-decoration: none">'.$row['colId'].'</a></b><br>';
			echo '<div class="row"><div class="col-md-4"></div> <div class="col-md-2"><div class="thumbnail" style="height:32px;width:40px;"><form action="likes.php"><input type="hidden" name="txtLike" value="'.$row['colId'].'"> 
<button type="submit"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button></form>'.$row['colLike'].'</div></div>
								&nbsp;&nbsp; <div class="col-md-2"><div class="thumbnail" style="height:32px;width:40px;"><form action="delete.php"><input type="hidden" name="txtDelete" value="'.$row['colId'].'"> 
<button type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></form></div></div></div>
							</div>
						</center></div>';
                      $sql1 = "UPDATE tblpics SET colHitLike = 0 WHERE colId =" . $row['colId'] . "";
                        $rt = mysqli_query($con, $sql1);
		}
		echo '</div>';
	mysqli_close($con);
?>

</body>
</html>
