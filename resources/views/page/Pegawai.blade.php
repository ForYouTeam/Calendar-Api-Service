@extends('layout.Base')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#home">Data Tabel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#menu1">Formulir</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <h1 class="card-title">Data Pegawai</h1>
                    <div class="table-responsive">
                        <table class="table" id="tableData">
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
                                @php
                                $no=1;
                                @endphp
                                @foreach ($pegawai as $d)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$d->nama}}</td>
                                    <td>{{$d->nip}}</td>
                                    <td>{{$d->jabatan}}</td>
                                    <td>{{$d->bagian}}</td>
                                    <td>{{$d->jk}}</td>
                                    <td>
                                        <button type="button" data-id="{{ $d->id }}" id="btnEdit"
                                            class="btn btn-success">
                                            <i class="mdi mdi-pencil"></i></button>
                                        <button type="button" data-id="{{ $d->id }}" id="btnHapus"
                                            class="btn btn-danger">
                                            <i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <div class="row">
                        <div class="card-body col-md-8 m-auto">
                            <h2 class="card-title">Input Data Pegawai</h2>
                            <form class="forms-sample" id="formSimpan">
                                @csrf
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Input Nama Lengkap">
                                        <p class="text-danger miniAlert text-capitalize" id="alert-nama"></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nip" name="nip"
                                            placeholder="Input NIP">
                                        <p class="text-danger miniAlert text-capitalize" id="alert-nip"></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                                            placeholder="Input Jabatan">
                                        <p class="text-danger miniAlert text-capitalize" id="alert-jabatan"></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="bagian" name="bagian"
                                            placeholder="Input Bagian">
                                        <p class="text-danger miniAlert text-capitalize" id="alert-bagian"></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="jk" name="jk">
                                            <option selected disabled>Pilih</option>
                                            <option value="pria">Pria</option>
                                            <option value="wanita">Wanita</option>
                                        </select>
                                        <p class="text-danger miniAlert text-capitalize" id="alert-jk"></p>
                                    </div>
                                </div>
                                <button type="button" id="btnSimpan"
                                    class="btn btn-primary mr-2 float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#tableData').DataTable();

        $('#btnSimpan').on('click', function() {
            let url = `{{ config('app.url') }}` + "/pegawai";
            let data = $('#formSimpan').serialize();
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: function(result) {
                    Swal.fire({
                        title: result.response.title,
                        text: result.response.message,
                        icon: result.response.icon,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(result) {
                    let data = result.responseJSON
                    let errorRes = data.errors
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    });
                    if (errorRes.length >= 1) {
                        $('.miniAlert').html('');
                        $('#alert-nama').html(errorRes.data.nama);
                        $('#alert-nip').html(errorRes.data.nip);
                        $('#alert-jabatan').html(errorRes.data.jabatan);
                        $('#alert-bagian').html(errorRes.data.bagian);
                        $('#alert-jk').html(errorRes.data.jk);
                    }
                }
            });
        });

        $(document).on('click', '#btnEdit', function() {
            let dataId = $(this).data('id');
            let url = `{{ config('app.url') }}` + "/pegawai/" + dataId;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(result) {
                    let data = result.data;
                    $('#modal-univ').modal('show');
                    $('.modal-title').html('Perubahan Data');
                    $('#form-univ').html('');
                    $('#form-univ').append(`
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="pegawai_id" name="id" value="`+data.id+`">
                            <input type="text" class="form-control" id="nama" name="nama" value="`+data.nama+`">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip" name="nip" value="`+data.nip+`">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="`+data.jabatan+`">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bagian" class="col-sm-3 col-form-label">Bagian</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bagian" name="bagian" value="`+data.bagian+`">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="jkEdit" name="jk">
                                <option selected disabled>Pilih</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                            <p class="text-danger miniAlert text-capitalize" id="alert-jk"></p>
                        </div>
                    </div>
                `);
                    $('#jkEdit').val(data.jk);
                },
                error: function(result) {
                    let data = result.responseJSON
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    });
                }

            });
        });

        $('#btnUpdate').on('click', function() {
            let dataId = $('#pegawai_id').val();
            let url = `{{ config('app.url') }}` + "/pegawai/" + dataId;
            let data = $('#form-univ').serialize();
            let modalClose = () => {
                $('#modal-univ').modal('hide');
            }
            $.ajax({
                url: url,
                method: "patch",
                data: data,
                success: function(result) {
                    modalClose();
                    Swal.fire({
                        title: result.response.title,
                        text: result.response.message,
                        icon: result.response.icon,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(result) {
                    let data = result.responseJSON
                    modalClose();
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    });
                }
            });
        });

        $(document).on('click', '#btnHapus', function() {
            let dataId = $(this).data('id');
            let url = `{{ config('app.url') }}` + "/pegawai/" + dataId;
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data ini mungkin terhubung ke tabel yang lain!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'delete',
                        success: function(result) {
                            let data = result.data;
                            Swal.fire({
                                title: result.response.title,
                                text: result.response.message,
                                icon: result.response.icon,
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(result) {
                            let data = result.responseJSON
                            Swal.fire({
                                icon: data.response.icon,
                                title: data.response.title,
                                text: data.response.message,
                            });
                        }
                    });
                }
            })
        });
    })
</script>
@endsection