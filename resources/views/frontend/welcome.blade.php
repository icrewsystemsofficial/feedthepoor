@extends('layouts.frontend.app')

@section('meta')
<title>
    FeedThePoor
</title>
@endsection

@section('css')
<style>
    /* Your Custom Styles Here*/
    .hero-section{
        height: calc(100vh - 5rem);
        width: 100vw;
    }
</style>
@endsection

@section('js')
<script>
    /* Your Custom Script Here*/
</script>
@endsection

@section('content')
<main>
    <div class="container hero-section d-flex flex-column align-items-center justify-content-center">
        <h1 class="display-4 text-center">Welcome to feedThePoor Project</h1>
        <p class="lead text-center">Congratulations! You have successfully set up the project. Happy coding!</p>
    </div>
</main>
@endsection
