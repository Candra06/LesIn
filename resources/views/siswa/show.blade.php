@extends('template.app')

@section('content')
    <div class="content">
        <div class="page-inner py-5 panel-header bg-primary-gradient">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h2 class="text-white pb-2 fw-bold">Siswa</h2>
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
                            <a href="{{url('/siswa')}}" class="text-white">Data Siswa</a>
                        </li>
                        <li class="separator text-white">
                            <i class="flaticon-right-arrow text-white"></i>
                        </li>
                        <li class="nav-item text-white">
                            <a href="#" class="text-white">Detail Data</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="page-inner mt--5">
            @if (session('status'))
                <script>
                    swal("Gagal!", "{{session('status')}}!", {
						icon : "error",
						buttons: {
							confirm: {
								className : 'btn btn-danger'
							}
						},
					});

                </script>
            @endif
            <div class="row">
                <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$data->nama}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Nama</label>
                                            <p>{{ $data->nama}}</p>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Telepon</label>
                                            <p>{{ $data->telepon}}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Gender</label>
                                            <p>{{ $data->gender == 'laki-laki' ? 'Laki-laki' : 'Perempuan' }}</p>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Tanggal Lahir</label>
                                            <p>{{ date('d F Y', strtotime($data->tgl_lahir)) }}</p>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Alamat</label>
                                        <p>{{ $data->alamat}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Email</label>
                                            <p>{{ $data->email }}</p>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Username</label>
                                            <p>{{ $data->username }}</p>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Status</label>
                                            <p>{{ $data->status }}</p>

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
