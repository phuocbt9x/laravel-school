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
                                    <span>{{ $subject->name }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <form class="multisteps-form__form mb-8" style="height: 408px;"
                        action="{{ route('point.update', $pointModel) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                            data-animation="FadeIn">
                            <h5 class="font-weight-bolder mb-0">{{$student->fullname }}</h5>
                            <p class="mb-0 text-sm">Lớp: {{ $course->name }}</p>
                            <div class="multisteps-form__content">
                                <div class="row mt-3">
                                    <div class="col-12 ">
                                        <label>Điểm quá trình</label>
                                        <input class="multisteps-form__input form-control" type="text"
                                        placeholder="" name="diligence"
                                        value="{{ ($pointModel[0]->diligence) ?? 0  }}" >
                                        @error('diligence')
                                        <div class="alert alert-danger" style="padding: 0.5% 0 0 1%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <label>Điểm giữa kì</label>
                                        <input class="multisteps-form__input form-control" type="text"
                                            placeholder="" name="mid_term"
                                            value="{{ ($pointModel[0]->mid_term) ??  0}}">
                                        @error('mid_term')
                                        <div class="alert alert-danger" style="padding: 1% 0 0 2%; margin-top: 2%;">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Điểm cuối kì</label>
                                        <input class="multisteps-form__input form-control" type="text"
                                            placeholder="" name="final"
                                            value="{{ ($pointModel[0]->final) ?? 0 }}">
                                        @error('final')
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
                                        title="Save">Lưu
                                    </button>
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
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true
    });
</script>
<script>
    
</script>
<script>
    preview();
    getAddress({{ old('city_id') ?? '-1' }}, {{ old('district_id') ?? '-1' }}, {{ old('ward_id') ?? '-1' }});
</script>
@endpush