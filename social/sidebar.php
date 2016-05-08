<div class="col-xs-12 col-md-4">
    <div class="row">
        <section class="sidebar">

            <?php

            $getEventPosts = mysqli_query($db_social, "SELECT * FROM posts WHERE category = 'events' LIMIT 1") or die("FOUT: " . mysqli_error($dblink)); //selecteer rij waar gebruikersnaam gelijk is aan de variabele

            while($rij = mysqli_fetch_assoc($getEventPosts)) {
                $postId = $rij["id"];
                $username = $rij["username"];
                $userId = $rij["userId"];
                $title = $rij["title"];
                $content = $rij["content"];
                $category = $rij["category"];
                $postDate = $rij["postDate"];

                $postDate1 = substr($postDate, -2);
                $postDate2 = substr($postDate, -5, -3);
                $postDate3 = substr($postDate, 0, 4);
                $postDate = $postDate1 . "-" . $postDate2 . "-" . $postDate3;

                ?>

                <article class="col-xs-12 col-md-12 event wow slideInRight">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="event_date">

                                <div class="calendar">
                                    <?php echo $postDate1; ?><em><?php //echo $postDate2; ?>januari</em>
                                </div>
                                
                                <div class="event_title">
                                    <span>Live event</span><h2><?php echo $title; ?></h2>
                                </div>
                        </div>
                    </div>
                </article>

                <article class="col-xs-12 col-md-12 quicklinks">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="links">

                                <?php if(isset($_SESSION["logged_in"])){ //controleer of je bent ingelogd ?>

                                <ul>
                                    <h2>Monster Plaza</h2>
                                    <li><a href="add_social_post.php">Berichtje plaatsen</a></li>
                                    <li><a href="social_posts.php">Alle berichten bekijken</a></li>

                                    <h2>Direct naar</h2>
                                    <li><a href="#">Vraag stellen</a></li>

                                    <?php if($_SESSION['username'] == "admin") { ?>
                                    <h2>Admin tools</h2>
                                        <li><a href="add_post.php">Blog plaatsen</a></li>
                                        <li><a href="#">Naar dashboard</a></li>
                                    <?php } ?>
                                </ul>

                                <? }else{ ?>
                                <ul>
                                    <h2>Monster Plaza</h2>
                                    <li><a href="social_posts.php">Alle berichten bekijken</a></li>

                                    <h2>Direct naar</h2>
                                    <li><a href="#">Vraag stellen</a></li>

                                </ul>
                                <?php } ?>

                            </div>
                        </div>
                </article>

                <?php
            }

            ?>

        </section>
    </div>
</div>
