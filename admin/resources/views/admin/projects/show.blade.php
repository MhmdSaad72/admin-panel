@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header"> {{ $project->title }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/projects') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $project->id }}</td>
                                </tr>
                                <tr>
                                    <th> Title </th>
                                    <td> {{ $project->title }} </td>
                                </tr>
                                <tr>
                                    <th> Lang Title </th>
                                    <td> {{ $project->lang_title }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {!! $project->description !!} </td>
                                </tr>
                                <tr>
                                    <th> Lang Description </th>
                                    <td> {!! $project->lang_description !!} </td>
                                </tr>
                                <tr>
                                    <th> Album </th>
                                    <td>
                                        @if (json_decode($project->album))
                                        <table>
                                            @foreach (json_decode($project->album) as $value)
                                            <tr>
                                                <td> <img src="{{asset('storage/' . $value)}}" style="width:30%"> </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        @endif
                                    </td>
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
