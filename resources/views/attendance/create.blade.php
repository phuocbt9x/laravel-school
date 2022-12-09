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
                                    <span>Điểm danh sinh viên</span>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <form class="multisteps-form__form mb-8" style="height: 408px;"
                        action="{{ route('assignment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                            data-animation="FadeIn">
                            <h5 class="font-weight-bolder mb-0">About me</h5>
                            <p class="mb-0 text-sm">Mandatory informations</p>
                            <div class="multisteps-form__content">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label>Lớp học</label>
                                        <select name="course_id" id="course_id"
                                            class="multisteps-form__input form-control">
                                            <option value="">Chọn lớp học</option>
                                            @foreach ($courses as $course)
                                                <option value="{{$course->id}}">
                                                    {{$course->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Môn học</label>
                                        <select name="subject_id" id="subject_id"
                                            class="multisteps-form__input form-control">
                                            <option value="">Chọn môn học</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{$subject->id}}">
                                                    {{$subject->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label>Giáo viên</label>
                                        <select name="teacher_id" id="teacher_id"
                                            class="multisteps-form__input form-control">
                                            <option value="">Chọn giáo viên dạy</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{$teacher->id}}">
                                                    {{$teacher->fullname}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <label>Ca học</label>
                                        <select name="shift_id" id="shift_id"
                                            class="multisteps-form__input form-control">
                                            <option value="">Chọn ca học</option>
                                            @foreach ($shifts as $shift)
                                                <option value="{{$shift->id}}">
                                                    {{$shift->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('shift_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Ngày</label>
                                        <input class="multisteps-form__input form-control" type="date"
                                             name="date"
                                            value="{{ date('Y-m-d', strtotime((old('date')))) ??  "" }}">
                                        @error('date')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                    title="Save">Lưu</button>
                                    
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