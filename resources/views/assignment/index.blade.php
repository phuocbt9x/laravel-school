@extends('layout.main')
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Danh sách phân công</h5>
                <a href="{{ route('assignment.create') }}" class="btn btn-success">Thêm mới</a>
            </div>
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Tên lớp</th>
                            <th>Tên môn học</th>
                            <th>Tên giáo viên</th>
                            <th>Ca</th>
                            <th>Thời gian</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                        <tr>
                            <td class="text-sm font-weight-normal">
                                {{ $assignment->id }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {{ $assignment->getCourseName->name}}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {{ $assignment->getSubject->name }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $assignment->getTeacher->fullname !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $assignment->getShift->title !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $assignment->getDate() !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                <a href="{{ route('assignment.show', $assignment->id) }}" class="badge bg-gradient-info"
                                    title="Chi tiết">
                                    <i class="fas fa-search"></i>
                                </a>
                                <a href="{{ route('assignment.edit', $assignment->id) }}" class="badge bg-gradient-secondary"
                                    title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="badge bg-gradient-danger" title="Xóa"
                                    onclick="deleteItem('{{ $assignment->id }}')">
                                    <i class="fas fa-trash"></i>
                                </a>
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
        let urlDelete = '{{ route("assignment.destroy", ":id") }}';
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
@endpush