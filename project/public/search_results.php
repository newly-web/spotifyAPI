<?php
require_once __DIR__ . "/../include/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $user_key_words = $_GET["user_key_words"];
  // print ( $user_key_words);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlackSpoken</title>
  <link rel="stylesheet" href="/project/styles/search_results.css">
  <script src="https://kit.fontawesome.com/f6b7ebe716.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include_once __DIR__ . "/../include/header.php";

  ?>

  <h1 class="mainTitle">Podcast episodes related to <span><?php echo $user_key_words ?></span></h1>



  <div><span><a href="/project/public/search.php" class="backToResultPage">Go back to results</a></span></div>
  <div class="container d-flex flex-row flex-wrap justify-content-around">

    <?php
    // Assuming Flask API is running on the same machine at port 5000
    $api_url = "http://127.0.0.1:5000/search";
    $data = ['keywords' => $user_key_words];



    // Existing code for displaying podcast results
    $sql = "SELECT * FROM `podcasts` WHERE Title LIKE '%$user_key_words%' OR Description LIKE '%$user_key_words%' AND (Title LIKE '%black%' OR Description LIKE '%black%')
                ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      $image = $row["Image"];
      $title = $row["Title"];
      $description = $row["Description"];
      $audio = $row["Audio"];
      $link = $row["URL"];
    ?>

      <div class="card">
        <div class="image">
          <img src="<?php echo $image ?>" alt="">
        </div>
        <h2 class="podcastName"><?php echo $title ?></h2>
        <div class="audioContainer">
          <audio controls>
            <source src="<?php echo $audio ?>" type="audio/mpeg">
            Your browser does not support the audio element.
          </audio>
        </div>
        <p class="podcastDescription"><?php echo $description ?></p>
        <h3 class="podcastLink"><a href="<?php echo $link ?>" target="_blank">See more</a></h3>
      </div>

    <?php
    }
    ?>
  </div>
</body>