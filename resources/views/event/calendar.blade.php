@extends('_layouts/main')

@section('content')

<link href='/vendors/fullcalendar/dist/fullcalendar.min.css' rel='stylesheet' />
<link href='/vendors/fullcalendar/diss/fullcalendar.print.min.css' media='print' />

<div class="container" >
	<div id="calendar" >

	</div>
</div>

@stop

@section('js')
<script src="/vendors/moment/moment.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.1/fullcalendar.min.js"></script>

{{ printJson('items', $items) }}
{{ printJson('events', $events) }}

<script>
	$(document).ready(function() {

		$('#calendar').fullCalendar({
			// defaultDate : '2017-10-12',
			editable : true,
			eventLimit : true, // allow "more" link when too many events
			events : events,
			eventClick : function(event) {
				if (event.id) {
					document.location = '/event/item/' + event.id;
				}
			}
			/*
			 events : [{
			 title : 'All Day Event',
			 start : '2017-10-10'
			 }, {
			 title : 'Long Event',
			 start : '2017-10-07',
			 end : '2017-10-10'
			 }, {
			 id : 999,
			 title : 'Repeating Event',
			 start : '2017-10-09T16:00:00'
			 }, {
			 id : 999,
			 title : 'Repeating Event',
			 start : '2017-10-16T16:00:00'
			 }, {
			 title : 'Conference',
			 start : '2017-10-11',
			 end : '2017-10-13'
			 }, {
			 title : 'Meeting',
			 start : '2017-10-12T10:30:00',
			 end : '2017-10-12T12:30:00'
			 }, {
			 title : 'Lunch',
			 start : '2017-10-12T12:00:00'
			 }, {
			 title : 'Meeting',
			 start : '2017-10-12T14:30:00'
			 }, {
			 title : 'Happy Hour',
			 start : '2017-10-12T17:30:00'
			 }, {
			 title : 'Dinner',
			 start : '2017-10-12T20:00:00'
			 }, {
			 title : 'Birthday Party',
			 start : '2017-10-13T07:00:00'
			 }, {
			 title : 'Click for Google',
			 url : 'http://google.com/',
			 start : '2017-10-28'
			 }]
			 */
		});

	});

</script>

@stop