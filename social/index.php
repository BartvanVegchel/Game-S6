<?php include('header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<section class="social">
				<div class="row">
					<!-- while loop -->					
					<?php
					
						$getSocialPosts = mysqli_query($db_social, "SELECT * FROM social ORDER by id DESC LIMIT 8") or die("FOUT: " . mysqli_error($dblink));
										
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
								
								<article class="col-xs-12 col-sm-6 col-md-4">
									<div class="social_block">
										<a href="social_item.php?id=<?php echo $postId; ?>"></a>
										<div class="social_img">
											<img src='img/social/<?php echo $category; ?>.jpg' />
										</div>
										<div class="social_text">
										<p><?php echo $title; ?></p>
										</div>
										<div class="clear"></div>
									</div>
								</article>
							
							<?php
						}
					?>
				</div>
			</section>
		
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
											<h1><a href="blog_item.php?id=<?php echo $postId; ?>"><?php echo $title; ?></a></h1>
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
		<?php include('sidebar.php'); ?>
	</div>
</div>



<?php include('footer.php'); ?>

