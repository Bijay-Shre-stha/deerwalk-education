<?php require_once("../system/application_top.php"); ?>
<?php require_once("./inc/verifyUser.php"); ?>
<?php require_once("./inc/header.php"); ?>
<?php require_once("./inc/sidebar.php"); ?>


<?php

if($_SESSION['version'] == 0 && (!isset($_GET['fold']) || empty($_GET['fold']) ))
{
	$pagename = Page_finder::findPage("change-password", "form");
} else{
	if (isset($_GET['page']) && isset($_GET['fold']))
	    $pagename = Page_finder::findPage($_GET['page'], $_GET['fold']);
	elseif (isset($_GET['page']))
	    $pagename = Page_finder::findPage($_GET['page']);
	else
	    $pagename = Page_finder::findPage();
}

?>

    <div class="col-md-10 contentBox">
        <?php echo Page_finder::get_message(); ?>
        <?php include($pagename); ?>
    </div>

<?php require_once("./inc/footer.php") ?>