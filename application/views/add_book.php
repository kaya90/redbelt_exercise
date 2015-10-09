<?php
	$current_user = $this->session->userdata('current_user');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Book and Review</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<style type="text/css">
	.red{
		color: red;
	}
	.green{
		color: green;
	}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="/view_home">Home</a></li>
				<li class="active"><a href="/view_add_book">Add Book and Review</a></li>
				<li><a href="/logout">Logout</a></li>
			 </ol>
		</div>
	</ol>
	<div class="container">
		<div class="row">
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
		</div>
		<div class="row">
			<form class="form-horizontal" method="post" action="add_bookreview">
				  <div class="form-group">
				    <label class="col-sm-3 control-label" name="title">Book Title</label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" name="title" placeholder="Book Title">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-3 control-label" name="select_author">Authors</label>
				    <div class="col-sm-6">
				      <label>Choose from the list:</label>
				      <select class="form-control" name="select_author">
				      	  <option>Select Author</option>
				  <?php
				  		  foreach($authors as $author) {
				  ?>
						  
						  <option><?=$author['name']?></option>
					<?php
				}
				?>
						</select>
				    </div>
			    </div>
				    <div class="form-group">
					    <label class="col-sm-3 control-label">Or add a new author</label>
					    <div class="col-sm-6">
					      <input type="text" class="form-control" name="type_author" placeholder="Author's Name">
					    </div>
					  </div>
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
				  <input type="hidden" name="add_book_and_review" value="true">
				</form>
		</div>
	</div>
	
</body>
</html>