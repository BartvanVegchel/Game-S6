<? 
	include('includes/header.php');
	include('functions/login_function.php');
	
	include 'includes/topmenu.php';

	
if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd?>

		<section class="socialScreenUp">
			<? include 'modules/screenover/social.php'; ?>
		</section>

		<section class="screenOver slideUp">
		<!--	<h1>Schermen van onder naar beneden</h1>-->
		</section>

		<!-- include the map -->
		<? include 'modules/map/map.php'; ?> 

		<!-- include tutorial -->
		<? //include 'functions/tutorial_function.php'; ?>

        <!-- include the popup -->
<!--        --><?// include 'modules/popup/popup.php'; ?>
<?
}
    else {
        header("Refresh: 0; url=index.php");
    }

	$monsterName = $_GET['monstername'];
	$requirement = $_GET['requirement'];

	if($monsterName && $requirement){?>
		<script>
			$monsterName = "<?php echo $monsterName;?>";
			$monsterNameLowerCase = $monsterName.toLowerCase();
			//$parentId = $('.part').find()parent().parent().attr('id');
			$monsterImage = $("img[monster-name='" + $monsterName +"']");
			$parentId = $($monsterImage).parent().parent().attr('id');
			swal({
				 title: "Gefeliciteerd!",
				 text: "<img src='images/star_rating.png'> <br>Je hebt de challenge voltooid",
				 type: "",
				 showCancelButton: false,
				 closeOnConfirm: true,
				 showLoaderOnConfirm: true,
				 confirmButtonText: "Super!",
				 html: true
			 }, function () {
				 $.ajax(
						 {
							 type: "get",
							 url: "functions/update_monsters.php",
							 data: {'monstername': $monsterName},
							 success: function (data) {}
						 }
					 )
					 .done(function (data) {
						 console.log($parentId);
						 $('#' + $parentId).find('.monsterEgg').hide();
						 $('#' + $parentId).find('.monsterbackground').append('<img src="images/egg_'+$monsterNameLowerCase+'_broken.png" monster-name='+$monsterName+'>');
					 })
					 .error(function (data) {
						 swal("Oeps", "We denken dat er iets verkeerd is gegaan.", "error");
					 });
			 });
		</script>
	<?php }

include 'includes/bottommenu.php';
include 'includes/footer.php'; 
?>