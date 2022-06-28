@extends('layout.Base')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Striped Table</h4>
            <p class="card-description">
                Add class <code>.table-striped</code>
            </p>
            <div class="table-responsive">
                <table class="table table-striped" id="tableData">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Bagian</th>
                            <th>Jenis Kelamin</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <button type="button" class="btn btn-gradient-success btn-rounded btn-icon"><i
                                        class="mdi mdi-map-marker"></i></button>
                                <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon"><i
                                        class="mdi mdi-email-open"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
            $('#tableData').DataTable();
        })
</script>
@endsection