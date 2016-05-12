<?php
	include('header.php');
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-offset-2 col-md-8">
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
							
							$postDate1 = substr($postDate, -2);
							$postDate2 = substr($postDate, -5, -3);
							$postDate3 = substr($postDate, 0, 4);
							$postDate = $postDate1 . "-" . $postDate2 . "-" . $postDate3;
							?>
							
							<article class="col-xs-12 col-md-12">
								<div class="panel panel-default">

									<span class="box_overlay <?php echo $category; ?>"><?php echo $category; ?></span>
									<div class="panel-body">
										<h1><?php echo $title; ?></h1>
										<p><?php echo $content; ?></p>
									</div>
									<div class="panel-footer">
										<span class="username_post"><?php echo $username; ?></span> <span class="post_date"><?php echo $postDate; ?></span>
										<div class="clear"></div>
									</div>
								</div>
							</article>
							
							<?php
								if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd
								
									$username = $_SESSION['username'];
									
									$getUserCommentId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' ") or die("FOUT: " . mysqli_error($dblink));
								
									while($rij = mysqli_fetch_assoc($getUserCommentId)) {
										$userCommentId = $rij["id"];
									}
							?>

									<div class="col-xs-12 col-md-12">
										<form method="POST" action="send_comment_function.php" style="margin-bottom: 20px;">
											<input type="hidden" name="postId" value="<?php echo $postId; ?>" />
											<input type="hidden" name="userPostId" value="<?php echo $userId; ?>" />
											<input type="hidden" name="userCommentId" value="<?php echo $userCommentId; ?>" />
											<input type="hidden" name="userCommentName" value="<?php echo $_SESSION['username']; ?>" />
											<textarea class="form-control" placeholder="Reageren" name="comment" ></textarea>
											<input class="btn btn-primary" type="submit" name="submit" value="Plaats reactie" />
										</form>
									</div>
									
							<?php
								}
								else {
								}
							?>
							
							<?php
							
								$getSocialComments = mysqli_query($db_social, "SELECT * FROM socialComments WHERE postId = '$socialId' ") or die("FOUT: " . mysqli_error($dblink));
								
								while($rij = mysqli_fetch_assoc($getSocialComments)) {
									$commentId = $rij["id"];
									$postId = $rij["postId"];
									$userPostId = $rij["userPostId"];
									$userCommentId = $rij["userCommentId"];
									$userCommentName = $rij["userCommentName"];
									$comment = $rij["comment"];
									$postDate = $rij["postDate"];
							
									$postDate1 = substr($postDate, -2);
									$postDate2 = substr($postDate, -5, -3);
									$postDate3 = substr($postDate, 0, 4);
									$postDate = $postDate1 . "-" . $postDate2 . "-" . $postDate3;
									?>
									
									<div class="col-xs-12 col-md-12">
										<div class="row">
											<div class="col-md-2 col-sm-2 hidden-xs">
												<figure class="thumbnail">
													<img class="img-responsive" src="img/profilepic/profile_pic1.jpg" />
													<figcaption class="text-center"><?php echo $userCommentName; ?></figcaption>
												</figure>
											</div>
											<div class="col-md-10 col-sm-10">
												<div class="panel panel-default arrow left">
													<div class="panel-body">
														<header class="text-left">
															<time class="comment-date"><i class="fa fa-clock-o"></i> <?php echo $postDate; ?></time>
														</header>
														<div class="comment-post">
															<p>
																<?php echo $comment; ?>
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<?php
								}
							
							?>
								
								
							
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