@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Attributes</h2>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash')
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($attributes as $attribute)
                                    <tr>    
                                        <td>{{ $attribute->id }}</td>
                                        <td>{{ $attribute->code }}</td>
                                        <td>{{ $attribute->name }}</td>
                                        <td>{{ $attribute->type }}</td>
                                        <td>
                                                <a href="{{ url('admin/attributes/'. $attribute->id .'/edit') }}" class="btn btn-warning btn-sm">edit</a>

                                                <a href="{{ url('admin/attributes/'. $attribute->id .'/options') }}" class="btn btn-success btn-sm">options</a>

                                                {!! Form::open(['url' => 'admin/attributes/'. $attribute->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $attributes->links() }}
                    </div>
                        <div class="card-footer text-right">
                            <a href="{{ url('admin/attributes/create') }}" class="btn btn-primary">Add New</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection