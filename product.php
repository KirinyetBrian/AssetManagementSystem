<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Asset Type </th>
                <th class="text-center" style="width: 10%;">Asset name </th>
                <th class="text-center" style="width: 10%;"> Description </th>
                <th class="text-center" style="width: 10%;"> Purpose </th>
                <th class="text-center" style="width: 10%;"> owner </th>
                <th class="text-center" style="width: 10%;"> financial_value </th>
                <th class="text-center" style="width: 10px;"> location </th>
                <th class="text-center" style="width: 10px;"> date </th>
                <th class="text-center" style="width: 10px;"> returns </th>
                <th class="text-center" style="width: 10px;">Date of Return </th>
                <th class="text-center" style="width: 10px;"> status </th>
                <th class="text-center" style="width: 10px;"> comments </th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['assettype'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td class="text-center"> <?php echo remove_junk($product['Type']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['assetname']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['description']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['purpose']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['owner']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['financial_value']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['location']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['date']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['returns']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['dateOfReturn']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['status']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['comments']); ?></td>
                

                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
