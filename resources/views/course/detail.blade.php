@extends('layout.main')
@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-header pb-0 p-3">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">{{ $courseModel->name }}</h6>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <ul class="list-group">
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">
                    Khoa:
                </strong>
                &nbsp; {{ $courseModel->department->name}}
            </li>
            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                <strong class="text-dark">
                    Số lượng sinh viên:
                </strong>
                &nbsp; {{ $courseModel->getCourseName->count()}}
            </li>
        </ul>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3 d-flex justify-content-between">
                <h6 class="mb-1">Danh sách sinh viên</h6>
                <a href="{{ route('student.create', $courseModel) }}" class="btn btn-success">Thêm mới sinh viên</a>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Lớp học</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courseModel->getCourseName as $student)
                            <tr>
                                <td class="text-sm font-weight-normal">
                                    {{ $student->fullname }}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {!! $student->stringGender() !!}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {!! $student->stringBirthDate() !!}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {!! $student->getCourseName() !!}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {!! $student->status() !!}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    <a href="{{ route('student.show', $student->id) }}" class="badge bg-gradient-info"
                                        title="Chi tiết">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    <a href="{{ route('student.edit', $student->id) }}"
                                        class="badge bg-gradient-secondary" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="badge bg-gradient-danger" title="Xóa"
                                        onclick="deleteItem({{ $student->id }})">
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
        let urlDelete = '{{ route("student.destroy", ":id") }}';
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