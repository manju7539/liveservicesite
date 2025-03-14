		<div class="page-footer">
			<div class="page-footer-inner"> 2022 &copy; Hotel Management By
				<a href="mailto:metizsofte@gmail.com" target="_top" class="makerCss">Metizsoft</a>
			</div>
			<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
		<!-- end footer -->
	</div>
	<!-- start js include path -->
	<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/popper/popper.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/jquery-blockui/jquery.blockui.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
	<!-- bootstrap -->
	
	<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/sparkline/jquery.sparkline.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/sparkline/sparkline-data.js')?>"></script>
	<!-- Common js-->

	<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>

	<script src="<?php echo base_url('assets/js/app.js')?>"></script>
	<script src="<?php echo base_url('assets/js/layout.js')?>"></script>
	<script src="<?php echo base_url('assets/js/theme-color.js')?>"></script>
	<!-- material -->
	<script src="<?php echo base_url('assets/plugins/material/material.min.js')?>"></script>
	<!-- animation -->
	<script src="<?php echo base_url('assets/js/pages/ui/animations.js')?>"></script>
	<!-- morris chart -->
	<script src="<?php echo base_url('assets/plugins/morris/morris.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/morris/raphael-min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/chart/morris/morris_chart_data.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/chart/morris/morris_home_data.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/chart/morris/morris_home_data1.js')?>"></script>
	<!-- calender -->
	<script src="<?php echo base_url('assets/js/calendar.js')?>"></script> 
	<script src="<?php echo base_url('assets/plugins/fullcalendar/packages/core/main.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/fullcalendar/packages/interaction/main.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/fullcalendar/packages/daygrid/main.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/fullcalendar/packages/timegrid/main.min.js')?>"></script>
	<!-- carousel -->
<script src="<?php echo base_url('assets/js/owl.carousel.js')?>"></script>
	<script src="<?php echo base_url('assets/js/owl_data.js')?>"></script> 

	<!-- steps wizard -->
	<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/steps/steps-data.js')?>"></script>

	<!-- end js include path -->

		<!-- summernote -->
	<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>

	<script src="<?php echo base_url('assets/plugins/jquery-toast/dist/jquery.toast.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/jquery-toast/dist/toast.js')?>"></script>

	<!-- datepicker start-->
	<script src="<?php echo base_url('assets/plugins/moment/moment.min.js')?>"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<!-- datepicker end -->
	<script>
        $(document).ready(function(){
            $('.alert').delay(4000).fadeOut();
        });
    </script>
	<script>
		// datepicker script start
		$(function() {

var start = moment();
var end = moment();

function cb(start, end) {
	$('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
	
	$('#date_picker').val((start.format('YYYY/MM/DD')));
	$('#start_date').val(start.format('YYYY-MM-DD'));
    $('#end_date').val(end.format('YYYY-MM-DD'));
	
}

$('#reportrange').daterangepicker({
	startDate: start,
	endDate: end,
	ranges: {
	'Today': [moment(), moment()],
	'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	//    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	//    'This Month': [moment().startOf('month'), moment().endOf('month')],
	//    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	}
}, cb);

cb(start, end);

});

// datepicker script end
		</script>
</body>

</html>