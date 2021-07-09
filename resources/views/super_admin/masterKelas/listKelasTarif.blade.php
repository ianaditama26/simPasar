@foreach($tarifKelas as $tarif)
   {{-- @foreach($tarif->borrowing->detailBorrowing as $spt) --}}
      <ul>
         <span class="badge badge-primary">{{ $tarif->zonasi }}:&nbsp;{{ number_format($tarif->tarif, 0, ',', '.') }}</span>
         {{-- <span class="badge badge-danger">{{ $spt->typeSpt }}</span> --}}
      </ul>
   {{-- @endforeach --}}
@endforeach