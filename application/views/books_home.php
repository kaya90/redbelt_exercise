<?php
$current_user = $this->session->userdata('current_user');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<style type="text/css">
	.red{
		color: red;
	}
	</style>
</head>
<body>
	
	<ol class="breadcrumb">
		<div class="container">
			<ol class="breadcrumb col-sm-6">
				<li class="active"><a href="/view_home">Home</a></li>
			  <li><a href="/view_add_book">Add Book and Review</a></li>
			  <li><a href="/logout">Logout</a></li>
			 </ol>
			 <p class="text-right">Welcome, <?=$current_user['first_name']?>!</p>
		</div>
	</ol>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 ">
				<p >Recent Book Reviews</p>
<?php
$recent = [];
if(count($reviews) == 0)
{
?>
				<p>No Reviews</p>
<?php
}
else{
	
	for($i = (count($reviews))-1; $i > count($reviews) - 4; $i--)
	{
?>
					<p class= "col-sm-offset-1"><a href="book_info/<?=$reviews[$i]['book_id']?>">
					<?=$reviews[$i]['title']?></a></p>
					<p class= "col-sm-offset-2">Rating: <?=$reviews[$i]['rating']?></p>
					<p class= "col-sm-offset-2"><?=$reviews[$i]['first_name']?> says: <?=$reviews[$i]['comment']?></p>
					<p class= "col-sm-offset-2"><?=$reviews[$i]['created_at']?></p>
<?php
	}
}
?>
				
			</div>
			<div class="col-xs-6">
				<p>Other Books with Reviews:</p>
<?php
	for($i = (count($reviews))-4; $i >= 0; $i--)
	{
?>
				<p><a href="book_info/<?=$reviews[$i]['book_id']?>"><?=$reviews[$i]['title']?></a></p>
<?php
	}
?>
		
			</div>
		</div>
	</div>
	
</body>
</html>