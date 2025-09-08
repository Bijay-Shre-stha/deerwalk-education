<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$totalCount = $obj->getCount("preregister");

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
    $query = "
        SELECT 
            preregister.id, 
            preregister.full_name, 
            preregister.phone_no, 
            preregister.stream,
            preregister.created_at,
            GROUP_CONCAT(preregistersource.source) as sources 
        FROM 
            preregister 
        LEFT JOIN 
            preregistersource 
        ON 
            preregister.id = preregistersource.register_id 
        GROUP BY 
            preregistersource.register_id 
        ORDER BY 
            preregister.id DESC
    ";

    $getData = $obj->db->query($query);
} else {
    $query = "
        SELECT 
            preregister.id, 
            preregister.full_name, 
            preregister.phone_no, 
            preregister.stream, 
            preregister.created_at,
            GROUP_CONCAT(preregistersource.source) as sources 
        FROM 
            preregister 
        LEFT JOIN 
            preregistersource 
        ON 
            preregister.id = preregistersource.register_id 
        GROUP BY 
            preregistersource.register_id 
        ORDER BY 
            preregister.id DESC
    ";

    $getData = $obj->db->query($query);
}

?>
<h2 class="text-center">Pre Registers</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th>SN</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Stream</th>
            <th>Date and Time</th>
            <th>Sources</th>
            <th style="text-align:center;width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($pageno) && !empty($perPage)) {
            $sn = $perPage * ($pageno - 1);
        } else {
            $sn = 0;
        }
        $intProgram = ['-', 'CSIT', 'BCA', 'Both'];
        while ($row = $getData->fetch()) {
            $sn++;
        ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['phone_no']; ?></td>
                <td><?php echo (intval($row['stream']) <= 3 && intval($row['stream']) >= 0) ? $intProgram[intval($row['stream'])] : 'Invalid Choice'; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td><?php echo $row['sources']; ?></td>
                <td style="text-align: center;"><a
                        href="?fold=actpages&page=act_register&action=delete&delete=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are You Sure?')"><i class="fas fa-trash-alt fa-2x"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php if ($sn == 0) echo "<center><b>No Data Found!</b></center>" ?>