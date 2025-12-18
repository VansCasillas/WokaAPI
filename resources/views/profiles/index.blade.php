@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 {{ request()->has('tab') ? '' : 'active' }}"
                                data-bs-toggle="tab"
                                href="#profile-tab">
                                <i class="material-symbols-rounded text-lg position-relative">home</i>
                                <span class="ms-1">Profile</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 {{ request()->get('tab') === 'update' ? 'active' : '' }}"
                                data-bs-toggle="tab"
                                href="#update-tab">
                                <i class="material-symbols-rounded text-lg position-relative">update</i>
                                <span class="ms-1">Update</span>
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
                                        src="{{ '' ? asset('storage/' . $profile->foto_profil) : asset('assets/img/kal-visuals-square.jpg') }}"
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

            {{-- ================= UPDATE TAB ================= --}}
            <div class="tab-pane fade {{ request()->get('tab') === 'update' ? 'show active' : '' }}"
                id="update-tab">
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-body p-3">
                                <div class="profile-pic-wrapper">
                                    <img id="previewImage"
                                        src="{{ '' ? asset('storage/' . $profile->foto_profil) : asset('assets/img/kal-visuals-square.jpg') }}"
                                        alt="Foto Profil"
                                        class="profile-pic">
                                    <button type="button" class="edit-btn px-4" onclick="document.getElementById('fotoInput').click()">Edit</button>
                                    <input type="file" id="fotoInput" name="foto_profil" class="hidden-input" accept="image/*" onchange="previewImage(event)">
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
                                                <input type="text" class="form-control styled-input" name="name" placeholder="nama" value="{{ $user->name }}"></input>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                                <input type="email" class="form-control styled-input" name="email" placeholder="email" value="{{ $user->email }}"></input>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="form-control-plaintext border-bottom pb-2 mb-2">
                                                <input type="" class="form-control styled-input" name="password" placeholder="password"></input>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hash = window.location.hash;

        if (hash) {
            const tabTrigger = document.querySelector(
                `a[data-bs-toggle="tab"][href="${hash}"]`
            );

            if (tabTrigger) {
                new bootstrap.Tab(tabTrigger).show();
            }
        }
    });
</script>

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
        background: #000;
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