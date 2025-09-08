<?php include './include/indexheader.php'; ?>

<?php
$backgroundImageData = $obj->getFilterDataByLimit('background_image', ['image_name'], ['selected' => 1], null);
$backImage           = $backgroundImageData[0]['image_name'];
?>

<?php echo (Page_finder::get_message()); ?>
<div id="welcomePopup" class="ohs-popup-overlay">
  <!-- Content will be loaded here by AJAX -->
  <div id="OHSLoader" class="ohs-popup-container"></div>
</div>
<style>
  .popup {
    width: 100%;
    height: 100vh;
    position: fixed;
    /* Stay in place */
    z-index: 9999;
    /* Sit on top */
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
  }

  .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

  .carousel-img {
    height: 600px;
    object-fit: cover;
    object-position: center;
  }
</style>
<div id="demo" class="carousel slide" data-ride="carousel">

  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./assets/images/dwlanding.JPG" class="d-block w-100 carousel-img" alt="Los Angeles">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/dwlanding1.jpg" class="d-block w-100 carousel-img" alt="Chicago">
    </div>
    <div class="carousel-item">
      <img src="./assets/images/dwlanding2.jpg" class="d-block w-100 carousel-img" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>



<!--    <div class="scroll" style="">-->
<!--        <a href="#content-scroll">-->
<!--            <img src="assets/images/scroll.png" height="35" width="35">-->
<!--        </a>-->
<!---->
<!--    </div>-->

</div>
<div class="container-fluid size size_a" style="background-color: white !important;">
  <div class="row">
    <div class="col-12 narrow mb-4" id="content-scroll">
      <b id="text"> IT ALL STARTS HERE</b><br>

      <div class="deg-btn-group" role="group">
        <a class="btn btn-outline-primary btns" href="./360-images/tour.php" target="_blank">
          <span>Virtual Tour</span>
        </a>
        <a class="btn btn-outline-primary btns1" href="https://application.deerwalk.edu.np/" target="_blank">
          <span>Apply for Admission</span>
        </a>
        <a class="btn btn-outline-primary btns1" href="downloads.php" target="_blank">
          <span>Downloads</span>
        </a>


      </div>

    </div>
  </div>
</div>

