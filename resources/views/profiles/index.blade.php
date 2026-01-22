@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills p-1 w-100">
                        <li class="nav-item w-100">
                            <a
                                type="button"
                                class="nav-link d-flex align-items-center justify-content-center gap-2 px-3 py-2 active"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="material-symbols-rounded text-lg">update</i>
                                <span>Update</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        {{-- TAB CONTENT --}}
        <div class="tab-content">
            {{-- ================= PROFILE TAB ================= --}}
            <div class="tab-pane fade {{ request()->has('tab') ? '' : 'show active' }}"
                id="profile-tab">
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-body p-3">
                                <div class="profile-pic-wrapper">
                                    <img id="previewImage"
                                        src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) 
                                        : asset('assets/img/kal-visuals-square.jpg') }}"
                                        alt="Foto Profil"
                                        class="profile-pic">
                                </div>
                                <hr class="horizontal gray-light my-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Profile Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                                <strong>{{ $user->name }}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                                <strong>{{ $user->email }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileLabel">Edit Profil Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body p-3">
                            <div class="profile-pic-wrapper">
                                <img id="previewImage"
                                    src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('assets/img/kal-visuals-square.jpg') }}"
                                    alt="Foto Profil"
                                    class="profile-pic">
                                <button type="button" class="edit-btn px-4" onclick="document.getElementById('fotoInput').click()">Edit</button>
                                <input type="file" id="fotoInput" name="foto_profil" class="hidden-input" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <hr class="horizontal gray-light my-4">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control styled-input" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control styled-input" rows="2" placeholder="Belum diisi" value="{{ $user->email }}">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control styled-input" rows="2" placeholder="">
                                <label class="text-primary">*kosongkan jika tidak ingin mengubah password</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .styled-input {
        border: 1.5px solid #bbb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .styled-input:focus {
        border-color: #000;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        outline: none;
    }

    label {
        margin-bottom: 6px;
    }

    .profile-pic-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        justify-items: center;
        position: relative;
    }

    .profile-pic {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .edit-btn {
        position: absolute;
        bottom: 5px;
        right: 130px;
        background-color: #0d6efd;
        border: none;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .edit-btn:hover {
        background-color: #0b5ed7;
    }

    .hidden-input {
        display: none;
    }
</style>
@endsection