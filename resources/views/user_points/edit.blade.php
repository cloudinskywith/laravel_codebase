@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Point
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userPoint, ['route' => ['userPoints.update', $userPoint->id], 'method' => 'patch']) !!}

                        @include('user_points.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection