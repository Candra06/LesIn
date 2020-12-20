@extends('template.app')

@section('content')
    <div class="content">
        <div class="page-inner py-5 panel-header bg-primary-gradient">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h2 class="text-white pb-2 fw-bold">Data Kelas</h2>
                    <ul class="breadcrumbs">
                        <li class="nav-home text-white">
                            <a href="#">
                                <i class="flaticon-home text-white"></i>
                            </a>
                        </li>
                        <li class="separator text-white">
                            <i class="flaticon-right-arrow text-white"></i>
                        </li>
                        <li class="nav-item text-white">
                            <a href="{{ url('/kelas') }}" class="text-white">Data Kelas</a>
                        </li>
                        <li class="separator text-white">
                            <i class="flaticon-right-arrow text-white"></i>
                        </li>
                        <li class="nav-item text-white">
                            <a href="#" class="text-white">Detail Kelas</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="page-inner mt--5">
            @if (session('status'))
                <script>
                    swal("Gagal!", "{{ session('status') }}!", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                    });

                </script>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Info Kelas</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Mata Pelajaran</label>
                                        <p>{{ $data['kelas']['mapel'] }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Kelas</label>
                                        <p>{{ $data['kelas']['kelas'].' '.$data['kelas']['jenjang'] }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Status</label>
                                        <p>{{ $data['kelas']['status'] }}</p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Harga Deal</label>
                                        <p>Rp. {{ Helper::uang($data['kelas']['harga_deal']) }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Siswa</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Nama</label>
                                        <p>{{ $data['siswa']['nama'] }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Telepon</label>
                                        <p>{{ $data['siswa']['telepon'] }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Alamat</label>
                                        <p>{{$data['siswa']['alamat']}}</p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Email</label>
                                        <p>{{ $data['siswa']['email'] }}</p>
                                    </div>

                                </div>


                            </div>


                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Tentor</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Nama</label>
                                        <p>{{ $data['tentor']['nama'] }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Telepon</label>
                                        <p>{{ $data['tentor']['telepon'] }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Alamat</label>
                                        <p>{{$data['tentor']['alamat']}}</p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Email</label>
                                        <p>{{ $data['tentor']['email'] }}</p>
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>



                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pembayaran</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
													<th>Keterangan</th>
													<th>Jumlah Bayar</th>
													<th>Tanggal Bayar</th>
													<th>Status</th>
												</tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['pembayaran'] as $item)
                                                    <tr>
                                                        <td>{{$item->keterangan}}</td>
                                                        <td>Rp. {{Helper::uang($item->jumlah_bayar)}}</td>
                                                        <td>{{Helper::waktu( $item->tanggal_bayar)}}</td>
                                                        <td>{{$item->status}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Info Jadwal</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email2">Hari</label>
                                        <p>{{ $data['pertemuan']['hari'] }}</p>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Tarif</label>
                                        <p>Rp. {{ Helper::uang($data['pertemuan']['tarif']) }}</p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Jumlah Pertemuan</label>
                                        <p>{{ $data['pertemuan']['pertemuan'].'/'.$data['pertemuan']['jumlah_pertemuan'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
													<th>Hari</th>
													<th>Tanggal</th>
												</tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['jadwal'] as $item)
                                                    <tr>
                                                        <td>{{$item->hari}}</td>

                                                        <td>{{Helper::tanggal($item->tanggal)}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
