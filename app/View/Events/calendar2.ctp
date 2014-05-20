<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel='stylesheet' href='../lib/cupertino/jquery-ui.min.css' />
<link href='../css/fullcalendar.css' rel='stylesheet' />
<link href='../css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='../lib/moment.min.js'></script>
<script src='../lib/jquery.min.js'></script>
<script src='../lib/jquery-ui.custom.min.js'></script>
<script src='../js/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2014-01-12',
			editable: false,
			events: [
				{
					title: 'All Day Event',
					start: '2014-01-01'
				},
				{
					title: 'Long Event',
					start: '2014-01-07',
					end: '2014-01-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-01-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-01-16T16:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-01-12T10:30:00',
					end: '2014-01-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-01-12T12:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-01-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-01-28'
				}
			]
		});
		
	});

</script>
<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		width: 900px;
		margin: 40px auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

</body>
</html>
