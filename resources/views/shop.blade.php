@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        {{$jsonData ?? ''}}
        <div class="row">
            <div class="card-body">
                @foreach($shops as $shop)
                <div class="col-md-12">
                    <h3>{{ $shop->category_name }}</h3>
                    <hr />
                    <div class="row">
                        @foreach($shop->children as $cats)
                        <div class="col-md-4">
                            <h4>{{ $cats->category_name }}</h4>
                            <hr />
                            @foreach($cats->children as $cat)
                            <h5>{{$cat->category_name}}</h5>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection