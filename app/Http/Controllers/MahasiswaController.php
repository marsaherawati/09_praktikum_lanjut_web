<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('nim', 'desc')->paginate(6);
        // return view('mahasiswas.index', compact('mahasiswas'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        // $kelas = Mahasiswa::with('kelas')->get();
        // dd($kelas);
        $keyword = $request->input('nama');

        if ($keyword) {
            $mahasiswas = Mahasiswa::with('kelas')->where('nama', 'like', '%' . $keyword . '%')->paginate(5);
        } else {
            // $mahasiswas = Mahasiswa::paginate(5);
            $mahasiswas = Mahasiswa::with('kelas')->paginate(5);
        }

        return view('mahasiswas.index', ['mahasiswas' => $mahasiswas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = kelas::all();
        return view('mahasiswas.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        // //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->input('nim');
        $mahasiswa->nama = $request->input('nama');
        $mahasiswa->jurusan = $request->input('jurusan');
        $mahasiswa->no_handphone = $request->input('no_handphone');
        $mahasiswa->email = $request->input('email');
        $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');
        $mahasiswa->save();

        $kelas = new kelas;
        $kelas->id = $request->input('kelas');

        //fungsi  eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //menampilkan detail data dengan menemukan/berdasarkan nim Mahasiswa
        // $Mahasiswa = Mahasiswa::find($nim);
        // $Mahasiswa = $mahasiswa;

        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $mahasiswa->nim)->first();

        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //menampilkan detail data dengan menemukan berdasarkan nim Mahasiswa untuk diedit
        // $Mahasiswa = $mahasiswa;

        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $mahasiswa->nim)->first();
        $kelas = kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::where('nim', $mahasiswa->nim)->update($request->all());
        // dd($request->all(), $mahasiswa_update, $mahasiswa);

        // $mahasiswa->nim = $request->nim;
        // $mahasiswa->nama = $request->nama;
        // $mahasiswa->kelas = $request->kelas;
        // $mahasiswa->jurusan = $request->jurusan;
        // $mahasiswa->no_handphone = $request->no_handphone;
        // $mahasiswa->email = $request->email;
        // $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        // $mahasiswa->save();

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $mahasiswa->nim)->first();
        $mahasiswa->nim = $request->input('nim');
        $mahasiswa->nama = $request->input('nama');
        $mahasiswa->jurusan = $request->input('jurusan');
        $mahasiswa->no_handphone = $request->input('no_handphone');
        $mahasiswa->email = $request->input('email');
        $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');
        $mahasiswa->save();

        $kelas = new kelas;
        $kelas->id = $request->input('kelas');

        //fungsi  eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect('mahasiswas')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //fungsi eloquent untuk menghapus data
        // Mahasiswa::find($mahasiswa->nim)->delete();
        $mahasiswa->delete();
        return redirect('mahasiswas')->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
    }
}
