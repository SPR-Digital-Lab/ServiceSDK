@extends('scaffold')
@section('content')
        @include('glide.navbar.guest')
        <main x-data class="overflow-auto d-flex flex-grow-1 position-relative ">
            <section class="container flex-grow-1 px-2">
                {{ $slot }}
            </section>
        </main>
    </div>
@endsection
