@extends('layout.main')
@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="multisteps-form mb-5">

            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                    <span>User Info</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button"
                                    title="Address">Address</button>
                                <button class="multisteps-form__progress-btn" type="button"
                                    title="Avatar">Avatar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <form class="multisteps-form__form mb-8" style="height: 408px;"
                        action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                            data-animation="FadeIn">
                            <h5 class="font-weight-bolder mb-0">About me</h5>
                            <p class="mb-0 text-sm">Mandatory informations</p>
                            <div class="multisteps-form__content">
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <label>Họ và tên</label>
                                        <input class="multisteps-form__input form-control" type="text"
                                            placeholder="eg. Michael" name="fullname"
                                            value="{{ old('fullname') ?? '' }}">
                                        @error('fullname')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Giới tính</label>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="female" {{
                                                        (old('gender')==0 || '' ) ? 'checked' : '' }} name="gender"
                                                        value="0">
                                                </div>
                                                <label for="female" class="mb-0 text-dark font-weight-bold text-sm">
                                                    Nữ
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="male" name="gender"
                                                        {{ (old('gender')==1 ) ? 'checked' : '' }} value="1">
                                                </div>
                                                <label for="male" class="mb-0 text-dark font-weight-bold text-sm">
                                                    Nam
                                                </label>
                                            </div>
                                        </div>
                                        @error('gender')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <label>Ngày sinh</label>
                                        <input class="multisteps-form__input form-control" type="date"
                                            placeholder="eg. Creative Tim" name="birthdate"
                                            value="{{ date('Y-m-d', strtotime(old('birthdate'))) ?? '' }}">
                                        @error('birthdate')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label for="level">Quyền hạn</label>
                                        <select name="level" id="level" class="multisteps-form__input form-control">
                                            <option value="">Lựa chọn quyền hạn</option>
                                            <option {{ (old('level')==1) ? 'selected' : '' }} value="1">Giáo vụ</option>
                                            <option {{ (old('level')==2) ? 'selected' : '' }} value="2">Giảng viên
                                            </option>
                                        </select>
                                        @error('level')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <label>Số điện thoại</label>
                                        <input class="multisteps-form__input form-control" type="text"
                                            placeholder="eg. (0975) 041 697" name="phone"
                                            value="{{ old('phone') ?? '' }}">
                                        @error('phone')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Email</label>
                                        <input class="multisteps-form__input form-control" type="email"
                                            placeholder="eg. test@gmail.com" name="email"
                                            value="{{ old('email') ?? '' }}">
                                        @error('email')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <label>Password</label>
                                        <input class="multisteps-form__input form-control" type="password"
                                            placeholder="******" name="password">
                                        @error('password')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Nhập lại Password</label>
                                        <input class="multisteps-form__input form-control" type="password"
                                            placeholder="******" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0 d-flex">
                                        <label class="text-sm me-3 my-auto">Kích hoạt</label>
                                        <div class="form-check form-switch my-auto">
                                            <input class="form-check-input" {{ old('activated') ? 'checked' : '' }}
                                                type="checkbox" value="1" name="activated">
                                        </div>
                                    </div>
                                </div>
                                <div class="button-row d-flex mt-4">
                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                        title="Next">Tiếp</button>
                                </div>
                            </div>
                        </div>

                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                            <h5 class="font-weight-bolder">Address</h5>
                            <div class="multisteps-form__content">
                                <div class="row mt-3">
                                    <div class="col">
                                        <label>Địa chỉ</label>
                                        <input class="multisteps-form__input form-control" type="text"
                                            placeholder="eg. Street 111" name="address"
                                            value="{{ old('address') ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label>Tỉnh/Thành</label>
                                        <select name="city_id" id="city_id" class="multisteps-form__input form-control">
                                            <option value="">Chọn tỉnh/thành</option>
                                        </select>
                                        @error('city_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <label>Quận/Huyện</label>
                                        <select name="district_id" id="district_id"
                                            class="multisteps-form__input form-control">
                                            <option value="">Chọn quận/huyện</option>
                                        </select>
                                        @error('district_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label>Xã/Phường</label>
                                        <select name="ward_id" id="ward_id" class="multisteps-form__input form-control">
                                            <option value="">Chọn phường/xã</option>
                                        </select>
                                        @error('ward_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="button-row d-flex mt-4">
                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                        title="Prev">Quay lại</button>
                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                        title="Next">Tiếp</button>
                                </div>
                            </div>
                        </div>

                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                            <h5 class="font-weight-bolder">Socials</h5>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12">
                                        <label>Avatar</label>
                                        <input class="multisteps-form__input form-control" type="file" name="avatar"
                                            id="avatar">
                                    </div>
                                    <div id="preview_image" class="d-flex justify-content-center">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="button-row d-flex mt-4 col-12">
                                        <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                            title="Prev">Quay lại</button>
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                            title="Next">Lưu lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets') }}/js/plugins/multistep-form.js"></script>
<script>
    preview();
    getAddress({{ old('city_id') ?? '-1' }}, {{ old('district_id') ?? '-1' }}, {{ old('ward_id') ?? '-1' }});
</script>
@endpush