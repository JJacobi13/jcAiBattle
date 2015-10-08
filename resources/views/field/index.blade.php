@extends('layout')

@section('page')
    <h1>Board</h1>
    @foreach($countries as $allCountries)
        <table>
            @foreach($allCountries as $listOfCountries)
                <tr>
                    @foreach($listOfCountries as $country)
                        {!! $country !!}
                    @endforeach
                </tr>
            @endforeach
        </table>
    @endforeach
@endsection