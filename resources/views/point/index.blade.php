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
            @error('success')
                <div class="alert alert-success" style="color: white">
                    {{ $message }}
                </div>
            @enderror
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0">Điểm học phần</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Môn học</th>
                                <th>Lớp học</th>
                                <th>Điểm Học phần</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($assignmentModel as $assignment)
                               <tr>
                                <td class="text-sm font-weight-normal">
                                    {{ $assignment->id }}
                                 </td>
                                    <td class="text-sm font-weight-normal">
                                       {{ $assignment->getSubject->name }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $assignment->getCourseName->name }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        <a href="{{ route('point.create', $assignment->id) }}" class="btn btn-success">Điểm</a>
                                    </td>
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
