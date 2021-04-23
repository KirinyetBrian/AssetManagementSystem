<?php
namespace Phppot;

use \Phppot\DataSource;

class Product
{
    private $ds;
    
    function __construct()
    {
        require_once __DIR__ . './DataSource.php';
        $this->ds = new DataSource();
    }
    
    public function getAllProduct() 
    {
       
    $query  =" SELECT A.id,A.Assetname,A.description,A.purpose,A.owner,A.financial_value,A.location,A.date,A.returns,A.dateOfReturn,A.status,A.comments,p.Type,";
  $query .= "COUNT(A.id) AS total_records,";
  $query.= "SUM(A.financial_value) AS total_value ";
  $query .= "FROM Assets A ";
  $query .= "LEFT JOIN assettype p ON A.assettype_id = p.id";
  $query .= " GROUP BY DATE(A.date),p.Type";
  $query .= " ORDER BY DATE(A.date) DESC";
        $result = $this->ds->select($query);
        return $result;
    }
    
    public function exportProductDatabase($productResult) {
        $timestamp = time();
        $filename = 'Export_excel_' . $timestamp . '.xls';
        
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $isPrintHeader = false;
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
        exit();
    }
}
