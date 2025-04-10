@extends('scaffold')
@section('content')
    {{-- @include('glide.navbar.dash') --}}

    @if (request('window') != 'support')
        @include('sdk::ui.navbar.user')
    @endif
    <main x-data class="overflow-hidden d-flex vw-100 flex-grow-1 position-relative">
        @if (request('window') != 'support')
            @include('sdk::ui.sidebar.dash', ['menu' => mainmenu()])
        @endif
        <section class="overflow-auto flex-grow-1">
            {{ $slot }}
        </section>
    </main>
@endsection
