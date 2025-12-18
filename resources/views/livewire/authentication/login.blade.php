<div class="min-vh-100 d-flex align-items-center justify-content-center position-relative" 
     style="background: url('{{ asset('compiled/jpg/gedungmcp.png') }}') center/cover no-repeat;">

  <!-- Overlay hitam transparan -->
  <div class="position-absolute top-0 start-0 w-100 h-100" 
       style="background-color: rgba(0, 0, 0, 0.55); z-index: 1;"></div>

  <!-- Card login -->
  <div class="card shadow-lg border-0 rounded-4 bg-white bg-opacity-75 backdrop-blur position-relative" 
       style="max-width: 420px; width: 100%; z-index: 2;">
    <div class="card-body p-5">
      <div class="text-center mb-4">
        <img src="{{ asset('compiled/jpg/SMK_Multicomp_Logo.png') }}" alt="Logo" width="80" class="mb-3">
        <h3 class="fw-bold mb-2 text-primary">SMK MULTICOMP</h3>
        <p class="text-muted">Silakan masuk untuk melanjutkan ke dashboard pembayaran.</p>
      </div>

      @if (session('error'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      @error('password')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <form wire:submit.prevent="authenticate">
        <div class="form-group position-relative mb-4">
          <input type="email" wire:model.blur="email"
            class="form-control form-control-lg ps-5 @error('email') is-invalid @enderror"
            placeholder="Alamat Email" autofocus>
          <i class="bi bi-envelope position-absolute top-50 start-0 translate-middle-y ps-3 text-muted"></i>
        </div>

        <div class="form-group position-relative mb-4">
          <input type="{{ $input_type }}" wire:model.blur="password"
            class="form-control form-control-lg ps-5 pe-5 @error('password') is-invalid @enderror"
            placeholder="Kata Sandi">
          <i class="bi bi-lock position-absolute top-50 start-0 translate-middle-y ps-3 text-muted"></i>
          <span wire:click="togglePasswordVisibility" title="{{ $input_title }}"
            class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;">
            <i class="{{ $icon }}"></i>
          </span>
        </div>

        <div class="d-flex align-items-center mb-3">
    <input class="form-check-input me-2" wire:model="remember_me" type="checkbox" id="rememberMe">
    <label class="form-check-label text-dark" for="rememberMe">
        Ingat saya
    </label>
</div>


        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
          Masuk
        </button>
      </form>

    <a href="{{ route('home') }}" 
   class="btn btn-outline-dark w-100 py-2 fw-bold mt-3 shadow-sm">
    Kembali ke Homepage
</a>

    </div>
  </div>
</div>
