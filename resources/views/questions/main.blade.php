@extends('layouts.b5')

@section('content_header')
    @include('questions.header')
@endsection

@section('content')
    <div class="row my-5 my-md-3 my-lg-2">
        <div class="col py-3 px-5 bg-light bg-gradient bg-opacity-50">
            <table id="questions-table" class="table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Pregunta</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                    @php
                        $date = new DateTime($question->created_at);
                    @endphp
                        <tr>
                            <td>{{ $question->FullName }}</td>
                            <td>{{ $question->Question }}</td>
                            <td data-order="{{$date->format('YmdHis')}}">{{ $date->format('d/m/Y H:i:s') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('content_footer')
    @include('questions.footer')
@endsection
