<?php include('./include/header.php'); ?>

<div class="container-fluid campus-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">In-House Applications</h4>
    </div>
</div>

<!-- CONTENT -->
<div class="container-fluid" id="in-house-app">
    <h4 class="text-center mt-5" style="color: #0f5288">In-House Applications</h4>

    <div class="row justify-content-center mt-5">
        <!-- slef -->
            <div class="col-md-3 col-sm-4">
                <div class="card">
                  <img class="card-img-top" src="./assets/images/in-house-app/dwit_classroom.jpg" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text"><h4><small>DWIT Classroom Site</small></h4>
                        <hr>
                        <a href="javascript:;" onclick="getIp('https://classroom.dwit.edu.np', 1)">Visit Site</a>
                    </p>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="card">
                  <img class="card-img-top" src="./assets/images/in-house-app/dwit_intern.jpg" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text"><h4><small>DWIT Intern Manager</small></h4>
                        <hr>
                        <a href="javascript:;" onclick="getIp('https://internmanager.deerwalk.edu.np', 1)">Visit Site</a>
                    </p>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="card">
                  <img class="card-img-top" src="./assets/images/in-house-app/dwit_drm.jpg" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text"><h4><small>DWIT Resource Manager</small></h4>
                        <hr>
                        <a href="javascript:;" onclick="getIp('http://drm.deerwalkgroup.com', 0)">Visit Site</a>
                    </p>
                  </div>
                </div>
            </div>
            <div class="w-100"></div>
        <!-- </div> -->
            <!-- row-2 -->
        <!-- <div class="row justify-content-center mt-5"> -->
            <div class="col-md-3 col-sm-4">
                <div class="card">
                  <img class="card-img-top" src="./assets/images/in-house-app/dwit_library.jpg" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text"><h4><small>DWIT Library</small></h4>
                        <hr>
                        <a href="javascript:;" onclick="getIp('https://dwitlibrary.deerwalk.edu.np', 0)">Visit Site</a>
                    </p>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="card">
                  <img class="card-img-top" src="./assets/images/in-house-app/dwit_profiler.jpg" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text"><h4><small>DWIT Profiler</small></h4>
                        <hr>
                        <a href="javascript:;" onclick="getIp('https://profiler.deerwalk.edu.np', 0)">Visit Site</a>
                    </p>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="card">
                  <img class="card-img-top" src="./assets/images/in-house-app/dwit_foods.jpg" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text"><h4><small>DWIT Foods</small></h4>
                        <hr>
                        <a href="javascript:;" onclick="getIp('https://foods.deerwalk.edu.np/', 0)">Visit Site</a>
                    </p>
                  </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-4">
                <div class="card">
                  <img class="card-img-top" src="./assets/images/in-house-app/dwit_helpdesk.jpg" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text"><h4><small>DWIT HelpDesk</small></h4>
                        <hr>
                        <a href="javascript:;" onclick="getIp('http://helpdesk.deerwalk.edu.np', 0)">Visit Site</a>
                    </p>
                  </div>
                </div>
            </div>
    </div>
</div>

<!-- form-old -->
        <script type="text/javascript">
            function getIp(redirectTo, isGlobal)
            {
                var xmlhttp = new XMLHttpRequest();
                var url = "https://ipecho.net/plain";

                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        redirectTO(redirectTo, isGlobal, this.responseText);
                    }
                };
                xmlhttp.open("GET", url, true);
                xmlhttp.send();
            }

            function redirectTO(url, isGlobal, ip) {
                if (isGlobal) {
                    window.open(url, '_blank');
                } else if (ip === "110.44.116.42") {
                    window.open(url, '_blank');
                } else {
                    swal({
                        title: 'Access Denied!',
                        icon: 'error',
                        text: 'This site is only accessible for DWIT Students and Staffs!',
                        confirmButtonText: 'Okay',
                    });
                }
            }
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- old ends -->

<style type="text/css">
    #in-house-app a{
        color: #e4860d;
        text-decoration: none;
    }

    #in-house-app .card-body{
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }

    #in-house-app hr{
        margin-top: 0.75rem;
        margin-bottom: 0.5rem;
    }

    #in-house-app .card{
        margin-bottom: 3rem;
    }
</style>

<?php include('./include/footer.php'); ?>
