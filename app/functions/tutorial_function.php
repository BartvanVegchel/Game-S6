 <?php

include_once 'includes/db_connection.php';
include_once 'includes/header.php';

$username = $_SESSION["username"];

//check userId
$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'") or die("FOUT: " . mysqli_error($dblink));
while($row = mysqli_fetch_assoc($getUserId)) {
    $userId = $row["id"];
	
	$getTutorialStatus = mysqli_query($db, "SELECT * FROM userProgress WHERE userId = '$userId'") or die("FOUT: " . mysqli_error($dblink));
	while($row = mysqli_fetch_assoc($getTutorialStatus)) {
		$tutorialStatus = $row["tutorialComplete"];
		//echo $tutorialStatus;
		
		?>
		<?php
	}
	
}

if ( $tutorialStatus == 0 ){
?>

		<script>
			$(window).load(function(){
			
				$tutorialValue = 1;
			
				swal({
					title: "Kan ik je helpen? " + $tutorialValue,
					text: "Ik wil je graag helpen in het spel.",
					imageUrl: "images/tutorial_guy.png",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ja, help me",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					$tutorialValue = 2;
					//console.log($tutorialValue);
					if (isConfirm) {
                        swal({
                            title: "Goedzo! " + $tutorialValue,
                            text: "Leuk dat ik je mag helpen. Laten we snel verder gaan.",
							confirmButtonColor: "#DD6B55",
                            showConfirmButton: true
                        });
					} else {
					}
				});
			
			});
			
		</script>
<?php
	
}
else {
}

?>




<?php

include_once 'includes/footer.php';

?>