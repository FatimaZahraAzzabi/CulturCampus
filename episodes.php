<?php
@include 'conn_db.php';

if(isset($_GET['/'])) {
    $programme_id = $_GET['/'];
    $sql_episodes = "SELECT *, audio FROM episodes WHERE id_programme = $programme_id AND visibility = 1"; // Ajout de la condition visibility = 1 pour afficher uniquement les épisodes visibles
}

// Requête SQL pour compter le nombre d'épisodes dans le programme
$sql_episode_count = "SELECT COUNT(*) AS episode_count FROM episodes WHERE id_programme = $programme_id AND visibility = 1";
$result_episode_count = mysqli_query($conn, $sql_episode_count);
$row_episode_count = mysqli_fetch_assoc($result_episode_count);
$episode_count = $row_episode_count['episode_count'];

// Requête pour récupérer les détails du programme
$sql2 = "SELECT titre_programme, image_prog, enregistre_par, description_programme FROM programme WHERE id_programme = '$programme_id' ";
$result = mysqli_query($conn, $sql2);


session_start(); // Démarrez la session pour stocker les informations sur les likes

if (isset($_GET['episode_id']) && isset($_GET['action'])) {
    $episodeId = $_GET['episode_id'];

    if ($_GET['action'] === 'like') {
        // Vérifiez si l'utilisateur n'a pas déjà aimé ce podcast
        if (!isset($_SESSION['liked_episodes']) || !in_array($episodeId, $_SESSION['liked_episodes'])) {
            // Mettez à jour le nombre de likes dans la base de données
            $updateQuery = "UPDATE episodes SET likes = likes + 1 WHERE id_episode = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("i", $episodeId);
            $stmt->execute();
            $stmt->close();

            // Ajoutez l'ID du podcast aux likes de l'utilisateur
            $_SESSION['liked_episodes'][] = $episodeId;
        }
    } elseif ($_GET['action'] === 'unlike') {
        // Retirez le like de l'utilisateur s'il existe
        if (isset($_SESSION['liked_episodes']) && in_array($episodeId, $_SESSION['liked_episodes'])) {
            // Requête SQL pour "unlike"
            $updateQuery = "UPDATE episodes SET likes = likes - 1 WHERE id_episode = ?";
            // Vérifiez si la requête SQL est correcte
            if ($stmt = $conn->prepare($updateQuery)) {
                // Liaison des paramètres et exécution de la requête
                $stmt->bind_param("i", $episodeId);
                $stmt->execute();
                $stmt->close();
                // Retirez l'ID du podcast des likes de l'utilisateur
                $_SESSION['liked_episodes'] = array_diff($_SESSION['liked_episodes'], array($episodeId));
            } else {
                // Afficher l'erreur SQL s'il y en a une
                echo "Error: " . $conn->error;
            }
        }
    }
	

    // Redirigez vers la même page pour éviter la répétition de l'action lors du rafraîchissement de la page
    header('Location: episodes ' . '?/=' . $programme_id);
    exit();
}



?>
<!DOCTYPE html>
<html lang="zxx">
<head>
		<title>Cultur campus | Podcasts</title>

	<meta charset="UTF-8">
	<meta name="description" content="SolMusic HTML Template">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
<link href="img/favicon1.jpeg" rel="shortcut icon"/>
	<!-- Google font -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
    <link rel="stylesheet" href="css/masterPlay.css">

    <script src="js/jquery-3.2.1.min.js"></script>

	<!-- Main Stylesheets -->
	<!-- <link rel="stylesheet" href="css/style3.css"/> -->


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		 /* Styles pour les boutons de like */
		 .like-button {
            text-decoration: none;
            color: #333;
        }
        .like-button:hover {
            color: #ff6347; /* Couleur de l'icône like au survol */
        }
	.songs-section {
    padding: 50px 0;
}

.song-item {
    margin-bottom: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.song-item:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

.song-info-box {
    display: flex;
    align-items: center;
    padding: 20px;
}

.song-info-box img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.song-info-box img:hover {
    transform: scale(1.1);
}

.song-info h4 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
}

.song-info p {
    font-size: 14px;
    color: #666;
}

.single_player_container {
    display: flex;
    align-items: center;
}

.songs-links {
    display: flex;
    align-items: center;
}

.songs-links a {
    margin-right: 10px;
}

