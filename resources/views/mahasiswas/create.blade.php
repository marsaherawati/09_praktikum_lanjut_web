@extends('mahasiswas.layout')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Tambah Mahasiswa
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your i
                            nput.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('mahasiswas.store') }}" id="myForm">
                        @csrf
                        <div class="form-group">
                            <label for="nim">nim</label>
                            <input type="text" name="nim" class="form-control" id="nim" aria-describedby="nim">
                        </div>
                        <div class="form-group">
                            <label for="nama">nama</label>
                            <input type="nama" name="nama" class="form-control" id="nama"
                                aria-describedby="nama">
                        </div>
                        <div class="form-group">
                            <label for="kelas">kelas</label>
                            <select class="form-control" name="kelas">
                                <option value="">Pilih kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jurusan">jurusan</label>
                            <input type="jurusan" name="jurusan" class="form-control" id="jurusan"
                                aria-describedby="jurusan">
                        </div>
                        <div class="form-group">
                            <label for="no_handphone">no_handphone</label>
                            <input type="no_handphone" name="no_handphone" class="form-control" id="no_handphone"
                                aria-describedby="no_handphone">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                aria-describedby="email">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">tanggal_lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                aria-describedby="tanggal_lahir">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
