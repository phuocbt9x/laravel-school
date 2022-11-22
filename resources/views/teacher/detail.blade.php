@extends('layout.main')
@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xxl position-relative">
                    <img src="{{ asset($teacherModel->avatar) }}" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $teacherModel->fullname }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {!! $teacherModel->level() !!}
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
                <h6 class="mb-1">About</h6>
            </div>
            <div class="card h-100">
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Giới tính:
                            </strong>
                            &nbsp; {!! $teacherModel->stringGender() !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Ngày sinh:
                            </strong>
                            &nbsp; {!! $teacherModel->stringBirthDate() !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Điện thoại:
                            </strong>
                            &nbsp; {!! $teacherModel->stringPhone() !!}
                        </li>
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                            <strong class="text-dark">
                                Email:
                            </strong>
                            &nbsp; {!! $teacherModel->getInfoLogin->email !!}
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
</div>
@endsection
@push('script')
<script>
    getFullAddress('address', "{{ $teacherModel->address }}", "{{ $teacherModel->ward_id }}", "{{ $teacherModel->district_id }}", "{{ $teacherModel->city_id }}")
</script>
@endpush