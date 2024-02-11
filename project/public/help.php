<?php
require_once __DIR__ . "/../include/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ & Contact - Podcast Discovery App</title>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/project/styles/help.css">
  <script src="https://kit.fontawesome.com/f6b7ebe716.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include_once __DIR__ . "/../include/header.php";
  ?>
  <!-- This app will allow you to listen to your favorite topics, all whilst supporting black ceators in America. -->
  <section class="helpTitles">
    <h3 class="title"> Support <span>black</span> podcasters. </h3>
    <h2 class="intro"> Find the answers for the most frequently asked questions below</h2>
  </section>
  <!--Section: FAQ-->
  <main class="faqMain">

    <section class="faq">
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
          <h6 class="questionTitle mb-3 "><i class="fas fa-pen-alt pe-2"></i>Can I suggest podcasts to be included in the app?</h6>
          <p>
            Absolutely! We encourage user suggestions. If there's a podcast you love that you believe should be part of our collection, please let us know. We're always looking to expand and enhance our offerings based on user recommendations.
          </p>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
          <h6 class="questionTitle mb-3"><i class="far fa-paper-plane  pe-2"></i> How does this app work?</h6>
          <p>
            Simply enter keywords or topics you're interested in, and our app will fetch podcasts created by Black content creators that align with those keywords. It's an easy way to explore diverse voices and stories.
          </p>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
          <h6 class="questionTitle mb-3"><i class="fas fa-user pe-2"></i>Can I input any keywords?
          </h6>
          <p>
            Yes, feel free to enter any keywords or topics that interest you. However, keep in mind that while we strive to match podcasts accurately, there might be instances where certain podcasts don't perfectly align due to the diversity of creators and content.
          </p>
        </div>
      </div>

      <p class="endOfFaq">Can't find your answers?</p>
      <div class="scroll-down"></div>

    </section>

  </main>
  <!--Section: FAQ-->

  <!-- Support Button-->


  </div>
  </div>
  </div>
  </div>
  </div>
  </section>


  <div id="contact-section">

    <div id="contact" class="contact-area section-padding">
      <div class="container">
        <div class="section-title text-center">
          <h1>Get in Touch</h1>
          <p>Have questions about this project or interested in collaboration? Reach out for inquiries, feedback, or any information you need.</p>
        </div>
        <div class="row">
          <div class="col-lg-7">
            <div class="contact">
              <form class="form" name="inquiry" method="post" action="contact.php">
                <div class="row">
                  <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
                  </div>
                  <div class="form-group col-md-12">
                    <textarea rows="6" name="message" class="form-control" placeholder="Your Message" required="required"></textarea>
                  </div>
                  <div class="col-md-12 text-center">
                    <button type="submit" value="Send message" name="submit" id="submitButton" class="btn btn-contact-bg" title="Submit Your Message!">Send Message</button>
                  </div>
                </div>
              </form>
            </div>
          </div><!--- END COL -->
          <!-- sending message -->


          <!--  -->
          <div class="col-lg-5">

            <div class="single_address">
              <i class="fa fa-envelope"></i>
              <h4>Send your message</h4>
              <p>sitesbywhitney@gmail.com</p>
            </div>
            <div class="single_address">
              <i class="fa fa-phone"></i>
              <h4>Call   on</h4>
              <p>(+1) 613 917 0966</p>
            </div>
            <div class="single_address">
              <i class="fa fa-clock-o"></i>
              <h4>Work Time</h4>
              <p>Mon - Fri: 15.00 - 18.00 <br>Sat: 10.00 - 14.00</p>
            </div>
          </div><!--- END COL -->
        </div><!--- END ROW -->
      </div><!--- END CONTAINER -->
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>