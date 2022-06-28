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
<div class="col-md-8 grid-margin stretch-card"><div class="card"><div class="card-body"><div class="row"><div class="col-md-7"><h4 class="card-title">Icon Buttons</h4><p class="card-description">Add class <code>.btn-icon</code> for buttons with only icons</p><div class="template-demo d-flex justify-content-between flex-nowrap"><button type="button" class="btn btn-gradient-primary btn-rounded btn-icon"><i class="mdi mdi-home-outline"></i></button><button type="button" class="btn btn-gradient-dark btn-rounded btn-icon"><i class="mdi mdi-internet-explorer"></i></button><button type="button" class="btn btn-gradient-danger btn-rounded btn-icon"><i class="mdi mdi-email-open"></i></button><button type="button" class="btn btn-gradient-info btn-rounded btn-icon"><i class="mdi mdi-star"></i></button><button type="button" class="btn btn-gradient-success btn-rounded btn-icon"><i class="mdi mdi-map-marker"></i></button></div><div class="template-demo d-flex justify-content-between flex-nowrap"><button type="button" class="btn btn-inverse-primary btn-rounded btn-icon"><i class="mdi mdi-home-outline"></i></button><button type="button" class="btn btn-inverse-dark btn-icon"><i class="mdi mdi-internet-explorer"></i></button><button type="button" class="btn btn-inverse-danger btn-icon"><i class="mdi mdi-email-open"></i></button><button type="button" class="btn btn-inverse-info btn-icon"><i class="mdi mdi-star"></i></button><button type="button" class="btn btn-inverse-success btn-icon"><i class="mdi mdi-map-marker"></i></button></div><div class="template-demo d-flex justify-content-between flex-nowrap mt-4"><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-heart-outline text-danger"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-music text-dark"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-star text-primary"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-signal text-info"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-trending-up text-success"></i></button></div><div class="template-demo d-flex justify-content-between flex-nowrap"><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-heart-outline"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-music"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-star"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-signal"></i></button><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon"><i class="mdi mdi-trending-up"></i></button></div></div><div class="col-md-5"><h4 class="card-title">Button Size</h4><p class="card-description">Use class <code>.btn-{size}</code></p><div class="template-demo"><button type="button" class="btn btn-outline-secondary btn-lg">btn-lg</button><button type="button" class="btn btn-outline-secondary btn-md">btn-md</button><button type="button" class="btn btn-outline-secondary btn-sm">btn-sm</button></div><div class="template-demo mt-4"><button type="button" class="btn btn-gradient-danger btn-lg">btn-lg</button><button type="button" class="btn btn-gradient-success btn-md">btn-md</button><button type="button" class="btn btn-gradient-primary btn-sm">btn-sm</button></div></div></div></div></div></div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
            $('#tableData').DataTable();
        })
</script>
@endsection