@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header"> {{ $client->name }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/clients') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $client->name }} </td>
                                </tr>
                                <tr>
                                    <th> Logo </th>
                                    <td> <img src="{{ asset('storage/' . $client->logo) }}" style="width:30%"> </td>
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
