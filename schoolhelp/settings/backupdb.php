
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpothers.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Department";
confirmcheckin();
$xdate=date("Y-m-d");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

//calling Database Class
 $Databasebackup=new Databasebackup;
 $schoolhelpsetting=new Allsettings;
$previlleges=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['backup_s']);
  $settingedit_s=trim($actualrecord['settingedit_s']);
  $settingdelete_s=trim($actualrecord['settingdelete_s']);
  $settingadd_s=trim($actualrecord['settingadd_s']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

$file=trim(isset($_GET['file'])?$_GET['file']:false);
if ($file!="") {
   
    // Download the SQL backup file to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exec('rm ' . $file); 
   $sql="Download of database completed successfully";
}

if ($page==1) {
     $mysqli= new Dbh;
                $conn=$mysqli->connect();
                $database_name="SH".date("Y-m-d_H_i_s");

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
                    $backup_file_name ='backup/'.$database_name . '_backup_' . time() . '.sql';
                    $fileHandler = fopen($backup_file_name, 'w+');
                    $number_of_lines = fwrite($fileHandler, $sqlScript);
                    fclose($fileHandler); 
                   
                }

                
    $sql="Database is backed up";
    $page="";
}


include("includes/header.php");
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>
   <!-- page content -->
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-bottom: 20px;">
                <div class="x_panel">
                  <div class="x_title" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h2 id="caption">Database Backup</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a></li>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a></li>
                      <li ><a class="btn btn-danger" href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1"><i class="fa fa-download"> Backup Database</a></i>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063">Database Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Download</th>
                          <th>Database Name</th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                           $ffs = scandir('backup/');

                            unset($ffs[array_search('.', $ffs, true)]);
                            unset($ffs[array_search('..', $ffs, true)]);

                            // prevent empty ordered elements
                            if (count($ffs) < 1)
                                return;
                                $i=0;

                            foreach($ffs as $ff){  $i+=1; ?>
                               <tr><td><?php echo $i ?></td><td><a type="button" class="btn btn-success" href="?file=<?php echo '/backup/'.$ff; ?>"><i class="fa fa-download"></i>Download Now</a></td><td><?php echo $ff; ?></td>
                                <!--if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);-->
                                </tr>
                         <?php   }
                                                     
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>           
              </div>
            </div>
       <?php include("includes/footer.php"); ?>