/* Animation pour le bouton de lecture */
.song-info-box:hover .play-button {
    opacity: 1;
    transform: scale(1);
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.play-button img {
    width: 50px;
    height: 50px;
}

/* Animation pour le bouton de like */
.like-button {
    transition: transform 0.3s ease;
}

.like-button:hover {
    transform: scale(1.1);
}

/* Styles pour les boutons de téléchargement et de like */
.tel-button,
.like-button {
    text-decoration: none;
    color: #333;
    transition: transform 0.3s ease;
    margin-right: 10px;
}

.tel-button:hover,
.like-button:hover {
    transform: scale(1.1);
}

@import url(https://fonts.googleapis.com/css?family=Lato:100,300,400,700);
@import url(https://raw.github.com/FortAwesome/Font-Awesome/master/docs/assets/css/font-awesome.min.css);

*{box-sizing: border-box;
}

.search-box{
  
  width: fit-content;
  height: fit-content;
  position: relative;
}
.input-search{
  height: 50px;
  width: 50px;
  border-style: none;
  padding: 10px;
  font-size: 18px;
  letter-spacing: 2px;
  outline: none;
  border-radius: 25px;
  transition: all .5s ease-in-out;
  background-color: #130f40;
  padding-right: 40px;
  color:#130f40;
}
.input-search::placeholder{
  color:#130f40;
  font-size: 18px;
  letter-spacing: 2px;
  font-weight: 100;
}
.btn-search{
  width: 50px;
  height: 50px;
  border-style: none;
  font-size: 20px;
  font-weight: bold;
  outline: none;
  cursor: pointer;
  border-radius: 50%;
  position: absolute;
  right: 0px;
  color:#ffffff ;
  background-color:#130f40;
  pointer-events: painted;  
}
.btn-search:focus ~ .input-search{
  width: 300px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid #130f40;
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}
.input-search:focus{
  width: 300px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid #130f40;
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}

 
#notFound {
    display: none;
    text-align: center;
    padding: 20px;
    background-color: #f8d7da; /* Couleur de fond rouge pour indiquer un message d'erreur */
    color: #721c24; /* Couleur du texte pour contraster avec le fond */
    border-radius: 5px;
    margin-top: 20px;
}

#notFound img {
    max-width: 100px; /* Ajustez la largeur de l'image selon vos besoins */
    margin-bottom: 10px; /* Espace entre l'image et le texte */
}

.song-item.active {
    background-color: #7db7cbb7;
}
.episode-number {
    font-size: 20px;
    font-weight: bold;
    margin-right: 10px;
    background-color:#0a92c0;
    color:white;
    width:25px;
}
</style>

</head>
<body>

	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<!-- Header section -->
	<?php include 'header.php'; ?>

	<!-- Header section end -->
   


<section class="songs-details-section">
        <?php
    
         if (mysqli_num_rows($result) > 0) : ?>
            <?php $row = mysqli_fetch_assoc($result); ?>
            <div class="song-details-box">
                <h2>Programme details</h2>
                <br><br>
                <div class="artist-details">
                    <img src="img/programme_images/<?php echo $row['image_prog']; ?>" >
                    <div class="ad-text">
                        <h4><?php echo $row['titre_programme']; ?></h4>
                        <p><?php echo $row['enregistre_par']; ?></p>
                        <p><?php echo $row['description_programme']; ?></p>
                        <h5>Nombre d'épisodes :  <?php echo $episode_count; ?> </h5>

                    </div>
                </div>
            </div>
        <?php else : ?>
            <p>Aucun détail de programme trouvé.</p>
        <?php endif; ?>
    </section>

		<div class="container-fluid">
         
        
			<div class="section-title">
                
  

<br><br>

			<h2>	&nbsp;&nbsp;Episode <i class="fa-solid fa-microphone-lines"></i></h2>
            <center>
<div class="search-box">
    <button class="btn-search"><i class="fas fa-search"></i></button>
    <input id="searchInput" name="search" type="text" class="input-search" placeholder="Type to Search...">
  </div></center>
        </div>
        
        


	<!-- Songs section  -->
	<div class="section-title">
	
		</div>	

	
	<section class="songs-section">
		
			<div class="container">
			
	<!-- song -->
    
	<?php  
	       if(isset($_GET['/'])) {
            $programme_id = $_GET['/'];
       
		   $select = mysqli_query($conn, "SELECT * FROM episodes WHERE visibility = 1 AND id_programme = $programme_id "); 
	    } else {
            echo "ID du programme non spécifié.";
        }
		   while($row = mysqli_fetch_assoc($select)){
            $episodeId = $row['id_episode'];
            $sql2 = "SELECT titre_programme,image_prog FROM programme WHERE id_programme='" . $row['id_programme'] . "'";
            $result2 = mysqli_query($conn, $sql2);
            $row2= mysqli_fetch_assoc($result2);
            ?>
	
			<div class="song-item">
		
            <div class="episode-number">&nbsp;<?php echo $row['num_episode']; ?></div><!-- Numéro de l'épisode -->


				<div class="row">

					<div class="col-lg-4">
                    
						<div class="song-info-box">
							<img src="img/programme_images/<?php echo $row2['image_prog']; ?>" alt="">
							<div class="song-info">
									<h4><?php echo $row['nom_episode']; ?></h4>	
                                    <P></P>
				
								</div>
						</div>
					</div>
					<div class="col-lg-6">
                    <div class="single_player_container">
                <div class="single_player">
                    <!-- Player Controls -->


                    <div class="player_controls_box" id="audio-<?php echo $episodeId; ?>">
    <audio id="audioPlayer-<?php echo $episodeId; ?>" data-podcast-id="<?php echo $episodeId; ?>" src="audios/audios_episodes/<?php echo $row['audio']; ?>" type="audio/mpeg"></audio>
    <button class="jp-prev player_button" id="prevButton-<?php echo $episodeId; ?>" tabindex="0">
        <i class="fa fa-backward" style="font-size: 1px;"></i>
    </button>
    <button class="jp-play player_button" id="playButton-<?php echo $episodeId; ?>" tabindex="0">
        <i class="fa fa-play" style="color:white;" style="font-size: 1px;"></i>
    </button>
    <button class="jp-next player_button" id="nextButton-<?php echo $episodeId; ?>" tabindex="0">
        <i class="fa fa-forward" style="font-size: 1px;"></i>
    </button>
    <button class="jp-stop player_button" id="stopButton-<?php echo $episodeId; ?>" tabindex="0">
        <i class="fa fa-stop" style="font-size: 1px;"></i>
    </button>
</div>
                  
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="audio-duration" id="duration-<?php echo $episodeId; ?>"></span>

            </div>

 <!-- script pour play pause audio -->

            <script>
document.addEventListener('DOMContentLoaded', function() {
    var audio = document.getElementById('audioPlayer-<?php echo $episodeId; ?>');
    var playButton = document.getElementById('playButton-<?php echo $episodeId; ?>');
    var stopButton = document.getElementById('stopButton-<?php echo $episodeId; ?>');
    
    playButton.addEventListener('click', function() {
        if (audio.paused) {
            audio.play();
            playButton.innerHTML = '<i class="fa fa-pause" style="color:white;"></i>';
        } else {
            audio.pause();
            playButton.innerHTML = '<i class="fa fa-play" style="color:white;"></i>';
        }
    });

    stopButton.addEventListener('click', function() {
        audio.pause();
        audio.currentTime = 0;
        playButton.innerHTML = '<i class="fa fa-play" style="color:white;"></i>';
    });
});

</script>



</div>

					<div class="col-lg-2">
					<div class="songs-links">
    <?php
        $programme_id = isset($_GET['/']) ? $_GET['/'] : ''; // Récupération de l'ID du programme
        $likeAction = isset($_SESSION['liked_episodes']) && in_array($row['id_episode'], $_SESSION['liked_episodes']) ? 'unlike' : 'like';
        $likeIcon = $likeAction === 'like' ? 'fa-regular' : 'fa-solid';
      // Construction des liens de like et unlike avec l'ID du programme
$likeLink = "?action={$likeAction}&episode_id={$row['id_episode']}&/={$programme_id}";

// Affichage des liens
echo "<a href='{$likeLink}' class='like-button'>";
echo "<i class='{$likeIcon} fa-heart'></i> {$row['likes']}";
echo "</a>";


    ?>

    
      <a href="#" style="color:black;">
        <i class="fa-solid fa-headphones"></i>   <?php echo $row['listeners']; ?>
    </a>
  <a class='tel-button' href="audios/audios_episodes/<?php echo $row['audio']; ?> " download="<?php echo $row['nom_episode']; ?> --<?php echo $row['num_episode']; ?> " style="color:black;">
	<i class="fa-solid fa-download" ></i> </a>
</div>


									</div>	
				</div>
				
			</div>
		
			<?php } ?>	
            <div id="notFound" style="display: none;">Aucun résultat trouvé
    </div>
								
		
	</section>	
 
	<!-- Songs section end -->
 <!-- MasterPlay Section -->
 <!-- <section class="masterPlay">
            <div class="leftside">
                <img src="" id="episodeImage">
                <div class="song-details">
                    <p class="song-title"></p>
                    <p class="artist-name"></p>
                </div>
                <i class="fa-solid fa-circle-plus plus-button"></i>
            </div>
            <div class="middle">
                <audio controls id="audioPlayer">
                    Votre navigateur ne supporte pas l'élément audio.
                </audio>
            
            </div>
        </section> -->

        
<!-- Footer section -->
<?php include 'footer.php'; ?>
<!-- Footer section end -->

 <!-- Script pour la gestion de la lecture des podcasts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Écoutez l'événement de lecture de chaque élément audio
    $('audio').on('play', function() {
        // Récupérez l'ID du podcast en cours de lecture
        var currentPodcastId = $(this).data('episode-id');
        // Parcourez tous les autres éléments audio
        $('audio').each(function() {
            // Si l'élément audio n'est pas celui en cours de lecture, mettez-le en pause
            if ($(this).data('episode-id') !== currentPodcastId) {
                this.pause(); // Mettez en pause l'élément audio
            }
        });
    });
});
</script>
<!-- script pour afficher la durée d'un podcast -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour obtenir la durée formatée de l'audio
    function getFormattedAudioDuration(audio) {
        var duration = Math.floor(audio.duration);
        var hours = Math.floor(duration / 3600);
        var minutes = Math.floor((duration % 3600) / 60);
        var seconds = duration % 60;
        var formattedDuration = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        return formattedDuration;
    }

    var audioElements = document.querySelectorAll('audio');
    
    audioElements.forEach(function(audio) {
        audio.addEventListener('loadedmetadata', function() {
            var episodeId = audio.dataset.podcastId; // Utilisez 'podcastId' au lieu de 'episodeId'
            var durationElement = document.getElementById('duration-' + episodeId);
            var formattedDuration = getFormattedAudioDuration(audio);
            durationElement.textContent = formattedDuration;
        });
    });
});
</script>

