@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
  <h1 class="mb-3">Daftar Produk</h1>
  <div class="row justify-content-center">
    @forelse ($products as $row)
    <div class="col-sm-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $row->product_name }}</h5>
          <h6>Rp. {{ number_format($row->price, 0, 0, '.') }}</h6>
          <p class="card-text">{!! Str::limit(strip_tags($row->description), 50) !!}</p>
          <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $row->id }}" name="id">
            <input type="hidden" value="{{ $row->product_name }}" name="name">
            <input type="hidden" value="{{ $row->price }}" name="price">
            <input type="hidden" value="1" name="quantity">
            <div class="d-grid gap-2">
              <button class="btn btn-primary">Tambah ke keranjang</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @empty
    <p class="text-center text-white">Tidak ada produk.</p>
    @endforelse
  </div>
</div>
@endsection