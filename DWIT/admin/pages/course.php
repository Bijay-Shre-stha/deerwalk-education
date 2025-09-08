<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$totalPage = 8;

if (isset($_GET['pageno']) && isset($_GET['stream'])) {
    if ($_GET['pageno'] >= 1 && $_GET['pageno'] <= 8) {
        $pageno = $_GET['pageno'];
    } else {
        $obj->redirect('?page=404');
    }

    if((int)$_GET['stream'] == 1 || (int)$_GET['stream'] == 2)
    {
        $stream = (int)$_GET['stream'];
    }else{
        $stream = 1;
    }
} else {
    $pageno = 1;
    $stream = 1;
}

$getData = $obj->select("courses", array("courses.id", "courses.code", "courses.subject", "staff.full_name"), array("sem" => $pageno, "stream" => $stream), array("courses.code" => "ASC"), NULL, "LEFT", "staff", "teacher", "id");

?>
<div class="dropdown">

    <button class="btn btn-secondary dropdown-toggle float-left" type="button" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 4%">
        Semester
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php for ($i = 1; $i <= 8; $i++) { ?>
            <a class="dropdown-item" href="?page=<?php echo $_GET['page'] . '&pageno=' . $i . '&stream=1'; ?>">
                <?php echo "CSIT: SEM-".$i; ?>
            </a>
            <a class="dropdown-item" href="?page=<?php echo $_GET['page'] . '&pageno=' . $i . '&stream=2'; ?>">
                <?php echo "BCA: SEM-".$i; ?>
            </a>
        <?php } ?>
    </div>
</div><br>

<div><a href='?page=add-course&fold=form'>
        <button type="button" class="btn btn-primary float-right" style="margin: 2%;">Add Course</button>
    </a></div>
<h2 class="text-center" style="margin-top: 0;">Courses</h2>
<h3 class="text-center">Semester - <?php echo $obj->numToRoman($pageno); ?></h3><br>


<table class="table table-hover">
    <thead>
    <tr>
        <th>SN</th>
        <th>Code</th>
        <th>Subject</th>
        <th>Teacher</th>
        <th style="text-align: center;">View</th>
        <th style="text-align: center;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $sn = 0;
    while ($row = $getData->fetch()) { $sn++; ?>
        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $row['code']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php if (!empty($row['full_name'])) echo $row['full_name']; else echo "N/A"; ?></td>
            <td style="text-align: center;"><a href="?page=courseDetail&id=<?php echo $row['id']; ?>" target="_blank"><i
                            class="fas fa-eye fa-2x"></i></a></td>
            <td style="text-align: center;">
                <a href="?fold=form&page=add-course&cid=<?php echo $row['id']; ?>"><i class="fas fa-edit fa-2x"></i></a>
                &nbsp; &nbsp; <a href="?fold=actpages&page=act_course&action=delete&delete=<?php echo $row['id']; ?>"
                                 onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a>
            </td>
        </tr>
        <?php
    }?>
    </tbody>
</table>
<?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>