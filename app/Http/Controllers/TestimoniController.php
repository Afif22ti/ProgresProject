<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Testimoni; // Menggunakan model Testimoni
use PHPUnit\Framework\Test;
use App\Models\Mobil;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::all(); // Mengambil semua data testimoni dari model Testimoni

        return view('testimoni.index', compact('testimonis'));
        if ($testimonis->isEmpty()) {
            $message = "Belum ada data yang ditambahkan";
            return view('testimoni.index', compact('message'));
        }

    }

    public function create(Request $request)
    {

        return view('testimoni.tambah');
        // Validasi request
        $request->validate([
            'nama_mobil' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tahun' => 'required|numeric',
            'harga' => 'required|numeric',
            'detail' => 'required',
            'no_hp' => 'required|numeric',
            'status' => 'required', 
        ]);

        // Simpan data mobil baru ke dalam database
        $testimoni = new Testimoni();
        $testimoni->nama_mobil = $request->nama_mobil;
        $testimoni->merk = $request->merk;
        $testimoni->model = $request->model;
        $testimoni->tahun = $request->tahun;
        $testimoni->harga = $request->harga;
        $testimoni->detail = $request->detail;
        $testimoni->no_hp = $request->no_hp;
        $testimoni->status = $request->status;

        // Simpan foto mobil ke dalam storage (misalnya menggunakan disk 'public')
        $fotoPath = $request->foto->store('mobil', 'public');
        $testimoni->foto = $fotoPath;

        $testimoni->save();

        return response()->json(['message' => 'Testimoni berhasil ditambahkan'], 201);
    }

    public function store(Request $request)
    {
        $testimoni = new Testimoni();
        $testimoni->nama_mobil = $request->input('nama_mobil');
        $testimoni->merk = $request->input('merk');
        $testimoni->model = $request->input('model');
        $testimoni->tahun = $request->input('tahun');
        // Simpan foto dan dapatkan path-nya, kemudian simpan path-nya ke dalam kolom foto
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/mobil');
            $testimoni->foto = basename($path);
        }
        $testimoni->harga = $request->input('harga');
        $testimoni->detail = $request->input('detail');
        $testimoni->no_hp = $request->input('no_hp');
        $testimoni->status = $request->input('status');
        $testimoni->save();

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function show($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        return view('testimoni.update', compact('testimoni'));
    }

    public function edit($id)
    {
        $testimoni = Testimoni::find($id);
        return view('testimoni.update', compact('testimonis')); // Mengembalikan view 'edit'
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nama_mobil' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tahun' => 'required|numeric',
            'harga' => 'required|numeric',
            'detail' => 'required',
            'no_hp' => 'required|numeric',
            'status' => 'required', 
            
        ]);

        // Temukan mobil berdasarkan ID
        $testimoni = Testimoni::findOrFail($id);

        // Update data mobil
        $testimoni->nama_mobil = $request->nama_mobil;
        $testimoni->merk = $request->merk;
        $testimoni->model = $request->model;
        $testimoni->tahun = $request->tahun;
        $testimoni->harga = $request->harga;
        $testimoni->detail = $request->detail;
        $testimoni->no_hp = $request->no_hp;
        $testimoni->status = $request->status;

        // Jika ada foto baru, simpan foto baru dan hapus foto lama
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            Storage::disk('public')->delete($testimoni->foto);

            // Simpan foto baru
            $fotoPath = $request->foto->store('mobil', 'public');
            $testimoni->foto = $fotoPath;
        }

        $testimoni->save();

        return redirect()->route('testimoni.index', $id)->with('success', 'Testimoni berhasil diupdate');
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus');
    }

    public function showCards()
    {
        $testimonis = Testimoni::all();
        
        return view('testimoni.cards', compact('testimonis'));
        if ($testimonis->isEmpty()) {
            $message = "Belum ada data yang ditambahkan";
            return view('testimoni.index', compact('message'));
        }
    }

    public function tentang()
    {
        $testimonis = Testimoni::all(); // Mengambil semua data testimonial
        return view('testimoni.tentang', compact('testimonis'));
    }
}
