<?php include('header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<section class="blog">
				<div class="row">
					<!-- while loop -->					
					<?php
					
						$getNewsPosts = mysqli_query($db_social, "SELECT * FROM posts WHERE category = 'news' LIMIT 6") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
										
						while($rij = mysqli_fetch_assoc($getNewsPosts)) {
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
								
								<article class="col-xs-12 col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											<?php echo "<img src='./" . $image . "' height='200px' width='100%' alt='#' />"; ?>
											<?php echo "<span class='category-overlay'>" . $category . "</span>"; ?>
										</div>
										<div class="panel-body">
											<h1><?php echo $title; ?></h1>
											<p><?php echo $content; ?></p>
										</div>
										<div class="panel-footer">
											<span><?php echo "Geplaatst op: " . $postDate; ?></span>
										</div>
									</div>
								</article>
							
							<?php
						}
					?>
				</div>
			</section>
		</div>

		<div class="col-xs-12 col-md-4">
			<section class="sidebar">
					
				<?php
				
					$getEventPosts = mysqli_query($db_social, "SELECT * FROM posts WHERE category = 'events' LIMIT 1") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
									
					while($rij = mysqli_fetch_assoc($getEventPosts)) {
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
							
							<article class="col-xs-12 col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<?php echo "<img src='./" . $image . "' height='180px' width='100%' alt='#' />"; ?>
										<?php echo "<span class='category-overlay'>" . $category . "</span>"; ?>
									</div>
									<div class="panel-body">
										<div class="post_date">
											<span class="date_day"><?php echo $postDate1; ?></span>
											<span class="date_month"><?php echo $postDate2; ?></span>
											<span class="date_year"><?php echo $postDate3; ?></span>
										</div>
										<h1><?php echo $title; ?></h1>
										<p><?php echo $content; ?></p>
									</div>
									<div class="panel-footer">
										<span><?php echo "Geplaatst op: " . $postDate; ?></span>
									</div>
								</div>
							</article>
						
						<?php
					}
				
				?>

			</section>
		</div>
	</div>
</div>



<?php include('footer.php'); ?>

