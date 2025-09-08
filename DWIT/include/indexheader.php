<?php require_once "./system/application_top.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L434P5CYP9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-L434P5CYP9');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-compatible" Content="IE-edge">
    <meta name="viewport" content="width=device-width">
    <title>DWIT</title>

    <!-- og-property-start -->
    <meta property="og:title" content="Deerwalk Institute Of Technology" />
    <meta property="og:url" content="http://deerwalk.edu.np/DWIT" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Deerwalk Institute of Technology provides extensive undergraduate programs, namely the Bachelors of Science in Computer Science and Information Technology (BSc.CSIT) and the Bachelor of Computer Applications (BCA)" />
    <meta property="og:image" content="https://deerwalk.edu.np/DWIT/assets/images/learn_backG.jpg" />
    <!-- og-property-end -->
    <link rel="stylesheet" type="text/css" href="./assets/css/multi-pop.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/clubstyles.css">
    <link rel="stylesheet" href="./assets/css/heroCard.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/media-queries.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/fixed.css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <style>
        html,
        body {
            width: 100%;
            height: auto;
            margin: 0px;
            padding: 0px;
            font-family: "Segoe UI", "sans-serif";
            /*overflow-x: hidden;*/
        }

        .btns {
            font-size: .75rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: .86px;
            line-height: 1.25;
            padding: 13px 30px;
            text-decoration: none;
            text-transform: uppercase;
            /* background-color: #cd4b13;*/
            background: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            position: relative;
            transition-duration: .4s;
            transition-property: background, color;
            /*   transition-timing-function: cubic-bezier(.55,.085,.68,.53);*/
            border: 3px solid;
            border-image-source: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            border-image-slice: 1;
            border-radius: 0px;
            /*background-image: linear-gradient(90deg,#02a28b,#067f87 52.4%,#0a5f82);*/
        }

        .btns:hover {
            background: white;
            color: #087285;
        }

        .btns a {
            text-decoration: none;
        }

        .btns1 {
            /*	margin-bottom: 10px;*/
            font-size: .75rem;
            font-weight: 700;
            color: #087285;
            letter-spacing: .86px;
            line-height: 1.25;
            padding: 13px 30px;
            text-decoration: none;
            text-transform: uppercase;
            background: white;
            position: relative;
            transition-duration: .4s;
            transition-property: background, color;
            border: 3px solid;
            border-image-source: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            border-image-slice: 1;
            border-radius: 0px;
        }

        .btns1:hover {
            background: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            color: #fff;
        }

        .btns1 a {
            text-decoration: none;
        }

        .dropdown_content {
            color: white
        }

        .dropdown-menus {
            display: none;
            width: auto;
            min-width: unset !important;
            padding: 0;
        }

        .dropdown-submenu>a::after {
            position: relative;
        }

        .padding {
            padding-left: 50px;
        }

        .loginbtn {
            margin-bottom: 10px;
            font-size: .75rem;
            font-weight: 700;
            color: #087285;
            letter-spacing: .86px;
            line-height: 1.25;
            padding: 10px 20px;
            margin-top: 5px;
            margin-left: 10px;
            text-decoration: none;
            text-transform: uppercase;
            background: white;
            position: relative;
            transition-duration: .4s;
            transition-property: background, color;
            border: 2px solid;
            border-image-source: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            border-image-slice: 1;
            border-radius: 0px;
        }

        .loginbtn:hover {
            background: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            color: #fff;
        }

        .aud {
            font-size: 18px !important;

        }

        .top-text {
            font-size: 16px !important;
        }

        .footer_middle a:hover {
            text-decoration: none;
        }

        .btnNews {
            font-size: .75rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: .86px;
            line-height: 1.25;
            padding: 13px 30px;
            text-decoration: none;
            text-transform: uppercase;
            /* background-color: #cd4b13;*/
            background: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            position: relative;
            transition-duration: .4s;
            transition-property: background, color;
            /*   transition-timing-function: cubic-bezier(.55,.085,.68,.53);*/
            border: 2px solid;
            border-image-source: linear-gradient(90deg, #02a28b, #067f87 52.4%, #0a5f82);
            border-image-slice: 1;
            border-radius: 0px;
            /*background-image: linear-gradient(90deg,#02a28b,#067f87 52.4%,#0a5f82);*/
        }

        .btnNews:hover {
            background: white;
            color: #087285;
        }





        @media only screen and (min-width: 768px) and (max-width: 1085px) {

            /*navbar*/
            .top-text {
                font-size: 12px !important;
            }

            .nav-link {
                font-size: 10px !important;
            }

            /*    footer*/

            #footer_content {
                font-size: 14px !important;
            }

            #logo_f {
                width: 130px !important;
                height: 60px !important;
            }

            #footer_content_mid {
                margin-left: unset !important;
                font-size: 14px !important;
            }

            #footer_content_right {
                font-size: 14px !important;
            }

            .footer-icon {
                font-size: 12px !important;
            }
        }
    </style>