<div id="resources" class="offset">
  <div class="fixed-background">
    <div class="row dark text-center ">
      <div class="col-12 narrow2 mb-4">
        <!-- <h3 class="heading">Built with Care</h3> -->
        <b id="text3"> STUDENTS AT DWIT</b><br>
      </div>
      <div class="col-md-4">
        <h3 id="text2">604</h3>
        <div class="heading-underline"></div>
        <p class="lead">STUDENTS AT DWIT</p>
      </div>
      <div class="col-md-4">
        <h3 id="text2">4:1</h3>
        <div class="heading-underline"></div>
        <p class="lead">MALE / FEMALE</p>
      </div>
      <div class="col-md-4">
        <h3 id="text2">1:6</h3>
        <div class="heading-underline"></div>
        <p class="lead">STUDENTS PER CLASS</p>
      </div>

    </div>

    <div class="fixed-wrap">
      <div class="fixed">

      </div>
    </div>

  </div>


  <div class="container-fluid size">
    <div class="row back" style="background-color: white !important;">
      <div class="col-md-12  narrow mb-4">
        <b id="text">what's happening at dwit?</b><br>
      </div>
    </div>

    <?php
    $data = $obj->getDataByLimit('article_post', ['id', 'content', 'title', 'image_name'], 3);
    foreach ($data as $value):
    ?>
      <div class="row" style="background-color: white !important;">
        <div class="col-md-3">
          <img src="./admin/uploads/articles/<?php echo ($value['image_name']); ?>" height="200" width="100%" class="mx-auto" style="object-fit: cover">
        </div>
        <div class="col-md-8">
          <b id="textNews"> <?php echo $value['title']; ?> </b><br><br>
          <p><?php echo html_entity_decode(substr($value['content'], 0, 200)) . "..."; ?></p>
          <div class="deg-btn-group" role="group">
            <a class="btn btn-outline-primary btnNews" href="newsDetail.php?art-id=<?php echo ($value['id']); ?>">
              <span>Read More</span>
            </a>
          </div>
        </div>

      </div>
    <?php endforeach; ?>

    <!-- Section Start for Heading -->
    <div class="container-fluid sizeLearn">
      <div class="row back1 pc-only" style="background-color: white !important;">
        <div class="col-md-12  narrow mb-4">
          <b id="text">Learn More About Us</b><br>
        </div>
      </div>
    </div>
    <!-- Section End for Heading -->


    <!-- Section Start for Box Part -->

    <div class="container-fluid pc-only">
      <div class="row ram "> <!-- //pc only esma thiyo -->

        <div class="col-md-3 it4d" onclick="It4d()">
          <div class="heading-underline s"></div>
          <span id="about">IT4D</span>
        </div>

        <div class="col-md-3 doko" onclick="Doko()">
          <div class="heading-underline s"></div>
          <span id="about">doko</span>
        </div>

        <div class="col-md-3 jobFair" onclick="Jobfair()">
          <div class="heading-underline s"></div>
          <span id="about">jobfair</span>
        </div>

        <div class="col-md-3 classroom" onclick="Dlc()">
          <div class="heading-underline s"></div>
          <span id="about">dlc</span>
        </div>

        <div class="col-md-3 alumni" onclick="Alumni()">
          <div class="heading-underline s"></div>
          <span id="about">dwit alumni</span>
        </div>

        <div class="col-md-3 news" onclick="News()">
          <div class="heading-underline s"></div>
          <span id="about">dwit news</span>
        </div>

        <div class="col-md-3 foods" onclick="Food()">
          <div class="heading-underline s"></div>
          <span id="about">deerwalk foods</span>
        </div>

        <div class="col-md-3 journal" onclick="Journal()">
          <div class="heading-underline s"></div>
          <span id="about">deerwalk journal</span>
        </div>



      </div>
    </div>

    <div class="container-fluid sm-only" style="background-color: white !important;">
      <div class="col-md-12">
        <b id="textAbout">Learn More About us</b><br>
      </div>
      <div class="row menu-bg"> <!-- //pc only esma thiyo -->

        <div class="row-overlay">
        </div>
        <div class="col-md-3" onclick="It4d()">
          <h5 class="text-center">IT4D</h5>
        </div>

        <div class="col-md-3" onclick="Doko()">
          <h5 class="text-center">DOKO</h5>
        </div>

        <div class="col-md-3" onclick="Jobfair()">
          <h5 class="text-center">JOBFAIR</h5>
        </div>

        <div class="col-md-3" onclick="Dlc()">
          <h5 class="text-center">DLC</h5>
        </div>

        <div class="col-md-3" onclick="Alumni()">
          <h5 class="text-center">ALUMNI</h5>
        </div>

        <div class="col-md-3" onclick="News()">
          <h5 class="text-center">DWIT NEWS</h5>
        </div>

        <div class="col-md-3" onclick="Food()">
          <h5 class="text-center">FOOD</h5>
        </div>

        <div class="col-md-3" onclick="Journal()">
          <h5 class="text-center">JOURNAL</h5>
        </div>



      </div>
    </div>

    <!-- Section End for Box Part -->

    <!-- Mobile Section for About Us start -->

    <!--  <div class="row backAbout sm-only">-->
    <!--        <div class="col-md-12"> -->
    <!--          <b id="textAbout">Learn More About us</b><br>-->
    <!--        </div>-->
    <!--        <div class="grid-5 check">-->
    <!--          -->
    <!--          <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>IT4D</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--          </a>-->
    <!---->
    <!--          <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>DOKO</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--         </a>-->
    <!---->
    <!--         <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>Jobfair</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--         </a>-->
    <!---->
    <!--          <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>Classroom</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--         </a>-->
    <!---->
    <!--          <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>DWIT Alumni</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--         </a>-->
    <!---->
    <!--          <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>DWIT News</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--         </a>-->
    <!---->
    <!--         <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>Deerwalk Foods</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--         </a>-->
    <!---->
    <!--         <a href="#" class="link-card col">-->
    <!--            <div class="link__content">-->
    <!--              <h5 id="link"> <strong>Deerwalk Journal</strong> &nbsp; <b><i class="fa fa-angle-right linkright"></i></b></h5>-->
    <!--            </div>-->
    <!--         </a>-->
    <!---->
    <!---->
    <!--        </div>-->
    <!--  </div>-->
    <!---->

    <script type="text/javascript">
      $(document).ready(function() {
        function loadOHSContent() {
          $.ajax({
            url: "./ajax/loadOHS.php",
            type: "POST",
            dataType: "json",
            timeout: 15000, // Increased timeout for database queries
            beforeSend: function() {
              console.log("Loading OHS content...");
              // Show overlay with loading spinner
              $('#welcomePopup').addClass('show');
              $('#OHSLoader').empty(); // This will show the loading spinner
            },
            success: function(response) {
              console.log("AJAX Success:", response);

              if (response.status == 1 || response.status == 0) {
                // Load content and show popup with animation
                $('#OHSLoader').html(response.detail);

                // Add loaded class to trigger animation after content is loaded
                setTimeout(function() {
                  $('.ohs-popup-content').addClass('loaded');
                }, 50);
              } else {
                console.log("Unexpected response:", response);
                $('#OHSLoader').html('<div class="ohs-popup-content loaded"><div class="ohs-single-section"><div class="ohs-section"><p>Unexpected response format</p></div></div></div>');
              }
            },
            error: function(xhr, status, error) {
              console.log("AJAX Error:");
              console.log("Status:", status);
              console.log("Error:", error);
              console.log("HTTP Status:", xhr.status);
              console.log("Response Text:", xhr.responseText);

              let errorMessage = '';
              if (xhr.status === 404) {
                errorMessage = '<div class="ohs-popup-content loaded"><div class="ohs-single-section"><div class="ohs-section"><p>OHS file not found. Please check the file path.</p></div></div></div>';
              } else if (xhr.status === 500) {
                errorMessage = '<div class="ohs-popup-content loaded"><div class="ohs-single-section"><div class="ohs-section"><p>Server error. Please check the PHP file and database connection.</p></div></div></div>';
              } else if (status === 'parsererror') {
                errorMessage = '<div class="ohs-popup-content loaded"><div class="ohs-single-section"><div class="ohs-section"><p>Invalid response from server. Check PHP syntax.</p></div></div></div>';
              } else {
                errorMessage = '<div class="ohs-popup-content loaded"><div class="ohs-single-section"><div class="ohs-section"><p>Failed to load OHS content. Please try again later.</p></div></div></div>';
              }

              $('#OHSLoader').html(errorMessage);
              $('#welcomePopup').addClass('show');
            }
          });
        }

        loadOHSContent();
      });
    </script>

    <style>
      /* Minimal styles for OHS popup - main styles are in multi-pop.css */
      #welcomePopup.ohs-popup-overlay {
        display: flex;
        opacity: 0;
        visibility: hidden;
      }

      #welcomePopup.ohs-popup-overlay.show {
        opacity: 1;
        visibility: visible;
      }
    </style>

    <script>
      function It4d() {
        window.open(
          "https://it4d.org/", "_blank");
      }

      function Doko() {
        window.open(
          "https://doko.dwit.edu.np/", "_blank");
      }

      function Jobfair() {
        window.open(
          "https://jobfair.dwit.edu.np/", "_blank");
      }

      function Dlc() {
        window.open(
          "https://dlc.dwit.edu.np/", "_blank");
      }

      function Alumni() {
        window.open(
          "https://alumni.dwit.edu.np/", "_blank");
      }

      function News() {
        window.open(
          "https://dwitnews.com/about", "_blank");
      }

      function Food() {
        window.open(
          "https://foods.deerwalk.edu.np", "_blank");
      }

      function Journal() {
        window.open(
          "https://journal.deerwalk.edu.np/", "_blank");
      }
      // Function to close the popup
      function closePopup() {
        const modal = document.getElementById('welcomePopup');
        if (modal) {
          modal.classList.remove('show');
        }
      }

      // Handle background click and escape key
      document.addEventListener('click', function(event) {
        if (event.target.id === 'welcomePopup') {
          closePopup();
        }
      });

      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
          closePopup();
        }
      });
    </script>


    <?php include './include/indexfooter.php'; ?>