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
                    <h1 class="card-title">Data Kegiatan</h1>
                    <div class="table-responsive">
                        <table class="table" id="tableData">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal/Waktu</th>
                                    <th>Kegiatan</th>
                                    <th>Keterangan</th>
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
                                @foreach ($data['data']['kegiatan'] as $d)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$d->tgl}}</td>
                                    <td>{{$d->kegiatan}}</td>
                                    <td>{{$d->keterangan}}</td>
                                    <td>{{$d->kegiatanRole->tempat}}</td>
                                    <td>{{$d->kegiatanRole->pakaian}}</td>
                                    <td>{{$d->kegiatanRole->penyelenggara}}</td>
                                    <td>{{$d->kegiatanRole->pejabat_menghadiri}}</td>
                                    <td>{{$d->kegiatanRole->protokolRole->nama}}</td>
                                    <td>{{$d->kegiatanRole->kopimRole->nama}}</td>
                                    <td>{{$d->kegiatanRole->dokpimRole->nama}}</td>
                                    <td>
                                        <button type="button" data-id="{{ $d->id }}" id="btnEdit"
                                            class="btn btn-success" data-toggle="modal" data-target="#modal-univ">
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
                        <div class="card-body col-md-12 m-auto">
                            <h2 class="card-title">Input Data Kegiatan</h2>
                            <form class="forms-sample" id="formSimpan">
                                @csrf
                                <div class="form-group col-12 row">
                                    <label class="col-sm-3 col-form-label">Detail Kegiatan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="kegiatan_id" name="kegiatan_id">
                                            <option selected disabled>Pilih</option>
                                            @foreach ($data['data']['detail'] as $d)
                                            <option value="{{$d->id}}">{{$d->penyelenggara}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger miniAlert text-capitalize" id="alert-kegiatan_id"></p>
                                    </div>
                                </div>
                                <div class="form-group col-12 row">
                                    <label for="tgl" class="col-sm-3 col-form-label">Hari/Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" class="form-control" id="tgl" name="tgl"
                                            placeholder="Input Hari/Tanggal">
                                        <p class="text-danger miniAlert text-capitalize" id="alert-tgl"></p>
                                    </div>
                                </div>
                                <div class="form-group col-12 row">
                                    <label for="kegiatan" class="col-sm-3 col-form-label">Kegiatan</label>
                                    <textarea class="form-control col-sm-9" id="kegiatan" name="kegiatan"
                                        rows="4"></textarea>
                                    <p class="text-danger miniAlert text-capitalize" id="alert-kegiatan"></p>
                                </div>
                                <div class="form-group col-12 row">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <textarea class="form-control col-sm-9" id="keterangan" name="keterangan"
                                        rows="4"></textarea>
                                    <p class="text-danger miniAlert text-capitalize" id="alert-keterangan"></p>
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
            let url = `{{ config('app.url') }}` + "/kegiatan";
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
                        $('#alert-kegiatan_id').html(errorRes.data.kegiatan_id);
                        $('#alert-tgl').html(errorRes.data.tgl);
                        $('#alert-kegiatan').html(errorRes.data.kegiatan);
                        $('#alert-keterangan').html(errorRes.data.keterangan);
                    }
                }
            });
        });

        $(document).on('click', '#btnEdit', function() {
            let dataId = $(this).data('id');
            let url = `{{ config('app.url') }}` + "/kegiatan/" + dataId;
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
                        <input type="hidden" id="kegiatan1_id" name="id" value="`+data.id+`">
                        <label class="col-sm-3 col-form-label">Detail Kegiatan</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="kegiatanEdit" name="kegiatan_id">
                                <option selected disabled>Pilih</option>
                                @foreach ($data['data']['detail'] as $d)
                                <option value="{{$d->id}}">{{$d->penyelenggara}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl" class="col-sm-3 col-form-label">Hari/Tanggal</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" id="tglEdit" name="tgl">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kegiatan" class="col-sm-3 col-form-label">Kegiatan</label>
                        <textarea class="form-control col-sm-9" id="kegiatan" name="kegiatan" rows="4">`+data.kegiatan+`</textarea>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <textarea class="form-control col-sm-9" id="keterangan" name="keterangan"
                            rows="4">`+data.keterangan+`</textarea>
                    </div>
                `);
                    $('#kegiatanEdit').val(data.kegiatan_id);
                    $('#tglEdit').val(data.tgl);
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
            let dataId = $('#kegiatan1_id').val();
            let url = `{{ config('app.url') }}` + "/kegiatan/" + dataId;
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
            let url = `{{ config('app.url') }}` + "/kegiatan/" + dataId;
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