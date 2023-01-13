@extends('layouts.app')

@section('content')
<div style="" class="text-center mt-5">
  <div class="row">
    @include('components.alert')
  </div>
  <h1>Keranjang</h1>
  <div class="col-sm-12">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Produk</th>
          <th scope="col">Harga</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Sub Harga</th>
          <th scope="col">Option</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($cartItems as $item)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->name }}</td>
          <td>Rp. {{ number_format($item->price, 0, 0, '.') }}</td>
          <td>
            <form action="{{ route('user.cart.update') }}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{ $item->id}}">
              <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" />
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </td>
          <td>
            Rp. {{ number_format($item->price*$item->quantity, 0, 0, '.') }}
          </td>
          <td>
            <form action="{{ route('user.cart.remove') }}" method="POST">
              @csrf
              <input type="hidden" value="{{ $item->id }}" name="id">
              <button class="btn btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6">
            <p>Keranjang belanja anda kosong</p>
          </td>
        </tr>
        @endforelse
      </tbody>
      <tfoot>
        <th colspan="4">
          <h4> Total </h4>
        </th>
        <th colspan="2">
          <h4>Rp. {{ number_format(Cart::getTotal(), 0, 0, '.'); }}</h4>
        </th>
      </tfoot>
    </table>
    <div class="row justify-content-center">
      @forelse ($discounts as $row)
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $row->name }}</h5>
            <h6>{{ $row->percentage }}% up to Rp. {{ number_format($row->max_disc, 0, 0, '.') }}</h6>
            <p>Code : <span class="badge bg-primary">{{ $row->code }}</span></p>
            <p>{{ $row->description }}</p>
          </div>
        </div>
      </div>
      @empty
      <p class="text-center text-white">Tidak ada Diskon.</p>
      @endforelse
    </div>
    <div class="row justify-content-center mt-2">
      <div class="col-3">
        <form action="{{ route('user.cart.useDiscount') }}" class="" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" id="code" class="form-control form-control-sm @error('code') is-invalid @enderror"
              name="code" value="{{ old('code') }}">
            <div class="input-group-append">
              <button class="btn btn-outline-primary" type="submit">Gunakan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="justify-content-end">
      <h6 id="afterDiscount">-{{ number_format($disc ?? 0 , 0, 0, '.') }}</h6>
      <h4 id="afterDiscount">Rp. {{ number_format($totalAfterDiscount ?? Cart::getTotal() , 0, 0, '.') }}</h4>
      {{-- @endif --}}
    </div>
    <div class="d-flex justify-content-end">
      <form action="{{ route('order.store') }}" method="POST">
        @csrf
        @isset($code)
        <input type="hidden" name="code" value="{{ $code }}">
        @endisset($code)
        <button type="submit" class="btn btn-primary"
          onclick="return confirm('Apakah sudah yakin dengan pesanan anda?')">Buat Pesanan</button>
      </form>
    </div>
  </div>
</div>
@endsection