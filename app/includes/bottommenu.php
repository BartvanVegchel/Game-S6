</section><!-- end container-->

<section class="nav bottom">

	<nav>
		<ul>
			<li>
				<a href="#"  class="dailychallenge-popup">
					<i class="fa fa-trophy" aria-hidden="true"></i>
				</a>
			</li><li class="questmaster-wrapper">&nbsp;
				<a class="questmaster">
					<img src="images/tutorial_guy.png">
				</a>
			</li><li>
				<a href="monsters.php" class="monsters-popup">
					<img src="images/monster_icon.png" style="height: 30px; width: auto;;">
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

//	$('.monsters-popup').click(function() {
//		swal({
//			title: "Dit zijn jouw monsters",
//			text: "<div><ul style='width:100%;'><?//
//			$getMonsters = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
//			while($row = mysqli_fetch_assoc($getMonsters)) {
//				$unlockedMonsters = $row["unlockedMonsters"];
//				$unlockedMonstersArray = unserialize( $unlockedMonsters );
//
//				foreach ($unlockedMonstersArray as $key => $value) {
//					if ($key === 0){
//					}
//					else{
//						echo "<li style='list-style: none; padding: 5px; border-bottom: 1px solid #ccc; width: 43%; float: left;'><img src='images/monster_" .strtolower($value). ".png' style='width: 75px;'></li>";
//					}
//
//				}
//			}
//			?>//</ul></div><div style='clear: both;'></div>",
//			html: true
//		});
//	});

	$('.dailychallenge-popup').click(function() {
		<?php
			$allDailyChallenge = mysqli_query($db, "SELECT * FROM dailyChallenges") or die("FOUT: " . mysqli_error($dblink));
			$dailyChallengeCount=mysqli_num_rows($allDailyChallenge);
            $chosenChallenge = rand(1,$dailyChallengeCount);

		?>
		swal({
            <?php
            $getDailyChallenge = mysqli_query($db, "SELECT * FROM dailyChallenges WHERE id = '$chosenChallenge'") or die("FOUT: " . mysqli_error($dblink));
			while($row = mysqli_fetch_assoc($getDailyChallenge)) {
                $dailyChallengeName = $row['name'];
                $dailyChallengeDescription = $row['description'];
                $dailyChallengeRequirment = $row['requirement'];
                $dailyChallengeTimelimit = $row['timelimit'];
                $dailyChallengeReward = $row['reward'];
			}
            ?>
            title: "<?php echo $dailyChallengeName;?>",
            text: "<?php echo $dailyChallengeDescription;?>",
            confirmButtonText: "Start",
            showCancelButton: true,
            cancelButtonText: "Nu niet",
            },
            function(){
                window.location.href = 'daily_challenge.php?challengeid=<?php echo $chosenChallenge;?>';
            });
	});

</script>