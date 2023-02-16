@extends('index')

@section('title')
Upload
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
              <h6>Daftar Perangkat</h6>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-sm">
                <form method="POST" action="{{ route('exec') }}">
                @csrf
                <div class="form-check form-switch">
                  <input class="form-check-input semua-opd" type="checkbox" id="select-opd" name="select-opd">
                  <label class="form-check-label" for="select-opd">OPD</label>
                </div>
                  @foreach($opds as $opd)
                  <div class="form-check">
                    <input class="form-check-input semua-opd" type="checkbox" value="{{ $opd->id }}" name="list[]" id="{{ $opd->nama }}">
                    <label class="form-check-label" for="{{ $opd->nama }}">
                      {{ $opd->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
                <div class="col-sm">
                <div class="form-check form-switch">
                  <input class="form-check-input semua-bagian" type="checkbox" id="select-bagian" name="select-bagian">
                  <label class="form-check-label" for="select-bagian">BAGIAN</label>
                </div>
                  @foreach($bags as $bag)
                  <div class="form-check">
                    <input class="form-check-input semua-bagian" type="checkbox" value="{{ $bag->id }}" name="list[]" id="{{ $bag->nama }}">
                    <label class="form-check-label" for="{{ $bag->nama }}">
                      {{ $bag->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
                <div class="col-sm">
                <div class="form-check form-switch">
                  <input class="form-check-input semua-kelurahan" type="checkbox" id="select-kelurahan" name="select-kelurahan">
                  <label class="form-check-label" for="select-kelurahan">KELURAHAN</label>
                </div>
                  @foreach($kels as $kel)
                  <div class="form-check">
                    <input class="form-check-input semua-kelurahan" type="checkbox" value="{{ $kel->id }}" name="list[]" id="{{ $kel->nama }}">
                    <label class="form-check-label" for="{{ $kel->nama }}">
                      {{ $kel->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
                <div class="col-sm">
                <div class="form-check form-switch">
                  <input class="form-check-input semua-kecamatan" type="checkbox" id="select-kecamatan" name="select-kecamatan">
                  <label class="form-check-label" for="select-kecamatan">KECAMATAN</label>
                </div>
                  @foreach($kecs as $kec)
                  <div class="form-check">
                    <input class="form-check-input semua-kecamatan" type="checkbox" value="{{ $kec->id }}" name="list[]" id="{{ $kec->nama }}">
                    <label class="form-check-label" for="{{ $kec->nama }}">
                      {{ $kec->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
                <div class="col-sm">
                <div class="form-check form-switch">
                  <input class="form-check-input semua-pkm" type="checkbox" id="select-pkm" name="select-pkm">
                  <label class="form-check-label" for="select-pkm">PUSKESMAS</label>
                </div>
                  @foreach($pkms as $pkm)
                  <div class="form-check">
                    <input class="form-check-input semua-pkm" type="checkbox" value="{{ $pkm->id }}" name="list[]" id="{{ $pkm->nama }}">
                    <label class="form-check-label" for="{{ $pkm->nama }}">
                      {{ $pkm->nama }}
                    </label>
                  </div>
                  @endforeach
                </div>
                  <input class="btn btn-primary btn-lg active" data-bs-toggle="modal" data-bs-target="#loadingModal" type="submit" value="Proses">
                </form>

                <!-- Modal -->
                <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-danger" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="py-3 text-center">
                          <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-success" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-info" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <br></br>
                          <p>Proses upload Login Page membutuhkan beberapa waktu. Harap bersabar...</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$('#select-opd').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $('.semua-opd').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.semua-opd').each(function() {
            this.checked = false;                       
        });
    }
}); 
$('#select-bagian').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $('.semua-bagian').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.semua-bagian').each(function() {
            this.checked = false;                       
        });
    }
}); 
$('#select-kelurahan').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $('.semua-kelurahan').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.semua-kelurahan').each(function() {
            this.checked = false;                       
        });
    }
}); 
$('#select-kecamatan').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $('.semua-kecamatan').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.semua-kecamatan').each(function() {
            this.checked = false;                       
        });
    }
}); 
$('#select-pkm').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $('.semua-pkm').each(function() {
            this.checked = true;                        
        });
    } else {
        $('.semua-pkm').each(function() {
            this.checked = false;                       
        });
    }
}); 
</script>
</script>
@endsection