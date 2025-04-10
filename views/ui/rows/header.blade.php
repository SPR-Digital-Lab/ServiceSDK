<div class="border-b bg-white shadow-sm pb-3 pt-4 mt-2">
    <div class="row">
        @foreach ($data as $col)
        <div class="col">
            {{$col['key']}}
        </div>
    @endforeach
    </div>
</div>
