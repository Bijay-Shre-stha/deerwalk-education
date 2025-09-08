<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$totalCount = $obj->getCount("workshop_student");

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

    $getData = $obj->select("workshop_student", array("workshop_student.id", "workshop_student.name AS studentName", "workshop_student.email", "workshop_student.image_name", "workshop.name AS workshopName", "workshop_student.validation_id", "workshop_student.grade","version"), NULL, array("workshop_student.id" => "DESC"), array($offset, $perPage), "LEFT", "workshop", "workshop_id", "id");
} else {
    $getData = $obj->select("workshop_student", array("workshop_student.id", "workshop_student.name AS studentName",  "workshop_student.image_name", "workshop_student.email", "workshop.name AS workshopName", "workshop_student.validation_id", "workshop_student.grade", "version"), NULL, array("workshop_student.id" => "DESC"), NULL, "LEFT", "workshop", "workshop_id", "id");
}

?>


<div><a href='?page=add-workshopStudent&fold=form'>
        <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Students</button>
    </a></div>
<h2 class="text-center">Workshop Students</h2>

<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Student's Name</th>
        <th>Email Address</th>
        <th>Workshop</th>
        <th>Grade</th>
        <th>Validation ID</th>
        <th>Student's Photo</th>
        <th style="text-align: center; width: 15%;">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sn = 0;
    while ($row = $getData->fetch()) {
        $sn++;
        $id = $row['id'];
        ?>

        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $row['studentName']; ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['workshopName']; ?></td>
            <td><?php echo $row['grade']; ?></td>
            <td><?php echo $row['validation_id']; ?></td>
            <td><img src="uploads/workshopStudent/<?php echo $row['image_name']; ?>" width=200></td>
            <td style="text-align: center;"><a href="?fold=form&page=add-workshopStudent&wid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_workshopStudent&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
           
        </tr>

        <?php } ?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>

<script>
   
</script>