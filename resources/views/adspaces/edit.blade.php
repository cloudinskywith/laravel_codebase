@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Adspace
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($adspace, ['route' => ['adspaces.update', $adspace->id], 'method' => 'patch']) !!}

                        @include('adspaces.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection