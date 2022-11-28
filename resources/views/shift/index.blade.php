@extends('layout.main')
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Danh sách ca học</h5>
                <a href="{{ route('shift.create') }}" class="btn btn-success">Thêm mới ca học</a>
            </div>
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Tên ca học</th>
                            <th>Slug</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shifts as $shift)
                        <tr>
                            <td class="text-sm font-weight-normal">
                                {{ $shift->title }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {{ $shift->slug }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {{ $shift->timeStart() }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {{ $shift->timeEnd() }}
                            </td>
                            <td class="text-sm font-weight-normal">
                                {!! $shift->status() !!}
                            </td>
                            <td class="text-sm font-weight-normal">
                                <a href="{{ route('shift.edit', $shift->slug) }}" class="badge bg-gradient-secondary"
                                    title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="badge bg-gradient-danger" title="Xóa"
                                    onclick="deleteItem('{{ $shift->slug }}')">
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
        let urlDelete = '{{ route("shift.destroy", ":slug") }}';
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