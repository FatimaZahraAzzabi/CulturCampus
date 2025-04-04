<?php


@include 'conn_db.php';

if(isset($_POST['send_message'])){

	$nom = mysqli_real_escape_string($conn,$_POST["nom"]);
    $prenom = mysqli_real_escape_string($conn,$_POST["prenom"]);
    $email = $_POST["email"];
    $subject =mysqli_real_escape_string($conn, $_POST["subject"]);
	$message =mysqli_real_escape_string($conn,$_POST["message"]);
   
	// Prépare la requête SQL d'insertion
    $query = "INSERT INTO contacts (nom, prenom, email, subject, message) VALUES ('$nom', '$prenom', '$email', '$subject', '$message')";

    // Exécute la requête SQL
    if (mysqli_query($conn, $query)) {
        // Redirige l'utilisateur vers une page de confirmation
        header("Location: contact.php?success=true");
        exit();
    } else {
        // En cas d'erreur, affiche un message d'erreur
        echo "Erreur: " . $query . "<br>" . mysqli_error($conn);
    }

    // Ferme la connexion à la base de données
    mysqli_close($conn);

};




?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Cultur campus | Contact</title>
	<meta charset="UTF-8">
	<meta name="description" content="SolMusic HTML Template">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
<link href="img/favicon1.jpeg" rel="shortcut icon"/>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style1.css"/>


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
	<?php include 'header.php'; 
	
	$select = mysqli_query($conn, "SELECT * FROM info");
$row = mysqli_fetch_assoc($select)?>
	<!-- Header section end -->

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 p-0">
					<!-- Map -->
					<div class="map"><iframe src="<?php echo $row['maps']?>" style="border:0" allowfullscreen></iframe></div>
				</div>
				<div class="col-lg-6 p-0">
					<div class="contact-warp">
						<div class="section-title mb-0">
							<h2>Contactez nous</h2>
						</div>
						<br><br>
						<ul>
							<li>Adresse :<?php echo $row['adresse']?></li>
							<li>Tel :<?php echo $row['tel']?></li>
							<li>Fax :<?php echo $row['fax']?></li>
							<li>E-mail :<?php echo $row['email']?></li>
						</ul>
						<form action="" method="post" class="contact-from">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="nom" placeholder="nom" required>
								</div>
								<div class="col-md-6">
									<input type="text" name="prenom" placeholder="prénom" required>
								</div>
								<div class="col-md-6">
									<input type="text" name="email" placeholder=" e-mail" required>
								</div>
								<div class="col-md-12">
									<input type="text" name="subject" placeholder="Subject" required>
									<textarea name="message" placeholder="Message" required></textarea>
									<button class="site-btn" method="post" name="send_message">	envoyer message</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Blog section end -->
<!-- Footer section -->
<?php include 'footer.php'; ?>
<!-- Footer section end -->
	

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/main.js"></script>
<!-- Ajoutez ce lien à la tête de votre page HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>
	</body>
</html>

<!-- Ajoutez ce script à la fin de votre page HTML -->
<script>
    if (window.location.href.includes("contact_as")) {
        setTimeout(function() {
            Swal.fire({
                title: 'Message envoyé avec succès!',
                text: 'Merci de nous avoir contacté. Nous allons nous mettre en contact avec vous bientôt.',
                icon: 'success',
                timer: 5000,
                timerProgressBar: true,
            });
        }, 1000);
    }
</script>
<!-- Ajoutez ce script à la fin de votre page HTML -->
<script>
    // Fonction pour obtenir les paramètres de l'URL
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
        let results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    // Fonction pour supprimer un paramètre d'URL
    function removeURLParameter(url, parameter) {
        // Construction de l'URL sans le paramètre spécifié
        let urlparts = url.split('?');
        if (urlparts.length >= 2) {
            let prefix = encodeURIComponent(parameter) + '=';
            let pars = urlparts[1].split(/[&;]/g);

            for (let i = pars.length; i-- > 0;) {
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            url = urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
            return url;
        } else {
            return url;
        }
    }

    // Vérifiez si le paramètre 'success' est présent
    if (getParameterByName('success') === 'true') {
        setTimeout(function() {
            Swal.fire({
                title: 'Message envoyé avec succès!',
                text: 'Merci de nous avoir contacté. Nous allons nous mettre en contact avec vous bientôt.',
                icon: 'success',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            }).then(() => {
                // Supprime le paramètre 'success' de l'URL après affichage de l'alerte
                window.history.replaceState({}, document.title, removeURLParameter(window.location.href, 'success'));
            });
        }, 1000);
    }
</script>
