@extends('adminlte::page')

@section('title', 'Calendar')

@section('plugins.Fullcalendar', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Calendar</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Calendar</li>
        </ol>
    </div>
@stop

@section('content')
<div class="row">
    <!-- Panel Draggable Events Kiri -->
     <!-- Panel Draggable Events Kiri -->
      <!-- Panel Draggable Events Kiri -->
    <div class="col-md-3">
        <div class="sticky-top mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold">Draggable Events</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Drag an event to the calendar to schedule it.</p>
                    <div id="external-events">
                        <div class="external-event bg-primary text-white p-2 mb-2 rounded cursor-pointer" style="cursor: move;">
                            <i class="fas fa-bars mr-1"></i> Team standup
                        </div>
                        <div class="external-event bg-success text-white p-2 mb-2 rounded cursor-pointer" style="cursor: move;">
                            <i class="fas fa-bars mr-1"></i> Customer call
                        </div>
                        <div class="external-event bg-warning text-dark p-2 mb-2 rounded cursor-pointer" style="cursor: move;">
                            <i class="fas fa-bars mr-1"></i> Design review
                        </div>
                        <div class="external-event bg-info text-white p-2 mb-2 rounded cursor-pointer" style="cursor: move;">
                            <i class="fas fa-bars mr-1"></i> 1:1 with manager
                        </div>
                        <div class="external-event bg-danger text-white p-2 mb-2 rounded cursor-pointer" style="cursor: move;">
                            <i class="fas fa-bars mr-1"></i> Release window
                        </div>
                        <div class="custom-control custom-checkbox mt-3">
                            <input class="custom-control-input" type="checkbox" id="drop-remove">
                            <label class="custom-control-label font-weight-normal text-muted" for="drop-remove">
                                Remove from list after dropping
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kalender Utama Kanan -->
    <div class="col-md-9">
        <div class="card card-primary">
            <div class="card-body p-0">
                <div id="calendar" class="p-3"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.3/main.global.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // Inisialisasi fitur drag & drop event dari sidebar
        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText.trim(),
                    backgroundColor: window.getComputedStyle(eventEl).backgroundColor,
                    borderColor: window.getComputedStyle(eventEl).backgroundColor,
                    textColor: window.getComputedStyle(eventEl).color
                };
            }
        });

        // Inisialisasi Tampilan Kalender
        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            themeSystem: 'bootstrap',
            initialDate: '2026-08-01',
            editable: true,
            droppable: true,
            drop: function(info) {
                if (checkbox.checked) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            events: [
                {
                    title          : 'Team standup',
                    start          : '2026-07-26',
                    backgroundColor: '#007bff',
                    borderColor    : '#007bff'
                },
                {
                    title          : 'Customer call',
                    start          : '2026-07-27',
                    backgroundColor: '#28a745',
                    borderColor    : '#28a745'
                },
                {
                    title          : 'Team standup',
                    start          : '2026-08-02',
                    backgroundColor: '#007bff',
                    borderColor    : '#007bff'
                },
                {
                    title          : 'Quarterly planning',
                    start          : '2026-08-21',
                    backgroundColor: '#007bff',
                    borderColor    : '#007bff'
                },
                {
                    title          : 'Onboarding session',
                    start          : '2026-08-24',
                    backgroundColor: '#28a745',
                    borderColor    : '#28a745'
                },
                {
                    title          : 'Design review',
                    start          : '2026-08-26',
                    backgroundColor: '#ffc107',
                    borderColor    : '#ffc107',
                    textColor      : '#1f2d3d'
                }
            ]
        });

        calendar.render();
    });
</script>
@stop