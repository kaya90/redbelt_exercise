<?php
var_dump($fetch_reviews);
// var_dump($book_info);
$current_user = $this->session->userdata('current_user');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<style type="text/css">
	.red {
		color: red;
	}
	.green {
		color: green;
	}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="/view_home">Home</a></li>
			  <li><a href="/view_add_book">Add Book and Review</a></li>
			  <li><a href="/logout">Logout</a></li>
			 </ol>
			 <p class="text-right">Welcome, <?=$current_user['first_name']?>!</p>
		</div>
	</ol>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 ">
				<p><?=$book_info['title']?></p>
				<p>Author: <?=$book_info['name']?></p>
				<p>Reviews:</p>

				<?php 
				for($i = count($fetch_reviews)-1; $i >= 0; $i--)
				{
?>
				<hr>
				<p class= "col-sm-offset-1">Rating: <?=$fetch_reviews[$i]['rating']?></p>
				<p class= "col-sm-offset-1"><a href="#/<?=$fetch_reviews[$i]['user_id']?>"><?=$fetch_reviews[$i]['first_name']?></a> says: <?=$fetch_reviews[$i]['comment']?> </p>
				<p class= "col-sm-offset-1">Posted on <?=$fetch_reviews[$i]['created_at']?></p>
				<p class= "col-sm-offset-9"><a href="/delete_review/<?=$fetch_reviews[$i]['review_id']?>/<?=$book_info['book_id']?>">Delete this Review</a></p>
<?php					
				}
				?>

			</div>
			<div class="col-xs-6">
				<?php
				if($this->session->flashdata('messages'))
				{
					echo "<div class='red'>". $this->session->flashdata('messages') ."</div>";
				}
				if($this->session->flashdata('success'))
				{
					echo "<div class='green'>". $this->session->flashdata('success')."</div>";
				}
				?>
				<form class="form-horizontal" method="post" action="/add_bookreview_from_book">
					<div class="form-group">
					    <label class="col-sm-3 control-label" name="review">Review</label>
					    <div class="col-sm-6">
					      <textarea class="form-control" rows="3" name="review"></textarea>
					    </div>
					 </div>
				  	<div class="form-group">
				    	<label class="col-sm-3 control-label" name="rating">Rating</label>
				    	<div class="col-sm-6">
					      	<label>Choose from the list</label>
				      		<select class="form-control" name="rating">
							  <option>5</option>
							  <option>4</option>
							  <option>3</option>
							  <option>2</option>
							  <option>1</option>
							</select>
				    	</div>
			    	</div>
				  	<div class="form-group">
				    	<div class="col-sm-offset-3 col-sm-10">
				      		<button type="submit" class="btn btn-primary">Add Book and Review</button>
				   		 </div>
				 	 </div>
				 	 <input type="hidden" name="current_user_id" value="<?=$current_user['id']?>">
				 	 <input type="hidden" name="book_id" value="<?=$book_info['book_id']?>">
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>