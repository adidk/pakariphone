</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center text-muted">
   Design By <a href="https://wrappixel.com">WrapPixel</a> Develope By <a href="https://slpatmdnt.com">SLPATMDNT</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="<?= base_url() ?>dist/js/app-style-switcher.js"></script>
<script src="<?= base_url() ?>dist/js/feather.min.js"></script>
<script src="<?= base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url() ?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url() ?>dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="<?= base_url() ?>assets/extra-libs/c3/d3.min.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/c3/c3.min.js"></script>
<script src="<?= base_url() ?>assets/libs/chartist/dist/chartist.min.js"></script>
<script src="<?= base_url() ?>assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url() ?>dist/js/pages/dashboards/dashboard1.min.js"></script>
<!--This page plugins -->
<script src="<?= base_url() ?>assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>dist/js/pages/datatable/datatable-basic.init.js"></script>

<script>
   $(document).ready(function() {
      $('#device').DataTable({
         "columns": [{
               "width": "5%"
            },
            {
               "width": "20%"
            },
            {
               "width": "20%"
            },
            {
               "width": "20%"
            },
            {
               "width": "35%"
            }
         ]
      });
   });

   $(document).ready(function() {
      $('#rule').DataTable();
   });
</script>
</body>

</html>