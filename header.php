<?php   

@include 'conn_db.php';

$select = mysqli_query($conn, "SELECT * FROM info");
$row = mysqli_fetch_assoc($select);

$select2 = mysqli_query($conn, "SELECT * FROM podcast");
$podcasts = [];
while ($row2 = mysqli_fetch_assoc($select2)) {
    $podcasts[] = $row2['audio']; // Adjust 'podcast_url' to your actual column name
}
?>

<link rel="stylesheet" href="css/style4.css"/>
</head>
<header class="header-section clearfix">
		<div style="display: inline-block;">
			<a href="/CulturCampus/accueil" class="site-logo">
			<img style="width: 100px;height: 100px; 	
			display: inline-block;
 			border-radius: 100%;" src="img/<?php echo $row['logo'];?>" alt="">
			</a>
		
			<a href="" class="site_logo">
				<img src="img/logo4.png" style="width: 160px;height: 120px; 	
			display: inline-block ;
 			" alt="">
			</a>
			
			 <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
			<a href="#" class="site-btn" id="playAll"><i id="playIcon" class="fa fa-play" style="color:white;"></i> EN direct</a>
            <a href="#" class="site-btn" id="playNext"><i class="fa fa-forward" style="color:white;"></i></a>
            </div><div id="audioPlayers" style="display: none;">
                <?php foreach ($podcasts as $podcast): ?>
                    <audio  class="podcast-audio"  src="audios/podcast_audio/<?php echo $podcast; ?>" ></audio>
                <?php endforeach; ?>
            </div>&nbsp;
		
		</div>
		
		<ul class="main-menu">



			<li ><br><a href="/CulturCampus/accueil">
					<center ><img src="img/icons/egaliseur.png" alt="">	
					</center>
					Cultur Campus
				</a></li>


			<li><a href="/CulturCampus/emission">
					<center><img src="img/icons/microphone.png" alt="">
						
					</center>
					Programmes
				</a></li>

			<li><a href="/CulturCampus/podcasts">
					<center><img src="img/icons/microphone.png" alt="">
						
					</center>
					Podcast
				</a></li>

				<li><a href="/CulturCampus/les_grille-programmes">
					<center><img src="img/icons/calendar.png" alt="">
					</center>
					Grille des programmes
				</a></li>
			<li><a href="/CulturCampus/Actualite">
					<center><img src="img/icons/annonce.png" alt="">
					</center>
					Actualités
				</a></li>

			<!--<li><a href="#">Pages</a>
						<ul class="sub-menu">
							<li><a href="playlist.html">Playlist</a></li>
							<li><a href="artist.html">Artist</a></li>
						</ul>
					</li>-->
			<li><a href="/CulturCampus/contact_us">
					<center><img src="img/icons/support.png" alt="">
					</center>Contact
				</a></li>

		</ul>
	</header>
	<!-- Hidden audio elements -->
	<script>
        document.addEventListener("DOMContentLoaded", function() {
            const playButton = document.getElementById('playAll');
            const playIcon = document.getElementById('playIcon');
            const nextButton = document.getElementById('playNext');
            const audioPlayers = document.querySelectorAll('.podcast-audio');
            let currentAudioIndex = 0;
            let isPlaying = false;

            function playNextPodcast() {
                if (audioPlayers.length === 0) return;

                if (isPlaying) {
                    audioPlayers[currentAudioIndex].pause(); // Pause the current podcast if playing
                    audioPlayers[currentAudioIndex].currentTime = 0; // Reset the current podcast to start
                }

                currentAudioIndex = (currentAudioIndex + 1) % audioPlayers.length;
                audioPlayers[currentAudioIndex].play();
                isPlaying = true;
                playIcon.className = "fa fa-pause";
            }

            playButton.addEventListener('click', function() {
                if (audioPlayers.length > 0) {
                    if (isPlaying) {
                        audioPlayers[currentAudioIndex].pause();
                        isPlaying = false;
                        playIcon.className = "fa fa-play";
                    } else {
                        audioPlayers[currentAudioIndex].play();
                        isPlaying = true;
                        playIcon.className = "fa fa-pause";
                    }
                }
            });

            nextButton.addEventListener('click', function() {
                playNextPodcast();
            });

            audioPlayers.forEach(audio => {
                audio.addEventListener('ended', function() {
                    playNextPodcast();
                });
            });
        });
    </script>