@extends('layout.master')

@section('title', 'Edit Data Perbaikan')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Edit Perbaikan</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('perbaikan.update', $perbaikan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Laporan Perbaikan -->
            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Laporan Kerusakan <span class="required">*</span></label>
                <div class="col-md-6">
                    <select name="laporan_perbaikan_id" class="form-control" required>
                        <option value="">Pilih Laporan Kerusakan</option>
                        @foreach ($laporans as $laporan)
                            <option value="{{ $laporan->id }}" {{ $perbaikan->laporan_perbaikan_id == $laporan->id ? 'selected' : '' }}>
                                {{ $laporan->kode_laporan }} || {{ $laporan->mesin->nama_mesin }} || {{ $laporan->created_at }}
                            </option>
                        @endforeach
                    </select>
                    @error('laporan_perbaikan_id')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>

            <!-- mekanik -->
            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Mekanik</label>
                <div class="col-md-6">
                    <select name="mekanik_id" class="form-control">
                        <option value="">Pilih mekanik</option>
                        @foreach ($mekaniks as $mekanik)
                            <option value="{{ $mekanik->id }}" {{ $perbaikan->mekanik_id == $mekanik->id ? 'selected' : '' }}>
                                {{ $mekanik->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('mekanik_id')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>

            {{-- Keterangan --}}

            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Keterangan</label>
                <div class="col-md-6">
                    <textarea name="keterangan" class="form-control">{{ $perbaikan->keterangan }}</textarea>
                    @error('keterangan')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>


           <!-- Prioritas -->
            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Prioritas <span class="required">*</span></label>
                <div class="col-md-6">
                    <select name="prioritas" id="prioritas" class="form-control" required>
                        @foreach (['Low', 'Medium', 'High', 'Critical'] as $priority)
                            <option value="{{ $priority }}" {{ $perbaikan->prioritas == $priority ? 'selected' : '' }}>{{ $priority }}</option>
                        @endforeach
                    </select>
                    @error('prioritas')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>

            <!-- Tanggal Batas Pekerjaan -->
            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Tanggal Batas Pekerjaan</label>
                <div class="col-md-6">
                    <input readonly type="date" name="tanggal_pekerjaan" id="tanggal_pekerjaan" value="{{ $perbaikan->tanggal_pekerjaan }}" class="form-control">
                    @error('tanggal_pekerjaan')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>

            <!-- Lokasi -->
            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Lokasi</label>
                <div class="col-md-6">
                    <input type="text" name="lokasi" value="{{ $perbaikan->lokasi }}" class="form-control">
                    @error('lokasi')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>

         

            <!-- Status -->
            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Status</label>
                <div class="col-md-6">
                    <select name="status" id="status" class="form-control" required>
                        <option value="Menunggu" {{ $perbaikan->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Proses" {{ $perbaikan->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ $perbaikan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>

            <!-- Catatan dan Tanggal Selesai -->
            <div id="selesai_fields" style="display: none;">
                <!-- Catatan Selesai -->
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 label-align">Catatan Selesai</label>
                    <div class="col-md-6">
                        <textarea name="catatan_selesai" class="form-control">{{ $perbaikan->catatan_selesai }}</textarea>
                        @error('catatan_selesai')
                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                        @enderror
                    </div>
                </div>

                <!-- Tanggal Selesai -->
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 label-align">Tanggal Selesai</label>
                    <div class="col-md-6">
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ $perbaikan->tanggal_selesai }}" class="form-control">
                        @error('tanggal_selesai')
                            <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Upload Foto -->
            <div class="field item form-group">
                <label class="col-form-label col-md-3 label-align">Foto</label>
                <div class="col-md-6">
                    <input type="file" name="foto" class="form-control">
                    @if ($perbaikan->foto)
                        <img src="{{ asset($perbaikan->foto) }}" alt="Foto Perbaikan" class="mt-2" style="max-height: 150px;">
                    @endif
                    @error('foto')
                        <ul class="parsley-errors-list filled"><li>{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('perbaikan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const prioritasSelect = document.getElementById('prioritas');
        const tanggalInput = document.getElementById('tanggal_pekerjaan');
        const statusSelect = document.getElementById('status');
        const selesaiFields = document.getElementById('selesai_fields');
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');

        function toggleSelesaiFields() {
            if (statusSelect.value === 'Selesai') {
                selesaiFields.style.display = 'block';
                if (!tanggalSelesaiInput.value) {
                    const today = new Date().toISOString().split('T')[0];
                    tanggalSelesaiInput.value = today;
                }
            } else {
                selesaiFields.style.display = 'none';
                tanggalSelesaiInput.value = '';
            }
        }

        statusSelect.addEventListener('change', toggleSelesaiFields);
        toggleSelesaiFields();


        const updateTanggal = () => {
            const today = new Date();
            let daysToAdd = 0;

            switch (prioritasSelect.value) {
                case 'Critical':
                    daysToAdd = 2;
                    break;
                case 'High':
                    daysToAdd = 14;
                    break;
                case 'Medium':
                    daysToAdd = 30;
                    break;
                case 'Low':
                    daysToAdd = 90;
                    break;
            }

            // Hitung tanggal
            today.setDate(today.getDate() + daysToAdd);

            // Format YYYY-MM-DD
            const formattedDate = today.toISOString().split('T')[0];
            tanggalInput.value = formattedDate;
        };

        // Jalankan saat prioritas berubah
        prioritasSelect.addEventListener('change', updateTanggal);
    });
</script>

@endsection