<script>
$(document).ready(function() {
    function pauseOtherAudio(currentAudio) {
        $('audio').each(function(index, audio) {
            if (audio !== currentAudio) {
                audio.pause(); io
            }
        });
    }

    $('audio').on('play', function() {
        var episodeId = $(this).data('episode-id');
        pauseOtherAudio(this); 
        $('.song-item').removeClass('active');
        $(this).closest('.song-item').addClass('active');
    });
    $('audio').on('pause', function() {
        $(this).closest('.song-item').removeClass('active');
    });
});
</script>


<!-- script pour la recherche -->
<script>
$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        var found = false;
        $('.song-item').each(function() {
            var songTitle = $(this).find('.song-info h4').text().toLowerCase();
            var songArtist = $(this).find('.song-info p').text().toLowerCase();
            if (songTitle.includes(searchText) || songArtist.includes(searchText)) {
                $(this).show();
                found = true;
            } else {
                $(this).hide();
            }
        });
        if (!found) {
            $('#notFound').show();
        } else {
            $('#notFound').hide();
        }
    });
});
</script>


<!-- script pour ne pas demarer deux podcast au meme temp -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Écoutez l'événement de lecture de chaque élément audio
    $('audio').on('play', function() {
        // Récupérez l'ID de l'épisode en cours de lecture
        var currentPodcastId = $(this).data('podcast-id');
        // Parcourez tous les autres éléments audio
        $('audio').each(function() {
            // Si l'élément audio n'est pas celui en cours de lecture, mettez-le en pause
            if ($(this).data('podcast-id') !== currentPodcastId) {
                this.pause(); // Mettez en pause l'élément audio
            }
        });
    });

    // Écoutez l'événement de clic sur le bouton stop
    $('.jp-stop').on('click', function() {
        var audioId = $(this).closest('.single_player_container').find('audio').attr('id');
        var audio = document.getElementById(audioId);
        audio.pause();
        audio.currentTime = 0;
    });
});


