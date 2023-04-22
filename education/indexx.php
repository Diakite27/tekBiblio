<?php
    require "database.php";

    if(isset($_POST['envoyer'])){

        $id_livre = $_POST['id_livre'];
        $etu = $_SESSION['idE'];
        $date_emprunt = $_POST['date_emprunt'];
        $date_retour_prevue = $_POST['date_retour_prevue'];
        
        // Vérification des champs obligatoires
        if(empty($date_emprunt) || empty($date_retour_prevue)){
            echo "Veuillez remplir tous les champs obligatoires.";
        }
        else{
            // Insertion de l'emprunt dans la base de données
            $datas = array(
                'id_livre' => $id_livre,
                "id_eleve" => $etu,
                'date_emprunt' => $date_emprunt,
                'date_retour_prevue' => $date_retour_prevue
            );
            $bd->inserer("emprunt", $datas);
            
            echo "<script>alert('Votre emprunt a été effectué avec succès.');</script>";
        }
    }
    require 'header.php';
?>


        <aside id="fh5co-hero">
            <div class="flexslider">
                <ul class="slides">
                    <li style="background-image: url(images/bg1.jpeg);">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                    <div class="slider-text-inner">
                                        <h1>La lecture est une source inépuisable de bonheur pour celui qui sait y puiser.</h1>
                                        <h2>William Somerset Maugham</a></h2>
                                        <p><a class="btn btn-primary btn-lg" href="livres.php">Emprunter un livre!</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li style="background-image: url(images/bg2.jpeg);">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                    <div class="slider-text-inner">
                                        <h1>Un livre est une fenêtre par laquelle on s'évade.</h1>
                                        <h2>Julien Green</h2>
                                        <p><a class="btn btn-primary btn-lg btn-learn" href="livres.php">Emprunter un livre!</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li style="background-image: url(images/bg3.jpeg);">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                    <div class="slider-text-inner">
                                        <h1>La lecture est une porte ouverte sur un monde enchanté.</h1>
                                        <h2>François Mauriac</h2>
                                        <p><a class="btn btn-primary btn-lg btn-learn" href="livres.php">Emprunter un livre!</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </aside>

        <div id="fh5co-course-categories">
            <div class="container">
                <div class="row animate-box">
                    <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                        <h2>Catégories de livres</h2>
                        <p>La bibliothèque de TEK-UP contient plusieurs livres de catégories diverses.</p>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $datas = $bd->lire("genre");
                        foreach ($datas as $data) {
                    ?>
                            <div class="col-md-3 col-sm-6 text-center animate-box">
                                <div class="services">
                                    <span class="icon">
                                    <i class="<?php echo $data['icon']; ?>"></i>
                                </span>
                                    <div class="desc">
                                        <h3><a href="#"><?php echo $data['nom_genre']; ?></a></h3>
                                        <p><?php echo $data['exemple']; ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>

        <div id="fh5co-counter" class="fh5co-counters" style="background-image: url(images/img_bg_4.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <h2 class="text-center" style="color: aliceblue;">STATISTIQUES D'EMPRUNTS</h2>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 text-center animate-box">
                                <span class="icon"><i class="icon-book"></i></span>
                                <span class="fh5co-counter js-counter" data-from="0" data-to="3297" data-speed="5000" data-refresh-interval="50"></span>
                                <span class="fh5co-counter-label">Mes livres empruntés</span>
                            </div>
                            <div class="col-md-3 col-sm-6 text-center animate-box">
                                <span class="icon"><i class="icon-book"></i></span>
                                <span class="fh5co-counter js-counter" data-from="0" data-to="3700" data-speed="5000" data-refresh-interval="50"></span>
                                <span class="fh5co-counter-label">Mes livres lues</span>
                            </div>
                            <div class="col-md-3 col-sm-6 text-center animate-box">
                                <span class="icon"><i class="icon-book"></i></span>
                                <span class="fh5co-counter js-counter" data-from="0" data-to="5034" data-speed="5000" data-refresh-interval="50"></span>
                                <span class="fh5co-counter-label">Mes livres en cours de lectures</span>
                            </div>
                            <div class="col-md-3 col-sm-6 text-center animate-box">
                                <span class="icon"><i class="icon-book"></i></span>
                                <span class="fh5co-counter js-counter" data-from="0" data-to="1080" data-speed="5000" data-refresh-interval="50"></span>
                                <span class="fh5co-counter-label">Mes livres non déposés</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="fh5co-course">
            <div class="container">
                <div class="row animate-box">
                    <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                        <h2>Quelques livres</h2>
                        <!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
                    </div>
                </div>
                <div class="row">
                <?php
                        $datas = $bd->lire("livre LIMIT 6", "*");
                        foreach ($datas as $data) {
                    ?>
                            
                            <div class="col-md-6 animate-box">
                                <div class="course">
                                    <a href="#" class="course-img" style="background-image: url(admin/assets/livres/<?php echo $data['img']; ?>);">
                                    </a>
                                    <div class="desc">
                                        <h3><a href="#"><?php echo $data['titre']; ?></a></h3>
                                        <p><?php echo $data['description']; ?>.</p>
                                        <span><a href="#" class="btn btn-primary btn-sm btn-course" data-toggle="modal" data-target="#emprunter" data-id="<?php echo $data['id_livre']; ?>">Emprunter</a></span>
                                    </div>
                                </div>
                            </div>
                            
                    <?php
                    }
                    echo '
                    <!-- Ajouter la fenêtre modale pour emprunter un livre -->
                    <div class="modal fade" id="emprunter" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ajouterEtudiantModalLabel">Emprunter un livre</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="indexx.php" method="POST" enctype="multipart/form-data">
                                        
                                        <div class="form-group">
                                            <label for="date_emprunt">Date d\'emprunt <span style="color:red"> *</span> :</label>
                                            <input type="date" class="form-control" name="date_emprunt" id="date_emprunt">
                                        </div>
                                        <div class="form-group">
                                            <label for="date_retour">Date de retour <span style="color:red"> *</span> :</label>
                                            <input type="date" class="form-control" name="date_retour_prevue" id="date_retour_prevue">
                                        </div>
                                        <input type="hidden" name="id_livre" id="id_livre">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary text-left" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary" name="envoyer">Emprunter</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div> 
                    ';
                    ?>
                </div>
            </div>
        </div>


        <!-- <div id="fh5co-blog">
            <div class="container">
                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>Blog &amp; Events</h2>
                        <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                    </div>
                </div>
                <div class="row row-padded-mb">
                    <div class="col-md-4 animate-box">
                        <div class="fh5co-event">
                            <div class="date text-center"><span>15<br>Mar.</span></div>
                            <h3><a href="#">USA, International Triathlon Event</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                    <div class="col-md-4 animate-box">
                        <div class="fh5co-event">
                            <div class="date text-center"><span>15<br>Mar.</span></div>
                            <h3><a href="#">USA, International Triathlon Event</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                    <div class="col-md-4 animate-box">
                        <div class="fh5co-event">
                            <div class="date text-center"><span>15<br>Mar.</span></div>
                            <h3><a href="#">New Device Develope by Microsoft</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#" class="blog-img-holder" style="background-image: url(images/project-1.jpg);"></a>
                            <div class="blog-text">
                                <h3><a href="#">Healty Lifestyle &amp; Living</a></h3>
                                <span class="posted_on">March. 15th</span>
                                <span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#" class="blog-img-holder" style="background-image: url(images/project-2.jpg);"></a>
                            <div class="blog-text">
                                <h3><a href="#">Healty Lifestyle &amp; Living</a></h3>
                                <span class="posted_on">March. 15th</span>
                                <span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#" class="blog-img-holder" style="background-image: url(images/project-3.jpg);"></a>
                            <div class="blog-text">
                                <h3><a href="#">Healty Lifestyle &amp; Living</a></h3>
                                <span class="posted_on">March. 15th</span>
                                <span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <?php
            require 'footer.php';
        ?>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>


    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Flexslider -->
    <script src="js/jquery.flexslider-min.js"></script>
    <!-- countTo -->
    <script src="js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Count Down -->
    <script src="js/simplyCountdown.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>
    <script>
        var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

        // default example
        simplyCountdown('.simply-countdown-one', {
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate()
        });

        //jQuery example
        $('#simply-countdown-losange').simplyCountdown({
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate(),
            enableUtc: false
        });
    </script>
    <script>
        $(document).ready(function() {
            // Récupérer la valeur de data-id lors du clic sur le bouton "Emprunter"
            $(".btn-course").click(function() {
            var id_livre = $(this).data("id");
            // Affecter la valeur de id_livre à un champ caché dans le formulaire modal
            $("#id_livre").val(id_livre);
            });
        });
    </script>
</body>

</html>