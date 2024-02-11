<?php
require_once __DIR__ . "/../include/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Black app</title>
  <link rel="stylesheet" href="/project/styles/search.css">
  <script src="https://kit.fontawesome.com/f6b7ebe716.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include_once __DIR__ . "/../include/header.php";
  ?>

  <section class="userInteraction">
    <h1>What are you looking for ?</h1>
    <div class="search-container">
      <div class="searchInput">
        <form method="POST" action="http://127.0.0.1:5000/search">
          <input type="search" name="user_key_words" placeholder="Search for a topic or even a creator">
          <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
          <button type="submit">Search</button>
        </form>
      </div>
    </div>


  </section>
  <main>
    <div class="results">
      <?php
      $sql = "SELECT * FROM podcasts";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $image = $row["Image"];
        $title = $row["Title"];
        $description = $row["Description"];
        $link = $row["URL"];
      ?>
        <div class="card">
          <a href="<?php echo $link ?>" target="_blank">
            <div class="image">
              <img src="<?php echo $image ?>" alt="">
            </div>
            <h2 class="podcastName"><?php echo $title ?></h2>
            <p class="podcastDescription"><?php echo $description ?></p>
                    </div>
          </a>

      <?php
      }
      ?>
    </div>
  </main>
</body>

</html>