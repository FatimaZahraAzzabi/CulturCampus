<?php
@include 'conn_db.php';

$select = mysqli_query($conn, "SELECT * FROM info");
$row = mysqli_fetch_assoc($select);

$query1 = "SELECT COUNT(*) AS total_podcast FROM podcast";
$result1 = mysqli_query($conn, $query1);
if ($result1) {
    $row1 = mysqli_fetch_assoc($result1);
    $total_podcast = $row1['total_podcast'];
} else {
    $total_podcast = 0;
}

$stat = "SELECT COUNT(*) AS stat_prog FROM programme";
$result2 = mysqli_query($conn, $stat);
if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
    $total_pr = $row2['stat_prog'];
} else {
    $total_pr = 0;
}

$stat2 = "SELECT COUNT(*) AS stat_episode FROM episodes";
$result3 = mysqli_query($conn, $stat2);
if ($result3) {
    $row3 = mysqli_fetch_assoc($result3);
    $total_episode = $row3['stat_episode'];
} else {
    $total_episode = 0;
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Cultur campus</title>
	<meta charset="UTF-8">
	<meta name="description">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
		integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Favicon -->
	<link href="img/favicon.jpeg" rel="shortcut icon"/>

	<!-- Google font -->
	<link
		href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
		rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/owl.carousel.min.css" />
	<link rel="stylesheet" href="css/slicknav.min.css" />

	<!-- Main Stylesheets -->
	<!-- <link rel="stylesheet" href="css/style2.css" /> -->

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	
	
	<style>
	
		.play-btn {
			display: flex;
			align-items: center;
			justify-content: center;
			background: #0a92c0;
			color: #fff;
			font-size: 47px;
			width: 57px;
			height: 55px;
			z-index: 2;
			border-radius: 100%;
			position: relative;
		}

		.play-btn:before {
			content: '';
			position: absolute;
			border: 15px solid #fff;
			border-radius: 50%;
			top: -20px;
			left: -20px;
			right: -20px;
			bottom: -20px;
			animation: bloom1 1.5s linear infinite;
			opacity: 0;
			z-index: 1;
		}

		.play-btn:after {
			content: '';
			position: absolute;
			border: 15px solid #fff;
			border-radius: 50%;
			top: -20px;
			left: -20px;
			right: -20px;
			bottom: -20px;
			animation: bloom2 1.5s linear infinite;
			opacity: 0;
			animation-delay: .4s;
			z-index: 1;
		}

		@keyframes bloom1 {
			0% {
				transform: scale(.5);
			}

			50% {
				opacity: 1;
			}

			100% {
				transform: scale(1.5);
			}
		}

		@keyframes bloom2 {
			0% {
				transform: scale(.5);
			}

			50% {
				opacity: 1;
			}

			100% {
				transform: scale(1.5);
			}
		}
		

.play-pause-button {
    --play: #6D58FF;
    --play-shadow: #{rgba(#6D58FF, .24)};
    --pause: #2B3044;
    --pause-shadow: #{rgba(#2B3044, .24)};
    --color: #fff;
    --icon: var(--color);
    margin: 0;
    line-height: 20px;
    font-size: 14px;
    padding: 11px 12px 11px 36px;
    border-radius: 22px;
    border: none;
    background: none;
    outline: none;
    cursor: pointer;
    display: flex;
    position: relative;
    backface-visibility: hidden;
    -webkit-appearance: none;
    -webkit-tap-highlight-color: transparent;
    transform: translateY(var(--y, 0)) translateZ(0);
    color: var(--color);
    box-shadow: 0 var(--shadow-y, 6px) var(--shadow-b, 16px) var(--shadow, var(--pause-shadow));
    background: radial-gradient(circle, var(--play) 0%, var(--play) 50%, var(--pause) 50.5%, var(--pause) 100%);
    background-size: 400% 400%;
    background-position: 0% 0%;
    transition: background .8s, box-shadow .3s, transform .3s;
    &:hover {
        --y: -1px;
        --shadow-y: 8px;
        --shadow-b: 20px;
    }
    &:active {
        --y: 1px;
        --shadow-y: 4px;
        --shadow-b: 12px;
    }
    &:before,
    &:after {
        content: '';
        background: var(--icon);
        width: var(--width, 16px);
        height: 12px;
        position: absolute;
        left: 18px;
        top: 15px;
        backface-visibility: hidden;
        transform-origin: 50% 100%;
        transform: translateX(var(--x, 0)) translateZ(0);
        -webkit-clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
        clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
        transition: clip-path .6s ease;
    }
    &:after {
        --width: 3px;
        --x: 6px;
    }
    i {
        display: block;
        font-weight: bold;
        font-style: normal;
        backface-visibility: hidden;
        opacity: var(--o, 1);
        transform: translateX(var(--x, 0));
        transition: transform .6s, opacity .6s;
        &:nth-child(2) {
            --o: 0;
            --x: 0;
        }
        &:nth-child(3) {
            --x: -50%;
        }
        &:nth-child(4) {
            --o: 0;
        }
        &:last-child {
            --x: -50%;
        }
    }
    &.paused {
        --shadow: var(--play-shadow);
        animation: var(--name, background-paused) .8s ease forwards;
        i {
            &:first-child {
                --x: 40%;
            }
            &:nth-child(2) {
                --o: 1;
                --x: 100%;
            }
            &:nth-child(3) {
                --x: 50%;
            }
            &:nth-child(4) {
                --o: 1;
                --x: 50%;
            }
            &:last-child {
                --x: 0;
                --o: 0;
            }
        }
        &:before {
            -webkit-clip-path: polygon(0 0, 11px 6px, 11px 6px, 0 12px);
            clip-path: polygon(0 0, 11px 6px, 11px 6px, 0 12px);
            transition-delay: .9s;
        }
        &:after {
            animation: to-play .9s ease forwards;
        }
        &.playing {
            --shadow: var(--pause-shadow);
            --name: background-playing;
            &:before {
                -webkit-clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
                clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
                transition-delay: 0s;
            }
            &:after {
                animation: to-pause 1.3s ease forwards;
            }
            i {
                &:first-child {
                    --x: 0;
                }
                &:nth-child(2) {
                    --o: 0;
                    --x: 0;
                }
                &:nth-child(3) {
                    --x: -50%;
                    --o: 1;
                }
                &:nth-child(4) {
                    --o: 0;
                    --x: 0;
                }
                &:last-child {
                    --x: -50%;
                    --o: 1;
                }
            }
        }
    }
}

@keyframes to-play {
    15% {
        transform: translateX(6px) scaleY(1.1);
    }
    30% {
        transform: translateX(6px) scaleY(.9);
    }
    45% {
        transform: translateX(6px) scaleY(1.15);
        -webkit-clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
        clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
        transform-origin: 50% 100%;
    }
    60%,
    100% {
        -webkit-clip-path: polygon(0 9px, 3px 9px, 3px 12px, 0 12px);
        clip-path: polygon(0 9px, 3px 9px, 3px 12px, 0 12px);
        transform-origin: 50% 10.5px;
    }
    60% {
        transform: translateX(6px);
    }
    99% {
        transform: translateX(0) rotate(-270deg);
    }
    100% {
        transform: translateX(0) rotate(-270deg) scale(0);
    }
}

@keyframes to-pause {
    0%,
    50% {
        -webkit-clip-path: polygon(0 9px, 3px 9px, 3px 12px, 0 12px);
        clip-path: polygon(0 9px, 3px 9px, 3px 12px, 0 12px);
        transform-origin: 50% 10.5px;
    }
    0%,
    39% {
        transform: translateX(0) rotate(-270deg) scale(0);
    }
    40% {
        transform: translateX(0) rotate(-270deg);
    }
    50% {
        transform: translateX(6px) rotate(0deg);
    }
    60%,
    100% {
        transform: translateX(6px);
        -webkit-clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
        clip-path: polygon(0 0, 3px 0, 3px 12px, 0 12px);
        transform-origin: 50% 100%;
    }
    70% {
        transform: translateX(6px) scaleY(1.15);
    }
    80% {
        transform: translateX(6px) scaleY(.9);
    }
    90% {
        transform: translateX(6px) scaleY(1.05);
    }
    100% {
        transform: translateX(6px);
    }
}

@keyframes background-paused {
    from {
        background-position: 0 0;
    }
    to {
        background-position: 50% 50%;
    }
}

@keyframes background-playing {
    from {
        background-position: 50% 50%;
    }
    to {
        background-position: 100% 100%;
    }
}

html {
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
}

* {
    box-sizing: inherit;
    &:before,
    &:after {
        box-sizing: inherit;
    }
}

// Center & dribbble
body {
    min-height: 100vh;
    display: flex;
    font-family: 'Roboto', Arial;
    justify-content: center;
    align-items: center;
    background: #ECEFFC;
    .dribbble {
        position: fixed;
        display: block;
        right: 20px;
        bottom: 20px;
        img {
            display: block;
            height: 28px;
        }
    }
    .twitter {
        position: fixed;
        display: block;
        right: 64px;
        bottom: 14px;
        svg {
            width: 32px;
            height: 32px;
            fill: #1da1f2;
        }
    }
}
/* Stylisation des icônes et des chiffres */
.counter_section {
    text-align: center;
}

.counter_section .couter_icon {
    font-size: 50px;
    margin-bottom: 20px;
}

.counter_section .counter_no {
    font-size: 24px;
}

/* Couleur des icônes */
.blue1_color {
    color: #007bff; /* Bleu */
}

.green_color {
    color: #28a745; /* Vert */
}

/* Stylisation des titres */


/* Alignement du texte */
.total_no {
    margin-top: 10px;
}

/* Marge inférieure pour chaque colonne */
.margin_bottom_30 {
    margin-bottom: 30px;
}
	</style>

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	<!-- Header section -->
	<?php include 'header.php'; ?>
	
	<!-- Header section end -->

	<!-- Hero section -->
	<section class="hero-section">
		
		<div class="hero-slider owl-carousel">
			
			<div style="background: url(img/backgound2.jpeg); background-repeat: no-repeat;
			 background-size: cover;
    background-attachment: fixed;
    overflow: hidden;
			" class="hs-item">
			
				<div class="container">

					<div class="row">
						<div class="col-lg-6">
		
							<div class="hs-text">

					
								<h2><span>Podcast</span> pour tous</h2>
	
								<p><?php echo $row['text1'] ?></p>
								<!-- <a href="#" class="site-btn sb-c2">Start free trial</a> -->
								
							</div>
						</div>
						<div class="col-lg-6">
							<div class="hr-img">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div style="background: url(img/backgound2.jpeg); background-repeat: no-repeat;
			 background-size: cover;
    background-attachment: fixed;
    overflow: hidden;
			" class="hs-item">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="hs-text">
								<h2><span>Web </span> radio</h2>
								<p><?php echo $row['text2'] ?></p>
								<!-- <a href="#radio" class="site-btn">Radio</a> -->
								<!-- <a href="#" class="site-btn sb-c2">Start free trial</a> -->
							</div>
						</div>
						<div class="col-lg-6">
							<div class="hr-img">
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div> 
	</section>
	<!-- Hero section end -->

	<!-- Player section -->
	<section class="player-section set-bg" data-setbg="img/player-bg.jpg">
		
		<div class="player-box" id="radio">
			<div class="tarck-thumb-warp">
				<div class="tarck-thumb">
					<img src="img/background.jpeg" alt="">
					<button onclick="wavesurfer.playPause();" class="wp-play"></button>
				</div>
			</div>
			<div class="wave-player-warp">
				<div class="row">
					<div class="col-lg-8">
						<div class="wave-player-info">
							<h3>Radio Culture campus <i class="fa-solid fa-tower-broadcast"></i></h3>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="songs-links">
						</div>
					</div>
				</div>
				<div id="wavePlayer" class="clierfix">
					<div id="audiowave" data-waveurl="audios/MOHAMMED ACHRAF.wav"></div>
					<div id="currentTime"></div>
					<div id="clipTime"></div>
					<!-- Player Controls -->
					<div class="wavePlayer_controls">
						<button class="jp-play player_button" onclick="wavesurfer.playPause();"></button>
						<button class="jp-stop player_button" onclick="wavesurfer.stop();"></button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Player section end -->


	<!-- How section -->
	<!-- <section class="how-section spad set-bg" data-setbg="img/how-to-bg.jpg">
		<div class="container text-white">
			<div class="section-title">
				<h2>Comment ça fonctionne</h2>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="how-item">
						<div class="hi-icon">
							<img src="img/icons/brain.png" alt="">
						</div>
						<h4>Ecouter radio live </h4>
					</div>
				</div>
				<div class="col-md-4">
					<div class="how-item">
						<div class="hi-icon">
							<img src="img/icons/pointer.png" alt="">
						</div>
						<h4>Choisir un programme</h4>
					</div>
				</div>
				<div class="col-md-4">
					<div class="how-item">
						<div class="hi-icon">
							<img src="img/icons/smartphone.png" alt="">
						</div>
						<h4>Télécharger un Podcast</h4>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- How section end -->

	<!-- Concept section -->
	<section class="concept-section spad">
		<div class="container">
			<div class="row">             

				<div class="col-lg-6">
					<div class="section-title">
						<h2>A propos de nous:</h2>
					</div>
				</div>
				<div class="col-lg-6" style="text-align: justify;">
					<p><?php echo $row['about']
                    ?> </p>
                    
				</div>
			</div>
            <div class="col-lg-6">
					<div class="section-title">
						<h2>Equipe :</h2>
					</div>
				</div>
            <div class="container"> <!-- Envelopper dans un conteneur pour centrer -->
    <div class="row justify-content-center"> <!-- Centrer le contenu horizontalement -->
        <?php
        $select = mysqli_query($conn, "SELECT * FROM users"); // Limiter la requête à 5 résultats
        $count = 0; // Initialiser le compteur
        while($row = mysqli_fetch_assoc($select)){
            ?>
            <div class="col-lg-3 col-sm-6">
                <div class="concept-item">
                    <img width="250" height="200" src="img/user_img/<?php echo $row['image']; ?>" alt="">
                    <h5><?php echo $row['nom']?> <?php echo $row['prenom']?></h5>
                    <p><?php echo $row['description']?></p>
                </div>
            </div>
            <?php
            $count++; // Incrémenter le compteur à chaque itération
            if ($count % 3 == 0) { // Vérifier si le compteur est un multiple de 4
                echo '</div><div class="row justify-content-center">'; // Fermer la ligne actuelle et en ouvrir une nouvelle
            }
        }?>
    </div>
</div>


	</section>
	<!-- Concept section end -->

	<!-- Subscription section -->
    <section class="how-section spad set-bg" data-setbg="img/how-to-bg.jpg" id="statistics-section">
        <div class="container text-white">
            <div class="section-title">
                <h2>Statistiques</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="how-item">
                        <div class="hi-icon">
                            <img src="img/icons/microphone.png" alt="">
                        </div>
                        <h4>Épisodes</h4>
                    <p class="statistic" data-count="<?= $total_episode; ?>">0</p> <!-- Mettez à jour ici -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-item">
                        <div class="hi-icon">
                            <img src="img/icons/calendar.png" alt="">
                        </div>
                        <h4>Programmes</h4>
                        <p class="statistic" data-count="<?= $total_pr; ?>">0</p> <!-- Mettez à jour ici -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-item">
                        <div class="hi-icon">
                            <img src="img/icons/smartphone.png" alt="">
                        </div>
                        <h4>Podcasts</h4>
                        <p class="statistic" data-count="<?= $total_podcast; ?>">0</p> <!-- Mettez à jour ici -->
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!-- Subscription section end -->

	<!-- Premium section end -->
	<!-- <section class="premium-section spad">
	
	</section> -->
	<!-- Premium section end -->
<br><br>
	<!-- Footer section -->
	<?php include 'footer.php'; ?>

	<!-- Footer section end -->


	<script>
	document.querySelectorAll('.play-pause-button').forEach(button => {
    button.addEventListener('click', e => {
        if(button.classList.contains('playing')) {
            button.classList.remove('paused', 'playing');
            button.classList.add('paused');
        } else {
            if(button.classList.contains('paused')) {
                button.classList.add('playing');
            }
        }
        if(!button.classList.contains('paused')) {
            button.classList.add('paused');
        }
    });
});

</script>
<script>
// Fonction pour détecter si un élément est visible dans la fenêtre du navigateur
function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Fonction pour incrémenter les statistiques lorsque la section devient visible
function incrementStatistics() {
    var statisticsSection = document.getElementById('statistics-section');
    var statisticsItems = statisticsSection.querySelectorAll('.statistic');

    // Vérifie si la section des statistiques est visible
    if (isElementInViewport(statisticsSection)) {
        // Pour chaque élément de statistique, commencez à incrémenter
        statisticsItems.forEach(function(item) {
            var countTo = parseInt(item.getAttribute('data-count'));
            animateCount(item, countTo);
        });
    }
}

// Fonction pour animer l'incrémentation des statistiques
function animateCount(element, to) {
    var start = 0;
    var duration = 2000; // Durée de l'animation en millisecondes
    var stepTime = Math.abs(Math.floor(duration / to));
    var current = 0;

    var timer = setInterval(function() {
        current++;
        element.textContent = current;
        if (current >= to) {
            clearInterval(timer);
        }
    }, stepTime);
}

// Déclencher l'incrémentation lorsque la page est chargée et que l'utilisateur fait défiler la page
document.addEventListener('DOMContentLoaded', incrementStatistics);
window.addEventListener('scroll', incrementStatistics);


</script>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/main.js"></script>



	<!-- Audio Players js -->
	<script src="js/jquery.jplayer.min.js"></script>
	<script src="js/wavesurfer.min.js"></script>

	<!-- Audio Players Initialization -->
	<script src="js/WaveSurferInit.js"></script>
	<script src="js/jplayerInit.js"></script>

</body>

</html>