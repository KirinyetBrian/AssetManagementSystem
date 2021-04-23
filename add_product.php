<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('AssetType');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('name','description','purpose','owner', 'financial_value','location','date','returns',
    'status','comments');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['name']));
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
     
     $query  = "INSERT INTO assets (";
$query .=" assetname,description,purpose,owner,financial_value,location,date,returns,dateOfReturn,status,comments,assettype_id,media_id";
$query .=") VALUES (";
$query .=
"'{$p_name}','{$p_desc}','{$p_purpose}','{$p_owner}','{$p_financial}','{$p_location}','{$p_date}','{$p_return}',
'{$p_returnDate}','{$p_status}','{$p_comments}','{$p_cat}','{$media_id}'";
     $query .=")";
     
     if($db->query($query)){
       $session->msg('s',"Asset added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to add Asset!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Asset</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="name" placeholder="Asset Name">
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
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value="">Select Asset Photo</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
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
              <button type="submit" name="add_product" class="btn btn-danger">Add Asset</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
