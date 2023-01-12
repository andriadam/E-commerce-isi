@extends('layouts.admin.app')

@section('content')
<div class="row mt-4 text-center">
  <h2>Daftar {{ $title }}</h2>
</div>
<div class="row">
  <div class="col-sm-12">
    @include('components.alert')
  </div>
  <div class="col-sm-12">
    <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-square"></i>
      Tambah
      {{ $title }}</a>
  </div>
</div>
<div class="row mt-2">
  <table class="table" id="table1">
    <thead>
      <tr>
        <th>No. </th>
        <th>Order Id</th>
        <th>Card Number</th>
        <th>CVC</th>
        <th>Discount</th>
        <th>Total</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($orders as $row)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->id }}</td>
        <td>{{ $row->card_number }}</td>
        <td>{{ $row->cvc }}</td>
        <td>Rp. {{ number_format($row->discount, 0, 0, '.') }}</td>
        <td>Rp. {{ number_format($row->total, 0, 0, '.') }}</td>
        <td>
          @if ($row->is_paid === 1)
          <span class="badge bg-success">Dibayar</span>
          @else
          <span class="badge bg-secondary">Belum Dibayar</span>
          @endif
        </td>
      </tr>
      @empty
      <tr class="text-center">
        <td colspan="6">No {{ $title }} found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection