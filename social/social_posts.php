<?php include('header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<section class="social">
				<!-- GENERAL -->
				<div class="row">
					<div class="col-md-12">

						<div class="panel-body filter">
							<button class="btn btn-small btn-primary" data-toggle="portfilter" data-target="all">
								Alles
							</button>
							<button class="btn btn-small btn-primary general" data-toggle="portfilter" data-target="general">
								Algemeen
							</button>
							<button class="btn btn-small btn-primary help" data-toggle="portfilter" data-target="help">
								Help
							</button>
							<button class="btn btn-small btn-primary ideas" data-toggle="portfilter" data-target="ideas">
								Ideeën
							</button>
							<button class="btn btn-small btn-primary bugs" data-toggle="portfilter" data-target="bugs">
								Bugs
							</button>
						</div>


							<!-- while loop -->
							<?php
							
								$getSocialPosts = mysqli_query($db_social, "SELECT * FROM social ORDER by id DESC") or die("FOUT: " . mysqli_error($dblink));
												
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
										<article class="col-xs-12 col-md-12" data-tag="<?php echo $category; ?>">
											<div class="panel">
												<span class="box_overlay <?php echo $category; ?>"><?php echo $category; ?></span>
												<div class="panel-body">
													<h1><a href="social_item.php?id=<?php echo $postId; ?>"><?php echo $title; ?></a></h1>
													<p><?php echo $content; ?></p>
													</div>

												<div class="panel-footer">
													<span class="username_post"><?php echo $username; ?></span><span class="post_date"><?php echo $postDate; ?></span>
													<div class="clear"></div>
												</div>
											</div>
										</article>

									<?php
								}
							?>
					</div>
				</div>
			</section>
		</div>

		<?php include('sidebar.php'); ?>
	</div>
</div>


<script src="js/bootstrap-portfilter.min.js"></script>
<?php include('footer.php'); ?>