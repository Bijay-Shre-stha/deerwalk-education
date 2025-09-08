<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


#$getData=$obj->select("merchandise",array("id","name","image","price"));

#$getCount=$obj->select("merchandise",array(count(1)));
$totalCount = $obj->getCount("merchandise");

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

    $getData = $obj->select("merchandise", array("id", "name", "image", "price"), NULL, array("id" => "DESC"), array($offset, $perPage));
} else {
    $getData = $obj->select("merchandise", array("id", "name", "image", "price"), NULL, array("id" => "DESC"));
}
?>
    <div><a href="?page=add-merchandise&fold=form">
            <button type="button" class="btn btn-primary float-right" style="margin: 3%;">Add Merchandise</button>
        </a></div>
    <h2 class="text-center">Merchandise</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Product</th>
            <th>Image</th>
            <th>Price</th>
            <th style="text-align: center;">Action</th>
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
                <td><img src="uploads/merchandise/<?php echo $row['image']; ?>" width=200></td>
                <td>Rs. <?php echo $row['price']; ?></td>
                <td style="text-align: center;"><a href="?fold=form&page=add-merchandise&mid=<?php echo $row['id']; ?>"><i
                                class="fas fa-edit fa-2x"></i></a> &nbsp; &nbsp; <a
                            href="?fold=actpages&page=act_merchandise&action=delete&delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if($sn==0) echo "<center><b>No Data Found!</b></center>" ?>


<?php if ($totalCount > 12) {
    include("inc/paginate.php");
} ?>