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
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableData">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Kegiatan</th>
                                        <th>Alamat</th>
                                        <th>Tgl/Waktu</th>
                                        <th style="width: 100px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data['data']['kegiatan'] as $d)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $d->nama_kegiatan }}</td>
                                            <td>{{ $d->kegiatanRole->tempat }}</td>
                                            <td>{{ date('d, F H:i', strtotime($d->tgl_mulai)) }} -
                                                {{ date('d, F Y H:i', strtotime($d->tgl_berakhir)) }}</td>
                                            <td>
                                                <button type="button" data-id="{{ $d->id }}"
                                                    id="btnInfo"class="btn btn-info btn-rounded btn-icon">
                                                    <i class="typcn typcn-info"></i>
                                                </button>
                                                <button type="button" data-id="{{ $d->id }}" data-detail="{{ $d->detail_kegiatan }}" id="btnHapus"
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
                                <form class="forms-sample" id="formSimpan" style="padding: 30px 120px">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="tempat" class="form-label">Nama Kegiatan</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="nama_kegiatan"
                                                    placeholder="Input Nama Kegiatan">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-nama_kegiatan">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label class="form-label">Tgl/Waktu Dimulai</label>
                                            <div class="">
                                                <input type="datetime-local" class="form-control" name="tgl_mulai"
                                                    value="{{ date('Y-m-d\\TH:i') }}">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-tgl_mulai"></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label class="form-label">Tgl/Waktu Berakhir</label>
                                            <div class="">
                                                <input type="datetime-local" class="form-control" name="tgl_berakhir"
                                                    value="{{ date('Y-m-d\\TH:i') }}">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-tgl_berakhir">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label class="form-label">Keterangan</label>
                                            <div class="">
                                                <textarea class="form-control" name="keterangan" placeholder="Keterangan Kegiatan" cols="30" rows="10"></textarea>
                                                <p class="text-danger miniAlert text-capitalize" id="alert-keterangan"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="tempat" class="form-label">Tempat</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="tempat" name="tempat"
                                                    placeholder="Input Tempat">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-tempat"></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="pakaian" class="form-label">Pakaian</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="pakaian" name="pakaian"
                                                    placeholder="Input Pakaian">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-pakaian"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="penyelenggara"
                                                    placeholder="Input Penyelenggara">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-penyelenggara">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="pejabat_menghadiri" class="form-label">Pejabat
                                                Menghadiri</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="penjabat_menghadiri"
                                                    name="penjabat_menghadiri" placeholder="Input Pejabat Menghadiri">
                                                <p class="text-danger miniAlert text-capitalize"
                                                    id="alert-pejabat_menghadiri">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="form-label">Protokol</label>
                                            <div class="">
                                                <select class="form-control" id="protokol" name="protokol">
                                                    <option selected disabled>Pilih</option>
                                                    @foreach ($data['data']['pegawai'] as $d)
                                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger miniAlert text-capitalize" id="alert-protokol"></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label class="form-label">Kopim</label>
                                            <div class="">
                                                <select class="form-control" id="kopim" name="kopim">
                                                    <option selected disabled>Pilih</option>
                                                    @foreach ($data['data']['pegawai'] as $d)
                                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger miniAlert text-capitalize" id="alert-kopim"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="form-label">Dokpim</label>
                                            <div class="">
                                                <select class="form-control" id="dokpim" name="dokpim">
                                                    <option selected disabled>Pilih</option>
                                                    @foreach ($data['data']['pegawai'] as $d)
                                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger miniAlert text-capitalize" id="alert-dokpim"></p>
                                            </div>
                                        </div>
                                        <div class=" col-6">
                                            <button type="button" id="btnSimpan" class="btn btn-primary mr-2 float-left"
                                                style="margin-top: 30px">Submit</button>
                                        </div>
                                    </div>
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
                            let data = errorRes.data;
                            $.each(data, function(i, value) {
                                $('#alert-' + i).html(value);
                            });
                        }
                    }
                });
            });

            $('#btnInfo').on('click', function() {
                let _id = $(this).data('id');
                let url = `{{ config('app.url') }}/kegiatan/${_id}`;

                $('.modal-title').html('Detail Kegiatan');
                $('#form-univ').html('');
                $('.modal-footer').css('padding-right', '180px');
                $('.modal-footer').css('padding-bottom', '30px');
                $('#btnUpdate').prop('disabled', true)
                $.get(url, function(result) {
                    
                    let data = result.data
                    console.log(data);
                    $('#form-univ').append(`
                    <div class="card" style="margin: 10px 170px; 70px">
                        <div class="row" style="padding: 20px 30px; 30px">
                            <div class="card-body col-sm-6">
                                <h4 class="card-title text-info">Detail & Perubahan Data</h4>
                                <p class="card-description text-danger">
                                    Perhatian
                                </p>
                                <p class="text-capitalize">
                                    perubahan data yang dilakukan akan merubah data jadwal yang telah disimpan di google calender.
                                </p>
                            </div>
                            <div class="col-sm-6" style="padding-right: 30px">
                                <button id="btn-enable" type="button" class="mt-4 float-right btn btn-sm btn-primary btn-icon-text">
                                Ubah Data <i class="typcn typcn-document btn-icon-append"></i>                          
                                </button>
                            </div>
                        </div>
                        <div class="row" style="padding: 10px 50px 50px">
                            <div class="form-group col-sm-6">
                                <label for="">Nama Kegiatan</label>
                                <input type="hidden" value="${data.id}" id="idKegiatan">
                                <input type="hidden" value="${data.detail_kegiatan}" name="detail_kegiatan">
                                <input value="${data.nama_kegiatan}" readonly type="text" class="form-control" id="" name="nama_kegiatan">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="">Tgl Mulai</label>
                                <input value="${data.tgl_mulai}" readonly type="datetime-local" class="form-control" id="" name="tgl_mulai">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="">Tgl Berakhir</label>
                                <input value="${data.tgl_berakhir}" readonly type="datetime-local" class="form-control" id="" name="tgl_berakhir">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="">Keterangan</label>
                                <textarea readonly class="form-control" id="" rows="4" name="keterangan">${data.keterangan}</textarea>
                                <hr>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tempat</label>
                                <input value="${data.kegiatan_role.tempat}" readonly type="text" class="form-control" id="" name="tempat">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Pakaian</label>
                                <input value="${data.kegiatan_role.pakaian}" readonly type="text" class="form-control" id="" name="pakaian">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Penyelenggara</label>
                                <input value="${data.kegiatan_role.penyelenggara}" readonly type="text" class="form-control" id="" name="penyelenggara">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Penjabat Menghadiri</label>
                                <input value="${data.kegiatan_role.penjabat_menghadiri}" readonly type="text" class="form-control" id="" name="penjabat_menghadiri">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">Protokol</label>
                                <select disabled class="form-control form-control-sm selectUpdate" id="editprotokol" name="protokol">
                                    <option selected disabled>-Pilih-</option>
                                    <option>-1-</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">Dokpim</label>
                                <select disabled class="form-control form-control-sm selectUpdate" id="editdokpim" name="dokpim">
                                    <option selected disabled>-Pilih-</option>
                                    <option>-1-</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">Kopim</label>
                                <select disabled class="form-control form-control-sm selectUpdate" id="editkopim" name="kopim">
                                    <option selected disabled>-Pilih-</option>
                                    <option>-1-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    `);
                    $('.selectUpdate').html(`
                        <option selected disabled>Pilih</option>
                        @foreach ($data['data']['pegawai'] as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    `);
                    let select3 = {
                        "protokol":data.kegiatan_role.protokol,
                        "dokpim":data.kegiatan_role.dokpim,
                        "kopim":data.kegiatan_role.kopim
                    }
                    $.each( select3, function(i, value){
                        $(`#edit`+i).val(value);
                    });
                    $('#modal-univ').modal('show');
                });
            });
        });
        $(document).on('click', '#btn-enable', function() {
            let checkPrimary = $(this).hasClass('btn-primary');
            if (!checkPrimary) {
                $(this).addClass('btn-primary') 
                $(this).removeClass('btn-dark') 
                $(this).html(`Ubah Data <i class="typcn typcn-document btn-icon-append"></i>`)
                $('#form-univ :input').prop('readonly', true)
                $('.selectUpdate').prop('disabled', true)
                $('#btnUpdate').prop('disabled', true)
            } else {
                $(this).addClass('btn-dark') 
                $(this).removeClass('btn-primary') 
                $(this).html(`Batal Ubah Data <i class="typcn typcn-document btn-icon-append"></i>`)
                $('#form-univ :input').prop('readonly', false)
                $('.selectUpdate').prop('disabled', false)
                $('#btnUpdate').prop('disabled', false)
            }
        });

        $(document).on('click', '#btnUpdate', function(){
            let _id = $('#idKegiatan').val();
            let url = `{{ config('app.url') }}/kegiatan/${_id}`;
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
            let _id = $(this).data('id');
            let id_detail = $(this).data('detail');
            let url = `{{ config('app.url') }}/kegiatan/${_id}/${id_detail}`;
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
    </script>
@endsection
