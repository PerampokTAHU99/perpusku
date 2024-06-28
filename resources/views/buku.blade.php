@extends('layouts.main')
@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 text-primary">Data Buku</h1>
        <button type="button" data-target="#createModal" data-toggle="modal" class="btn btn-primary btn-capsule">+ Tambah Buku</button>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-secondary" style="max-width: 75px; word-wrap: break-word;">ID Buku</th>
                            <th class="text-secondary" style="max-width: 200px; word-wrap: break-word;">Judul</th>
                            <th class="text-secondary" style="max-width: 100px; word-wrap: break-word;">Penulis</th>
                            <th class="text-secondary" style="max-width: 100px; word-wrap: break-word;">Penerbit</th>
                            <th class="text-secondary">Sampul</th>
                            <th class="text-secondary">Kategori</th>
                            <th class="text-secondary">Stok</th>
                            <th class="text-secondary">Harga</th>
                            <th class="text-secondary" style="min-width: 100px; word-wrap: break-word;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listBuku as $buku)
                            <tr>
                                <td class="text-center" style="max-width: 50px; word-wrap: break-word;">{{ $buku->id_buku }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ $buku->penerbit }}</td>
                                <td>
                                    <div style="display: flex; justify-content: center;">
                                        <img id="book-cover" src="{{ $buku->sampul ? Storage::url($buku->sampul) : Storage::url('uploads/default.png') }}" alt="Cover" style="width: 150px; height: 200px; object-fit: contain;">
                                    </div>
                                </td>
                                <td>{{ $buku->kategori }}</td>
                                <td>{{ $buku->stok }}</td>
                                <td>Rp. {{ number_format($buku->harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="container text-center">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editModal{{ $buku->id_buku }}" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#deleteModal{{ $buku->id_buku }}" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $buku->id_buku }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Edit Buku</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="{{ route('buku.update', ['id' => $buku->id_buku]) }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body d-flex justify-content-between">
                                                <div>
                                                    <input type="text" name="id" value="{{ $buku->id_buku }}" placeholder="id buku" class="form-control" required hidden>
                                                    <br>
                                                    <input type="text" name="judul" value="{{ $buku->judul }}" placeholder="Judul" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="penulis" value="{{ $buku->penulis }}" placeholder="Penulis" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="penerbit" value="{{ $buku->penerbit }}" placeholder="penerbit" class="form-control" required>
                                                    <br>
                                                    <input type="number" name="stok" value="{{ $buku->stok }}" placeholder="Stok" class="form-control" required>
                                                    <br>
                                                    <input type="number" name="harga" value="{{ $buku->harga }}" placeholder="Harga" class="form-control" required>
                                                    <br>
                                                    <input type="text" name="keterangan" value="{{ $buku->keterangan }}" placeholder="Keterangan" class="form-control" required>
                                                    <br>
                                                    <select name="kategori" id="kategori" class="form-control">
                                                        <option value=""> -- Pilih Kategori -- </option>
                                                        @foreach (KATEGORI_BUKU as $kategori)
                                                            @if (isset($buku))
                                                                <option value="{{ $kategori }}" {{ $kategori == $buku->kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                                                            @else
                                                                <option value="{{ $kategori }}">{{ $kategori }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                </div>
                                                <div class="w-75">
                                                    <div class="container mt-1">
                                                        <div class="text-center p-5">
                                                            <div class="card">
                                                                @if (isset($buku))
                                                                    @if ($buku->sampul)
                                                                        <img id="book-cover" src="{{ Storage::url($buku->sampul) }}" class="w-100" alt="Cover {{ $buku->judul }}">
                                                                    @else
                                                                        <img id="book-cover" src="{{ Storage::url('uploads/default.png') }}" class="w-100" alt="Book Cover">
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <label class="custom-file-upload btn btn-secondary mt-5" id="upload-button">
                                                                <input type="file" name="sampul" id="sampul" accept="image/*">
                                                                Pilih Gambar
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" name="updateItem" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal{{ $buku->id_buku }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Hapus {{ $buku->judul }}</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="{{ route('buku.destroy', ['id' => $buku->id_buku]) }}">
                                            @csrf
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus buku {{ $buku->judul }} ?
                                                <br>
                                                <input type="hidden" name="bukuId" value="{{ $buku->id_buku }}">
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" name="deleteItem" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                <h4 class="modal-title">Tambah Buku</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="POST" action="{{ route('buku.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body d-flex justify-content-between">
                    <div>
                        <input type="text" name="judul" placeholder="Judul" class="form-control" required>
                        <br>
                        <input type="text" name="penulis" placeholder="Penulis" class="form-control" required>
                        <br>
                        <input type="text" name="penerbit" placeholder="penerbit" class="form-control" required>
                        <br>
                        <input type="number" name="stok" placeholder="Stok" class="form-control" required>
                        <br>
                        <input type="number" name="harga" placeholder="Harga" class="form-control" required>
                        <br>
                        <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required>
                        <br>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value=""> -- Pilih Kategori -- </option>
                            @foreach (KATEGORI_BUKU as $kategori)
                                <option value="{{ $kategori }}">{{ $kategori }}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <div class="w-75">
                        <div class="container mt-1">
                            <div class="text-center p-5">
                                <div class="card">
                                    <img id="book-cover" src="{{ Storage::url('uploads/default.png') }}" class="w-100" alt="Book Cover">
                                </div>
                                <label class="custom-file-upload btn btn-secondary mt-5" id="upload-button">
                                    <input type="file" name="sampul" id="sampul" accept="image/*">
                                    Pilih Gambar
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="createBuku" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const fileInputs = document.querySelectorAll('#sampul');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(event) {
            const file = event.target.files[0];
            console.log(event.target.files);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    input.parentNode.parentNode.querySelector('img').src = e.target.result;
                    input.value = file;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
