<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: "{{ route('calendars') }}",
            eventColor: '#319DA0',
            displayEventTime: true,
            editable: true,
            eventRender: function(event, element, view, info) {

                element.bind('dblclick', function() {

                    // show data in edit form
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var edit_start_time = $.fullCalendar.formatDate(event.start, "HH:mm");
                    var edit_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    $('#editCalendar').modal('show');

                    let edit_title = event.title;
                    let edit_patient = event.patient;
                    let edit_description = event.description;
                    let edit_end_time = event.end_time;

                    $('#edit_title').val(edit_title);
                    $('#edit_patient').val(edit_patient);
                    $('#edit_description').val(edit_description);
                    $('#edit_start_time').val(edit_start_time);
                    $('#edit_end').val(edit_end);
                    $('#edit_end_time').val(edit_end_time);

                    // edit calendar
                    $(document).on('click', '.edit_Calendar', function(e) {
                        let edit_title = $('#edit_title').val();
                        let edit_patient = $('#edit_patient').val();
                        let edit_description = $('#edit_description').val();
                        let edit_start_time = $('#edit_start_time').val();
                        let edit_end = $('#edit_end').val();
                        let edit_end_time = $('#edit_end_time').val();

                        let new_start = start + ' ' + edit_start_time;
                        let new_end = edit_end + ' ' + edit_end_time;

                        $.ajax({
                            url: "{{ route('calendar.update') }}",
                            data: 'edit_title=' + edit_title +
                                '&edit_patient=' + edit_patient +
                                '&edit_description=' + edit_description +
                                '&new_start=' + new_start +
                                '&edit_start_time=' + edit_start_time +
                                '&new_end=' + new_end +
                                '&edit_end_time=' + edit_end_time +
                                '&id=' + event.id,
                            type: "POST",
                            success: function(response) {
                                $('#editCalendar').modal('hide');
                                $('#editCalendar_form')[0].reset();
                                displayMessage("Updated Successfully");
                            }
                        });
                    });

                    //delete calender
                    $(document).on('click', '.delete_Calendar', function(e) {
                        var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('calendar.delete') }}",
                                data: "&id=" + event.id,
                                success: function(response) {
                                    if (parseInt(response) > 0) {
                                        $('#calendar').fullCalendar(
                                            'removeEvents', event.id
                                        );
                                        displayMessage(
                                            "Deleted Successfully");
                                    }
                                }
                            });
                        }
                    });
                });
                if (event.status == 'انتظار') {
                    element.css({
                        'background-color': '#1CD6CE',
                        'border': '1px solid #1CD6CE    '
                    });
                } else {
                    element.css({
                        'background-color': '#D61C4E',
                        'border': '1px solid #D61C4E'
                    });
                }
                element.find('.fc-title').append("<p>اسم المريض: " + event.patient + "</p>");
                element.find('.fc-title').append("<p>وصف: " + event.description + "</p>");
                element.find('.fc-title').append("<p>ساعة: " + "من " + event.start_time + " إلى " +
                    event.end_time + "</p>");
                element.find('.fc-title').append("<p>حالة: " + event.status + "</p>");

                // if (event.allDay === 'true') {
                //     event.allDay = true;

                // } else {
                //     event.allDay = false;

                // }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, allDay) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");

                $('#addCalendar').modal('show');

                //add calendar
                $(document).on('click', '.add_Calendar', function(e) {
                    let title = $('#title').val();
                    let patient = $('#patient').val();
                    let description = $('#description').val();
                    let start_time = $('#start_time').val();
                    let end = $('#end').val();
                    let end_time = $('#end_time').val();

                    let new_start = start + ' ' + start_time;
                    let new_end = end + ' ' + end_time;

                    if (title) {

                        $.ajax({
                            url: "{{ route('calendar.create') }}",
                            data: 'title=' + title +
                                '&patient=' + patient +
                                '&description=' + description +
                                '&new_start=' + new_start +
                                '&start_time=' + start_time +
                                '&new_end=' + new_end +
                                '&end_time=' + end_time,
                            type: "POST",
                            success: function(data) {
                                $('#addCalendar').modal('hide');
                                $('#addCalendar_form')[0].reset();
                                displayMessage("Added Successfully");
                            }
                        });
                        calendar.fullCalendar('renderEvent', {
                                title: title,
                                patient: patient,
                                description: description,
                                start: start,
                                start_time: start_time,
                                end: end,
                                end_time: end_time,
                                allDay: allDay
                            },
                            true
                        );
                    }

                });
                calendar.fullCalendar('unselect');
            },
            //show data calendar
            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                var edit_start_time = $.fullCalendar.formatDate(event.start, "HH:mm");
                var edit_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                $('#editCalendar').modal('show');

                let edit_title = event.title;
                let edit_patient = event.patient;
                let edit_description = event.description;
                let edit_end_time = event.end_time;

                $('#edit_title').val(edit_title);
                $('#edit_patient').val(edit_patient);
                $('#edit_description').val(edit_description);
                $('#edit_start_time').val(edit_start_time);
                $('#edit_end').val(edit_end);
                $('#edit_end_time').val(edit_end_time);

                //edit data calendar by drop
                $(document).on('click', '.edit_Calendar', function(e) {
                    let edit_title = $('#edit_title').val();
                    let edit_patient = $('#edit_patient').val();
                    let edit_description = $('#edit_description').val();
                    let edit_start_time = $('#edit_start_time').val();
                    let edit_end_time = $('#edit_end_time').val();
                    edit_end = $('#edit_end').val();

                    let new_start = start + ' ' + edit_start_time;
                    let new_end = edit_end + ' ' + edit_end_time;

                    $.ajax({
                        url: "{{ route('calendar.update') }}",
                        data: 'edit_title=' + edit_title +
                            '&edit_patient=' + edit_patient +
                            '&edit_description=' + edit_description +
                            '&new_start=' + new_start +
                            '&edit_start_time=' + edit_start_time +
                            '&new_end=' + new_end +
                            '&edit_end_time=' + edit_end_time +
                            '&id=' + event.id,
                        type: "POST",
                        success: function(response) {
                            $('#editCalendar').modal('hide');
                            $('#editCalendar_form')[0].reset();
                            displayMessage("Updated Successfully");
                        }
                    });
                });
            },
        });



        //weekly
        $('input[type=radio][name=weekly]').change(function() {
            if (this.value == 'week') {
                $('.between_date').hide();
                $('#add_Weekly').show();
                $('#addBetween_Weekly').hide();

                var endDate = moment().endOf('isoweek');
                var days = [];
                let full = {};

                var endTest = moment().endOf('isoweek');

                endDate = endDate.format('Y-MM-DD HH:mm:ss');

                $(document).on('click', '.add_Weekly', function(e) {

                    var CurrentDate = moment().format('Y-MM-DD HH:mm:ss');
                    var CurrentDateTest = moment().format('DD');
                    var rest = (endTest.format('DD') - CurrentDateTest) + 1;

                    for (var i = 0; i <= rest; i++) {
                        days.push(moment(CurrentDate).add(i, 'days').format("dddd"));
                        var start_time = new Array();

                        var j = 0;
                        $("." + days[i]).each(function() {
                            start_time[j] = $(this).val();
                            j++;
                        });
                        if (start_time[0] != '') {
                            full[days[i]] = start_time;
                            full[days[i]].push(moment(CurrentDate).add(i, 'days').format(
                                "Y-MM-DD"));;
                        }

                    }

                    let type = $('.form-check-input').val();
                    let week_title = $('#week_title').val();
                    let week_patient = $('#week_patient').val();
                    let week_description = $('#week_description').val();



                    $.ajax({
                        url: "{{ route('calendar.weeklycreate') }}",
                        data: {
                            type: type,
                            week_title: week_title,
                            week_patient: week_patient,
                            week_description: week_description,
                            full: full
                        },
                        cache: false,

                        // contentType: 'application/json',
                        dataType: 'json',
                        type: "POST",

                        success: function(response) {
                            location.reload();
                            displayMessage("Added Successfully");
                        },
                    });
                });

            } else if (this.value == 'between_date') {
                $('.between_date').show();
                $('#add_Weekly').hide();
                $('#addBetween_Weekly').show();

                $(document).on('click', '.addBetween_Weekly', function(e) {

                    let type = 'between_date';
                    let week_title = $('#week_title').val();
                    let week_patient = $('#week_patient').val();
                    let week_description = $('#week_description').val();

                    var days = [];
                    let full_between = {};

                    let between_start = $('#between_start').val();
                    let between_end = $('#between_end').val();

                    var between_startTest = moment(between_start).format('DD');
                    var between_endTest = moment(between_end).format('DD');
                    var CurrentDate = moment(between_start).format('Y-MM-DD HH:mm:ss');

                    var rest = (between_endTest - between_startTest) + 1;

                    for (var i = 0; i < rest; i++) {
                        days.push(moment(CurrentDate).add(i, 'days').format("dddd"));
                    }


                    var counts = {};
                    jQuery.each(days, function(key, value) {
                        if (!counts.hasOwnProperty(value)) {
                            counts[value] = 1;
                            var start_time = new Array();

                            var j = 0;
                            $("." + days[key]).each(function() {
                                start_time[j] = $(this).val();
                                j++;
                            });
                            if (start_time[0] != '') {
                                full_between[moment(CurrentDate).add(key,
                                        'days')
                                    .format("Y-MM-DD")] = start_time;
                            }

                        } else {
                            counts[value]++;

                            var start_time = new Array();

                            var j = 0;
                            $("." + days[key]).each(function() {
                                start_time[j] = $(this).val();
                                j++;
                            });
                            if (start_time[0] != '') {
                                full_between[moment(CurrentDate).add(key,
                                        'days')
                                    .format("Y-MM-DD")] = start_time;
                            }
                        }
                    });


                    $.ajax({
                        url: "{{ route('calendar.weeklycreate') }}",
                        data: {
                            type: type,
                            week_title: week_title,
                            week_patient: week_patient,
                            week_description: week_description,
                            full_between: full_between
                        },
                        cache: false,

                        dataType: 'json',
                        type: "POST",

                        success: function(response) {
                            location.reload();
                            displayMessage("Added Successfully");
                        },
                    });

                });
            }
        });





    });

    function displayMessage(message) {
        $("#response").html("<div class='success'>" + message + "</div>");
        setInterval(function() {
            $(".success").fadeOut();
        }, 1000);
    }
</script>
