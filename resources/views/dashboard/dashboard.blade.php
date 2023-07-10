@extends('layouts.sidebar')

@section('content')
    
<h4>
    Selamat datang {{ Auth::user()->name }}, Anda login sebagai user {{ Auth::user()->level }}
</h4>
<hr>

    <div class="container">
        
	</div>
@endsection