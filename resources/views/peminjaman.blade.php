@extends('layouts.main')
@section('container')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 text-primary">Data Peminjaman</h1>
        <button type="button" data-target="#createModal" data-toggle="modal" class="btn btn-primary btn-capsule">+ Entry Pinjaman Baru</button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-secondary">ID Peminjaman</th>
                            <th class="text-secondary">Peminjam</th>
                            <th class="text-secondary">Buku</th>
                            <th class="text-secondary">Tanggal Pinjam</th>
                            <th class="text-secondary">Tanggal Kembali</th>
                            <th class="text-secondary" style="min-width: 100px; word-wrap: break-word;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPeminjaman as $peminjaman)
                            <tr>
                                <td class="text-center">{{ $peminjaman->id_peminjaman }}</td>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->buku->judul }}</td>
                                <td>{{ $peminjaman->tgl_pinjaman }}</td>
                                <td>{{ $peminjaman->tgl_pengembalian }}</td>
                                <td>
                                    <div class="container text-center">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#updateModal{{ $peminjaman->id_peminjaman }}" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#deleteModal{{ $peminjaman->id_peminjaman }}" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="updateModal{{ $peminjaman->id_peminjaman }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Update Data Peminjaman</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="{{ route('peminjaman.update', ['id' => $peminjaman->id_peminjaman]) }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div>
                                                    <div class="form-group">
                                                        <label for="buku">Buku Yang Dipinjam</label>
                                                        <select class="form-control" name="id_buku" id="buku" value="{{ $peminjaman->buku->id_buku }}" required>
                                                            <option value=""> -- Pilih Buku -- </option>
                                                            @foreach ($listBuku as $buku)
                                                                <option value="{{ $buku->id_buku }}" {{ $peminjaman->buku->id_buku == $buku->id_buku ? 'selected' : '' }}>{{ $buku->judul }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="user">Peminjam</label>
                                                        <select class="form-control" name="id_user" id="user" value="{{ $peminjaman->user->id_user }}" required>
                                                            <option value=""> -- Pilih Peminjam -- </option>
                                                            @foreach ($listUser as $user)
                                                                <option value="{{ $user->id_user }}" {{ $peminjaman->user->id_user == $user->id_user ? 'selected' : '' }}>{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="tgl-pinjam">Tanggal Pinjam</label>
                                                        <input type="date" class="form-control" name="tgl_pinjaman" id="tgl-pinjam" value="{{ $peminjaman->tgl_pinjaman }}" required>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="tgl-kembali">Tanggal Pengembalian</label>
                                                        <input type="date" class="form-control" name="tgl_pengembalian" id="tgl-kembali" value="{{ $peminjaman->tgl_pengembalian }}" required>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="jml-pinjam">Jumlah Pinjaman</label>
                                                        <input type="number" class="form-control" name="jumlah_pinjaman" id="jml-pinjam" value="{{ $peminjaman->jumlah_pinjaman }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal{{ $peminjaman->id_peminjaman }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Hapus Transaksi</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="{{ route('peminjaman.destroy', ['id' => $peminjaman->id_peminjaman]) }}">
                                            @csrf
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus transaksi dengan ID {{ $peminjaman->id_peminjaman }} ?
                                                <br>
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

<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                <h4 class="modal-title">Tambah Data Peminjaman</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="POST" action="{{ route('peminjaman.create') }}">
                @csrf
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="buku">Buku Yang Dipinjam</label>
                            <select class="form-control" name="id_buku" id="buku" required>
                                <option value="" selected> -- Pilih Buku -- </option>
                                @foreach ($listBuku as $buku)
                                    <option value="{{ $buku->id_buku }}">{{ $buku->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="user">Peminjam</label>
                            <select class="form-control" name="id_user" id="user" required>
                                <option value="" selected> -- Pilih Peminjam -- </option>
                                @foreach ($listUser as $user)
                                    <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tgl-pinjam">Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjaman" id="tgl-pinjam" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tgl-kembali">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" name="tgl_pengembalian" id="tgl-kembali" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="jml-pinjam">Jumlah Pinjaman</label>
                            <input type="number" class="form-control" name="jumlah_pinjaman" id="jml-pinjam" required>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="createPeminjaman" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
