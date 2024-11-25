@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header ">
                <h2>{{$currency->name}} ({{$currency->symbol}}) {{__('Details')}}</h2>
                <img width="150" class="float-end" src="{{$currency->image_url}}" alt="">
            </div>
            <div class="card-body">
                <p><strong>{{__('Current Price')}}</strong>: {{$currency->current_price}}</p>
                <p><strong>{{__('Change 24h in %')}}</strong>: {{$currency->price_change_percentage_24h}}</p>
                <p><strong>{{__('Market Cap')}}</strong>: {{$currency->market_cap}}</p>
            </div>
        </div>
    </div>
@endsection
