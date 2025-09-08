<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$totalCount = $obj->getCount("students", array('status' => '1'));

if ($totalCount > 12) {
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    if ($totalCount < 16)
        $perPage = 8;
    else
        $perPage = 10;

    $offset = ($pageno - 1) * $perPage;

    $totalPage = ceil($totalCount / $perPage);

    $getData = $obj->select("students", array("id", "name", "email", "batch", "school", "high_school", "district", "image", "marker"), array('status' => '1'), array('name' => 'asc'), array($offset, $perPage));

} else {
    $getData = $obj->select("students", array("id", "name", "email", "batch", "school", "high_school", "district", "image", "marker"), array('status' => '1'), array('name' => 'asc'));
}

?>

<div>
    <a href="?page=add-student&fold=form">
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Student</button>
    </a>
    <a href="#">
        <button type="button" class="btn btn-success float-right" style="margin: 3%;" data-toggle="modal" data-target="#csvModal">Bulk Add</button>
    </a>
    <a href="?page=batch">
        <button type="button" class="btn btn-secondary float-right" style="margin: 3%;">Batch</button>
    </a>
</div>
<h2 class="text-center">Students List</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>School</th>
        <th>High School</th>
        <th>District</th>
        <th>Image</th>
        <th style="text-align: center; width: 20%;">Action</th>
        <th>Marker</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($pageno) && !empty($perPage)) {
        // echo "Here";
        // echo $pageno . " ". $perPage;
        $sn = $perPage * ($pageno - 1);
    } else {
        $sn = 0;
    }

    while ($row = $getData->fetch()) { 
        $sn++;
        $status = $row['marker'];
        $id = $row['id'];
        ?>
        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['school']; ?></td>
            <td><?php echo $row['high_school']; ?></td>
            <td><?php echo $row['district']; ?></td>
            <td><img src="<?php echo $row['image']; ?>" width=50></td>
            <td style="text-align: center;"><a href="?fold=form&page=add-student&sid=<?php echo $row['id']; ?>"><i
                            class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                        href="?fold=actpages&page=act_student&action=delete&delete=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            <td><a href="#"><img src="assets/icons/<?php echo $status . ".png"; ?>"
                                 onclick="changeStatus('students','marker',<?php echo $status . "," . $id; ?>)"></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- model starts -->
<div class="modal" tabindex="-1" role="dialog" id="csvModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Data Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
      
            <form action="?fold=actpages&page=act_student" id="studentListCSV" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="file" name="studentlist">
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="uploadCsv" value="true">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model ends -->

<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>

<?php if ($totalCount > 12) {
    include("inc/paginate.php");
} ?>

<script>
    function changeStatus(table, field, value, uid) {
        if (confirm("Are you sure to perform this action ?")) {
            $.ajax({
                type: "post",
                url: "actpages/change_status.php",
                data: {'table': table, 'field': field, 'value': value, 'id': uid},
                dataType: "json",
                success: function (response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
    }
</script>
