<?php
$pgName = 'Admission';
include('./include/header.php') ?>

<?php $data = $obj->selectAllDataByField('admission_detail', array('csit', 'bca', 'common'), null); ?>

<!-- Welcome Popup Modal
<div id="welcomePopup" class="ohs-modal">
    <div class="ohs-popup-content">
        <button class="ohs-close-btn" onclick="closeModal()" aria-label="Close popup">&times;</button>

        <div class="ohs-single-section">
            <div class="ohs-section">
                <div>
                    <h2 class="ohs-title">
                        ADMISSION<br />
                        <span class="ohs-accent-blue">OPEN</span>
                    </h2>
                    <h5 class="ohs-subtitle">
                        NOW OPEN FOR <span class="ohs-accent-green">REGISTRATION</span>
                    </h5>
                    <h3 class="ohs-program-title">For BCA | BSc. CSIT</h3>
                </div>
                <a class="ohs-action-btn" href="https://application.deerwalk.edu.np/">
                    APPLY NOW
                </a>
            </div>
        </div>
    </div>
</div> -->

<style>
    /* Popup Modal Styles */
    .ohs-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
    }

    .ohs-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .ohs-popup-content {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        max-width: 500px;
        width: 90%;
        margin: 20px;
        animation: slideUp 0.4s ease-out;
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .ohs-close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        background: none;
        border: none;
        font-size: 28px;
        font-weight: bold;
        color: #666;
        cursor: pointer;
        z-index: 10;
        transition: color 0.3s ease;
    }

    .ohs-close-btn:hover {
        color: #333;
    }

    .ohs-single-section {
        padding: 40px 30px;
    }

    .ohs-section {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 25px;
    }

    .ohs-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #2c3e50;
        margin: 0;
        line-height: 1.1;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .ohs-accent-blue {
        color: #0f5288;
    }

    .ohs-accent-green {
        color: #27ae60;
    }

    .ohs-subtitle {
        font-size: 1rem;
        color: #34495e;
        margin: 10px 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .ohs-program-title {
        font-size: 1.3rem;
        color: #0f5288;
        margin: 15px 0;
        font-weight: 700;
    }

    .ohs-action-btn {
        background: linear-gradient(135deg, #17880fff 0%, #065400ff 100%);
        color: white;
        padding: 15px 35px;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(15, 82, 136, 0.3);
        border: none;
        cursor: pointer;
    }

    .ohs-action-btn:hover {
        background: linear-gradient(135deg, #17880fff 0%, #1f8e06ff 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(15, 82, 136, 0.4);
        color: white;
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .ohs-popup-content {
            margin: 10px;
            max-width: none;
        }

        .ohs-single-section {
            padding: 30px 20px;
        }

        .ohs-title {
            font-size: 1.8rem;
        }

        .ohs-program-title {
            font-size: 1.1rem;
        }

        .ohs-action-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }
    }
</style>

<!--Page Banner-->
<div class="container-fluid admission-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">ADMISSION</h4>
    </div>
</div>

<!--undergraduate courses-->

<div class="container-fluid page-desc">
    <h4 class="text-center" style="color: #0f5288">UNDERGRADUATE ADMISSION</h4>
    <p class="lead page-desc-text">DWIT offers two programs for Undergraduate students under science and
        management. The two programs are Bsc.CSIT and BCA offered under science and management respectively.
        The programs are run under the affiliation with Tribhuvan University.</p>
    <div class="row">
        <div class="col-md-6 page-subtitle">
            <h5 class="adm-csit">BSC. CSIT</h5>
            <p class="lead page-desc-text">B.Sc. CSIT program affiliated to Tribhuvan University (TU) is a four year
                Bachelor Degree program run by DWIT.The objective of the B.Sc. CSIT program is to enable students
                know the fundamental theories, knowledge and skill sets of computer science and Information Technology.
                B.Sc. CSIT programs focuses on programming field thus enabling students to develop profound knowledge
                in software field so that they can pursue the path to become software programmers, software system
                analysis, software consultants.</p>
        </div>
        <div class="col-md-6 page-subtitle">
            <img src="./assets/images/faculties.JPG" class="img-all2 img-fluid image-center" alt="a lecturer at dwit,beside the whiteboard">
        </div>
    </div>
    <div class="row">


        <div class="col-md-6 order-sm-12 page-subtitle course-bca">
            <h5>BCA</h5>
            <p class="lead page-desc-text">DWIT runs BCA program under the affiliation of Tribhuvan
                University.It is a 4 years program run on semester-system. </p>
        </div>
        <div class="col-md-6 order-sm-1 page-subtitle course-bca">
            <img src="./assets/images/bca1.jpg" class="img-fluid img-all4" alt="students appearing the dwit aptitude test">
        </div>

    </div>
</div>



<!--admission requirements-->
<section id="tabs">
    <div class="container-fluid adm-rqm">
        <h4 class="text-center adm-heading">ADMISSION REQUIREMENTS/NOTICES</h4>
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link adm-tab-item active" id="nav-eligibility-tab" data-toggle="tab" href="#nav-eligibility" role="tab" aria-controls="nav-eligibility" aria-selected="true">Eligibility</a>
                        <a class="nav-item nav-link adm-tab-item" id="nav-documents-tab" data-toggle="tab" href="#nav-documents" role="tab" aria-controls="nav-documents" aria-selected="false">Documents Required</a>
                        <a class="nav-item nav-link adm-tab-item" id="nav-key-dates-tab" data-toggle="tab" href="#nav-key-dates" role="tab" aria-controls="nav-key-dates" aria-selected="false">Key Dates</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-eligibility" role="tabpanel" aria-labelledby="nav-eligibility-tab">
                        <div class="row course-eligibility">
                            <div class="col-md-6 col-xs-6">
                                <div class="lead font-all">
                                    <?php if ($data[0]['csit'] != "") echo html_entity_decode($data[0]['csit']); ?>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-6">
                                <div class="lead font-all">
                                    <?php if ($data[0]['bca'] != "") echo html_entity_decode($data[0]['bca']); ?>
                                </div>
                            </div>

                            <div class="lead font-all">
                                <?php if ($data[0]['common'] != "") echo html_entity_decode($data[0]['common']); ?>
                            </div>
                            <!-- <p class="lead font-all">
                            Qualified candidates can collect the DAT Form from the Admission Department, DWIT. The forms must be submitted back along with the following documents at campus:
                        </p>
                        <ul class="lead font-all">
                            <li>DAT Form along with the personal statement.</li>
                            <li> NRS 1500 Application Processing Fee.</li>
                        </ul> -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
                        <div class="lead font-all doc-rqm">
                            <?php if ($data[1]['csit'] != "") echo html_entity_decode($data[1]['csit']); ?>
                        </div>
                        <div class="lead font-all doc-rqm">
                            <?php if ($data[1]['bca'] != "") echo html_entity_decode($data[1]['bca']); ?>
                        </div>
                        <div class="lead font-all doc-rqm">
                            <?php if ($data[1]['common'] != "") echo html_entity_decode($data[1]['common']); ?>
                        </div>

                        <!--                     <ul class="lead font-all doc-rqm">
                        <li>Original Copy of SLC Marksheet</li>
                        <li> Character Certificate – SLC</li>
                        <li>Plus 2 / Equivalent Transcript – HSEB/NEB / Equivalent</li>
                        <li>Character Certificate – +2/Equivalent College</li>

                    </ul> -->
                    </div>
                    <div class="tab-pane fade" id="nav-key-dates" role="tabpanel" aria-labelledby="nav-key-dates-tab">
                        <div class="row course-eligibility">
                            <div class="col-md-6">
                                <div class="lead font-all">
                                    <?php if ($data[2]['csit'] != "") echo html_entity_decode($data[2]['csit']); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="lead font-all">
                                    <?php if ($data[2]['bca'] != "") echo html_entity_decode($data[2]['bca']); ?>
                                </div>
                            </div>

                            <div class="lead font-all">
                                <?php if ($data[2]['common'] != "") echo html_entity_decode($data[2]['common']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<div class="d-flex justify-content-center">
    <div class="container">
        <div class="btn-wrapper">
            <a class="btn btn-large btn-outline btns" href="https://application.deerwalk.edu.np/" target="_blank">APPLY NOW</a>
        </div>
    </div>
    <div class="container">
        <div class="btn-wrapper">
            <a class="btn btn-large btn-outline btns" href="./preregister.php">ADMISSION INQUIRY</a>
        </div>
    </div>
    <!--why dwit-->
</div>
<div class="container" style="margin-top: 110px">

    <h4 class="text-center" style="color: #0f5288">WHY CHOOSE DWIT?</h4>
    <ul>
        <li class="lead font-all">Paid Internship at Deerwalk</li>
        <li class="lead font-all">Scholarships for deserving candidated</li>
        <li class="lead font-all">Expert faculty with industry experience</li>
        <li class="lead font-all">Real projects involving teamwork</li>
        <li class="lead font-all">Skill development through academic/industry partnership</li>
        <li class="lead font-all">Career Advisor for each student</li>
    </ul>
</div>

<!--testimonial-->

<div class="container">
    <h4 class="text-center" style="color: #0f5288">STUDENT TESTIMONIAL</h4>
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="card  mx-auto std-test">
                <img src="./assets/images/simran-parajuli-1.jpeg" class="card-img-top img-all" alt="Simran Parajuli">
                <div class="card-body scroll-test">
                    <p class="lead" style="font-size: 14px; line-height: 1.5"><i>"I choose to learn from the best, be it a make-up artist
                            with a youtube tutorial or a good college. But choosing the right college was a
                            great deal, as it would have a great impact on my career. Now that I am a 3rd
                            year student with a good internship at hand and an institution that
                            always pushes me to achieve more, I am glad I made the right decision."</i><br>
                        <i style="padding-left: 46px"> - Simran Parajuli, Class of 2021</i>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card  mx-auto std-test">
                <img src="./assets/images/sagar-shrestha.jpg" class="card-img-top img-all" alt="Sagar-Shrestha">
                <div class="card-body">
                    <p class="lead" style="font-size: 14px; line-height: 1.5"><i>"Being a final year student I am grateful towards Deerwalk
                            Institute of Technology for all the knowledge,
                            high quality theoretical & practical education that I
                            have achieved so far. I have learnt so much in the past 3 years and I am confident that
                            the knowledge and experience I will have gained by my finals days will help
                            me standout in my professional career."</i><br>
                        <i style="padding-left: 44px">- Sagar Shrestha, Class of 2020</i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--stats-->
<div class="container-fluid adm-stat">
    <div class="layer">
        <h1 class="text-center" style="color: white; padding-top: 20px">DWIT IN NUMBER</h1>
        <div class="row">
            <div class="col-md-4">
                <h3 class="adm-stat-num text-center">12</h3>
                <div class="heading-underline"></div>
                <p class="lead font-all text-center" style="color: white">BATCHES</p>
            </div>

            <div class="col-md-4">
                <h3 class="adm-stat-num text-center">604</h3>
                <div class="heading-underline"></div>
                <p class="lead font-all text-center" style="color: white">STUDENTS</p>
            </div>

            <div class="col-md-4">
                <h3 class="adm-stat-num text-center">2023</h3>
                <div class="heading-underline"></div>
                <p class="lead font-all text-center" style="color: white"> GRADUATING BATCH</p>
            </div>
        </div>
    </div>

</div>
<!--international student-->
<div class="container int-std">
    <h4 class="text-center" style="color: #0f5288">INTERNATIONAL STUDENTS</h4>
    <p class="lead font-all"> Passed the entrance exam administered by the Tribhuvan University –
        Institute of Science and Technology</p>

    <div class="row int-main-points">
        <div class="col-md-4">
            <div class="card int-box mx-auto">
                <div class="card-body">
                    <p class="lead font-all int-box1">Completed Application Form</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card int-box">
                <div class="card-body">
                    <p class="lead font-all int-box2"> Certified academic transcript of completion of high-schooling </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card int-box">
                <div class="card-body">
                    <p class="lead font-all int-box1">Application Processing Fee</p>
                </div>
            </div>
        </div>
    </div>
    <p class="lead font-all">The form processing will start only after payment of USD 25. In order to get
        an admission students MUST pass the Entrance Test taken by Tribhuvan University as well as
        Aptitude Test administered by DWIT. <br><br>
        Please write to admission@deerwalk.edu.np for further details.
    </p>
</div>

<script>
    function closeModal() {
        const modal = document.getElementById("welcomePopup");
        if (modal) {
            modal.classList.remove("show");
        }
    }

    // Show popup on page load
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById("welcomePopup");
        if (modal) {
            // Add a small delay for better UX
            setTimeout(() => {
                modal.classList.add("show");
            }, 500);
        }
    });

    // Close popup when clicking outside of it
    document.addEventListener('click', function(event) {
        const modal = document.getElementById("welcomePopup");
        if (event.target === modal) {
            closeModal();
        }
    });

    // Close popup with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
</script>

<?php include('./include/footer.php') ?>
<?php #include('./model.php')
?>