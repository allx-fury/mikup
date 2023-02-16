@extends('index')

@section('title')
Upload
@endsection

@section('css')
@endsection

@section('content')
<div class="container-fluid py-4">
      <div class="row">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
          <span class="alert-icon"><i class="ni ni-like-2"></i></span>
          <span class="alert-text"><strong>{{ session('success') }}</strong></span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
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
              <h6>Pilih File Login Page</h6>
            </div>
            <div class="container">
              <div class="row">
                <div class="mb-3">
                  <form method="POST" action="{{ route('pilih') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="file" class="form-label">File Ekstensi .zip</label>
                    <input class="form-control" type="file" id="file" name="file" accept=".zip">
                    <br></br>
                    <input class="btn btn-primary btn-lg active" type="submit" value="Upload">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('js')
@endsection