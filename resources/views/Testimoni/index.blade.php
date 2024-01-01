<!-- testimoni.index.blade.php -->
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
    <h2 class="my-4">Daftar Testimoni Penjualan Mobil</h2>
    <a href="{{ route('testimoni.create') }}" class="btn btn-primary mb-3">Tambah Testimoni Baru</a>
    @if ($testimonis->isEmpty())
    <p>Belum ada data yang ditambahkan.</p>
    @else
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Mobil</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Tahun</th>
                    <th>Foto</th>
                    <th>Harga</th>
                    <th>Detail</th>
                    <th>No Handphone</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testimonis as $testimoni)
                <tr>
                    <td>{{ $testimoni->nama_mobil }}</td>
                    <td>{{ $testimoni->merk }}</td>
                    <td>{{ $testimoni->model }}</td>
                    <td>{{ $testimoni->tahun }}</td>
                    <td><img src="{{ asset('storage/mobil/' . $testimoni->foto) }}" alt="Foto Mobil" style="width: 100px;"></td>
                    <td>{{ $testimoni->harga }}</td>
                    <td>{{ $testimoni->detail }}</td>
                    <td>{{ $testimoni->no_hp }}</td>
                    <td>{{ $testimoni->status }}</td>
                    <td>
                        <a href="{{ route('testimoni.update', $testimoni->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('testimoni.destroy', $testimoni->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection