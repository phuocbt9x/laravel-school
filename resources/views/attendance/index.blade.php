@extends('layout.main')
@section('content')
    @push('css')
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/ju/jq-3.6.0/jszip-2.5.0/dt-1.13.1/e-2.0.10/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.css" />
    @endpush
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0">Điểm danh sinh viên</h5>
                    <form method="POST" id="form" >
                        @csrf
                        @method('POST')
                        <select name="assignment_subject" id="assignment_subject">
                            <option value="">Chọn môn học</option>
                            @foreach ($assignments as $assignment) 
                                @if ($assignment->teacher_id === Auth::user()->getInfo->id && date('Y-m', strtotime($assignment->date)) === date("Y-m"))
                                    <option value="{{ old($assignment->subject_id) ?? $assignment->subject_id }}"
                                        @if ((isset($subject_id) && $subject_id == $assignment->subject_id) || isset($_GET['subject_id'])) selected @endif>
                                        {{ $assignment->getSubject->name ?? $_GET['subject_name'] }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <select name="assignment_course" id="assignment_course">
                            @foreach ($assignments as $assignment)
                                @if ($assignment->teacher_id === Auth::user()->getInfo->id)
                                    <option value="{{ $assignment->course_id ?? $course_id }}"
                                        @if (isset($course_id) && $course_id == $assignment->course_id) selected @endif>
                                        {{ $assignment->getCourseName->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <input type="text" value="{{ $shifts[0]->getShift->title ?? 'Trống' }}" disabled>
                        <button type="submit"  id="btn_assignment">Submit</button>
                    </form>
                    
                    <a href="{{ route('attendance.create') }}" class="btn btn-success">Thêm mới</a>
                </div>
                <div class="table-responsive">
                    
                    
                        <form action="{{ route('attendance.attendance') }}" method="POST">
                            @csrf
                            @method('POST')
                            
                            
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sinh viên</th>
                                        <th>Tình trạng đi học</th>
                                    </tr>
                                </thead>
                                <tbody id="list_attendance">
                                    
                                    
                                </tbody>
                            </table>
                            <button>Nhập</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')    
    <script>
        $('#form').submit(function(e) {
            
            let data = new FormData(this);
            
            e.preventDefault();
            $.ajax({
                type: 'POST',
                contentType: false,
                processData: false,
                async: false,
                // uploadUrl: '{{ url('attendance.post') }}',
                url: '{{ route('attendance.post') }}',
                data: data,
                dataType: "json",
                success: function(data) {
                    html = '';

                    for (const [key, value] of Object.entries(data)) {
                        console.log(`${key}: ${value}`);
                        html += ``;
                    }
                    
                    // $('#list_attendance').append(html);
                },
            })
            
        })
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/ju/jq-3.6.0/jszip-2.5.0/dt-1.13.1/e-2.0.10/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js">
    </script>
@endpush
