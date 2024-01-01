@extends('template.master')

@section('content')

<style>
    /* CSS untuk animasi saat halaman dimuat */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Terapkan animasi pada elemen yang diinginkan */
    .container {
        animation: fadeIn 1s ease-in-out;
    }
</style>
<div class="container">
    <h3>Edit Mobil</h3>

    <form action="{{ route('mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_mobil" class="form-label">Nama Mobil:</label>
            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="{{ $mobil->nama_mobil }}" required>
        </div>
        <div class="mb-3">
            <label for="merk" class="form-label">Merk:</label>
            <input type="text" class="form-control" id="merk" name="merk" value="{{ $mobil->merk }}" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model:</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ $mobil->model }}" required>
        </div>
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun:</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $mobil->tahun }}" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $mobil->harga }}" required>
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Detail:</label>
            <textarea class="form-control" id="detail" name="detail" required>{{ $mobil->detail }} </textarea>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No Handphone:</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ $mobil->no_hp }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ $mobil->status }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="javascript:history.back()" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection