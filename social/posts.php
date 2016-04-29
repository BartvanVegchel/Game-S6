<?php include('header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<section class="social">
				<!-- EVENTS -->
				<div class="row">
					<div class="table-responsive col-md-12">
						<table class="table table-bordered">
							<!-- while loop -->					
							<?php
							
								$getSocialPosts = mysqli_query($db_social, "SELECT * FROM posts WHERE category = 'events' ORDER by id DESC LIMIT 1") or die("FOUT: " . mysqli_error($dblink));
												
								while($rij = mysqli_fetch_assoc($getSocialPosts)) {
									$postId = $rij["id"];
									$username = $rij["username"];
									$userId = $rij["userId"];
									$title = $rij["title"];
									$content = $rij["content"];
									$category = $rij["category"];
									$postDate = $rij["postDate"];
									$image = $rij["image"];
									
									$postDate1 = substr($postDate, -2);
									$postDate2 = substr($postDate, -5, -3);
									$postDate3 = substr($postDate, 0, 4);
									$postDate = $postDate1 . "-" . $postDate2 . "-" . $postDate3;
									
									?>
									
										<tr>
											<td>
											<?php echo "<img src='./" . $image . "' height='200px' width='100%' alt='#' />"; ?>
											<?php echo $category; ?>
											<h1><a href="social_item.php?id=<?php echo $postId; ?>"><?php echo $title; ?></a></h1>
											<p><?php echo $content; ?></p>
											<span><?php echo "Geplaatst op: " . $postDate; ?></span>
											</td>
										</tr>
									
									<?php
								}
							?>
						</table>
					</div>
				</div>
				<!-- HELP -->
				<div class="row">
					<div class="table-responsive col-md-12">
						<table class="table table-bordered">
							<!-- while loop -->					
							<?php
							
								$getSocialPosts = mysqli_query($db_social, "SELECT * FROM posts WHERE category = 'news' ORDER by id DESC") or die("FOUT: " . mysqli_error($dblink));
												
								while($rij = mysqli_fetch_assoc($getSocialPosts)) {
									$postId = $rij["id"];
									$username = $rij["username"];
									$userId = $rij["userId"];
									$title = $rij["title"];
									$content = $rij["content"];
									$category = $rij["category"];
									$postDate = $rij["postDate"];
									$image = $rij["image"];
									
									$postDate1 = substr($postDate, -2);
									$postDate2 = substr($postDate, -5, -3);
									$postDate3 = substr($postDate, 0, 4);
									$postDate = $postDate1 . "-" . $postDate2 . "-" . $postDate3;
									
									?>
									
										<tr>
											<td>
											<?php echo "<img src='./" . $image . "' height='200px' width='100%' alt='#' />"; ?>
											<?php echo $category; ?>
											<h1><a href="social_item.php?id=<?php echo $postId; ?>"><?php echo $title; ?></a></h1>
											<p><?php echo $content; ?></p>
											<span><?php echo "Geplaatst op: " . $postDate; ?></span>
											</td>
										</tr>
									
									<?php
								}
							?>
						</table>
					</div>
				</div>
			</section>
		</div>
		<?php include('sidebar.php'); ?>
	</div>
</div>



<?php include('footer.php'); ?>