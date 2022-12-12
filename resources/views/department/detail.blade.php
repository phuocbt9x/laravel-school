@extends('layout.main')
@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-header pb-0 p-3">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">{{ $departmentModel->name }}</h6>
            </div>
        </div>
    </div>

</div>
<div class="row mt-3">
    <div class="col-12">

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