function getAddress(cityId = -1, districtId = -1, wardId = -1) {
    fetch('https://provinces.open-api.vn/api/?depth=3')
        .then((response) => response.json())
        .then((data) => {
            var districts;
            data.map(value => {
                $('#city_id').append(`<option ${(value.code == cityId) ? 'selected' : -1} value="${value.code}">${value.name}</option>`);
            });
            if (districtId != -1) {
                $('#district_id').html('<option value="">Chọn quận/huyện</option>');
                $('#ward_id').html('<option value=""> Chọn phường/xã </option>');
                data.map(value => {
                    if (value.code == cityId) {
                        districts = value.districts;
                        districts.map(value => {
                            $('#district_id').append(`<option ${(value.code == districtId) ? 'selected' : -1} value="${value.code}">${value.name}</option>`);
                        });
                    }
                })
            }
            $('#city_id').change(function () {
                $('#district_id').html('<option value="">Chọn quận/huyện</option>');
                $('#ward_id').html('<option value=""> Chọn phường/xã </option>');
                let idCity = $(this).val();
                data.map(value => {
                    if (value.code == idCity) {
                        districts = value.districts;
                        districts.map(value => {
                            $('#district_id').append(`<option value="${value.code}">${value.name}</option>`);
                        });
                    }
                })
            });
            if (wardId != -1) {
                $('#ward_id').html('<option> Chọn phường/xã </option>');
                districts.map(value => {
                    if (value.code == districtId) {
                        ward = value.wards;
                        ward.map(value => {
                            $('#ward_id').append(`<option ${(value.code == wardId) ? 'selected' : -1} value="${value.code}">${value.name}</option>`);
                        });
                    }
                })
            }
            $('#district_id').change(function () {
                $('#ward_id').html('<option> Chọn phường/xã </option>');
                let idDistrict = $(this).val();
                districts.map(value => {
                    if (value.code == idDistrict) {
                        ward = value.wards;
                        ward.map(value => {
                            $('#ward_id').append(`<option value="${value.code}">${value.name}</option>`);
                        });
                    }
                })
            })
        });
}

function getFullAddress(elementShow, address, wardId, districtId, cityId) {
    fetch('https://provinces.open-api.vn/api/w/' + wardId)
        .then((response) => response.json())
        .then((data) => {
            ward = data.name;
            fetch('https://provinces.open-api.vn/api/d/' + districtId)
                .then((response) => response.json())
                .then((data) => {
                    district = data.name;
                    fetch('https://provinces.open-api.vn/api/p/' + cityId)
                        .then((response) => response.json())
                        .then((data) => {
                            city = data.name;
                            var element = document.getElementById(elementShow);
                            var addressFull;
                            if (address == '') {
                                addressFull = ward + ', ' + district + ', ' + city;
                            } else {
                                addressFull = address + ', ' + ward + ', ' + district + ', ' + city;
                            }
                            element.textContent += addressFull;
                        });
                });
        })
}


function preview() {
    $('#avatar').change(function (e) {
        const preview = document.getElementById('preview_image');
        const imageOld = document.getElementById('imagePreview')
        const files = e.target.files;
        const file = files[0];
        const fileReader = new FileReader();
        if (imageOld) {
            $('#imagePreview').remove();
            fileReader.readAsDataURL(file);
            fileReader.onload = function () {
                const src = fileReader.result;
                var tagImage = `<div class="mt-3 mr-3" id='imagePreview'>
                                <div style="width: 220px; height: 220px;">
                                    <img id="output" class="rounded-circle" src="${src}"
                                        style="width: 100%; height: 100%; object-fit: cover" />
                                </div>
                            </div>
                            `;
                preview.insertAdjacentHTML('beforeend', tagImage)
            }
        } else {
            fileReader.readAsDataURL(file);
            fileReader.onload = function () {
                const src = fileReader.result;
                var tagImage = `<div class="mt-3 mr-3" id='imagePreview'>
                                <div style="width: 220px; height: 220px;">
                                    <img id="output" class="rounded-circle" src="${src}"
                                        style="width: 100%; height: 100%; object-fit: cover" />
                                </div>
                            </div>
                            `;
                preview.insertAdjacentHTML('beforeend', tagImage)
            }
        }
    })
}

function toastMessage(message){
    toastr.success(message);
}

function toastMessageDanger(message){
    toastr.warning(message);
}