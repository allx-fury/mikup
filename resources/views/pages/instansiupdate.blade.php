@extends('index')

@section('title')
Instansi
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
              <h6>Update Kategori Instansi</h6>
            </div>
            <div class="p-4 bg-gray-200">
              <form method="POST" action="{{ route('instansi.update',$instansi->id) }}">
              @csrf
              {{ method_field('PUT') }}
                <div class="form-group">
                  <label class="form-control-label" for="nama">Nama Kategori :</label>
                  <input type="text" class="form-control" name="nama" id="nama" value="{{ $instansi->nama }}" placeholder="Kategori...">
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