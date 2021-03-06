@extends('template.app')

@section('content')
    <div class="content">
        <div class="page-inner py-5 panel-header bg-primary-gradient">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h2 class="text-white pb-2 fw-bold">Tutor</h2>
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
                            <a href="{{url('/tentor')}}" class="text-white">Data Tutor</a>
                        </li>
                        <li class="separator text-white">
                            <i class="flaticon-right-arrow text-white"></i>
                        </li>
                        <li class="nav-item text-white">
                            <a href="#" class="text-white">Tambah Data</a>
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
                    <form action="{{ url('/tentor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email2">Nama</label>
                                            <input type="text" class="form-control  @error('nama') is-invalid @enderror"
                                                value="{{ old('nama') }}" name="nama" placeholder="Nama Lengkap">
                                            @error('nama')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Telepon</label>
                                            <input type="text" class="form-control  @error('telepon') is-invalid @enderror"
                                                name="telepon" placeholder="Nomor Telephone/WA"
                                                value="{{ old('telepon') }}">
                                            @error('telepon')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Gender</label>
                                            <select class="form-control  @error('gender') is-invalid @enderror"
                                                name="gender" id="exampleFormControlSelect1">
                                                <option value="">Pilih Gender</option>
                                                <option value="laki-laki"
                                                    {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="perempuan"
                                                    {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email2">Tanggal Lahir</label>
                                            <input type="date" value="{{ old('tgl_lahir') }}"
                                                class="form-control  @error('tgl_lahir') is-invalid @enderror"
                                                name="tgl_lahir">
                                            @error('tgl_lahir')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email2">Tarif</label>
                                            <input type="number" value="{{ old('tarif') }}" placeholder="Tarif Tutor"
                                                class="form-control  @error('tarif') is-invalid @enderror"
                                                name="tarif">
                                            @error('tarif')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Alamat</label>
                                            <textarea name="alamat" id="" cols="3"
                                                class="form-control  @error('alamat') is-invalid @enderror"
                                                rows="1">{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email2">Email</label>
                                            <input type="email" value="{{ old('email') }}"
                                                class="form-control  @error('email') is-invalid @enderror" name="email"
                                                placeholder="example@gmail.com">
                                            @error('email')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email2">Username</label>
                                            <input type="text" value="{{ old('username') }}"
                                                class="form-control  @error('email') is-invalid @enderror" name="username"
                                                placeholder="example@gmail.com">
                                            @error('username')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                name="password" placeholder="Password">
                                            @error('password')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Foto KTP</label>
                                            <input type="file" name="foto_ktp" id="input-file-now-custom-1"
                                                class="dropify @error('foto_ktp') is-invalid @enderror" required/>
                                                {{--
                                                data-default-file="../assets/plugins/dropify/src/images/test-image-1.jpg"
                                                --}}
                                            @error('foto_ktp')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Foto Diri</label>
                                            <input type="file" name="foto_diri" id="input-file-now-custom-1"
                                                class="dropify @error('foto_diri') is-invalid @enderror" required
                                                {{--
                                                data-default-file="../assets/plugins/dropify/src/images/test-image-1.jpg"
                                                --}} />
                                            @error('foto_diri')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-action mt-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();


            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });

    </script>
@endsection
