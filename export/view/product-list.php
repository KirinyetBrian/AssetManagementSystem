<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./view/css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="table-container">
    <?php
    if (empty($productResults)) {
        ?>
        <table id="tab">
            <thead>
                <tr>               
                      <th width="35%">Asset Type</th>    
                      <th width="35%">Asset Name</th>                      
                      <th width="35%">description</th>
                      <th width="35%">purpose</th>
                      <th width="35%">owner</th>
                      <th width="35%">financial_value</th>
                      <th width="45%">Date Issued</th>
                      <th width="45%">Date Returned</th>
                      <th width="35%">location</th>
                      <th width="35%">returns</th>
                      <th width="35%">status</th>
                      <th width="35%">comments</th>
                </tr>
            </thead>
            <tbody>
            <?php
        foreach ($productResult as $key => $value) 
        {
            ?>   
                <tr>
                       <td><?php echo $productResult[$key]["Type"]; ?></td>
                      <td><?php echo $productResult[$key]["Assetname"]; ?></td>
                      <td><?php echo $productResult[$key]['description'];?></td>
                      <td><?php echo $productResult[$key]['purpose'];?></td>
                      <td><?php echo $productResult[$key]['owner'];?></td>
                      <td><?php echo $productResult[$key]['financial_value'];?></td>
                      <td><?php echo $productResult[$key]['date'];?></td>
                      <td><?php echo $productResult[$key]['dateOfReturn'];?></td>
                      <td><?php echo $productResult[$key]['location'];?></td>
                      <td><?php echo $productResult[$key]['returns'];?></td>
                      <td><?php echo $productResult[$key]['status'];?></td>
                      <td><?php echo $productResult[$key]['comments'];?></td>
                  </tr>
                </tr>
            <?php
        }
        ?>
            </tbody>
        </table>

        <div class="btn">
            <form action="" method="post">
                <button type="submit" id="btnExport" name='export'
                    value="Export to Excel" class="btn btn-info">Export
                    to Excel</button>
            </form>
        </div>
    <?php
    }
    else
    {
    ?>
    <div class="empty-table">
    <div class="svg-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"><circle cx="12" cy="19" r="2"/><path d="M10 3h4v12h-4z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
    </div>
    No records found</div>
    <?php 
    }
    ?>
    </div>
</body>
</html>