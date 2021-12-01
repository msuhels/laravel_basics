@extends("layouts.skeleton")
    
@include("partials.sidebar")
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include("partials.header")
        @yield("page-content")
</div>
@include("partials.footer")
    