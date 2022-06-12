@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>DATA ANGGOTA</h2>
        </div>
        <div class="float-right my-2">
        </div>
        <div class="float-left my-3">
            <form action="{{ route('anggota.index') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="" name="search" value="{{ request('search')}}" style="width: 856px">
                    <button class="btn btn-primary" type="submit">Search</button>&emsp;
                    <a class="btn btn-success" href="{{ route('anggota.create') }}"> Input Anggota</a>
                </div>
            </form>
        </div>
    </div>
</div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-error">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th><center>ID</th>
            <th><center>Nama</th>
            <th><center>Alamat</th>
            <th><center>Jenis Kelamin</th>
            <th width="298px"><center>Action</th>
        </tr>
        @foreach ($paginate as $ag)
        <tr>
            <td><center>{{ $ag ->id_ag }}</td>
            <td><center>{{ $ag ->nama_ag }}</td>
            <td><center>{{ $ag ->alamat }}</td>
            <td><center>{{ $ag ->jenis_kelamin }}</td>
            <td>

                    <a class="btn btn-info" href="{{ route('anggota.show',$ag->id_ag) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('anggota.edit',$ag->id_ag) }}">Edit</a>
                    
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a class="btn btn-warning" href="{{ route('cetak',$ag->id_ag) }}">Kartu</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $paginate->links()}}
    
@endsection