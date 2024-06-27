@extends('layouts.main')
@section('container')

<div class="container-fluid">
    <h1 class="h3 text-primary">Denda</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-secondary">ID Denda</th>
                            <th class="text-secondary">Nama Anggota</th>
                            <th class="text-secondary">Buku Dipinjam</th>
                            <th class="text-secondary">Tanggal Pinjam</th>
                            <th class="text-secondary">Tanggal Kembali</th>
                            <th class="text-secondary text-center">Sudah Lunas?</th>
                            <th class="text-secondary">Tanggal Denda Lunas</th>
                            <th class="text-secondary" style="min-width: 100px; word-wrap: break-word;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listDenda as $denda)
                            <tr>
                                <td class="text-center">{{ $denda->id_peminjaman }}</td>
                                <td>{{ $denda->user->name }}</td>
                                <td>{{ $denda->buku->judul }}</td>
                                <td>{{ $denda->peminjaman->tgl_pinjaman }}</td>
                                <td>{{ $denda->peminjaman->tgl_pengembalian }}</td>
                                <td class="text-center">
                                    @if ($denda->is_lunas)
                                        <i class="fa fa-check text-success"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($denda->is_lunas)
                                        {{ $denda->tgl_denda }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$denda->is_lunas)
                                        <div class="container text-center">
                                            <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#deleteModal{{ $denda->id_denda }}" data-placement="top" title="Tandai Denda Dibayar Lunas"><i class="fa fa-check"></i></button>
                                        </div>
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal{{ $denda->id_denda }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                                            <h4 class="modal-title">Tandai Lunas</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="POST" action="{{ route('denda.put', ['id' => $denda->id_denda]) }}">
                                            @csrf
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menandai denda dari <strong>{{ $denda->user->name }}</strong> sebagai lunas ?
                                                <br>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Lunas</button>
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

@endsection
