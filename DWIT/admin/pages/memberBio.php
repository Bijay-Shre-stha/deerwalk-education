<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

    $totalCount = $obj->getCount("memberBio");

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

    $getData = $obj->select("memberBio", array("id", "name", "bio"), NULL, array("id" => "DESC"), array($offset, $perPage));
} else {
    $getData = $obj->select("memberBio", array("id", "name", "bio"), NULL, array("id" => "DESC"));
}

?>
    <div>
        <a href="?page=add-bio&fold=form">
            <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Bio</button>
        </a>
    </div>
    <h2 class="text-center">Member Bio</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Bio</th>
            <th style="text-align:center;width: 15%;">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($pageno) && !empty($perPage)) {
            $sn = $perPage * ($pageno - 1) + 1;
        } else {
            $sn = 0;
        }
        while ($row = $getData->fetch()) { $sn++;
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['bio']; ?></td>
                <td style="text-align: center;"><a href="?fold=form&page=add-bio&aid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_bio&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>
