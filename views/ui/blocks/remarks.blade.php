@foreach ($remarks as $ori => $remark)
    <div class="d-flex text-break">
        <div class="d-flex flex-column">
            <div style="min-height:0.5rem;" class="flex-grow-1 mx-1 border-start border-2 border-{{@$accent??"secondary"}}"></div>
            <div style="height:0.7rem;width:0.7rem" class="bg-{{@$accent??"secondary"}} flex-shrink-0 rounded-circle">
            </div>
            <div style="min-height:0.5rem;" class="mx-1 border-start border-2 border-{{@$accent??"secondary"}} flex-grow-1"></div>
        </div>
        &nbsp;
        <div class="d-flex flex-column text-muted py-2">
            <div class="text-dark"> {!! $remark['value'] !!} </div>
            <div>{{ cipher($remark['username'])->name }} &middot; {{carbon()->setTimestamp($remark['timestamp'])->diffForHumans()}} &middot; {{carbon()->setTimestamp($remark['timestamp'])->toDateTimeString()}}</div>
        </div>
    </div>
@endforeach
@if ($remarks->count()==0)
     <div class="text-muted small">
            <em>No remarks has been added.</em>
    </div>
@endif
