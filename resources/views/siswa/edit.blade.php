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
                            <a href="#" class="text-white">Data Siswa</a>
                        </li>
                        <li class="separator text-white">
                            <i class="flaticon-right-arrow text-white"></i>
                        </li>
                        <li class="nav-item text-white">
                            <a href="#" class="text-white">Edit Data</a>
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
                    <form action="{{ url('/siswa/'.$data->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Nama</label>
                                        <input type="text" class="form-control" value="{{ $data->nama}}" name="nama" placeholder="Nama Lengkap">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Telepon</label>
                                            <input type="text"  value="{{ $data->telepon}}" class="form-control" name="telepon"
                                                placeholder="Nomor Telephone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Gender</label>
                                            <select class="form-control" name="gender" id="exampleFormControlSelect1">
                                                <option>Pilih Gender</option>
                                                <option value="laki-laki"  {{ $data->gender == 'laki-laki' ? 'selected' : ''}}>Laki-Laki</option>
                                                <option value="perempuan" {{ $data->gender == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Tanggal Lahir</label>
                                            <input type="date" value="{{ $data->tgl_lahir }}"class="form-control" name="tglLahir"
                                                placeholder="Enter Email">

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Alamat</label>
                                        <textarea name="alamat" id="" cols="3" class="form-control" rows="1">{{ $data->alamat}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Email</label>
                                            <input type="email" class="form-control" value="{{ $data->email }}" name="email"
                                                placeholder="example@gmail.com">

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Username</label>
                                            <input type="text" class="form-control" value="{{ $data->username }}" name="username"
                                                placeholder="Username">

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Username</label>
                                            <input type="email" class="form-control" value="{{ $data->username }}" name="email"
                                                placeholder="example@gmail.com">

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Status</label>
                                            <select class="form-control" name="status" id="exampleFormControlSelect1">
                                                <option>Pilih Status</option>
                                                <option value="Aktif"  {{ $data->status == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                                <option value="Banned" {{ $data->status == 'Banned' ? 'selected' : ''}}>Banned</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
