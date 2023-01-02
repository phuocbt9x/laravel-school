@extends('layout.main')
@section('content')
<div class="row mb-5">
    
    <div class="col-12">
        <div class="multisteps-form mb-5">
            @if(session()->has('error'))
                <div class="alert alert-danger" style="color: white">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                    <span>Lịch thi</span>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <form class="multisteps-form__form mb-8" style="height: 408px;"
                        action="{{ route('examSchedule.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                            data-animation="FadeIn">
                            <h5 class="font-weight-bolder mb-0">About me</h5>
                            <p class="mb-0 text-sm">Mandatory informations</p>
                            <div class="multisteps-form__content">
                                <div class="row mt-3">
                                    <div class="col-12 ">
                                        <label>Môn học</label>
                                        <select name="subject_id" id="subject_id"
                                            class="multisteps-form__input form-control">
                                            <option value="">Chọn môn học</option>
                                            @foreach ($subjects as $subjects)
                                                <option value="{{$subjects->id}}">
                                                    {{$subjects->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                        <div class="alert alert-danger" style="padding: 0.5% 0 0 1%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Ngành học</label>
                                        <select name="department_id" id="department_id"
                                            class="multisteps-form__input form-control">
                                            <option value="">Chọn ngành</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}">
                                                    {{$department->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label>Kiểu thi</label>
                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="1"
                                                        id="di_hoc" name="type"
                                                        >
                                                        <span class="form-check-sign">Thực hành</span>
                                                </label>
                                            </div> 
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" value="0"
                                                        id="di_hoc" name="type" 
                                                        >
                                                        <span class="form-check-sign">Tự luận</span>
                                                </label>
                                            
                                            </div> 
                                        </div>
                                        
                                        @error('type')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 3%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
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
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Ngày thi</label>
                                        <input class="multisteps-form__input form-control" type="date"
                                             name="date"
                                            value="{{ date('Y-m-d', strtotime((old('date') ?? 'now'))) ??  "" }}">
                                        @error('date')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Thời gian bắt đầu</label>
                                        <select name="timestart" id="timestart"
                                            class="multisteps-form__input form-control" >
                                            <option value="">Chọn giờ bắt đầu</option>
                                            @foreach ($timeStarts as $option=>$value)
                                            <option value="{{ $value }}" @if ($loop->first)
                                                checked
                                                @endif
                                                >
                                                {{$option}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('timestart')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 ">
                                        <label>Thời gian làm bài</label>
                                        <select name="minutes" id="minutes"
                                            class="multisteps-form__input form-control" >
                                            <option value="">Chọn thời gian làm bài</option>
                                            @foreach ($minutes as $option=>$value)
                                            <option value="{{ $value }}" @if ($loop->first)
                                                checked
                                                @endif
                                                >
                                                {{$option}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('minutes')
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