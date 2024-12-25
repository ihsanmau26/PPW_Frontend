@extends('layouts.form-layout')

@section('title', 'Edit Doctor')

@section('page', 'Edit Doctor')

@section('content')
<form id="doctorForm" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Doctor's Name" required>
    </div>
    <div class="mb-3">
        <label for="specialization" class="form-label">Specialization</label>
        <select id="specialization" name="specialization" class="form-control" required>
            <option value="">Select Specialization</option>
            <option value="Dental">Dental</option>
            <option value="General">General</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="shifts" class="form-label">Shifts</label>
        <div id="shiftInputs"></div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-success" id="saveDoctorBtn">Save</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const authToken = localStorage.getItem('authToken');
        const userId = localStorage.getItem('userId');

        if (!authToken) {
            alert('Anda belum login!');
            window.location.href = '/login';
            return;
        }

        if (!userId) {
            alert('ID dokter tidak ditemukan!');
            window.location.href = '/doctors';
            return;
        }

        $.ajaxSetup({
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${authToken}`,
            },
        });

        $.ajax({
            url: 'http://localhost:8000/api/shifts',
            method: 'GET',
            success: function (response) {
                const shifts = response.data;
                const shiftInputs = $('#shiftInputs');

                shifts.forEach((shift) => {
                    shiftInputs.append(`
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="shifts[]" value="${shift.id}" id="shift-${shift.id}">
                            <label class="form-check-label" for="shift-${shift.id}">
                                ${shift.day} (${shift.shift_start} - ${shift.shift_end})
                            </label>
                        </div>`);
                });

                $.ajax({
                    url: `http://localhost:8000/api/users/doctors/${userId}`,
                    method: 'GET',
                    success: function (response) {
                        const doctor = response.data;

                        $('#name').val(doctor.name);
                        $('#specialization').val(doctor.specialization);

                        if (Array.isArray(doctor.shifts)) {
                            doctor.shifts.forEach((shift) => {
                                $(`#shift-${shift.id}`).prop('checked', true);
                            });
                        }
                        
                    },
                    error: function (xhr) {
                        console.error('Error:', xhr.responseJSON || xhr);
                        alert('Gagal memuat data dokter.');
                    },
                });
            },
            error: function (xhr) {
                console.error('Error:', xhr.responseJSON || xhr);
                alert('Gagal memuat data shifts.');
            },
        });

        $('#doctorForm').on('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: `http://localhost:8000/api/users/doctors/${userId}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    alert('Dokter berhasil diperbarui!');
                    window.location.href = '/doctors';
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseJSON || xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        console.error('Validation Errors:', xhr.responseJSON.errors);
                    }
                    alert('Gagal memperbarui dokter. Periksa input dan coba lagi.');
                },
            });
        });
    });
</script>
@endsection
