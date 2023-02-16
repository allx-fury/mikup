@extends('index')

@section('title')
Server
@endsection

@section('css')
@endsection

@section('content')
<div class="container-fluid py-4">
      <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Update Perangkat</h6>
            </div>
            <div class="p-4 bg-gray-200">
              <form method="POST" action="{{ route('server.update',$server->id) }}">
              @csrf
              {{ method_field('PUT') }}
                <div class="form-group">
                  <label class="form-control-label" for="nama">Nama Perangkat :</label>
                  <input type="text" class="form-control" name="nama" id="nama" value="{{ $server->nama }}" placeholder="Perangkat...">
                </div>
                <div class="form-group">
                  <label class="form-control-label" for="ip_address">IP Address :</label>
                  <input type="text" class="form-control" name="ip_address" id="ip_address" value="{{ $server->ip_address }}" placeholder="IP Address...">
                </div>
                <div class="form-group">
                  <label class="form-control-label" for="port">Port :</label>
                  <input type="text" class="form-control" name="port" id="port" value="{{ $server->port }}" placeholder="Port...">
                </div>
                <div class="form-group">
                    <label for="instansi_id">Pilih Instansi</label>
                    <select class="form-control" searchable="Search here.." name="instansi_id" id="instansi_id">
                    <option value="" disabled selected>Pilih Instansi</option>
                    @foreach ($instansis as $instansi)
                    <option value="{{ $instansi->id }}">{{ $instansi->nama }}</option>
                    @endforeach
                    </select>
                </div>
                <input class="btn btn-primary btn-lg active" type="submit" value="Simpan">
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('js')
@endsection