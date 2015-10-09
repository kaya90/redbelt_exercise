<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<style type="text/css">
		.space-right{
			padding-right: 15px;
		}
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
			<h3>Welcome</h3>
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
			<div class="col-xs-6 ">
				
				<h5>REGISTER</h5>
				<form class="form-horizontal" method="post" action="add">
				  <div class="form-group" class="form-group">
				    <label class="col-sm-4 control-label">First Name</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="first_name" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group" class="form-group">
				    <label class="col-sm-4 control-label">Last Name</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" name="last_name" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group" class="form-group">
				    <label class="col-sm-4 control-label">Email</label>
				    <div class="col-sm-8">
				      <input type="email" class="form-control" name="email" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group" class="form-group">
				    <label class="col-sm-4 control-label">Password</label>
				    <div class="col-sm-8">
				      <input type="password" class="form-control" name="password" placeholder="Email">
				    	
				    </div>
				    <p class="col-sm-offset-2 text-right space-right">*Password should be at least 8 characters</p>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-4 control-label">Confirm Password</label>
				    <div class="col-sm-8">
				      <input type="password" class="form-control" name="confirm_password" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-8">
				      <button type="submit" class="btn btn-primary">Register</button>
				    </div>
				  </div>
				  <input type="hidden" name="validation" value="registration">
				</form>
			</div>
			<div class="col-xs-6">
				<h5>LOGIN</h5>
				<form class="form-horizontal" method="post" action="login">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
				    <div class="col-sm-8">
				      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-10">
				      <button type="submit" class="btn btn-primary">Sign in</button>
				    </div>
				  </div>
				  <input type="hidden" name="validation" value="login">
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>