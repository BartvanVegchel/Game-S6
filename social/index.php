<?php include('header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<section class="blog">
				<div class="row">
					<!-- while loop = -->
					
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
							
							?>
								
								<article class="col-xs-12 col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<?php echo "<img src='./" . $image . "' height='300px' width='100%' alt='#' />"; ?>
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
					
					<article class="col-xs-12 col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<img src="img/social_bg.png" height="100px" width="100%" alt="#">
							</div>
							<div class="panel-body">
								<h1>Titel bericht</h1>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quia nec honesto quic quam honestius nec turpi turpius. Quae quidem vel cum periculo est quaerenda vobis; Omnia contraria, quos etiam insanos esse vultis. Multa sunt dicta ab antiquis de contemnendis ac despiciendis rebus humanis; Tollitur beneficium, tollitur gratia, quae sunt vincla concordiae. Duo Reges: constructio interrete. Nam prius a se poterit quisque discedere quam appetitum earum rerum.</p>
							</div>
							<div class="panel-footer">
								<span>12-12-2012</span>
							</div>
						</div>
					</article>
					
					<article class="col-xs-12 col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<img src="img/social_bg.png" height="100px" width="100%" alt="#">
							</div>
							<div class="panel-body">
								<h1>Titel bericht</h1>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quia nec honesto quic quam honestius nec turpi turpius. Quae quidem vel cum periculo est quaerenda vobis; Omnia contraria, quos etiam insanos esse vultis. Multa sunt dicta ab antiquis de contemnendis ac despiciendis rebus humanis; Tollitur beneficium, tollitur gratia, quae sunt vincla concordiae. Duo Reges: constructio interrete. Nam prius a se poterit quisque discedere quam appetitum earum rerum.</p>
							</div>
							<div class="panel-footer">
								<span>12-12-2012</span>
							</div>
						</div>
					</article>
					
					<article class="col-xs-12 col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<img src="img/social_bg.png" height="100px" width="100%" alt="#">
							</div>
							<div class="panel-body">
								<h1>Titel bericht</h1>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quia nec honesto quic quam honestius nec turpi turpius. Quae quidem vel cum periculo est quaerenda vobis; Omnia contraria, quos etiam insanos esse vultis. Multa sunt dicta ab antiquis de contemnendis ac despiciendis rebus humanis; Tollitur beneficium, tollitur gratia, quae sunt vincla concordiae. Duo Reges: constructio interrete. Nam prius a se poterit quisque discedere quam appetitum earum rerum.</p>
							</div>
							<div class="panel-footer">
								<span>12-12-2012</span>
							</div>
						</div>
					</article>
				</div>
			</section>
		</div>

		<div class="col-xs-12 col-md-4">
			<section class="sidebar">

				<h2>Sidebar</h2>
				dsojfsd\vsj

			</section>
		</div>
	</div>
</div>



<?php include('footer.php'); ?>

