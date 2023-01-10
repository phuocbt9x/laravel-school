@extends('layout.main')
@section('content')

    <div class="row mt-3">
        

        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 class="mb-0">Điểm</h6>

                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Mã môn học</th>
                                <th>Môn học</th>
                                <th>Điểm quá trình</th>
                                <th>Điểm giữa kì</th>
                                <th>Điểm cuối kì</th>
                                <th>Phân loại</th>
                                <th>Tổng kết</th>
                                <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignment_empty as $assignment)
                                <tr>
                                    <td class="text-sm font-weight-normal">
                                        {{ $assignment->id }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $assignment->getSubject->slug }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $assignment->getSubject->name }}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $point[$assignment->id]['diligence'] ?? 0}}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $point[$assignment->id]['mid_term']  ?? 0}}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $point[$assignment->id]['final'] ?? 0}}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $assignment->getRank($point[$assignment->id]['total'] ?? 0) ?? '0'}}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        {{ $point[$assignment->id]['total'] ?? 0}}
                                    </td>
                                    <td class="text-sm font-weight-normal">
                                        <span class="text-danger text-gradient px-0 mb-0 font-weight-bold" >
                                            @if (isset($point[$assignment->id]))
                                                {{ $assignment->checkFinalPoint($point[$assignment->id]['final'] ?? 0) }}
                                            @endif
                                        </span>
                                        
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
    
@endpush
