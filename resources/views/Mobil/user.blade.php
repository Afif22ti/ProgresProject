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
    <h3 class="my-4">Mobil Tersedia</h3>
    @if ($mobils->isEmpty())
    <p>Belum ada data yang ditambahkan.</p>
    @else
    <div class="row">
        @foreach($mobils as $mobil)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm mx-auto" style="width: 28rem; margin-top: 20px;">
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
                    <!-- Tombol "Lihat" -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $mobil->id }}">
                        Lihat
                    </button>
                    <!-- Tombol "Hubungi Penjual" -->
                    <button type="button" class="btn btn-warning{{ $mobil->status == 'Sold' ? ' disabled' : '' }}" data-bs-toggle="{{ $mobil->status == 'Sold' ? '' : 'modal' }}" data-bs-target="{{ $mobil->status == 'Sold' ? '' : '#hubungiPenjualModal' . $mobil->id }}" {{ $mobil->status == 'Sold' ? 'disabled' : '' }}>
                        Hubungi Penjual
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $mobil->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Mobil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/mobil/' . $mobil->foto) }}" class="img-fluid" alt="...">
                        <p class="card-text">
                            <span style="font-size: 20px; font-weight: bold; color: blue;">{{ $mobil->merk }} {{ $mobil->nama_mobil }}, {{ $mobil->model }}, {{ $mobil->tahun }}</span>
                        </p>
                        <p class="card-text" style="font-size: 15px; font-weight: bold;">Harga: {{ $mobil->harga }}</p>
                        <p class="card-text" style="font-size: 15px; font-weight: bold;">Detail: {{ $mobil->detail }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Hubungi Penjual -->
        <div class="modal fade" id="hubungiPenjualModal{{ $mobil->id }}" tabindex="-1" aria-labelledby="hubungiPenjualModalLabel{{ $mobil->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hubungiPenjualModalLabel{{ $mobil->id }}">Hubungi Penjual - {{ $mobil->nama_mobil }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="https://img.freepik.com/premium-vector/chat-bot-logo-smiling-virtual-assistant-bot-smiles-icon-logo-robot-head-with-headphones_843540-91.jpg?" style="width: 200px;">
                        <i class="fas fa-phone-alt fa-3x mb-2"></i>
                        <p style="font-weight: bold;">Kamu Ingin Menghubungi Penjual? Klik Nomor Di bawah Ini</p>
                        <p style="font-weight: semibold;">Saya berharap memberikan pelayanan terbaik terkait informasi mobil, dan bisa memberikan pengalaman yang memuaskan bagi setiap pelanggan.</p>
                        <button class="btn btn-primary btn-lg btn-block btn-copy-no-hp" data-no-hp="{{ $mobil->no_hp }}">{{ $mobil->no_hp }}</button>
                        <div class="alert alert-success d-none mt-3" role="alert" id="copiedAlert{{ $mobil->id }}">
                            Nomor Handphone telah disalin!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- JavaScript untuk menyalin nomor handphone saat tombol "Copy" diklik -->
        <script>
            var copyButtons = document.querySelectorAll('.btn-copy-no-hp');
            copyButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.stopPropagation(); // Menghentikan event propagation agar modal tidak tertutup
                    var noHp = this.getAttribute('data-no-hp');
                    navigator.clipboard.writeText(noHp).then(function() {
                        // Tampilkan pemberitahuan bahwa nomor handphone telah disalin
                        var alertElement = document.getElementById('copiedAlert{{ $mobil->id }}');
                        alertElement.classList.remove('d-none');
                        setTimeout(function() {
                            alertElement.classList.add('d-none');
                        }, 3000); // Sembunyikan pemberitahuan setelah 3 detik
                    }, function(err) {
                        console.error('Gagal menyalin nomor handphone: ', err);
                    });
                });
            });
        </script>
        @endforeach
    </div>
    @endif
</div>
@endsection