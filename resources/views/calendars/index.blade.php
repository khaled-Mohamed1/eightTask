@extends('layouts.layout')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendars</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

</head>

<style>
    .required:after {
        content: " *";
        color: red;
    }
</style>

<body style="font-family: Cairo; direction: rtl;">
    <br>
    <div class="container">
        <div class="row">
            <h3>صفحة الرئيسية للحجوزات</h3>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addWeekly">حجز اسبوعي
                </button>
            </div>
        </nav>


        <div class="row">
            <div id="response"></div>
            <div id='calendar'></div>
        </div>

    </div>

    {{-- model --}}

    @extends('modals.addcalendar')
    @extends('modals.editcalendar')


    {{-- week --}}
    @extends('modals.weekly.addweekly')

    {{-- endmodel --}}

    @extends('ajax.calendar_js')

</body>

</html>
