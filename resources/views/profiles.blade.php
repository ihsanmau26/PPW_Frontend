@extends('layouts.main-layout')

@section('title', 'Profiles')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="text-center border-end pe-3">
                <img src="https://via.placeholder.com/100" alt="Profile Picture" class="rounded-circle img-fluid mb-3">
                <h2 class="fs-5 mb-3">Nama Pengguna</h2>
                <button class="btn btn-primary btn-sm mb-3 w-100">Ganti Foto Profil</button>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-user me-2"></i>Edit Profil</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-key me-2"></i>Ganti Kata Sandi</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-bell me-2"></i>Pengaturan Notifikasi</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark"><i class="fas fa-question-circle me-2"></i>Bantuan</a></li>
                </ul>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-md-9">
            <h2 class="fs-4 mb-4">Profil Pengguna</h2>
            <div class="bg-light p-4 rounded shadow-sm">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-bold">Nama</label>
                    <div class="col-sm-9">
                        <span class="form-control-plaintext">Nama Pengguna</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-bold">Email</label>
                    <div class="col-sm-9">
                        <span class="form-control-plaintext">email@example.com</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label fw-bold">Password</label>
                    <div class="col-sm-9">
                        <span class="form-control-plaintext">********</span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary mt-3 float-end">Edit Profil</button>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endsection