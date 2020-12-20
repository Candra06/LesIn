@extends('template.app')

@section('content')
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Kelas</h2>
                        <h5 class="text-white op-7 mb-2">Rekap Data Kelas</h5>
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
                            <h4 class="card-title">Data Kelas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Tentor</th>
                                            <th>Harga Deal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                {{-- <td><a href="{{ url('/siswa/'.$item->id)}}">{{ $item->nama }}</a></td> --}}
                                                <td>{{ $item->siswa}}</td>
                                                <td>{{ $item->tentor}}</td>
                                                <td>Rp. {{  Helper::uang($item->harga_deal)}}</td>
                                                <td>{{ $item->status}}</td>
                                                <td >
                                                    <a href="{{ url('/kelas/'.$item->id)}}" class="btn btn-xs btn-primary">Detail</a>

                                                </td>
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
