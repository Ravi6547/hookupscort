@extends('adminLayouts.app')
@section('content')
    <div class="container  mr-5" style="margin-top:80px">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit User</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    @if (!isset($seenErrors[$error]))
                                        <li>{{ $error }}</li>
                                        @php $seenErrors[$error] = true; @endphp
                                    @endif
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($user, [
                            'method' => 'PATCH',
                            'url' => ['/admin/users', $user->id],
                            'class' => 'form-horizontal',
                            "enctype" => "multipart/form-data"
                        ]) !!}

                        @include ('admin.users.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
