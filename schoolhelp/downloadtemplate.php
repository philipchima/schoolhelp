<?php
include_once("includes/connection.php");
$schoolhelp=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$tablename=trim(isset($_GET['tablename'])?$_GET['tablename']:false);
  $tablefield=trim(isset($_GET['tablefield'])?$_GET['tablefield']:false);
  $tabledata=trim(isset($_GET['tabledata'])?$_GET['tabledata']:false);

      //Excel Template class
$database=new Dbh;
     $mysqli = $database->connect();
    $setCounter = 0;
 $setMainHeader="";
 $setData="";
$setExcelName = $tablename;

$setSql = "SELECT * FROM {$tablename} LIMIT 0";

$setRec = $mysqli->prepare($setSql);
$setRec->execute();

$setCounter = $setRec->columnCount();

if ($tablefield==1) {
   

    for ($i = 0; $i < $setCounter; $i++) {
        $col = $setRec->getColumnMeta($i);
        if ($i != 0) {
        $setMainHeader .=$col['name']."\t"; //mysql_field_name($setRec, $i)."\t";
        $columns[] = $col['name'];
        }
        
    }

}
/*for ($i = 0; $i < $setCounter; $i++) {
    $setMainHeader .= mysql_field_name($setRec, $i)."\t";
}*/

if ($tabledata==1) {
        while($rec = $setRec->fetch())  {
          $rowLine = '';
          foreach($rec as $value)       {
            if(!isset($value) || $value == "")  {
              $value = "\t";
            }   else  {
        //It escape all the special charactor, quotes from the data.
              $value = strip_tags(str_replace('"', '""', $value));
              $value = '"' . $value . '"' . "\t";
            }
            $rowLine .= $value;
          }
          $setData .= trim($rowLine)."\n";
        }
          $setData = str_replace("\r", "", $setData);

        if ($setData == "") {
          $setData = "no matching records found";
        }
}else{$setData="";}

$setCounter =  $setRec->columnCount();


if ($setMainHeader!="") {
  
//This Header is used to make data download instead of display the data
 header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=".$setExcelName."_template.xls");
header("Pragma: no-cache");
header("Expires: 0");

//It will print all the Table row as Excel file row with selected column name as header.
echo ucwords($setMainHeader)."\n".$setData."\n";
    }

    
?>
