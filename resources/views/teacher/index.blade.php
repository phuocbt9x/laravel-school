@extends('layout.main')
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Danh sách giảng viên</h5>
                <a href="{{ route('teacher.create') }}" class="btn btn-success">Thêm mới giảng viên</a>
            </div>
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Họ và tên</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Chức vụ</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                        <tr>
                            <td class="text-sm font-weight-normal">
                                {{ $teacher->fullname }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $teacher->stringGender() !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $teacher->stringBirthDate() !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $teacher->level() !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $teacher->status() !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                <a href="{{ route('teacher.show', $teacher->id) }}" class="badge bg-gradient-info"
                                    title="Chi tiết">
                                    <i class="fas fa-search"></i>
                                </a>
                                <a href="{{ route('teacher.edit', $teacher->id) }}" class="badge bg-gradient-secondary"
                                    title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="badge bg-gradient-danger" title="Xóa"
                                    onclick="deleteItem({{ $teacher->id }})">
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
        let urlDelete = '{{ route("teacher.destroy", ":id") }}';
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