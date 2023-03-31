@extends('ajax.layout')

@section('content')

  <!-- /.page-header -->
   <div class="page-header">
      <h1>Daftar Tarif</h1>
   </div><!-- /.page-header -->

<div class="form-group row add">
    <div class="col-md-8">
        <input type="text" class="form-control" id="name" name="name"
            placeholder="Enter some name" required>
        <p class="error text-center alert alert-danger hidden"></p>
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary" type="submit" id="add">
            <span class="glyphicon glyphicon-plus"></span> ADD
        </button>
    </div>
</div>

<div class="table-responsive text-center">
    <table class="table table-borderless" id="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Name</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        @foreach($tarif as $item)
        <tr class="item{{$item->id}}">
            <td>{{$item->id}}</td>
            <td>{{$item->nama_tarif}}</td>
            <td><button class="edit-modal btn btn-info" data-id="{{$item->id}}"
                    data-name="{{$item->nama_tarif}}">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger" data-id="{{$item->id}}"
                    data-name="{{$item->nama_tarif}}">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button></td>
        </tr>
        @endforeach
    </table>
</div>


@endsection
