@extends('layouts.main')
@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-secondary">No</th>
                            <th class="text-secondary">ID Buku</th>
                            <th class="text-secondary">Judul</th>
                            <th class="text-secondary">Penulis</th>
                            <th class="text-secondary">Penerbit</th>
                            <th class="text-secondary">Sampul</th>
                            <th class="text-secondary">Kategori</th>
                            <th class="text-secondary">Stok</th>
                            <th class="text-secondary">Harga</th>
                            <th class="text-secondary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td><ul class="list-inline m-0">
                                    <li class="list-inline-item">
                                        <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editModal" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                        
                                    </li>
                                    <li class="list-inline-item">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- The Edit Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header ms-auto ms-md-0 me-3 me-lg-4">
                <h4 class="modal-title">Edit Buku</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="POST" action="function.php">
                <div class="modal-body">
                    <input type="text" name="id" value="" placeholder="id buku" class="form-control" required hidden>
                    <br>
                    <input type="text" name="judul" value="" placeholder="Judul" class="form-control" required>
                    <br>
                    <input type="text" name="penulis" value="" placeholder="Penulis" class="form-control" required>
                    <br>
                    <input type="text" name="penerbit" value="" placeholder="penerbit" class="form-control" required>
                    <br>
                    <input type="number" name="stok" value="" placeholder="Stok" class="form-control" required>
                    <br>
                    <input type="number" name="harga" value="" placeholder="Harga" class="form-control" required>
                    <br>
                    <input type="text" name="keterangan" value="" placeholder="Keterangan" class="form-control" required>
                    <br>
                    <input type="text" name="kategori" value="" placeholder="Kategori" class="form-control" required>
                    <br>
                    <input type="hidden" name="itemId" value="">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="updateItem" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
        