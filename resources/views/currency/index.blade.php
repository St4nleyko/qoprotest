@extends('layouts.app')

@section('content')
    <section class="d-flex align-items-center bg-grey bd-bottom bd-top">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    {{ __('Currency list') }}
                </div>
                <div class="card-body">
                    @auth
                        <table id="currency_table" class="table table-striped create-form "  >
                            <thead>
                            <th></th>
                            <th>ID</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Coin ID') }}</th>
                            </thead>
                            <tbody>
                            @foreach($currencies as $currency)
                                <tr>
                                    <td>
                                        <img width="25" src="{{$currency->image_url}}" alt="">
                                    </td>
                                    <td>{{$currency->id}}</td>
                                    <td>{{$currency->name}}</td>
                                    <td>{{$currency->coin_id}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{route('currency.view',$currency->coin_id)}}">
                                            {{ __('Currency Details') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    @endauth
                </div>
                {{$currencies->links()}}
            </div>
        </div>
    </section>
@endsection
