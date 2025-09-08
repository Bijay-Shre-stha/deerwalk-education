<?php
$pgName = 'Calendar';
include('./include/header.php');
include 'calendar.php';


$request_month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('m');
$request_year = isset($_REQUEST['year']) ? (int)$_REQUEST['year'] : date('Y');
$request_date = date('Y-m', strtotime($request_year . '-' . $request_month));

$is_month_valid = in_array($request_month,['0','1','2','3','4','5','6','7','8','9','10','11','12']);
$is_year_valid = (strtotime($request_year) == true);

if($is_month_valid == 1 && $is_year_valid == 1 && $request_year>1995){
	$calendar_events = $obj->getAllDataByField('events',array('name','start_date'),"month(start_date)=$request_month AND year(start_date)=$request_year",array('start_date'=>'ASC'));

	$date_associated_events = array();

	foreach($calendar_events as $event){	
		$date_associated_events[$event['start_date']][] = $event["name"];
	}

	$calendar = new Calendar($request_date);
	$calendar->add_event($date_associated_events);

}else{
	header('Location: https://localhost/Deerwalk-Education-Group/error-page.php',TRUE);
	// die("sdfsd");
	// exit();
	// die("dfd");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="./assets/css/calendarDisplay.css?version=3" rel="stylesheet" type="text/css">
		<link href="./assets/css/calendar.css?version=3" rel="stylesheet" type="text/css">
		<title>Event Calendar</title>

	</head>
	<body>
		<div class="content row">
			<?=$calendar?>
		</div>

		<div id="eventModal">
			<div class="modal" tabindex="-1" role="dialog" id="eventDetailModal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title modal-date-title" id="event-modal-title"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						
						<div class="modal-body">
							<p id="event-modal-content" class="modal-event-body">...</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	function showEvent(e)
	{
		let msg = "No Event Found";
		if(e.title != "")
			msg = e.title;

		$("#event-modal-title").text(e.dataset.eventdate);
		$("#event-modal-content").text(msg);
		$('#eventDetailModal').modal('show');
	}
</script>

<?php include('./include/footer.php') ?>
