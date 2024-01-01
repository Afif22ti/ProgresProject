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
    <h2 class="my-4">Daftar Mobil</h2>
    <a href="{{ route('mobil.create') }}" class="btn btn-primary mb-3">Tambah Mobil Baru</a>
    @if ($mobils->isEmpty())
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
                @foreach ($mobils as $mobil)
                <tr>
                    <td>{{ $mobil->nama_mobil }}</td>
                    <td>{{ $mobil->merk }}</td>
                    <td>{{ $mobil->model }}</td>
                    <td>{{ $mobil->tahun }}</td>
                    <td><img src="{{ asset('storage/mobil/' . $mobil->foto) }}" alt="Foto Mobil" style="width: 100px;"></td>
                    <td>{{ $mobil->harga }}</td>
                    <td>{{ $mobil->detail }}</td>
                    <td>{{ $mobil->no_hp }}</td>
                    <td>{{ $mobil->status }}</td>
                    <td>
                        <a href="{{ route('mobil.update', $mobil->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('mobil.destroy', $mobil->id) }}" method="POST" class="d-inline">
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