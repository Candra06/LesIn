@extends('template.app')

@section('content')
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Pmebayaran Kelas</h2>
                        <h5 class="text-white op-7 mb-2">List Data Pembayaran Kelas Siswa</h5>
                    </div>

                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            @if (session('status'))
                <script>
                    swal("Berhasil", "{{ session('status') }}!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                    });

                </script>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Jumlah Bayar</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td><a href="{{ url('/pembayaran/'.$item->id)}}">{{ $item->nama }}</a></td>
                                                <td>{{ $item->jumlah_bayar}}</td>
                                                <td>{{ $item->keterangan}}</td>
                                                <td>{{ Helper::waktu( $item->tanggal_bayar) }}</td>
                                                <td>{{ $item->status}}</td>
                                                <!-- <td >
                                                    <a href="{{ url('/siswa/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>

                                                </td> -->
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
@endsection
