@extends('layout.main')
@push('link')
<meta name="csrf-token" content="{{  csrf_token() }}">
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src='/docs/dist/demo-to-codepen.js'></script>

<script>
    const csrfToken = document.head.querySelector("[name=csrf-token][content]").content;
    
    
    $(document).ready(function(){
        $.ajax({
            type: "get",
            url: "{{ route('fullcalendar.index') }}",
            data: "data",
            dataType: "html",
            success: function (response) {
                
            }
        });
    });
    // document.addEventListener('DOMContentLoaded', function() {
    //     var calendarEl = document.getElementById('calendar');
    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         contentHeight: 'auto',
    //         navLinks: true,
    //         selectable: true,
    //         editable: true,
    //         weekNumbers: true,
    //         dayMaxEvents: true,
    //         initialDate: '2022-12-01',
    //         headerToolbar: 
    //         {
    //             left: 'prev,next today',
    //             center: 'title',
    //             right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    //         },
    //         events: function(fetchInfo, successCallback, failureCallback ) {
    //         $.ajax({
    //             
    //             type: 'GET',
    //             dataType: 'JSON',
    //             success: function(data) {
                    
    //             var events = [];
    //             if (data != null) {
    //                 $.each(data, function(i, item) {
    //                 //    alert(item); 
    //                    for(let key in item){
    //                                id = item[key].id;
    //                                  console.log( id );
    //                                }
    //                 events.push({
                        
    //                     start: item.date,
    //                     title: item.title,
    //                     display: 'background'
    //                 })
    //                 })
    //             }
    //             console.log('events', events);
    //             successCallback(events);
    //             }
    //         })
    //         }
    //     });
    //     calendar.render();
    // });
    document.addEventListener('DOMContentLoaded', function() {
            
           
            var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                
                contentHeight: 'auto',
                initialView: "dayGridMonth",
                headerToolbar: {
                              left: 'prev,next today',
                              center: 'title',
                              right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                          },
                navLinks: true,
                selectable: true,
                weekNumbers: true,
                dayMaxEvents: true,
                initialDate: '2022-12-01',
                eventSources: [
                    {
                        events: function(fetchInfo, successCallback, failureCallback ) {
                            $.ajax({
                                url: '{{ route('fullcalendar.fecth' ,Auth::user()->getInfo->id  ) }}',
                                type: 'GET',
                                dataType: 'JSON',
                                success: function(data) {
                                    
                                var events = [];
                                if (data != null) {
                                    $.each(data, function(i, item) {
                                    //    alert(item); 
                                        //console.log(item);
                                        
                                        events.push({
                                            start: item.date_start ,
                                            title: item.title,
                                            id: item.id,
                                            display: '',
                                            color: '#4AAAB5',
                                        })      
                                    
                                        //console.log('events',events);
                                    
                                    })
                                }
                                
                                //console.log('events', events);

                                successCallback(events);
                                } 
                            })
                           
                        },
                        
                    }
                ],
                


                    
                    eventClick: function(event) {
                        let urlDetail = '{{ route("attendance.index", ":id") }}';
                        let urlAttendance = urlDetail.replace(':id', event.event.id);
                        console.log(urlAttendance);
                        //console.log(event.event.id); 
                        window.location.href = urlAttendance
                       
                    }
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
                    <img src="{{ (asset(Auth::user()->getInfo->avatar())) ?? "" }}" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ Auth::user()->getInfo->fullname }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        <span class="badge badge-pill bg-gradient-primary">
                            {{ Auth::user()->level === '1' ? 'Giáo vụ' : (Auth::user()->level === '2' ? 'Giang viên' :
                            'Sinh viên') }}</span>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card h-100 ">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h4 class="mb-0">Thời gian học</h6>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3">
                <hr class="horizontal gray-light my-2">
                <ul class="list-group list-group-flush" data-toggle="checklist">
                    <li class="list-group-item text-m   px-0">
                        <strong class="text-dark">- Buổi sáng: </strong>
                        <br>
                        &nbsp; + Ca 1 (tiết 1,2,3): từ 06g45' đến 09g00'
                        <br>
                        &nbsp; + Ca 2 (tiết 4,5,6): từ 09g20' đến 11g35'

                    </li>
                    <li class="list-group-item text-m   px-0">
                        <strong class="text-dark">- Buổi chiều: </strong>
                        <br>
                        &nbsp; + Ca 3 (tiết 7,8,9): từ 12g30' đến 14g45'
                        <br>
                        &nbsp; + Ca 4 (tiết 10,11,12): từ 15g05' đến 17g20'

                    </li>
                    <li class="list-group-item text-m   px-0">
                        <strong class="text-dark">- Buổi tối: </strong>
                        <br>
                        &nbsp; + Ca 5 (tiết 13,14,15): từ 18g00' đến 20g15'
                    </li>
                    <li class="list-group-item text-sm  px-0">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h4 class="mb-0">Thông tin cá nhân</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="javascript:;">
                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" aria-hidden="true" aria-label="Edit Profile"></i><span
                                class="sr-only">Edit Profile</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <hr class="horizontal gray-light my-2">
                <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-m"><strong class="text-dark">Họ và
                            tên</strong>
                        &nbsp; {{ Auth::user()->getInfo->fullname }}</li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-m"><strong class="text-dark">Ngày
                            sinh</strong>
                        &nbsp; {{ date('d/m/Y', strtotime(Auth::user()->getInfo->birthdate)) }}</li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-m"><strong class="text-dark">Tuổi</strong>
                        &nbsp; {{ date_diff(date_create('now'), date_create(Auth::user()->getInfo->birthdate))->y }}
                    </li>
                    <li class="list-group-item border-0 ps-0 text-m"><strong class="text-dark">Số điện
                            thoại:</strong>
                        &nbsp; {{ Auth::user()->getInfo->phone }}</li>
                    <li class="list-group-item border-0 ps-0 text-m"><strong class="text-dark">Email:</strong>
                        &nbsp; {{ Auth::user()->email }}</li>
                    <li class="list-group-item border-0 ps-0 text-m"><strong class="text-dark">Địa chỉ:</strong>
                        &nbsp;
                        <span id="address"></span>
                    </li>
                    <li class="list-group-item border-0 ps-0 pb-0">
                        <strong class="text-dark text-m">Liên hệ:</strong> &nbsp;
                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                            <i class="fab fa-facebook fa-lg" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                            <i class="fab fa-twitter fa-lg" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                            <i class="fab fa-instagram fa-lg" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 mt-xl-0 mt-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h4 class="mb-0">Môn học</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src="../../../assets/img/kal-visuals-square.jpg" alt="kal"
                                class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Sophie B.</h6>
                            <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src="../../../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Anne Marie</h6>
                            <p class="mb-0 text-xs">Awesome work, can you..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src="../../../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Ivanna</h6>
                            <p class="mb-0 text-xs">About files I can..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                            <img src="../../../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Peterson</h6>
                            <p class="mb-0 text-xs">Have a great afternoon..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0">
                        <div class="avatar me-3">
                            <img src="../../../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Nick Daniel</h6>
                            <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h4 class="mb-1">Thời khóa biểu</h6>
            </div>
            <div class="card-body">
                <div class="col-12 col-md-12 col-xl-12 mt-md-0 mt-4">
                    <div id='calendar'></div>
                </div>
            </div>
            {{-- <div class="card-body p-3">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="../../../assets/img/home-decor-1.jpg" alt="img-blur-shadow"
                                        class="img-fluid shadow border-radius-xl">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                                <a href="javascript:;">
                                    <h5>
                                        Bubbles
                                    </h5>
                                </a>
                                <p class="mb-4 text-sm">
                                    As Bubble works through a huge amount of internal management turmoil.
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                        Project</button>
                                    <div class="avatar-group mt-2">
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-1.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-2.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-3.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-4.jpg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="../../../assets/img/home-decor-2.jpg" alt="img-blur-shadow"
                                        class="img-fluid shadow border-radius-lg">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                                <a href="javascript:;">
                                    <h5>
                                        Scandinavian
                                    </h5>
                                </a>
                                <p class="mb-4 text-sm">
                                    Music is something that every person has his or her own specific opinion about.
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                        Project</button>
                                    <div class="avatar-group mt-2">
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-3.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-4.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-1.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-2.jpg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="../../../assets/img/home-decor-3.jpg" alt="img-blur-shadow"
                                        class="img-fluid shadow border-radius-xl">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                                <a href="javascript:;">
                                    <h5>
                                        Minimalist
                                    </h5>
                                </a>
                                <p class="mb-4 text-sm">
                                    Different people have different taste, and various types of music.
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                        Project</button>
                                    <div class="avatar-group mt-2">
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-4.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-3.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-2.jpg">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <img alt="Image placeholder" src="../../../assets/img/team-1.jpg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card h-100 card-plain border">
                            <div class="card-body d-flex flex-column justify-content-center text-center">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
                                    <h5 class=" text-secondary"> New project </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    getFullAddress('address', "{{ Auth::user()->getInfo->address }}", "{{ Auth::user()->getInfo->ward_id }}",
            "{{ Auth::user()->getInfo->district_id }}", "{{ Auth::user()->getInfo->city_id }}")
</script>
@endpush