@extends('template.app')

@section('content')
    <div class="content">
        <div class="page-inner py-5 panel-header bg-primary-gradient">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h2 class="text-white pb-2 fw-bold">Pembayaran Kelas</h2>
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
                            <a href="{{ url('/pembayaran') }}" class="text-white">Data Pembayaran</a>
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
                            <h4 class="card-title">Detail Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Nama</label>
                                        <p>{{ $data->nama }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Tanggal Pembayaran</label>
                                        <p>{{ Helper::waktu($data->tanggal_bayar) }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Status</label>
                                        @if ($data->status_pembayaran == 'Pending')
                                            <p><button
                                                    class="btn btn-sm btn-warning">{{ $data->status_pembayaran }}</button>
                                            </p>
                                        @elseif($data->status_pembayaran == 'Diterima')
                                            <p><button
                                                    class="btn btn-sm btn-success">{{ $data->status_pembayaran }}</button>
                                            </p>
                                        @else
                                            <p><button class="btn btn-sm btn-danger">{{ $data->status_pembayaran }}</button>
                                            </p>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email2">Keterangan</label>
                                        <p>{{ $data->keterangan }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Jumlah Pembayaran</label>
                                        <p>{{ $data->jumlah_bayar }}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email2">Bukti Pembayaran</label>
                                        <p>
                                            <img src="{{ url('/' . $data->bukti_tf) }}" class="col-md-12" alt="" srcset="">
                                        </p>

                                    </div>

                                </div>

                            </div>


                        </div>
                        <div class="card-action mt-3 row">
                            <div class="col-md-6">
                                <form action="{{url('/pembayaran/'.$data->id_log)}}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="Confirmed" id="">
                                    <button type="submit" class="btn btn-success">Terima</button>
                                </form>
                            </div>
                            <div class="col-md-6 d-flex flex-row-reverse">
                                <form action="{{url('/pembayaran/'.$data->id_log)}}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="Ditolak" id="">
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
