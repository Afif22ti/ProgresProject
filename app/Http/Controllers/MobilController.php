<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Mobil; 

class MobilController extends Controller
{

    public function index()
    {
        $mobils = Mobil::all();
        return view('mobil.index', compact('mobils'));
        if ($mobils->isEmpty()) {
            $message = "Belum ada data yang ditambahkan";
            return view('mobil.index', compact('message'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mobil' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tahun' => 'required|numeric',
            'foto' => 'required|image',
            'harga' => 'required|numeric',
            'detail' => 'required',
            'no_hp' => 'required|numeric',
            'status' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/mobil', $fileName);
        }

        $mobil = new Mobil();
        $mobil->nama_mobil = $validatedData['nama_mobil'];
        $mobil->merk = $validatedData['merk'];
        $mobil->model = $validatedData['model'];
        $mobil->tahun = $validatedData['tahun'];
        $mobil->foto = $fileName;
        $mobil->harga = $validatedData['harga'];
        $mobil->detail = $validatedData['detail'];
        $mobil->no_hp = $validatedData['no_hp'];
        $mobil->status = $validatedData['status'];
        $mobil->save();

        return redirect()->route('mobil.index')->with('success', 'Mobil berhasil ditambahkan');
    }

    public function create(Request $request)
    {

        return view('mobil.tambah');
        // Validasi request
        $request->validate([
            'nama_mobil' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tahun' => 'required|numeric',
            'foto' => 'required|image',
            'harga' => 'required|numeric',
            'detail' => 'required',
            'no_hp' => 'required|numeric',
            'status' => 'required',
        ]);

        
        $mobil = new Mobil();
        $mobil->nama_mobil = $request->nama_mobil;
        $mobil->merk = $request->merk;
        $mobil->model = $request->model;
        $mobil->tahun = $request->tahun;
        $mobil->harga = $request->harga;
        $mobil->detail = $request->detail;
        $mobil->no_hp = $request->no_hp;
        $mobil->status = $request->status;

       
        $fotoPath = $request->foto->store('mobil', 'public');
        $mobil->foto = $fotoPath;

        $mobil->save();

        return response()->json(['message' => 'Mobil berhasil ditambahkan'], 201);
    }

    public function edit($id)
    {
        $mobil = Mobil::find($id);
        return view('mobil.update', compact('mobil')); // Mengembalikan view 'edit'
    }

    public function show($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('mobil.update', compact('mobil'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_mobil' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tahun' => 'required|numeric',
            'harga' => 'required|numeric',
            'detail' => 'required',
            'no_hp' => 'required|numeric',
            'status' => 'required', 
        ]);

        $mobil = Mobil::findOrFail($id);
        $mobil->nama_mobil = $validatedData['nama_mobil'];
        $mobil->merk = $validatedData['merk'];
        $mobil->model = $validatedData['model'];
        $mobil->tahun = $validatedData['tahun'];
        $mobil->harga = $validatedData['harga'];
        $mobil->detail = $validatedData['detail'];
        $mobil->no_hp = $validatedData['no_hp']; 
        $mobil->status = $validatedData['status'];

        if ($request->hasFile('foto')) {
            Storage::delete($mobil->foto);
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/mobil', $fileName);
            $mobil->foto = $fileName;
        }

        $mobil->save();

        return redirect()->route('mobil.index')->with('success', 'Mobil berhasil diupdate');
    }

    public function destroy($id)
    {
        // Temukan mobil berdasarkan ID
        $mobil = Mobil::findOrFail($id);

        // Hapus foto dari storage
        Storage::delete($mobil->foto);

        // Hapus data mobil dari database
        $mobil->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('mobil.index')->with('success', 'Mobil berhasil dihapus');
    }

    public function showCards()
    {
        $mobils = Mobil::all();
        return view('mobil.cards', compact('mobils'));
        if ($mobils->isEmpty()) {
            $message = "Belum ada data yang ditambahkan";
            return view('mobil.index', compact('message'));
        }
    }

    public function dashboard()
    {
        $mobils = Mobil::all();
        return view('mobil.dashboard', compact('mobils'));
        if ($mobils->isEmpty()) {
            $message = "Belum ada data yang ditambahkan";
            return view('mobil.index', compact('message'));
        }
    }

    public function user()
    {
        $mobils = Mobil::all();
        return view('mobil.user', compact('mobils'));
        if ($mobils->isEmpty()) {
            $message = "Belum ada data yang ditambahkan";
            return view('mobil.index', compact('message'));
        }
    }

}
