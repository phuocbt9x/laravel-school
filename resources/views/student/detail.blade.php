@extends('layout.main')
@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xxl position-relative">
                    <img src="{{ $studentModel->avatar() }}" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $studentModel->fullname }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {!! $studentModel->level() !!}
                    </p>

                    <p class="mb-0 font-weight-bold text-sm">
                        {!! $studentModel->getCourseName() !!}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-1">Thông tin cá nhân</h6>
            </div>
            <div class="card h-100">
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Giới tính:
                            </strong>
                            &nbsp; {!! $studentModel->stringGender() !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Ngày sinh:
                            </strong>
                            &nbsp; {!! $studentModel->stringBirthDate() !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Điện thoại:
                            </strong>
                            &nbsp; {!! $studentModel->stringPhone() !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Email:
                            </strong>
                            &nbsp; {!! $studentModel->getInfoLogin->email !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Địa chỉ:
                            </strong>
                            &nbsp;
                            <span id="address"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
                                    {{ $point[$assignment->id]['diligence'] }}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {{ $point[$assignment->id]['mid_term'] }}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {{ $point[$assignment->id]['final'] }}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {{ $assignment->getRank($point[$assignment->id]['total']) }}
                                </td>
                                <td class="text-sm font-weight-normal">
                                    {{ $point[$assignment->id]['total']}}
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
    getFullAddress('address', "{{ $studentModel->address }}", "{{ $studentModel->ward_id }}", "{{ $studentModel->district_id }}", "{{ $studentModel->city_id }}")
</script>
@endpush