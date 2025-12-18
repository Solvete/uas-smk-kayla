<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5">Tambah Data Transaksi SPP</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <form wire:submit="save">

            <div class="row">

              {{-- PILIH PELAJAR --}}
              <div wire:ignore class="col-md-6">
                <x-forms.select-with-icon 
                    wire:model.blur="form.student_ids" 
                    label="Pilih Pelajar"
                    name="form.student_ids"
                    icon="bi bi-people-fill"
                    multiple
                >
                  @foreach ($students as $student)
                    <option value="{{ $student->id }}">
                      {{ $student->identification_number }} - {{ $student->name }}
                    </option>
                  @endforeach
                </x-forms.select-with-icon>
              </div>

              {{-- KATEGORI PEMBAYARAN --}}
              <div class="col-md-6">
                <label class="form-label fw-bold">Kategori Pembayaran</label>
                <select 
                    wire:model.live="form.payment_category_id"
                    class="form-select @error('form.payment_category_id') is-invalid @enderror"
                >
                  <option value="">-- Pilih Kategori --</option>
                  @foreach ($paymentCategories as $category)
                    <option value="{{ $category->id }}">
                      {{ $category->name }} - Rp{{ number_format($category->price, 0, ',', '.') }}
                    </option>
                  @endforeach
                </select>

                @error('form.payment_category_id')
                  <div class="invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>

            </div>

            <div class="row mt-3">

              {{-- TAGIHAN OTOMATIS --}}
              <div class="col-md-6">
                <x-forms.input-with-icon 
                    wire:model="form.amount"
                    label="Tagihan (otomatis)"
                    name="form.amount"
                    type="number"
                    icon="bi bi-cash"
                    readonly
                />
              </div>

              {{-- TANGGAL + CATATAN --}}
              <div class="col-md-6">
                <label class="form-label">Tanggal Bayar</label>
                <input
                    type="date"
                    wire:model.blur="form.date_paid"
                    class="form-control @error('form.date_paid') is-invalid @enderror"
                >

                @error('form.date_paid')
                  <div class="invalid-feedback fw-bold">{{ $message }}</div>
                @enderror

                <x-forms.textarea-with-icon 
                    class="mt-2"
                    label="Catatan"
                    name="form.transaction_note"
                    icon="bi bi-card-text"
                    wire:model.blur="form.transaction_note"
                />
              </div>

              {{-- UPLOAD BUKTI BAYAR --}}
              <div class="col-md-6"></div>
              <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Upload Bukti Bayar</label>
                <input
                    type="file"
                    wire:model="form.payment_proof"
                    class="form-control @error('form.payment_proof') is-invalid @enderror"
                    accept="image/*"
                >

                <div wire:loading wire:target="form.payment_proof" class="text-muted">
                  Mengupload file...
                </div>

                @error('form.payment_proof')
                  <div class="invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
</div>
