@php
    $message = $type = null;

    if(session()->has('success')){
        $message = session()->get('success');
        $type = "primary";
    }

    if(session()->has('error')){
        $message = session()->get('error');
        $type = "danger";
    }
@endphp

@if(!is_null($type) && !is_null($message))
    <div class="alert alert-{{$type}}" role="alert">
        {{$message}}
    </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    @endforeach
@endif
