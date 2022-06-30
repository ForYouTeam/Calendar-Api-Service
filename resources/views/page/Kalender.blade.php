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
                        <h4 class="card-title">Tabel Kalender Kegiatan</h4>
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableData">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Acara</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Berakhir</th>
                                        <th>Lokasi</th>
                                        <th>Deskripsi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->startDate }}</td>
                                            <td>{{ $d->endDate }}</td>
                                            <td>{{ $d->location }}</td>
                                            <td>{{ $d->description }}</td>
                                            <td>
                                                <button id="btn-edit" type="button"
                                                    class="btn btn-gradient-success btn-rounded btn-icon"><i
                                                        class="mdi mdi-map-marker"></i></button>
                                                <button id="btn-hapus" type="button"
                                                    class="btn btn-gradient-danger btn-rounded btn-icon"><i
                                                        class="mdi mdi-email-open"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <div class="row">
                            <div class="card-body" style="padding: 30px 120px">
                                <h2 class="card-title">Atur Acara</h2>
                                <form class="forms-sample" id="formSimpan">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="name" class="form-label">Nama Acara</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Input Nama Acara">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-nama"></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nip" class="form-label">Tanggal dan Waktu Dimulai</label>
                                            <div class="">
                                                <input type="datetime-local" class="form-control" id="startDate"
                                                    value="{{ date('Y-m-d\\TH:i') }}" name="startDate">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-startDate"></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nip" class="form-label">Tanggal dan Waktu Berakhir</label>
                                            <div class="">
                                                <input type="datetime-local" class="form-control" id="endDate"
                                                    value="{{ date('Y-m-d\\TH:i') }}" name="endDate">
                                                <p class="text-danger miniAlert text-capitalize" id="alert-endDate"></p>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="location" class="form-label">Lokasi Acara</label>
                                            <div class="">
                                                <textarea name="location" class="form-control" cols="30" rows="10" placeholder="Masukan lokasi acara"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="location" class="form-label">Deskripsi Acara</label>
                                            <div class="">
                                                <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Deskripsi Acara"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" id="btnSimpan"
                                                class="btn btn-primary mr-2 float-right">Submit</button>
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
            $('#tableData').DataTable();
        })
    </script>
@endsection
