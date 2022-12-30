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
                    <h5 class="mb-0">Lịch thi</h5>
                    @if (Auth::user()->level === '1')
                        <a href="{{ route('examSchedule.create') }}" class="btn btn-success">Thêm lịch thi</a>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th>Môn thi</th>
                                <th>Khoa</th>
                                <th>Ngày thi</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian làm bài</th>
                                <th>Kiểu thi</th>
                                <th>Giáo viên coi thi</th>
                                @if (Auth::user()->level === '1')
                                    <th>Chức năng</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($examScheduleTeacher as $examSchedule)
                                <tr>
                                    <td class="text-sm font-weight-normal">
                                        {{ $examSchedule->getSubject->name }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                         Khoa - {{ $examSchedule->getDepartment->name }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $examSchedule->stringDate() }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $examSchedule->getTimeStart($examSchedule->timestart) }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $examSchedule->getNumberOfMinutes($examSchedule->minutes) }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $examSchedule->getType() }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $examSchedule->getTeacher->fullname }}
                                    </td>
                                    @if (Auth::user()->level === '1')
                                        <td class="text-sm font-weight-normal">
                                            <a href="{{ route('examSchedule.edit', $examSchedule->id) }}" class="badge bg-gradient-secondary"
                                                title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:;" class="badge bg-gradient-danger" title="Xóa"
                                                onclick="deleteItem({{ $examSchedule->id }})">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
        function deleteItem(id){
            let urlDelete = '{{ route("examSchedule.destroy", ":id") }}';
            urlDelete = urlDelete.replace(':id', id);
            let message = "Bạn có thực sự muốn xóa dữ liệu này! Dữ liệu sẽ không thể khôi phục khi bạn chấp nhận xóa nó!";
            if(confirm(message)){
                $.ajax({
                    url: urlDelete,
                    data: { _method: 'delete' },
                    method: 'delete',
                    typeData: 'json',
                    async: false
                }).done(function(res){
                    window.location.href = res.url;
                    toastMessage(res.message);
                });
            }
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/ju/jq-3.6.0/jszip-2.5.0/dt-1.13.1/e-2.0.10/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js">
    </script>
@endpush
