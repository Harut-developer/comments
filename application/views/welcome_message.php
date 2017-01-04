<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Comments</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" />
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" />
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
	<!--Pulling Awesome Font -->
	<div class="container">
	    <div class="row">
	        <div class="col-md-offset-5 col-md-3">
	            <div class="form-login">
	            	<h4>Welcome back.</h4>
	            	<form method="post">
		            	<input type="text" name="userName" id="userName" class="form-control input-sm chat-input" placeholder="username" />
		            	</br>
			            <div class="wrapper">
				            <span class="group-btn">
				                <button class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
				            </span>
			            </div>
		            </form>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>
