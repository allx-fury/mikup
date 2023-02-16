@extends('index')

@section('title')
Instansi
@endsection

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.min.css">
@endsection

@section('content')
<div class="container-fluid py-4">
      <div class="row">
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>{{ session('success') }}</strong></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Daftar Kategori Instansi</h6>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
            <button class="btn btn-icon btn-3 btn-success" type="button" onclick="location.href='{{ route('instansi.create') }}';">
              <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
              <span class="btn-inner--text">Tambah Kategori Instansi</span>
            </button>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori Instansi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($instansis as $nomor => $instansi)
                    <tr>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $instansis->firstItem() + $nomor }}</span>
                      </td>
                      <td>
                        <h6 class="mb-0 text-sm">{{$instansi->nama}}</h6>
                      </td>
                      <td class="align-middle text-center">
                      <!-- <div class="ms-auto text-end"> -->
                        <a class="text-secondary text-xs btn btn-link text-danger text-gradient px-3 mb-0 hapus-data" data-id="{{ $instansi->id }}" href="#"><i class="far fa-trash-alt me-2"></i>Delete</a>|
                        <a class="text-secondary text-xs btn btn-link text-dark px-3 mb-0" href="{{ route('instansi.edit',$instansi->id) }}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                      <!-- </div> -->
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td>{{ $instansis->links() }}</td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.0/sweetalert2.min.js') }}"></script>
<script>
        $(document).ready(function () {
            var del = function (id) {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengembalikan data yang sudah terhapus!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Iya!",
                    cancelButtonText: "Tidak!",
                }).then(
                    function (result) {
                        $.ajax({
                          headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                            url: "{{route('instansi.index')}}/" + id,
                            method: "DELETE"
                        }).done(function (msg) {
                            swal("Deleted!", "Data sudah terhapus.", "success");
                            location.reload()
                        }).fail(function (textStatus) {
                            alert("Request failed: " + textStatus);
                        });
                    }, function (dismiss) {
                        // dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
                        swal("Cancelled", "Data batal dihapus", "error");
                    });
            };
            $('body').on('click', '.hapus-data', function () {
                del($(this).attr('data-id'));
            });
        });
</script>
@endsection