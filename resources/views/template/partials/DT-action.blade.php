<a href="/{{ request()->segment(1) }}/{{ request()->segment(3) }}/{{ $model->id }}/edit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit data."><i class="fa fa-edit"></i></a>

<a href="/{{ request()->segment(1) }}/{{ request()->segment(3) }}/{{ $model->id }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat data."><i class="fa fa-eye"></i></a>

<button type="submit" class="button btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus data." style="display: inline" id="delete" data-id="{{ $model->id }}">
<i class="fa fa-trash"></i>
</button>

{{-- admin(segment 1)/product(segment 2)/edit(segment 3) --}}
{{-- {{ request()->segment(3) }} --}} 