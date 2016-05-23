<?php include('header.php'); ?>

<div class="page_intro">

	<div class="playbtn" data-toggle="modal" data-target="#exampleModal" >
		<img src="img/play-button.png" alt="Play video" />
	</div>

	<div class="intro_bg">
		<img src="img/header_bg.png" alt="" />
	</div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/QB3ry-04G-I" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>


<div class="page_explore">

	<div class="row explore_push">

		<div class="explore_text">
			<h2>Ontdek nieuwe werelden!</h2>
			<p>Verken zoveel nieuwe werelden als je kunt en vang monsters door in het echt te bewegen!</p>
		</div>

	</div><!--/row-->

	<div class="explore_bg">
		<img src="img/explore_bg.png" alt="" />
	</div>

</div>


<div class="page_monsters">

	<div class="row explore_push">

		<div class="monsters_text">
			<h2>Vang alle monsters die je tegen komt!</h2>
			<p>Probeer alle monsters te vangen door ze uit te dagen voor een challenge!</p>
			<a href="monsterdex.php" class="btn">Bekijk de Monsterdex!</a>
		</div>



	</div><!--/row-->

	<div class="monsters_bg">
		<img src="img/monsters_bg.png" alt="" />
	</div>

</div>

<div class="page_play">

	<div class="play_bg">
		<img src="img/play_bg.png" alt="" />
	</div>

	<div class="row explore_push">

		<div class="col-xs-12 text-center">
			<div class="play_text">
				<h2>Speel nu!</h2>
				<p>Download de app meteen op je smartphone!</p>

				<div class="download_icons">
					<img src="img/apple_app.png" alt="" />
					<img src="img/android_app.png" alt="" />
				</div>

			</div>
		</div>


	</div><!--/row-->

</div>









<?php include('footer.php'); ?>

