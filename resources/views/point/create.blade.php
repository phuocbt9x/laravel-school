@extends('layout.main')
@section('content')


<div class="row mt-4">
    <div class="col-12">
        <form action="" method="POST">
            <div class="card">
                <div class="card-header" style="display: flex;
                flex-direction: column;
                align-items: center;">
                    <h5 class="mb-0">Điểm học phần</h5>
                    <div style="display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    width: 100%;">
                        <span>Lớp: {{ $course_name }}</span>
                        <span>Môn học: {{ $subject_name }}</span>
                    </div>
                </div>

                <div class="table-responsive">
                    @csrf
                    @method('POST')
                    
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th >Mã sinh viên</th>
                                <th>Tên sinh viên</th>
                                <th>Điểm quá trình</th>
                                <th>Điểm giữa kì</th>
                                <th>Điểm cuối kì</th>
                                <th>Điểm tổng kết</th>
                                
                                <th>Nhập điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $point)
                                <tr>
                                    <td class="text-sm font-weight-normal">
                                        <input type="text" style="outline: none; border: none;" name="student_id" value="{{ ($point['id'])  }}">
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        <input type="text" style="outline: none; border: none;" name="name" value="{{ ($point['fullname'])  }}">
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        @if (isset($listPoint[$id][$point['id']]) )
                                            {{  $listPoint[$id][$point['id']]['diligence'] }}
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        @if (isset($listPoint[$id][$point['id']]) )
                                            {{ ($listPoint[$id][$point['id']]['mid_term']) }}
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </td>
                                    <td class="text-sm font-weight-normal"> 
                                        @if (isset($listPoint[$id][$point['id']]) )
                                            {{ ($listPoint[$id][$point['id']]['final']) }}
                                        @else
                                            {{ '0' }}
                                        @endif
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        @if (isset($listPoint[$id][$point['id']]) )
                                            {{ ($listPoint[$id][$point['id']]['total']) }}
                                        @else
                                            {{ '0' }}
                                        @endif 
                                    </td>
                                    <td>
                                        
                                        
                                        <a href="{{ route('point.createPoint', [$id,$point['id']]) }}" class="btn btn-success">Nhập</a> 
                                        <a href="{{ route('point.edit', [$id,$point['id']]) }}" class="btn btn-primary">Sửa</a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets') }}/js/plugins/multistep-form.js"></script>
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true
    });
</script>
<script>
    $(document).ready(function(){
       
             $.ajax({
                url: '',
                data: {id,type},
                type: 'GET',
                dataType: '',
            })
            let total = $(this);
            let diligence = $(this).parents('tr').find('.diligence');
            let mid_term = $(this).parents('tr').find('.mid_term');
            let final = $(this).parents('tr').find('.mid_term');
       
    })
    
    // function myFunction() {
    //     var price = document.getElementById("inputProductPrice").value;
    //     var gst = document.getElementById("inputGST").value;
    //     var delivery = document.getElementById("inputDelivery").value;
    //     var total = +price + +gst + +delivery;
    //     document.getElementById("totalPrice").innerHTML = total;
         
    // }

</script>
<script>
    preview();
    getAddress({{ old('city_id') ?? '-1' }}, {{ old('district_id') ?? '-1' }}, {{ old('ward_id') ?? '-1' }});
</script>
@endpush