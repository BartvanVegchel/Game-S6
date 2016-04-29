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

                <?php
            }

            ?>

        </section>
    </div>
</div>
