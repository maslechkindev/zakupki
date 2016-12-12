@extends('layouts.main')

@section('pageTitle', ' - '.$pageTitle)

@section('content')
    <table class="table" id="table">
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Images</th>
            <th></th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->model}}</td>
                <td>
                    @foreach($product->images as $image)
                        <a class="label label-success" data-toggle="modal" data-target="#imageModal"
                           onclick='sendImageToModal("{{$image['src']}}")'>{{$image['src']}}</a>
                    @endforeach
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#uploadForm"
                            onclick='sendImageParams("{{$product->id}}", "product")'>Upload Image
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
@endsection