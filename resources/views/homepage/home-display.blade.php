@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="" style="margin-top: 5px;">
    @include ('homepage.announcements')
    </div>
    @include ('homepage.product-category')
</div>
@endsection
