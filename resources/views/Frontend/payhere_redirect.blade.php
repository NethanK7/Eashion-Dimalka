@extends('layouts.app1')

@section('title', 'Processing Payment | EASHION')

@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="text-center">
        <div class="inline-block w-12 h-12 border-4 border-black border-t-transparent rounded-full animate-spin mb-6"></div>
        <h2 class="text-xl font-light tracking-[0.2em] uppercase italic">Processing to Secure Payment</h2>
        <p class="text-xs text-gray-400 mt-4 tracking-widest uppercase">Please do not refresh the page...</p>

        <form id="payhere_form" action="{{ $payhere_url }}" method="POST">
            @foreach($payhere_data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
    </div>
</div>

<script>
    window.onload = function() {
        document.getElementById('payhere_form').submit();
    };
</script>
@endsection
