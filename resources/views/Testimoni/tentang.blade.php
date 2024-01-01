@extends('template.master')

@section('content')
<style>
    /* CSS untuk animasi saat halaman dimuat */
    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Terapkan animasi pada elemen yang diinginkan */
    .container {
        animation: slideInUp 1s ease-in-out;
    }
</style>
<div class="container">
    <h3 class="my-4">Tentang Showroom Ini</h3>
    <div class="row">
        @foreach($testimonis as $testimoni)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm mx-auto" style="width: 28rem; margin-top: 20px;">
                <img src="{{ asset('storage/mobil/' . $testimoni->foto) }}" class="card-img-top" alt="...">

                <div class="card-body">
                    <h5 class="card-title">Nama Mobil: {{ $testimoni->nama_mobil }}</h5>
                    <p class="card-text">Merk: {{ $testimoni->merk }}</p>
                    <p class="card-text">Model: {{ $testimoni->model }}</p>
                    <p class="card-text">Tahun: {{ $testimoni->tahun }}</p>
                    <p class="card-text">Harga: {{ $testimoni->harga }}</p>
                    <a href="{{ route('testimoni.update', $testimoni->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $testimoni->id }}">
                        Lihat
                    </button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $testimoni->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Testimoni</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/mobil/' . $testimoni->foto) }}" class="img-fluid" alt="...">
                        <h5 class="card-title">Nama Mobil: {{ $testimoni->nama_mobil }}</h5>
                        <p></p>
                        <p class="card-text">Merk: {{ $testimoni->merk }}</p>
                        <p class="card-text">Model: {{ $testimoni->model }}</p>
                        <p class="card-text">Tahun: {{ $testimoni->tahun }}</p>
                        <p class="card-text">Harga: {{ $testimoni->harga }}</p>
                        <p class="card-text">Detail: {{ $testimoni->detail }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection