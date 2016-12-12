@extends('layouts.main')

@section('content')
    <table class="table" id="table">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Images</th>
            <th></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @foreach($user->images as $image)
                        <a class="label label-success" data-toggle="modal" data-target="#imageModal"
                           onclick='sendImageToModal("{{$image['src']}}")'>{{$image['src']}}</a>
                    @endforeach
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#uploadForm"
                            onclick='sendImageParams("{{$user->id}}", "user")'>Upload Image
                    </button>
                </td>

            </tr>
        @endforeach
    </table>
@endsection