</script>

<!-- Script pour chnager la color de l'episode demarer  -->
<script>$('audio').on('play', function() {
    // Récupérez l'ID de l'épisode en cours de lecture
    var currentPodcastId = $(this).data('podcast-id');
    // Parcourez tous les autres éléments audio
    $('audio').each(function() {
        // Si l'élément audio n'est pas celui en cours de lecture, mettez-le en pause
        if ($(this).data('podcast-id') !== currentPodcastId) {
            this.pause(); // Mettez en pause l'élément audio
            // Retirez la classe .active des autres éléments
            $(this).closest('.song-item').removeClass('active');
        } else {
            // Ajoutez la classe .active à l'élément en cours de lecture
            $(this).closest('.song-item').addClass('active');
        }
    });
});
</script>
<script>$(document).ready(function() {
    var playingEpisodes = {}; // Variable pour stocker les épisodes en cours de lecture
    
    // Écoutez l'événement de clic sur le bouton de lecture
    $('.jp-play').on('click', function() {
        var episodeId = $(this).closest('.single_player_container').find('audio').data('podcast-id');
        if (!playingEpisodes[episodeId]) { // Vérifie si l'épisode n'est pas déjà en train de jouer
            $.ajax({
                url: 'update_listeners_episodes.php',
                method: 'POST',
                data: { episode_id: episodeId },
                success: function(response) {
                    console.log('Nombre de listeners mis à jour pour l\'épisode ' + episodeId);
                    playingEpisodes[episodeId] = true; // Marque l'épisode comme en cours de lecture
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors de la mise à jour du nombre de listeners : ' + error);
                }
            });
        }
    });
});

</script>
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/main.js"></script>

	<!-- Audio Player and Initialization -->
	<script src="js/jquery.jplayer.min.js"></script>
	<script src="js/jplayerInit.js"></script>

	</body>
</html>
