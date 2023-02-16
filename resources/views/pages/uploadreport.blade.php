@extends('index')

@section('title')
Upload
@endsection

@section('css')
@endsection

@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Laporan Hasil Upload</h6>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-sm">
                <div class="form-group">
                  <!-- <label for="exampleFormControlSelect2">Example multiple select</label> -->
                  <select multiple class="form-control" id="exampleFormControlSelect2">
                    @foreach($messages as $message)
                    <option>{{ $message }}</option>                    
                    @endforeach
                  </select>
                  <div class="form-group">
                    <p><b>Total  : </b>{{ $total }} Perangkat<p>
                  </div>
                  <button class="btn btn-icon btn-3 btn-success" type="button" onclick="location.href='{{ route('upload.index') }}';">
                    <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                    <span class="btn-inner--text">Kembali</span>
                  </button>
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
<script>
// Function to hide the Spinner
function hideSpinner() {
  document.getElementById('spinner')
          .style.display = 'none';
}
</script>
@endsection