</head>

<body>



    <!-- This is the HTML structure for your navbar -->
    <nav class="navbar navbar-expand-md navbar-light sticky-top">
        <!-- Logo -->
        <a href="index.php" class="navbar-brand">
            <img id="logo" src="./assets/images/logo.png" alt="Logo">
        </a>

        <!-- Mobile toggle button -->
        <div class="navbar-toggler-right">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse flex-column" id="navbar">
            <!-- Main navigation -->
            <ul class="navbar-nav main-nav w-100 px-3 downNav pc-onlyss">
                <ul class="navbar-nav nav-items">
                    <li class="nav-item dropdown">
                        <a class="nav-link aud dropdown-toggle" href="#" id="aboutDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            About
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <div class="dropdown-submenu">
                                <a class="dropdown-item drop_content dropdown-toggle" href="#" id="ourTeamBtn">Our Team</a>
                                <div class="dropdown-menus" id="ourTeamMenu">
                                    <a class="dropdown-item drop_content padding" href="administration.php">Management</a>
                                    <a class="dropdown-item drop_content padding" href="faculty.php">Faculties</a>
                                    <a class="dropdown-item drop_content padding" href="adminlist.php">Admin Staff</a>
                                </div>
                            </div>
                            <a class="dropdown-item drop_content" href="campus.php">Campus Facilities</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link aud" href="admission.php">
                            Admission
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link aud" href="#">
                            Academics
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item drop_content" href="academics-csit.php">BSC. CSIT</a>
                            <a class="dropdown-item drop_content" href="academics-bca.php">BCA</a>
                            <a class="dropdown-item drop_content" href="diploma.php">Diploma in Data Analytics</a>
                            <a class="dropdown-item drop_content" href="credit-course.php">DWIT Credit Courses</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link aud" href="#">
                            Student Life
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item drop_content" href="studentlife-clubs.php">Clubs</a>
                            <a class="dropdown-item drop_content" href="internship.php">Internships</a>
                            <a class="dropdown-item drop_content" href="powerworkshop.php">Power Workshops</a>
                            <a class="dropdown-item drop_content" href="incubation.php">Incubation center</a>
                            <a class="dropdown-item drop_content" href="rural-teaching-program.php">Rural Teaching Program</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link aud" href="https://alumni.dwit.edu.np/home" target="_blank">
                            Alumni
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link aud" href="contact.php">
                            Contact
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link aud" href="calendarDisplay.php">
                            Calendar
                        </a>
                    </li>
                </ul>

                <!-- Social icons -->
                <div class="social-icons">
                    <a href="https://www.facebook.com/dwit.college/" target="_blank" class="social-icon">
                        <i class="fab fa-facebook-f" style="color: #fff; font-size: 28px;"></i>
                    </a>
                    <a href="https://www.instagram.com/deerwalk.college/" target="_blank" class="social-icon">
                        <i class="fab fa-instagram" style="color: #fff; font-size: 28px;"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCkyucMwCIBSqOV_oFHcq9cg" target="_blank" class="social-icon">
                        <i class="fab fa-youtube" style="color: #fff; font-size: 28px;"></i>
                    </a>
                </div>
            </ul>

            <!-- Mobile Nav -->
            <ul class="navbar-nav justify-content-end w-100  px-3 downNav sm-only">
                <ul class="navbar-nav ml-auto " id="mobile-nav-test">
                    <li class="nav-item dropdown">
                        <a class="nav-link mob-nav dropdown-toggle" href="#" id="aboutDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            About
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <div class="dropdown-submenu">
                                <a class="dropdown-item drop_content dropdown-toggle" href="#" id="ourTeamBtn-sm">Our
                                    Team</a>
                                <div class="dropdown-menus" id="ourTeamMenu-sm">
                                    <a class="dropdown-item drop_content padding"
                                        href="administration.php">Management</a>
                                    <a class="dropdown-item drop_content padding" href="faculty.php">Faculties</a>
                                    <a class="dropdown-item drop_content padding" href="adminlist.php">Admin Staff</a>
                                </div>
                            </div>
                            <a class="dropdown-item drop_content" href="campus.php">Campus Facilities</a>
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link  mob-nav" href="admission.php">
                            Admission
                        </a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  mob-nav dropdown-toggle" href="#">
                            Academics
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item drop_content" href="academics-csit.php">BSC. CSIT</a>
                            <a class="dropdown-item drop_content" href="academics-bca.php">BCA</a>
                            <a class="dropdown-item drop_content" href="diploma.php">Diploma in Data Analytics</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link  mob-nav dropdown-toggle" href="#">
                            Student Life
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item drop_content" href="studentlife-clubs.php">Clubs</a>
                            <a class="dropdown-item drop_content" href="internship.php">Internships</a>
                            <a class="dropdown-item drop_content" href="powerworkshop.php">Power Workshops</a>
                            <a class="dropdown-item drop_content" href="incubation.php">Incubation Center</a>
                            <a class="dropdown-item drop_content" href="rural-teaching-program.php">Rural Teaching</a>

                        </div>
                    </li>

                    <!-- <li class="nav-item">
                    <a class="nav-link  mob-nav" href="connect.php">
                        CONNECT
                    </a>

                </li> -->
                    <li class="nav-item">
                        <a class="nav-link  mob-nav-sm" href="https://alumni.dwit.edu.np/home" target="_blank">
                            Alumni
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link  mob-nav-sm" href="contact.php">
                            Contact
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link  mob-nav-sm" href="calendarDisplay.php">
                            Calendar
                        </a>

                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link  mob-nav" href="calendarDisplay.php">
                        CALENDAR
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  mob-nav" href="calendarDisplay.php">
                        VERIFY CERTIFICATE
                    </a>
                </li> -->




                </ul>
            </ul>
        </div>
    </nav>



    <!--  Verify Certificate Modal -->
    <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Verify Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="get" action="certificateDetails.php?validation_id">
                        <div class="form-group">
                            <label for="validation_id" class="col-form-label">Enter Verification ID:</label>
                            <input type="text" class="form-control" name="validation_id" id="validation_id" autofocus />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Verify" />
                            <!-- onclick="window.location.href=this.form.action + this.form.validation_id.value;" -->
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script>
        document.getElementById('ourTeamBtn').addEventListener('click', function(e) {
            const dropdownMenu = document.getElementById('ourTeamMenu');
            const buttonWidth = this.offsetWidth;

            // Toggle display
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
                dropdownMenu.style.width = buttonWidth + 'px';
            }

            // Prevent default anchor behavior (if needed)
            e.preventDefault();
        });

        // Optional: Close menu when clicking outside
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('ourTeamBtn');
            const menu = document.getElementById('ourTeamMenu');
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });

        document.getElementById('ourTeamBtn-sm').addEventListener('click', function(e) {
            const dropdownMenu = document.getElementById('ourTeamMenu-sm');
            const buttonWidth = this.offsetWidth;

            // Toggle display
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
                dropdownMenu.style.width = buttonWidth + 'px';
            }

            // Prevent default anchor behavior (if needed)
            e.preventDefault();
        });

        // Optional: Close menu when clicking outside
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('ourTeamBtn-sm');
            const menu = document.getElementById('ourTeamMenu-sm');
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    </script>