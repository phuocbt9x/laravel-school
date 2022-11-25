@extends('layout.main')
@push('link')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>





    <script src='/docs/dist/demo-to-codepen.js'></script>


    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //           var calendarEl = document.getElementById('calendar');

            //           var calendar = new FullCalendar.Calendar(calendarEl, {
            //               timeZone: 'UTC',
            //               themeSystem: 'bootstrap5',
            //               headerToolbar: {
            //                   left: 'prev,next today',
            //                   center: 'title',
            //                   right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            //               },
            //               weekNumbers: true,
            //               dayMaxEvents: true, // allow "more" link when too many events
            //               events:  [ 
            //   { title: 'event 1', date: '2022-11-24' },
            //   { title: 'event 2', date: '2022-11-30' }
            // ]
            //           });

            var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                contentHeight: 'auto',
                initialView: "dayGridMonth",
                headerToolbar: {
                              left: 'prev,next today',
                              center: 'title',
                              right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                          },
                selectable: true,
                editable: true,
                weekNumbers: true,
                          dayMaxEvents: true, // allow "more" link when too many events
                initialDate: '2021-12-01',
                events: [{
                        title: 'Call with Dave',
                        start: '2021-11-18',
                        end: '2021-11-18',
                        className: 'bg-gradient-danger'
                    },

                    {
                        title: 'Lunch meeting',
                        start: '2021-11-21',
                        end: '2021-11-22',
                        className: 'bg-gradient-warning'
                    },

                    {
                        title: 'All day conference',
                        start: '2021-11-29',
                        end: '2021-11-29',
                        className: 'bg-gradient-success'
                    },

                    {
                        title: 'Meeting with Mary',
                        start: '2021-12-01',
                        end: '2021-12-01',
                        className: 'bg-gradient-info'
                    },

                    {
                        title: 'Winter Hackaton',
                        start: '2021-12-03',
                        end: '2021-12-03',
                        className: 'bg-gradient-danger'
                    },

                    {
                        title: 'Digital event',
                        start: '2021-12-07',
                        end: '2021-12-09',
                        className: 'bg-gradient-warning'
                    },

                    {
                        title: 'Marketing event',
                        start: '2021-12-10',
                        end: '2021-12-10',
                        className: 'bg-gradient-primary'
                    },

                    {
                        title: 'Dinner with Family',
                        start: '2021-12-19',
                        end: '2021-12-19',
                        className: 'bg-gradient-danger'
                    },

                    {
                        title: 'Black Friday',
                        start: '2021-12-23',
                        end: '2021-12-23',
                        className: 'bg-gradient-info'
                    },

                    {
                        title: 'Cyber Week',
                        start: '2021-12-02',
                        end: '2021-12-02',
                        className: 'bg-gradient-warning'
                    },

                ],
                views: {
                    month: {
                        titleFormat: {
                            month: "long",
                            year: "numeric"
                        }
                    },
                    agendaWeek: {
                        titleFormat: {
                            month: "long",
                            year: "numeric",
                            day: "numeric"
                        }
                    },
                    agendaDay: {
                        titleFormat: {
                            month: "short",
                            year: "numeric",
                            day: "numeric"
                        }
                    }
                },
            });

            calendar.render();

        });
    </script>
@endpush
@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../../../assets/img/team-1.jpg" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Sayo Kravits
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Public Relations
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">App</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false"
                                    tabindex="-1">
                                    <i class="ni ni-email-83"></i>
                                    <span class="ms-2">Messages</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false"
                                    tabindex="-1">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span class="ms-2">Settings</span>
                                </a>
                            </li>
                            <div class="moving-tab position-absolute nav-link"
                                style="padding: 0px; transition: all 0.5s ease 0s; transform: translate3d(0px, 0px, 0px); width: 80px;">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">-</a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Platform Settings</h6>
                </div>
                <div class="card-body p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault"
                                    checked="">
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="flexSwitchCheckDefault">Email me when someone follows me</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault1">
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault2"
                                    checked="">
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                            </div>
                        </li>
                    </ul>
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault3">
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="flexSwitchCheckDefault3">New launches and projects</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault4"
                                    checked="">
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="flexSwitchCheckDefault4">Monthly product updates</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0 pb-0">
                            <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault5">
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                    for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-8 mt-md-0 mt-4">
            <div id='calendar'></div>
        </div>

    </div>
@endsection
