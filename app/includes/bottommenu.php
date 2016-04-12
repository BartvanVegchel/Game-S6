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
				<a href="#" style="display: block !important;" class="monsters-popup">
					<i class="fa fa-th-list" aria-hidden="true" style="font-size: 90%;"></i> Monsters
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

	$('.monsters-popup').click(function() {

		swal({
			title: "Dit zijn jouw monsters",
			text: "<?
			$getMonsters = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
    while($row = mysqli_fetch_assoc($getMonsters)) {
        $unlockedMonsters = $row["unlockedMonsters"];
        $unlockedMonstersArray = unserialize( $unlockedMonsters );

        foreach ($unlockedMonstersArray as $key => $value) {
            if ($key === 0){
            }
            else{
                echo "<li style='list-style: none; padding: 5px; border-bottom: 1px solid #ccc;'><img src='images/monster_" .strtolower($value). ".png' style='width: 75px;'><strong>".$value."</strong></li>";
            }

        }
    }
			?>",
			html: true
		});
		
	});

</script>