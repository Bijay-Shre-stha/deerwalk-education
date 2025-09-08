<?php
$pgName = 'News';
include('./include/header.php'); ?>

<?php
$id = (int) $_GET['art-id'];
$data = $obj->selectDataByField('article_post', array('date', 'title', 'content', 'image_name'), array('id' => $id));

if ($data == null)
    die($obj->redirect("./404.php"));
?>

<div class="container-fluid campus-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">NEWS DETAIL</h4>
    </div>
</div>

<!--content-->

<div class="container padding-top">
    <h4 class="text-center page-desc" style="color: #0f5288"><?php echo $data['title']; ?></h4>
    <img src="./admin/uploads/articles/<?php echo $data['image_name']; ?>" class="img-fluid img-all fellowship-img w-50"
        align="left">
    <div class="container">
        <!--         <h6></h6> -->
        <p class="lead font-all"><b> Posted on:</b> <?php echo $data['date']; ?></p>
        <div class="article-content">
            <?php echo html_entity_decode($data['content']); ?>
        </div>
    </div>
</div>


<?php include('./include/footer.php'); ?>