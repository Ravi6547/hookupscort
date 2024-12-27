@extends('adminLayouts.app')

@section('content')
    <div class="container mr-5" style="margin-top:80px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/admin/users', $user->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    <th>ID.</th><td>{{ $user->id }}</td> 
                                    </tr>
                                    <tr><th>Name</th><td> {{ $user->name }} </td></tr>
                                    <tr><th>Email</th><td> {{ $user->email }} </td></tr>
                                    <tr><th>Mobile</th><td> {{ $user->mobile }} </td></tr>
                                    <tr><th>City</th><td> {{ $citys[$user->city] }} </td></tr>
                                    <tr><th>Description</th><td> {{ $user->description }} </td></tr>
                                    <tr>
                                        <th>Images</th>
                                        <td width="60%">
                                            @foreach($user->images as $image)
                                            <img src='{{ asset($image->image_path) }}' class="mr-2 mt-2" style="width:200px">
                                            @endforeach
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
