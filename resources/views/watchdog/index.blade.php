@extends('layouts.app')

@section('content')
    <section class="d-flex align-items-center bg-grey bd-bottom bd-top">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    {{ __('Watchdogs') }}
                </div>
                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                    @endif
                    @auth
                        <table id="watchdog_table" class="table table-striped create-form "  >
                            <thead>
                            <th>ID</th>
                            <th>{{ __('Currency') }}</th>
                            <th >{{ __('Actions') }}</th>
                            </thead>
                            <tbody>
                                @foreach($watchDogs as $watchDog)
                                    <tr>
                                        <td>{{$watchDog->id}}</td>
                                        <td>{{$watchDog->currency_name}}</td>
                                        <td>
                                            <form action="{{ route('watchdog.delete',$watchDog)}}" method="post" onsubmit="return confirm('{{__('Are you sure you want to delete this item?')}}');">
                                                @csrf
                                                @method('DELETE')
                                                <button  class="btn btn-danger" type="submit">
                                                    {{__('Delete')}}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="create-form">
                            <a href="{{ route('watchdog.create')}}" class="btn btn-success">{{ __('Add Watchdog') }}</a>
                        </div>
                    @endauth
                </div>
                {{$watchDogs->links()}}
            </div>
        </div>
    </section>
@endsection
