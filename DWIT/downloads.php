<?php include('./include/header.php'); ?>

<?php 
    $categoryList = $obj->getAllDataByField('pdfdocument', array('distinct(category) as category'), null, array('category' => 'ASC')); 
    #print_r($categoryList);

    // foreach ($categoryList as $key) {
    //     echo $key['category']."<br>";
    // }


?>

<div class="container-fluid campus-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">DOWNLOADS</h4>
    </div>
</div>

<!-- CONTENT -->
<div class="container-fluid">
    <div class="row">

        <?php 
            foreach ($categoryList as $key): if($key['category'] != 'APPLICATION FORMS'):
        ?>
            <div class="col-md-6">
                <h4 class="page-desc" style="color: #0f5288"><?php echo $key['category']; ?></h4>
                <?php
                    $docList = $obj->getAllDataByField('pdfdocument', array('pdfurl', 'title'), array('category' => $key['category']), array('id' => 'DESC'));
                    #print_r($docList);
                ?>            
                <ul class="download-list">
                    <?php foreach ($docList as $value): ?>
                        <li class="lead font-all download-link"><a href="<?php echo('./admin/uploads/pdf/'.$value['pdfurl']); ?>"><?php echo $value['title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php 
            endif;
            endforeach;
        ?>

        <?php 
            foreach ($categoryList as $key): if($key['category'] == 'APPLICATION FORMS'):
        ?>
            <div class="col-md-6">
                <h4 class="page-desc" style="color: #0f5288"><?php echo $key['category']; ?></h4>
                <?php
                    $docList = $obj->getAllDataByField('pdfdocument', array('pdfurl', 'title'), array('category' => $key['category']), array('id' => 'DESC'));
                    #print_r($docList);
                ?>            
                <ul class="download-list">
                    <?php foreach ($docList as $value): ?>
                        <li class="lead font-all download-link"><a href="<?php echo('./admin/uploads/pdf/'.$value['pdfurl']); ?>"><?php echo $value['title']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php 
            endif;
            endforeach;
        ?>

    </div>
</div>

<?php include('./include/footer.php'); ?>
