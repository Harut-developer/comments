<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Comments</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" />
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
	<script type="text/javascript">
		base_url = '<?php echo base_url(); ?>';
	</script>
</head>
<body>

<div class="container" id="comments">
	<br />
	<?php if(count($comments) > 0): ?>
		<?php foreach($comments as $comment): ?>
			<div class="row">
				<div class="col-sm-1">
					<div class="thumbnail">
						<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
					</div><!-- /thumbnail -->
				</div><!-- /col-sm-1 -->

				<div class="col-sm-5">
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong><?=$comment['username'];?></strong>
							<span class="text-muted">
								commented 
								<?php
								$datetime1 = new DateTime($comment['date']);

								$datetime2 = new DateTime("now");

								$difference = $datetime1->diff($datetime2);
								if ($difference->y) {
									echo $difference->y.' yers';
								} elseif ($difference->m) {
									echo $difference->m.' months';
								} elseif ($difference->d) {
									echo $difference->d.' days';
								} elseif ($difference->h) {
									echo $difference->h.' hours';
								} elseif ($difference->i) {
									echo $difference->i.' minutes';
								} elseif ($difference->s) {
									echo $difference->s.' seconds';
								} else {
									echo '1 second';
								}
								?>
								ago
							</span>
						</div>
						<div class="panel-body">
							<?=$comment['description'];?>
						</div><!-- /panel-body -->
					</div><!-- /panel panel-default -->
				</div><!-- /col-sm-5 -->
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="row">Have no comments.</div>
	<?php endif ?>
</div>
<div class="container">
	<form method="post">
		<div class="form-group relative">
		  <div class="typing hide"> dsad asd asd asd asd asd </div>
		  <label for="comment">Comment:</label>
		  <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
		</div>
		<button class="btn btn-primary btn-md">Add</button>
	</form>
</div>
</body>
</html>