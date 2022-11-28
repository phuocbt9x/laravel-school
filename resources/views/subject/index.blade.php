@extends('layout.main')
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Danh sách môn học</h5>
                <a href="{{ route('subject.create') }}" class="btn btn-success">Thêm mới môn học</a>
            </div>
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Tên môn học</th>
                            <th>Slug</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                        <tr>
                            <td class="text-sm font-weight-normal">
                                {{ $subject->name }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {{ $subject->slug }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $subject->status() !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                <a href="{{ route('subject.edit', $subject->slug) }}"
                                    class="badge bg-gradient-secondary" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="badge bg-gradient-danger" title="Xóa"
                                    onclick="deleteItem('{{ $subject->slug }}')">
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
    function deleteItem(slug){
        let urlDelete = '{{ route("subject.destroy", ":slug") }}';
        urlDelete = urlDelete.replace(':slug', slug);
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