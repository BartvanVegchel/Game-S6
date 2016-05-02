<?php
	include('header.php');
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<div class="row">

				<?php

				$socialId = $_GET['id'];

				if($socialId != ''){
					$query = mysqli_query($db_social, "SELECT * FROM social WHERE id = '$socialId' ") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele
					$socialResult = $query->num_rows;
					if ($socialResult == 1){
						while($rij = mysqli_fetch_assoc($query)) {
							$postId = $rij["id"];
							$username = $rij["username"];
							$userId = $rij["userId"];
							$title = $rij["title"];
							$content = $rij["content"];
							$category = $rij["category"];
							$postDate = $rij["postDate"];
							$image = $rij["image"];
							?>
							
							<article class="col-xs-12 col-md-12">
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
							
							<div class="col-xs-12 col-md-12">
								<form method="POST" action="send_comment_function.php" style="margin-bottom: 20px;">
									<input type="hidden" name="postId" value="<?php echo $postId; ?>" />
									<input type="hidden" name="userPostId" value="<?php echo $userId; ?>" />
									<input type="hidden" name="userCommentId" value="<?php echo ''; ?>" />
									<input type="hidden" name="userCommentName" value="<?php echo $_SESSION['username']; ?>" />
									<textarea class="form-control" placeholder="Doe hier maar wat typen ofzo" ></textarea>
									<input class="btn btn-primary" type="submit" name="submit" value="Plaats reactie" />
								</form>
							</div>
							
							<div class="col-xs-12 col-md-12">
								<div class="row">
									<div class="col-md-2 col-sm-2 hidden-xs">
										<figure class="thumbnail">
											<img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
											<figcaption class="text-center">username</figcaption>
										</figure>
									</div>
									<div class="col-md-10 col-sm-10">
										<div class="panel panel-default arrow left">
											<div class="panel-body">
												<header class="text-left">
													<div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
													<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
												</header>
												<div class="comment-post">
													<p>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
													</p>
												</div>
												<p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						<?php
							
						} //endif als blogbericht bestaat
						?>
						
						<?php
						
					} else{
						echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Blogitem does not exist</strong>" . "<p>Go back and try another blogitem.</p></div></div>";
					} // als blog niet bestaat
				} //endif blog is not empty 
				else{
					echo "<div class='container'><div class='alert alert-danger'><strong><span class=\"entypo-block\"></span>Blogitem does not exist</strong>" . "<p>Go back and try another blogitem.</p></div></div>";
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php');?>