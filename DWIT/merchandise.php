<?php
$pgName = 'Deerwalk Merchandise';
include('./include/header.php'); ?>

<?php 
    $data = $obj->selectAllDataByField("merchandise", array('name', 'image', 'price'), NULL);
 ?>

<div class="container-fluid merchandise-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">DEERWALK MERCHANDISE</h4>
    </div>
</div>
<br>
<!-- CONTENT -->

<h4 class="text-center" style="color:#0f5288">FEATURED PRODUCTS</h4>
<br>
<br>
<div class="container">
  <?php for($i = 0; $i < count($data); $i+=3): ?>
    <div class="card-deck">
      <?php for ($j=$i; ($j < count($data)) && ($j < $i+3); $j++):?>
        <div class="card">
          <img src="./admin/uploads/merchandise/<?php echo($data[$j]['image']); ?>" class="card-img-top">
          <div class="card-body">
            <br>
            <h5 class="card-title text-center"><?php echo $data[$j]['name']; ?></h5>
            <p class="card-text text-center" style="color: #0f5288"><b>RS. <?php echo $data[$j]['price']; ?></b></p>
          </div>
        </div>
      <?php endfor; ?>
    </div>
    <br><br>
  <?php endfor; ?>
</div>
<br>

<!-- contact -->
<div class="container-fluid" style="border: 1px solid #0f5288; width: 70%">
    <h4 class="r-sub-title text-center" style="padding-top: 20px">If you want to buy any of the above products, please contact:</h4>
    <h5 class="r-sub-title text-center">Upama Pandey, DWIT Accounts Officer<br>Contact: 9823488249</h5>
</div>


<?php include('./include/footer.php'); ?>