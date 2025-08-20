@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <table class="table table-bordered table-striped" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kegiatan</th>
                            <th>kontraktor</th>
                            <th>Konsultan</th>
                            <th>PPK</th>
                            <th style="width: 13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_umums as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td class="text-uppercase">{{$data->nm_paket}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="flex space-x-1 space-y-2 justify-center">
                                    <a href="#" class="btn btn-mat btn-success waves-effect waves-light">
                                        <i class="bx bx-search-alt-2"></i>
                                    </a>    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 

@section('scripts')

@endsection