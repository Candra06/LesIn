@extends('template.app')

@section('content')
    <div class="content">
        <div class="page-inner py-5 panel-header bg-primary-gradient">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h2 class="text-white pb-2 fw-bold">Data Mengajar</h2>
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
                            <a href="{{url('/dataMengajar')}}" class="text-white">Data Mengajar</a>
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
                    <form action="{{ url('/dataMengajar') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email2">Tutor</label>
                                            <select class="form-control @error('tentor') is-invalid @enderror"
                                                name="tentor">
                                                <option value="">Pilih Tutor</option>
                                                @foreach ($tentor as $tn)
                                                    <option value="{{ $tn->id }}" {{old('tentor') == $tn->id ? 'selected' : ''}}>{{ $tn->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('tentor')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Mata Pelajaran</label>
                                            <select class="form-control @error('mapel') is-invalid @enderror" name="mapel"
                                                id="exampleFormControlSelect1">
                                                <option value="">Pilih Mapel</option>
                                                @foreach ($mapel as $tn)
                                                    <option value="{{ $tn->id }}" {{old('mapel') == $tn->id ? 'selected' : ''}}>
                                                        {{ $tn->mapel . ' ' . $tn->jenjang . '(' . $tn->kelas . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('mapel')
                                                <label class="mt-1" style="color: red">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status"
                                                id="exampleFormControlSelect1">
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif" {{old('status') == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                                <option value="Banned" {{old('status') == 'Banned' ? 'selected' : ''}}>Tidak Aktif</option>
                                            </select>
                                            @error('status')
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
@endsection
