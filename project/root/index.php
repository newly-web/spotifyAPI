<?php
require_once __DIR__ . "/../include/connection.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Black app</title>
  <link rel="stylesheet" href="/project/styles/main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/f6b7ebe716.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include __DIR__ . "/../include/header.php"; ?>

  <section class="main">
    <section class="home_1 container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="hometext">Discover new Black creators on <span>Spotify</span></h1>
          <p>Discover and enjoy podcast episodes exclusively created by talented black content creators. Elevate your listening experience and support inclusivity in the world of podcasts!</p>
          <a href="/project/public/search.php" class="btn btn-secondary"> Browse now </a>
        </div>
      </div>
    </section>
    <section class="home_2 container">
      <div class="row">
        <?php
        $sql = "SELECT * FROM `podcasts` LIMIT 2";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
          $image = $row["Image"];
          $title = $row["Title"];
          $description = $row["Description"];
          $link = $row["URL"];
        ?>
      
          <div class="col-md-6">
            <div class="card">
            <a href="<?php echo $link ?>" target="_blank">
              <div class="image">
                <img src="<?php echo $image ?>" alt="Podcast episode picture">
              </div>
              <div class="podcastInfos">
                <h2 class="podcastName"><?php echo $title ?></h2>
                <p class="podcastDescription"><?php echo $description ?></p>
              </a>
                <h3 class="podcastLink"><a href="<?php echo $link ?>" target="_blank">See more</a></h3>
              </div>
            
            </div>
          </div>

        <?php
        }
        ?>

      </div>
      </div>
    </section>






    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>