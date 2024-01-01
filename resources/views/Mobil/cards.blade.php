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

    /* CSS untuk label status */
    .status-label {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
        z-index: 1;
        /* Untuk memastikan label muncul di atas gambar */
    }

    .status-available {
        background-color: green;
    }

    .status-sold {
        background-color: red;
    }
</style>
<div class="container">
    <h3 class="my-4">Mobil yang Diupload</h3>
    @if ($mobils->isEmpty())
    <p>Belum ada data yang ditambahkan.</p>
    @else
    <div class="row">
        @foreach($mobils as $mobil)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm mx-auto" style="width: 28rem; margin-top: 20px; position: relative;">
                @if ($mobil->status == 'Tersedia')
                <div class="status-label status-available">Tersedia</div>
                @else
                <div class="status-label status-sold">Sold</div>
                @endif
                <img src="{{ asset('storage/mobil/' . $mobil->foto) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">
                        <span style="font-size: 20px; font-weight: bold; color: blue;">{{ $mobil->merk }} {{ $mobil->nama_mobil }}, {{ $mobil->model }}, {{ $mobil->tahun }}</span>
                    </p>
                    <p class="card-text" style="font-size: 15px; font-weight: bold;">Harga: {{ $mobil->harga }}</p>
                    <p class="card-text" style="font-size: 15px; font-weight: bold;">Detail: {{ $mobil->detail }}</p>
                    <p class="card-text" style="font-size: 15px; font-weight: bold;">No Handphone: {{ $mobil->no_hp }}</p>
                    <a href="{{ route('mobil.update', $mobil->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $mobil->id }}">
                        Lihat
                    </button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $mobil->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" >Detail Mobil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($mobil->status == 'Tersedia')
                        <div class="status-label status-available" style="margin-left: 15px;">Tersedia</div>
                        @else
                        <div class="status-label status-sold" style="margin-left: 15px;">Sold</div>
                        @endif
                        <img src="{{ asset('storage/mobil/' . $mobil->foto) }}" class="img-fluid" alt="...">
                        <p class="card-text">
                            <span style="font-size: 20px; font-weight: bold; color: blue;">{{ $mobil->merk }} {{ $mobil->nama_mobil }}, {{ $mobil->model }}, {{ $mobil->tahun }}</span>
                        </p>
                        <p class="card-text" style="font-size: 15px; font-weight: bold;">Harga: {{ $mobil->harga }}</p>
                        <p class="card-text" style="font-size: 15px; font-weight: bold;">Detail: {{ $mobil->detail }}</p>
                        <p class="card-text" style="font-size: 15px; font-weight: bold;">No Handphone: {{ $mobil->no_hp }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection