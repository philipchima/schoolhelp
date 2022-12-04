<?php

class Others{

    public static function ordinalize($num) {
        $suff = 'th';
        if ( ! in_array(($num % 100), array(11,12,13))){
            switch ($num % 10) {
                case 1:  $suff = 'st'; break;
                case 2:  $suff = 'nd'; break;
                case 3:  $suff = 'rd'; break;
            }
            return "{$num}{$suff}";
        }
        return "{$num}{$suff}";
    }


    public static function studenttypename($typeid){
    if ($typeid==1) {
        return "Daytime|Partime";
    }
     if ($typeid==2) {
        return "Boarder|Full Time";
    }else{
         return "";
    }

    }

 public static function stafftypename($staffid){
    if ($staffid==1) {
        return "Academic";
    }
     if ($staffid==2) {
        return "Non Academic";
    }else{
         return "";
    }

    }

public static function sexname($sexid){
    if ($sexid==1) {
        return "Male";
    }
     if ($sexid==2) {
        return "Female";
    }else{
         return "";
    }

    }


public static function passwordconvert($password){
$password1=md5($password);
$password2=sha1($password1);
$password3=md5($password2);
return $password3;
}

}

class Databasebackup extends Dbh{

   

    public function saveDBS($pathandfile){
                $mysqli= new Dbh;
                $conn=$mysqli->connect();
                $database_name="SH".date("Y-m-d H:i:s");

                // Get All Table Names From the Database
                $tables = array();
                $sql = "SHOW TABLES";
                $result =$conn->prepare($sql);
                $result->execute();
                while ($row = $result->fetch()) {
                    $tables[] = $row[0];
                }

                $sqlScript = "";
                foreach ($tables as $table) {
                    
                    // Prepare SQLscript for creating table structure
                    $query = "SHOW CREATE TABLE $table";
                    $result = $conn->prepare($query);
                    $result->execute();
                    $row =$result-> fetch();
                    
                    $sqlScript .= "\n\n" . $row[1] . ";\n\n";
                    
                    
                    $query = "SELECT * FROM $table";
                    $result = $conn->prepare($query);
                    $result->execute();
                    
                    $columnCount = $result->columnCount();
                    
                    // Prepare SQLscript for dumping data for each table
                    for ($i = 0; $i < $columnCount; $i ++) {
                        while ($row = $result->fetch()) {
                            $sqlScript .= "INSERT INTO $table VALUES(";
                            for ($j = 0; $j < $columnCount; $j ++) {
                                $row[$j] = $row[$j];
                                
                                if (isset($row[$j])) {
                                    $sqlScript .= '"' . $row[$j] . '"';
                                } else {
                                    $sqlScript .= '""';
                                }
                                if ($j < ($columnCount - 1)) {
                                    $sqlScript .= ',';
                                }
                            }
                            $sqlScript .= ");\n";
                        }
                    }
                    
                    $sqlScript .= "\n"; 
                }

                if(!empty($sqlScript))
                {
                    // Save the SQL script to a backup file
                    $backup_file_name =$pathandfile.$database_name . '_backup_' . time() . '.sql';
                    $fileHandler = fopen($backup_file_name, 'w+');
                    $number_of_lines = fwrite($fileHandler, $sqlScript);
                    fclose($fileHandler); 
                   
                }

                }

public function downloadDBS($pathandfile){

    }

public function exporttable ($tablename, $tablehead, $tabledata){
    $mysqli = $this->connect();
    $setCounter = 0;
 $setMainHeader="";
$setExcelName = $tablename;

$setSql = "SELECT * FROM {$tablename} LIMIT 0";

$setRec = $mysqli->prepare($setSql);
$setRec->execute();

$setCounter = $setRec->columnCount();

if ($tablehead==1) {
   

    for ($i = 0; $i < $setCounter; $i++) {
        $col = $setRec->getColumnMeta($i);
        if ($i != 0) {
        $setMainHeader .=$col['name']; //mysql_field_name($setRec, $i)."\t";
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
 }   

 // 

 

}// End of class
?>