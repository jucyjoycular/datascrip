<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Datascript</span></strong>.2023 All Rights Reserved
    </div>
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url()?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/quill/quill.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url()?>assets/js/main.js"></script>
  <script src="<?php echo base_url()?>assets/js/jquery.3.3.1.js"></script>


  <script type="text/javascript">
    $(document).ready(function() {

        //checkRoomFullMember();


        $("#category_id").change(function(){

            var Selectedcategory = $(".category option:selected").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url()?>proses-request.php",
                data: { category : Selectedcategory } 
            }).done(function(data){
               
                $("#response").html(data);
            });
        });
  
      });

       const checkRoomFullMember = () => {
            setInterval(() => {
                $.ajax({
                    type: "GET",
                    url: "https://esportsfightarena.com/User/Home/checkRoomFullMemberAdmin",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                    },
                });
            }, 5000)
        }


  </script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {


        var table = $('#example').DataTable( {
            responsive: true
        } );

        var table2 = $('#example2').DataTable( {
            responsive: true
        } );
     
        new $.fn.dataTable.FixedHeader( table );
        new $.fn.dataTable.FixedHeader( table2 );




    });
</script>

</body>

</html>