<div class="col-12 col-md-{{ $col }} mb-3 py-2" x-init="console.log(table)"
    wire:key="field_{{ $key }}_{{ $rid }}" x-data="window.field_{{ $key }}_initiator($wire)">
    <script wire:key="field_{{ $key }}_{{ $rid }}_script">
        window.field_{{ $key }}_initiator = function($wire) {
            return {
                table: $wire.entangle('dataEditorFields.{{ $key }}.value').defer,
                opt: @json($opt),
                addRow() {
                    if (this.table.length > 0) {
                        let l = this.table[this.table.length - 1];
                        let empty = Object.values(l).filter(element => {
                            // console.log('addc',element)
                            return element == "" || element == null;
                        }).length;
                        // console.log('add',empty,this.opt.length)
                        if (empty == this.opt.length) {
                            return;
                        }
                    }
                    let o = {};
                    this.opt.forEach(element => {
                        // console.log('addnew',element)
                        o[element.key] = null;
                    });
                    this.table.push(o);
                    console.log(this.table);
                    setTimeout(() => {
                        this.autofocus();
                    }, 100);

                },
                removeRow(index) {
                    // console.log('removing', index);
                    this.table.splice(index, 1)
                },
                autofocus() {
                    window.t = $("#table_{{ $key }}");
                    let tb = $("#table_{{ $key }}");
                    let trs = tb.find('tr');
                    let lastTr = trs[trs.length - 2]
                    if (lastTr) {
                        let tds = $(lastTr).find('td');
                        let firstTd = tds[1];
                        if(firstTd){
                            let input = $(firstTd).find('input');
                            input.focus()
                        }
                    }

                }
            }
        };
    </script>
    <div class="d-flex justify-content-between align-items-center">
        <label class="m-0" for="input_{{ $key }}">
            <span class="data-label">{{ $label ?? $key }}</span> <br>
            <small class="form-text">
                {{ $description }}
            </small>
        </label>
        <button type="button" @click="addRow()" class="btn btn-dark btn-sm fs-6 rounded-sm text-white">
            <i class="bi bi-node-plus-fill"></i>
        </button>
    </div>

    <table class="table mt-2 table-sm table-stripped" id="table_{{ $key }}">
        <thead>
            <tr class="">
                <td class="text-uppercase text-success fw-bold text-center border-top">#</td>
                <template x-for="v in opt">
                    <td x-text='v.label'
                        class="border-top text-uppercase small fw-bold text-success border-start border-end"></td>
                </template>
                <td class="border-top"></td>
            </tr>
        </thead>
        <tbody>
            <template x-if="table.length==0">
                <tr>
                    <td :colspan="Object.keys(opt).length + 2" class="text-muted small text-center">
                        <em>
                            This table seems to be empty!
                        </em>
                    <td>
                </tr>
            </template>
            <template x-for="r,i in table">
                <tr>
                    <td x-text="i+1" class="px-0 text-center"></td>
                    <template x-for="v,k in opt">
                        <td class="border-start border-end">
                            <template x-if="v.type=='string'">
                                <input tabindex="0" type="text"
                                    class="form-control form-control-sm data-input px-2 py-1" :placeholder="v.label"
                                    x-key="v.key" x-model='table[i][v.key]'>
                            </template>
                            <template x-if="v.type=='select'">
                                <select tabindex="0" type="text"
                                    class="form-select form-select-sm data-input px-2 py-1" x-key="v.key"
                                    x-model='table[i][v.key]'>
                                    <option value="">Select An Item</option>
                                    <template x-for="ov,ok in v.opt">
                                        <option :value="ok" x-text="ov" :selected="table[i][v.key] == ok">
                                        </option>
                                    </template>
                                </select>
                            </template>
                        </td>
                    </template>
                    <td class="text-end">
                        <button type="button" @click="removeRow(i)"
                            class="btn btn-danger small btn-sm fs-6 rounded-sm text-white text-uppercase">
                            <small class="fw-bold">
                                <i class="bi bi-node-minus-fill"></i>
                            </small>
                        </button>
                    </td>
                </tr>
            </template>
        </tbody>
        <tfoot>
            <tr class="">
                <td class="text-uppercase text-muted fw-bold text-center border-top"></td>
                <template x-for="v in opt">
                    <td class="border-top text-uppercase small fw-bold text-muted border-start border-end"></td>
                </template>
                <td class="border-top">
                    <button type="button" @click="addRow()" class="btn btn-dark btn-sm fs-6 rounded-sm text-white">
                        <i class="bi bi-node-plus-fill"></i>
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>
    @error("{$key}.*")
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
</div>
