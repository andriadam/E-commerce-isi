@extends('layouts.app')

@section('content')
<div class="row mt-4 text-center">
  <h2>Daftar {{ $title }}</h2>
</div>
<div class="row">
  <div class="col-sm-12">
    @if ($message = Session::get('successOrder'))
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Pesanan Berhasil dibuat</h4>
    <p>Silahkan lakukan pembayaran sejumlah Rp. {{ number_format($message, 0, 0, '.') }} melalui BCA : 26532567326 A/n
      Andri Adam</p>
    <hr>
    <p class="mb-0">Konfirmasi pembayaran melalui Api {{ URL::to('/api/paymentOrder'); }}</p>
  </div>
  @endif
  </div>
</div>
<div class="row mt-2">
  <table class="table" id="table1">
    <thead>
      <tr>
        <th>No. </th>
        <th>Order Id</th>
        <th>Discount</th>
        <th>Total</th>
        <th>No.Rek</th>
        <th>Nama Bank</th>
        <th>Tanggal Transfer</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($orders as $row)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->id }}</td>
        <td>Rp. {{ number_format($row->discount, 0, 0, '.') }}</td>
        <td>Rp. {{ number_format($row->total, 0, 0, '.') }}</td>
        <td>{{ $row->no_rek }}</td>
        <td>{{ $row->bank_name }}</td>
        <td>{{ $row->transfer_date }}</td>
        <td>
          <?php if ($row->statusPayment === "Paid") { ?>
          <span class="badge bg-success">Dibayar</span>
          <?php } elseif ($row->statusPayment === "Waiting Confirmation"){ ?>
          <span class="badge bg-secondary">Menunggu konfirmasi</span>
          <?php }else{ ?>
          <span class="badge bg-secondary">Belum Dibayar</span>
          <?php } ?>
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