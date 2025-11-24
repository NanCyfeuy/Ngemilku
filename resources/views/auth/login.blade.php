@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm p-4" style="width: 350px; border-radius: 12px;">
        <h3 class="text-center mb-4">Login</h3>
        
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
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
                    placeholder="Masukkan password" 
                    required>
            </div>

            <!-- Tombol -->
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Login</button>
            </div>
        </form>

        <!-- Link daftar -->
        <p class="text-center mt-3 mb-0">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a>
        </p>
    </div>
</div>
@endsection
