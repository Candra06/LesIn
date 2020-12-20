@extends('template.app')

@section('content')
    <div class="content">
        <div class="page-inner py-5 panel-header bg-primary-gradient">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h2 class="text-white pb-2 fw-bold">Data Rekening</h2>
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
                            <a href="{{ url('/rekening') }}" class="text-white">Data Rekening</a>
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
                    <form action="{{ url('/rekening') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Nomor Rekening</label>
                                            <input type="text" value="{{ old('nomor_rekening') }}"
                                                class="form-control  @error('nomor_rekening') is-invalid @enderror"
                                                name="nomor_rekening" placeholder="Nomor Rekening">
                                            @error('nomor_rekening')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Nama Rekening</label>
                                            <input type="text" value="{{ old('nama_rekening') }}"
                                                class="form-control  @error('nama_rekening') is-invalid @enderror"
                                                name="nama_rekening" placeholder="Nama Rekening">
                                            @error('nama_rekening')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Nama Bank</label>
                                            <input type="text" value="{{ old('bank') }}"
                                                class="form-control  @error('bank') is-invalid @enderror" name="bank"
                                                placeholder="Nama Bank">
                                            @error('bank')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Saldo</label>
                                            <input type="number" value="{{ old('saldo') }}"
                                                class="form-control  @error('saldo') is-invalid @enderror" name="saldo"
                                                placeholder="Saldo Rekening">
                                            @error('saldo')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                           <select name="status" class="form-control @error('status') is-invalid @enderror"  id="">
                                               <option value="">Pilih Status</option>
                                               <option value="Aktif" {{old('status') == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                               <option value="NonAktif" {{old('status') == 'NonAktif' ? 'selected' : ''}}>NonAktif</option>
                                           </select>
                                            @error('saldo')
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

    <script type="text/javascript">
        $(document).ready(function() {
            $("select#tingkatan").change(function() {
                var val = $(this).children("option:selected").val();
                if (val == 'SMP') {
                    $('#kelas').empty();
                    $('#kelas').append('<option value="" >Pilih Kelas</option>');
                    $('#kelas').append(
                        "<option value='7' {{ old('kelas') == '7' ? 'selected' : '' }}>7</option>");
                    $('#kelas').append(
                        "<option value='8' {{ old('kelas') == '8' ? 'selected' : '' }}>8</option>");
                    $('#kelas').append(
                        "<option value='9' {{ old('kelas') == '9' ? 'selected' : '' }}>9</option>");

                } else if (val == 'SD') {
                    $('#kelas').empty();
                    $('#kelas').append('<option value="" >Pilih Kelas</option>');
                    $('#kelas').append('<option value="1" >1</option>');
                    $('#kelas').append('<option value="2" >2</option>');
                    $('#kelas').append('<option value="3" >3</option>');
                    $('#kelas').append('<option value="4" >4</option>');
                    $('#kelas').append('<option value="5" >5</option>');
                    $('#kelas').append('<option value="6" >6</option>');

                } else if (val == 'SMA') {
                    $('#kelas').empty();
                    $('#kelas').append('<option value="" >Pilih Kelas</option>');
                    $('#kelas').append('<option value="10" >10</option>');
                    $('#kelas').append('<option value="11" >11</option>');
                    $('#kelas').append('<option value="12" >12</option>');
                }
            });
        });

    </script>
@endsection
