@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm p-4" style="width: 380px; border-radius: 12px;">
        <h3 class="text-center mb-4">Register</h3>
        
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <!-- Nama -->
            <div class="mb-3">
                <label for="username" class="form-label">Nama</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="username" 
                    name="username" 
                    placeholder="Masukkan nama lengkap" 
                    required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    placeholder="Masukkan email" 
                    required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password" 
                    placeholder="Minimal 6 karakter" 
                    required>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Ulangi password" 
                    required>
            </div>

            <!-- Tombol -->
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Daftar</button>
            </div>
        </form>

        <!-- Link login -->
        <p class="text-center mt-3 mb-0">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
        </p>
    </div>
</div>
@endsection
