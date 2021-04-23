<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('assets',(int)$_GET['id']);
$all_categories = find_all('assettype');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
   $req_fields = array('product-title','description','purpose','owner', 'financial_value','location','date','returns',
    'status','comments');
    validate_fields($req_fields);

   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_desc  = remove_junk($db->escape($_POST['description']));
     $p_purpose   = remove_junk($db->escape($_POST['purpose']));
     $p_owner   = remove_junk($db->escape($_POST['owner']));
     $p_financial  = remove_junk($db->escape($_POST['financial_value']));
     $p_location  = remove_junk($db->escape($_POST['location']));
     $p_return  = remove_junk($db->escape($_POST['returns']));
     $p_returnDate  = remove_junk($db->escape($_POST['dateOfReturn']));
     $p_status  = remove_junk($db->escape($_POST['status']));
     $p_comments = remove_junk($db->escape($_POST['comments']));
     $p_date = remove_junk($db->escape($_POST['date']));
     $p_cat = remove_junk($db->escape($_POST['product-categorie']));

       if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['product-photo']));
       }
       $query   = "UPDATE assets SET";
        $query  .=" Assetname='{$p_name}',description='{$p_desc}',purpose='{$p_purpose}',owner='{$p_owner}',financial_value='{$p_financial}',location='{$p_location}',date='{$p_date}',returns='{$p_return}',dateOfReturn='{$p_returnDate}',status='{$p_status}',comments='{$p_comments}',assettype_id='{$p_cat}',media_id='{$media_id}'";
     
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Asset</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['Assetname']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                  <select class="form-control" name="product-categorie">
            
                      <option value="">Select Asset Type</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['Type'] ?></option>
                    <?php endforeach; ?>
                    </select>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value=""> No image</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-th-large"></i>
                     </span>
                     <input type="text" class="form-control" name="description" placeholder="Description">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-th"></i>
                     </span>
                     <input type="text" class="form-control" name="purpose" placeholder="Purpose">
                 
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th"></i>
                      </span>
                      <input type="text" class="form-control" name="owner" placeholder="Owner">
                      
                   </div>
                  </div>
                     <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                <input type="number" class="form-control" name="financial_value" placeholder="Financial Value">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>

                      <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-map-marker"></i>
                      </span>
                <input type="text" class="form-control" name="location" placeholder="Location">
                     
                   </div>
                  </div>

                     <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                      </span>
                <input type="date" class="form-control" name="date" placeholder="Date">
                    
                   </div>
                  </div>


                     <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th"></i>
                      </span>
                      <select class="form-control" name="returns" placeholder="Return">
                        <option value="">Select...</option>
                        <option>return</option>
                        <option>issue</option>
                      </select>
                                   
                   </div>
                  </div>

                     <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                      </span>
                      <label>Date Returned</label>
                <input type="date" class="form-control" name="dateOfReturn" placeholder="Date">
                    
                   </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th"></i>
                      </span>
                <input type="text" class="form-control" name="status" placeholder="Status">
                   
                   </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th"></i>
                      </span>
                <input type="text" class="form-control" name="comments" placeholder="Comments">
                    
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
