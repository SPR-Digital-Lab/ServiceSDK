<div class="">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    {{-- @include('glide.header.dash') --}}
    @include('glide.header.dash')
    {{-- @include('glide.blocks.confirmation') --}}
    <script>
        window.{{ $tableID }}_loader = function($el) {
            window.{{ $tableID }} = new DTable($el,

                {
                    @if ($orderByColumnIndex > -1)
                        order: [{{ $orderByColumnIndex }}, '{{ $orderByColumnOrder }}'],
                    @endif
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            text: 'Copy',
                            className: 'btn btn-dark',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            text: 'CSV',
                            className: 'btn btn-dark',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            className: 'btn btn-dark',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            className: 'btn btn-dark',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            className: 'btn btn-dark',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'colvis',
                            text: 'Column Visibility',
                            className: 'btn btn-success'
                        },
                        {
                            text: 'Pivot',
                            className: 'btn btn-info',
                            action: function(e, dt, node, config) {
                                // Your custom button's action code here
                                let data = dt.rows({ search: 'applied' }).data().toArray();
                                data = data.map(r => r.map((d) => d.display ? htmlDecode(d.display.replace(
                                    /<[^>]*>?/gm, "")) : null))
                                console.log(data)
                            }
                        }

                    ],
                    searchBuilder: {
                        logic: 'AND' // Default logical operation for SearchBuilder
                    }
                }
            )
        }
    </script>
    @component('glide.blocks.paper')
        <div class="overflow-auto" x-data>
            <table class="small table-striped table" x-init="$nextTick(() => window.{{ $tableID }}_loader($el))">
                <thead>
                    <tr>
                        @foreach ($columns as $item)
                            <th scope="col" class="text-dark">{{ $this->formatColumn($item) }}</th>
                        @endforeach()
                        <th scope="col" class="text-uppercase">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $i => $row)
                        <tr x-data="{}" wire:key='row_{{ $this->generateUniqueID($row) }}'>
                            @foreach ($columns as $item)
                                {{-- @if (@$item['editable'])
                                    <td x-data="{}" @click="console.log"
                                        wire:key="row_{{ $this->generateUniqueID($row) }}_{{ $item['key'] }}">
                                        {{ $this->formatValue($item, $row) }}
                                    </td>
                                @else --}}
                                <td class="" data-search="{{ $this->formatSearch($item, $row) }}">
                                    {!! $this->formatValue($item, $row) !!}</td>
                                {{-- @endif --}}
                            @endforeach
                            <td class="">
                                @if ($this->generateRowMenu($row)->menu->count())
                                    <div class="d-flex gap-2 text-end" wire:key='btn_{{ $i }}_menu'
                                        x-data={menu:false}>
                                        @foreach ($this->generateRowMenu($row)->menu as $m)
                                            @if ($m->code == 'delete')
                                                <button wire:click='deleteRow({{ $i }})'
                                                    wire:loading.attr='disabled'
                                                    class="btn btn-sm btn-danger text-uppercase fw-bold d-flex">
                                                    <small wire:loading.attr="hidden" class="py-1"
                                                        wire:target="deleteRow({{ $i }})">delete</small>
                                                    <div wire:loading="" wire:target="deleteRow({{ $i }})"
                                                        class="spinner-border spinner-border-sm mx-2 my-1" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </button>
                                            @elseif ($m->code == 'edit')
                                                <button wire:click='editRow({{ $i }})'
                                                    wire:loading.attr='disabled'
                                                    class="btn btn-sm btn-light text-uppercase fw-bold d-flex">
                                                    <small wire:loading.attr="hidden" class="py-1"
                                                        wire:target="editRow({{ $i }})">{{ $m->name }}</small>
                                                    <div wire:loading="" wire:target="editRow({{ $i }})"
                                                        class="spinner-border spinner-border-sm mx-2 my-1" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </button>
                                            @else
                                                @if ($m->meta('wire:click'))
                                                    <button wire:click='{{ $m->meta('wire:click') }}'
                                                        wire:loading.attr='disabled'
                                                        class="btn btn-sm btn-light text-uppercase fw-bold d-flex">
                                                        <small wire:loading.attr="hidden" class="py-1"
                                                            wire:target="{{ $m->meta('wire:click') }}">{{ $m->name }}</small>
                                                        <div wire:loading="" wire:target="{{ $m->meta('wire:click') }}"
                                                            class="spinner-border spinner-border-sm mx-2 my-1"
                                                            role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </button>
                                                @else
                                                    <a href="{{ $m->link }}"
                                                        class="btn btn-sm btn-light text-uppercase fw-bold">
                                                        <small>{{ $m->name }}</small>
                                                    </a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        @foreach ($columns as $item)
                            <th scope="col" class="text-dark">{{ $this->formatColumn($item) }}</th>
                        @endforeach()
                        <th scope="col" class="text-uppercase" data-no-select="true">

                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endcomponent
    <script>
        window.{{ $tableID }}_reporter = function(D) {
            let data = window["{{ $tableID }}"].data();
            data = data.map(r => r.map((d) => d.display ? htmlDecode(d.display.replace(/<[^>]*>?/gm, "")) : null))
            console.log(data);
        }
    </script>

    <div @click="Reporter('{{ $tableID }}')">

    </div>
</div>
