@extends('scaffold')
@section('content')
    @include('glide.navbar.user')
    <main x-data class="overflow-hidden d-flex vw-100 flex-grow-1 position-relative">
        @if (@mainmenu()->getActiveChild()->parent)
            @include('glide.sidebar.dash', ['menu' => mainmenu()])
        @endif
        <section class="overflow-auto flex-grow-1">
            {{ $slot }}
        </section>
    </main>
@endsection
