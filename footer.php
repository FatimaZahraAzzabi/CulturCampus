<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

@include 'conn_db.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$select = mysqli_query($conn, "SELECT * FROM info");
if (!$select) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($select);
if (!$row) {
    die("Fetch failed: " . mysqli_error($conn));
}
?>

<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 order-lg-2">
                <div class="row">
                    <div class="col-sm-4">
                        <?php
                        
                        ?>
                        <div class="footer-widget">
                            <h2>Plan de site</h2>
                            <ul>
                               
                                <li><a href="/version_vendredi/CulturCampus/contact_us">Contact</a></li>
                                <li><a href="/version_vendredi/CulturCampus/Actualite">News</a></li>
                                <li><a href="/version_vendredi/CulturCampus/accueil">Culter Campus</a></li>
                                <li><a href="/version_vendredi/CulturCampus/podcasts">Podcasts</a></li>
                                <li><a href="/version_vendredi/CulturCampus/emission">Programmes</a></li>
                                <li><a href="/version_vendredi/CulturCampus/les_grille_programmes">Grille des programmes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 order-lg-1">
                <img src="img/<?php echo $row['logo']; ?>" style="width: 100px;height: 100px; display: inline-block; border-radius: 100%;" alt="">
                &nbsp&nbsp
                &nbsp
                &nbsp

                <img src="img/logo4.png" style="width: 170px;height: 120px; display: inline-block;" alt="">

                <br>
                <div class="copyright">
                    Copyright &copy;
                    <script>document.write(new Date().getFullYear());</script> All rights reserved | This template
                    is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by : <br>
                </div>
                <div class="social-links">
                    <a href="<?php echo $row['lien_linkedin']; ?>"><i class="fa fa-linkedin"></i></a>
                    <a href="<?php echo $row['lien_fb']; ?>"><i class="fa fa-facebook"></i></a>
                    <a href="<?php echo $row['lien_instagram']; ?>"><i class="fa fa-instagram"></i></a>
                    <a href="<?php echo $row['lien_pinterest']; ?>"><i class="fa fa-pinterest"></i></a>
                    <a href="<?php echo $row['lien_youtube']; ?>"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>