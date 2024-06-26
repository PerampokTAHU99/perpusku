@extends('layouts.main')
@section('container')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 text-primary">Data Pengembalian Pinjaman Buku</h1>
        <button type="button" data-target="#createModal" data-toggle="modal" class="btn btn-primary btn-capsule">+ Entry Data Pengembalian</button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-secondary">ID Pengembalian</th>
                            <th class="text-secondary">Peminjam</th>
                            <th class="text-secondary">Buku</th>
                            <th class="text-secondary">Tanggal Pengembalian</th>
                            <th class="text-secondary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPengembalian as $pengembalian)
                            <tr>
                                <td class="text-center">{{ $pengembalian->id_pengembalian }}</td>
                                <td>{{ $pengembalian->user->name }}</td>
                                <td>{{ $pengembalian->buku->judul }}</td>
                                <td>{{ $pengembalian->tgl_pengembalian }}</td>
                                <td>
                                    <div class="container text-center">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#deleteModal{{ $pengembalian->id_pengembalian }}" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal{{ $pengembalian->id_pengembalian }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Hapus Transaksi</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="{{ route('pengembalian.destroy', ['id' => $pengembalian->id_pengembalian]) }}">
                                            @csrf
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus transaksi dengan ID {{ $pengembalian->id_pengembalian }} ?
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
                <h4 class="modal-title">Pengembalian Buku</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="POST" action="{{ route('pengembalian.create') }}">
                @csrf
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label for="user">Peminjam</label>
                            <select class="form-control" name="id_user" id="user" required>
                                <option value="" selected> -- Pilih Peminjam -- </option>
                                @foreach ($listUser as $user)
                                    @if (in_array($user->id_user, $listPeminjamanUserIds))
                                        <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="buku-create">Buku</label>
                            <select class="form-control" name="id_buku-create" id="buku-create" required disabled>
                                <option value="" selected> -- Silahkan Pilih Peminjam Terlebih Dahulu -- </option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tgl-kembali">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" name="tgl_pengembalian" id="tgl-kembali" required>
                        </div>
                    </div>
                    <input type="hidden" id="id-peminjaman" name="id_peminjaman" value="" required>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', () => {
        const listUser = @json($listUser);
        console.log(listUser);
        const listBuku = @json($listBuku);
        const listPeminjamanAll = @json($listPeminjaman);
        const listPengembalian = @json($listPengembalian);
        const listPeminjaman = listPeminjamanAll.filter(peminjaman => !listPengembalian.some(pengembalian => peminjaman.id_peminjaman === pengembalian.id_peminjaman));

        const userDropdowns = document.querySelectorAll('#user');

        userDropdowns.forEach((dropdown) => {
            dropdown.addEventListener('change', (event) => {
                const selectedUser = listUser.find((user) => user.id_user === parseInt(event.target.value));
                const listPeminjamanByUser = listPeminjaman.filter((peminjaman) => peminjaman.id_user === selectedUser.id_user);
                const listBukuByUser = listBuku.filter((buku) => listPeminjamanByUser.some((peminjaman) => peminjaman.id_buku === buku.id_buku));

                const formOptionsBuku = document.getElementById('buku-create');

                formOptionsBuku.innerHTML = '';

                if (listBukuByUser.length === 0) {
                    formOptionsBuku.disabled = true;
                    formOptionsBuku.innerHTML = '<option value=""> -- Belum Meminjam Buku -- </option>';
                } else {
                    formOptionsBuku.disabled = false;
                    listBukuByUser.forEach((buku) => {
                        const option = document.createElement('option');
                        option.value = buku.id_buku;
                        option.textContent = buku.judul;
                        formOptionsBuku.appendChild(option);
                    });

                    const selectedPeminjaman = listPeminjamanByUser.find(
                        (peminjaman) => peminjaman.id_user === selectedUser.id_user && peminjaman.id_buku === parseInt(formOptionsBuku.value)
                    );
                    document.getElementById('id-peminjaman').value = selectedPeminjaman.id_peminjaman;

                    formOptionsBuku.addEventListener('change', (event) => {
                        const selectedPeminjaman = listPeminjamanByUser.find(
                            (peminjaman) => peminjaman.id_user === selectedUser.id_user && peminjaman.id_buku === parseInt(event.target.value)
                        );
                        document.getElementById('id-peminjaman').value = selectedPeminjaman.id_peminjaman;
                    });
                }
            })
        });
    });
</script>

@endsection
