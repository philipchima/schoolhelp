
<?php include_once("../includes/global.php");
include_once("../includes/connection.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$schoolhelp=1;
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
include("includes/header.php"); ?>

    
        <!-- page content -->
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12" style="width: 100%">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Website</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up" style="color:#d2dc2a;"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="systemsettings">Website Content management</a>
                          </li>
                          <li><a href="resultsettings">Result Settings</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="../?schoolhelp=<?php echo $schoolhelp; ?>" class="close-link" style="color:red"><i class="fa fa-close" style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">

                    

                      <div class="col-md-55">
                         <a href="../?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/home.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Access to all modules</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-arrow-left"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060"><b>Dashboard</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       <div class="col-md-55">
                         <a href="slides?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/slide.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Slides</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       <div class="col-md-55">
                         <a href="news?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/news.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>News</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                     
                     
                      
                       <div class="col-md-55">
                         <a href="events?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/events.jpg" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Events</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       <div class="col-md-55">
                         <a href="testimony?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/testimonial.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:12px;" class="fa fa-hand-o-down">Different Level in a department(school)</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Testimony</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                                            
                      <div class="col-md-55">
                         <a href="option?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/album.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:12px;" class="fa fa-hand-o-down">Groups in a class</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Album</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

           

                  </div>
                </div>
              </div>
            </div>





           

             

             
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>