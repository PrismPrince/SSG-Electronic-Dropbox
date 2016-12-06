@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <ul class="list-group">
          <li class="list-group-item"><a href="#">Posts</a></li>
          <li class="list-group-item"><a href="#">Polls</a></li>
          <li class="list-group-item"><a href="#">Suggestions</a></li>
        </ul>
      </div>
    </div>

    <div class="col-sm-8">

      <panel-media :fullname="'Dave Dane P'" :image="'/images/user.jpg'" v-for="n in 5">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum accusantium esse repellat quasi placeat, labore atque autem minima, sit est error sunt voluptatem nobis quas quis, molestias tempore animi ipsam.
      </panel-media>

      <div class="panel panel-default">
        <div class="panel-body">
          Load more...
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@endpush