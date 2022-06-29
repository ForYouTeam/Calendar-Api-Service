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
                    <h1 class="card-title">Data Detaik Kegiatan</h1>
                    <div class="table-responsive">
                        <table class="table" id="tableData">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tempat</th>
                                    <th>Pakaian</th>
                                    <th>Penyelenggara</th>
                                    <th>Pejabatan Menghadiri</th>
                                    <th>Protokol</th>
                                    <th>Kopim</th>
                                    <th>Dokpim</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp
                                @foreach ($data['data']['detail'] as $d)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$d->tempat}}</td>
                                    <td>{{$d->pakaian}}</td>
                                    <td>{{$d->penyelenggara}}</td>
                                    <td>{{$d->pejabat_menghadiri}}</td>
                                    <td>{{$d->protokolRole->nama}}</td>
                                    <td>{{$d->kopimRole->nama}}</td>
                                    <td>{{$d->dokpimRole->nama}}</td>
                                    <td>
                                        <button type="button" data-id="{{ $d->id }}" id="btnEdit" data-toggle="modal"
                                            data-target="#modal-univ" class="btn btn-success btn-rounded btn-icon">
                                            <i class="typcn typcn-pencil"></i>
                                        </button>
                                        <button type="button" data-id="{{ $d->id }}" id="btnHapus"
                                            class="btn btn-danger btn-rounded btn-icon">
                                            <i class="typcn typcn-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <div class="row">
                        <div class="card-body col-md-12 m-auto">
                            <h2 class="card-title">Input Data Detail Kegiatan</h2>
                            <form class="forms-sample" id="formSimpan">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6 row">
                                        <label for="tempat" class="col-sm-3 col-form-label">Tempat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="tempat" name="tempat"
                                                placeholder="Input Tempat">
                                            <p class="text-danger miniAlert text-capitalize" id="alert-tempat"></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 row">
                                        <label for="pakaian" class="col-sm-3 col-form-label">Pakaian</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pakaian" name="pakaian"
                                                placeholder="Input Pakaian">
                                            <p class="text-danger miniAlert text-capitalize" id="alert-pakaian"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 row">
                                        <label for="penyelenggara" class="col-sm-3 col-form-label">Penyelenggara</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="penyelenggara"
                                                name="penyelenggara" placeholder="Input Penyelenggara">
                                            <p class="text-danger miniAlert text-capitalize" id="alert-penyelenggara">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 row">
                                        <label for="pejabat_menghadiri" class="col-sm-3 col-form-label">Pejabat
                                            Menghadiri</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="pejabat_menghadiri"
                                                name="pejabat_menghadiri" placeholder="Input Pejabat Menghadiri">
                                            <p class="text-danger miniAlert text-capitalize"
                                                id="alert-pejabat_menghadiri">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 row">
                                        <label class="col-sm-3 col-form-label">Protokol</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="protokol" name="protokol">
                                                <option selected disabled>Pilih</option>
                                                @foreach ($data['data']['pegawai'] as $d)
                                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger miniAlert text-capitalize" id="alert-protokol"></p>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 row">
                                        <label class="col-sm-3 col-form-label">Kopim</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="kopim" name="kopim">
                                                <option selected disabled>Pilih</option>
                                                @foreach ($data['data']['pegawai'] as $d)
                                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger miniAlert text-capitalize" id="alert-kopim"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group row col-6">
                                        <label class="col-sm-3 col-form-label">Dokpim</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="dokpim" name="dokpim">
                                                <option selected disabled>Pilih</option>
                                                @foreach ($data['data']['pegawai'] as $d)
                                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger miniAlert text-capitalize" id="alert-dokpim"></p>
                                        </div>
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
            let url = `{{ config('app.url') }}` + "/detail_kegiatan";
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
                        $('#alert-tempat').html(errorRes.data.tempat);
                        $('#alert-pakaian').html(errorRes.data.pakaian);
                        $('#alert-penyelenggara').html(errorRes.data.penyelenggara);
                        $('#alert-pejabat_menghadiri').html(errorRes.data.pejabat_menghadiri);
                        $('#alert-protokol').html(errorRes.data.protokol);
                        $('#alert-kopim').html(errorRes.data.kopim);
                        $('#alert-dokpim').html(errorRes.data.dokpim);
                    }
                }
            });
        });

        $(document).on('click', '#btnEdit', function() {
            let dataId = $(this).data('id');
            let url = `{{ config('app.url') }}` + "/detail_kegiatan/" + dataId;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(result) {
                    let data = result.data;
                    $('#modal-univ').modal('show');
                    $('.modal-title').html('Perubahan Data');
                    $('#form-univ').html('');
                    $('#form-univ').append(`
                    <div class="row">
                        <div class="form-group row col-6">
                            <label for="tempat" class="col-sm-3 col-form-label">Tempat</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" id="detail_id" name="id" value="`+data.id+`">
                                <input type="text" class="form-control" id="tempat" name="tempat" value="`+data.tempat+`">
                            </div>
                        </div>
                        <div class="form-group row col-6">
                            <label for="pakaian" class="col-sm-3 col-form-label">Pakaian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pakaian" name="pakaian"
                                value="`+data.pakaian+`">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-6">
                            <label for="penyelenggara" class="col-sm-3 col-form-label">Penyelenggara</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara"
                                value="`+data.penyelenggara+`">
                            </div>
                        </div>
                        <div class="form-group row col-6">
                            <label for="pejabat_menghadiri" class="col-sm-3 col-form-label">Pejabat
                                Menghadiri</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pejabat_menghadiri"
                                    name="pejabat_menghadiri" value="`+data.pejabat_menghadiri+`">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-6">
                            <label class="col-sm-3 col-form-label">Protokol</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="protokolEdit" name="protokol">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($data['data']['pegawai'] as $d)
                                    <option value="{{$d->id}}">{{$d->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-6">
                            <label class="col-sm-3 col-form-label">Kopim</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="kopimEdit" name="kopim">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($data['data']['pegawai'] as $d)
                                    <option value="{{$d->id}}">{{$d->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                   <div class="row">
                    <div class="form-group row col-6">
                        <label class="col-sm-3 col-form-label">Dokpim</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="dokpimEdit" name="dokpim">
                                <option selected disabled>Pilih</option>
                                @foreach ($data['data']['pegawai'] as $d)
                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   </div>
                `);
                    $('#protokolEdit').val(data.protokol);
                    $('#kopimEdit').val(data.kopim);
                    $('#dokpimEdit').val(data.dokpim);
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
            let dataId = $('#detail_id').val();
            let url = `{{ config('app.url') }}` + "/detail_kegiatan/" + dataId;
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
            let url = `{{ config('app.url') }}` + "/detail_kegiatan/" + dataId;
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