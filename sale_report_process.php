<?php
$page_title = 'Sales Report';
$results = '';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
  if(isset($_POST['submit'])){
    $req_dates = array('start-date','end-date');
    validate_fields($req_dates);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $results      = find_sale_by_dates($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('sales_report.php', false);
    endif;

  } 
  elseif(isset($_POST['generate'])){
    $req_dates = array('start-date','end-date');
    validate_fields($req_dates);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $results      = find_date_of_return($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('sales_report.php', false);
    endif;
  }

  else {
    $session->msg("d", "Select dates");
    redirect('sales_report.php', false);
  }
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Asset Reports</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="sale-head pull-right">
           <h1>Asset Report</h1>
           <strong><?php if(isset($start_date)){ echo $start_date;}?> To <?php if(isset($end_date)){echo $end_date;}?> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              
              <th>Asset Title</th>
              <th>total records</th>
              <th>total value</th>
              <th>description</th>
              <th>purpose</th>
              <th>owner</th>
              <th>financial_value</th>
              <th>location</th>
              <th>returns</th>
              <th>Date Issued</th>
              <th>Date Returned</th>
              <th>status</th>
              <th>comments</th>
              
            
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              
              <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['Assetname']));?></h6>
              </td>
              <td class="text-right"><?php echo remove_junk($result['total_records']);?></td>
              <td class="text-right"><?php echo remove_junk($result['total_value']);?></td>
              <td class="text-right"><?php echo remove_junk($result['description']);?></td>
              <td class="text-right"><?php echo remove_junk($result['purpose']);?></td>
              <td class="text-right"><?php echo remove_junk($result['owner']);?></td>
              <td class="text-right"><?php echo remove_junk($result['financial_value']);?></td>
              <td class="text-right"><?php echo remove_junk($result['location']);?></td>
              <td class="text-right"><?php echo remove_junk($result['returns']);?></td>
              <td class=""><?php echo remove_junk($result['date']);?></td>
              <td class="text-right"><?php echo remove_junk($result['dateOfReturn']);?></td>
              <td class="text-right"><?php echo remove_junk($result['status']);?></td>
              <td class="text-right"><?php echo remove_junk($result['comments']);?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
       
<!--
        <tfoot>
         <tr class="text-right">
           <td colspan="4"></td>
           <td colspan="1">Grand Total</td>
           <td> $
           // <?php echo number_format(total_price($results)[0], 2);?> 
          </td>
         </tr>
         <tr class="text-right">
           <td colspan="4"></td>
           <td colspan="1">Profit</td>
           <td> $<?php echo number_format(total_price($results)[1], 2);?></td>
         </tr>
        </tfoot>
      -->
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "Sorry no Asset has been found. ");
        redirect('sales_report.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
