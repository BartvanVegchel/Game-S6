</section><!-- end container-->

<section class="nav bottom">

	<nav>
		<ul>
			<li>
				<a href="">
					<span class="screenup">Settings</span>
				</a>
			</li><li class="questmaster-wrapper">&nbsp;
				<a class="questmaster">
					<img src="images/tutorial_guy.png">
				</a>
			</li><li>
				<a href="#">
					Vriendjes
				</a>
			</li>
		</ul>
	</nav>
	
</section>

<script>

	$('.questmaster').click(function() {

		swal({
			title: "Hallo <? echo $_SESSION['username']; ?>",
			text: "Heb je een vraag over het spel? Vraag een begeleider om hulp.",
			imageUrl: "images/tutorial_guy.png"
		});
		
	});

</script>