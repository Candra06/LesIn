@extends('template.app')

@section('content')
    <div class="content">
        <div class="page-inner py-5 panel-header bg-primary-gradient">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h2 class="text-white pb-2 fw-bold">Pencairan Saldo Dompet</h2>
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
                            <a href="{{ url('/gajiTentor') }}" class="text-white">Gaji Tentor</a>
                        </li>
                        <li class="separator text-white">
                            <i class="flaticon-right-arrow text-white"></i>
                        </li>
                        <li class="nav-item text-white">
                            <a href="#" class="text-white">Form Pencairan Saldo</a>
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
                    <form action="{{ url('/pencairan/'.$data->id) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pencairan Saldo</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Saldo saat ini : </label>
                                        <h1>Rp. {{ Helper::uang($data->saldo_dompet) }}</h1>
                                        <input type="hidden" name="saldo" value="{{$data->saldo_dompet}}">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Nominal Pencairan</label>
                                            <input type="number" value="{{ old('nominal') }}"
                                                class="form-control  @error('nominal') is-invalid @enderror" name="nominal"
                                                placeholder="Nominal Pencairan">
                                            @error('nominal')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" value="{{ old('keterangan') }}"
                                                class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan"
                                                placeholder="Keterangan">
                                            @error('keterangan')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-action mt-3">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-danger">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
