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
        });
    </script>
@endsection
