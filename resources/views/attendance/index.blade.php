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
            <form action="{{ route('attendance.attendance') }}" method="POST">
                <div class="card">
                    <div class="card-header" style="display: flex;
                    flex-direction: column;
                    align-items: center;">
                        <h5 class="mb-0">Điểm danh sinh viên</h5>
                        <div style="display: flex;
                        flex-direction: row;
                        justify-content: space-between;
                        width: 100%;">
                            <span>Lớp: {{ $course_name }}</span>
                            <span>Môn học: {{ $subject_name }}</span>
                            <span>Ngày: {{ $date }}</span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="assignment_id" value="{{ $assignments->id }}">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Ngày sinh</th>
                                    <th>Điểm danh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arr as $student)
                                    <tr>
                                        <td>
                                            {{ $student['id'] }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $student['name'] }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ date('Y-m-d', strtotime($student['birthdate'])) }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="1"
                                                        id="di_hoc" name="item[{{ $student['id'] }}]"
                                                        {{ $student['check'] == 1 ? 'checked' : '' }}>
                                                        <span class="form-check-sign">Đi học</span>
                                                </label>
                                               
                                            </div> 
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="0" id="nghi_hoc"
                                                        name="item[{{$student['id']}}]"  {{($student['check'] == 0) ? 'checked' : ''}}>
                                                        <span class="form-check-sign">Nghỉ học</span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex;flex-direction: column; align-items: center;" >
                            <button  class="btn btn-primary btn-round">Điểm danh</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
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
