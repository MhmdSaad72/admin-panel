@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header"> {{ $newsletter->id }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/news-letter') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Title </th>
                                    <td> {{ $newsletter->title }} </td>
                                </tr>
                                <tr>
                                    <th> Lang Title </th>
                                    <td> {{ $newsletter->lang_title }} </td>
                                </tr>
                                <tr>
                                    <th> Body </th>
                                    <td> {!! $newsletter->body !!} </td>
                                </tr>
                                <tr>
                                    <th> Lang Body </th>
                                    <td> {!! $newsletter->lang_body !!} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td> <img src="{{ asset('storage/' . $newsletter->image) }}" style="width:30%"> </td>
                                </tr>
                                <tr>
                                    <th> Lang Image </th>
                                    <td> <img src="{{ asset('storage/' . $newsletter->lang_image) }}" style="width:30%"> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
