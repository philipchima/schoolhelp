 <!-- footer content -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="?page=1&schoolhelp=<?php echo $schoolhelp; ?>" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Enter Number of <?php echo $pagename ?> you want to add</h4>
      </div>

      <div class="modal-body">
        <div class="row">
           <div classs="col-lg-12">
            <div id="msgnum"></div>
            <div class="input-group">
            <input type="number" class="form-control" name="numberoffields" required="required" onblur="checkisnumeric(this.value);" placeholder="Please enter number of <?php echo $pagename; ?> you want to add" id="numberoffields">
             <span class="input-group-btn">
             <button type="submit" class="btn btn-primary" >Add <? echo $pagename; ?></button>
             </span>
            </div>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
           <div classs="col-lg-12" style="color:red">
            <b>Please select the actual number of <?php echo $pagename ?> you have in your school</b>
           </div>
        </div>
      </div>
     
    </div>

  </div>
</div>

<img id="waitprocessing" src="images/load-indicator.gif" class="img img-responsive">
        <footer id="footer" > 
            <div class="">
                <p class="pull-right">Designed by <a href="http://swiftotech.com.ng" target="_blank" style="color:#003366; font-weight:bold">Swiftotech Microsystems. | 
                     <img src="images/swifto_logo.png" width="60" height="40" /> </a> 
                </p>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  

     <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
      <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="js/jQuery.print.js"></script>

    <!--Web Camera script-->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>-->
    <script src="assets/fancybox/jquery.easing-1.3.pack.js"></script>
    <script src="assets/fancybox/jquery.fancybox.pack.js"></script>
    <!--<script src="assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>-->
    <script src="assets/webcam/webcam.js"></script>
    <script src="assets/js/script.js"></script>
  

    <!--SchoolHelp Script-->
    <script src="js/SHdashscript.js"></script>
    <script type="text/javascript" src="js/jquery.gdocsviewer.min.js"></script> 

    
  </body>
</html>