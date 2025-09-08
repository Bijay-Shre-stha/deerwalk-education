<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<?php
$pgName = 'Faculties';
include('./include/header.php'); 

$data = $obj->selectAllJoin("staff", array("staff.id", "staff.full_name", "staff.image_name", "department.name"), array("staff.priority" => "DESC", "staff.full_name" => "ASC"), "LEFT", "department", "department_id", "id");
?>
    
    <div class="container-fluid faculty-bg">
        <div class="container page-title">
            <h4 class="display-6 text-center r-d-unit-top">FACULTIES</h4>
        </div>
    </div>

    <!-- Modal Starts Here - Large Modal   -->
    <div
        class="profile-modal modal fade bd-example-modal-lg"
        id="staticBackdrop"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
    >
        <div class="profile-modal-dialog modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content faculty-modal-content position-relative bg-white border-transparent">
                <div class="modal-header profile-modal-header w-100 position-sticky border-0 m-0 border-0">
                    <button type="button" class="close" onclick="clear_modal()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body profile-model-body">
                    <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2"
                         id="add-to-modal">
                        <!-- HTML insertion using AJAX on Card Click Event -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container-fluid mt-3">
        <div class="row mx-auto ">
            <!-- card starts here  -->
            <?php while ($detail = $data->fetch()): ?>
                <div class="col-12 p-3 col-sm-6 col-md-4 col-lg-3 full-height vm-10-px"
                      onclick=toggle_popup(<?php echo $detail['id'] ?>)>
                    <div
                        data-toggle="modal"
                        data-target=".bd-example-modal-lg"
                        class="card member-card card-hover-effect toggle-opaque-wrapper w-100 m-1 cursor pl-2 pt-2 pr-2 pb-0 bg-light"
                        style="width: 18rem"
                    >

                        <div class="ribbon-pop position-absolute d-inline-block arial-medium">
                            <strong class="one-liner"><?php echo $detail['name']; ?></strong>
                        </div>

                        <div class="profile-img-wrapper position-relative overflow-hidden">
                            <div style="width: 100%; max-height: 100%">
                                <?php if(file_exists("./admin/uploads/staff/".$detail['image_name'])) {?>
                                <img class="card-img-top avatar-img"
                                     src="./admin/uploads/staff/<?php echo($detail['image_name']); ?>"
                                     alt="Card image cap"/>
                                <?php }else { ?>
                                    <img class="card-img-top avatar-img"
                                         src="./assets/images/noimg-placeholderII.jpg"
                                         alt="Card image cap"/>
                                <?php } ?>
                            </div>
                            <div class="card-overlap overflow-hidden position-absolute d-flex">
                                <h3 class="arial-medium view-profile-wrapper view_profile_modal">
                                    View Profile
                                </h3>
                            </div>
                        </div>

                        <h6 class="text-center m-0 pt-2 pb-2">
                            <?php echo $detail['full_name']; ?>
                        </h6>
                    </div>
                </div>
            <?php endwhile; ?>
            <!-- card ends here -->
        </div>
    </section>

    <script>
        function toggle_popup(id) {
            $.ajax(
                {
                    method: "POST",
                    url: './ajax/faculty-detail.php?fac-id='+id,
                    success: function (data) {
                        data = JSON.parse(data)
                        $('#add-to-modal').html(data.data);                        
                    },
                    error: function (message) {
                        console.log(message)
                    }
                }
            );
        }

        function clear_modal() {
            $("#add-to-modal").html("")
        }
    </script>

<?php include('./include/footer.php') ?>