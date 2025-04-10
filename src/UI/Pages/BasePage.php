<?php

namespace SPR\ServiceSDK\UI\Pages;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use SPR\ServiceSDK\UI\Menu\MenuItem;

abstract class BasePage extends Component
{
    public $layout = 'sdk::ui.layouts.guest';

    public $defaultDailogComponent = 'sdk::ui.blocks.dialog';
    public $dailogComponent = 'sdk::ui.blocks.dialog';

    public $dataEditorFields;
    public $dataEditorFiles;

    public $__header = null;
    public $search = false;
    public $user_spec = [];

    public $__confirmation = null;

    public ?array $__editorDialog;

    public bool $smartBackOverride = false;

    public function setHeader($title, $info = null, $success = null, $danger = null, $path = [], $counters = [])
    {

        $this->__header = [
            'title' => $title,
            'info' => $info,
            'success' => $success,
            'danger' => $danger,
            'path' => $path,
            'counters' => $counters,
        ];
    }

    public function setHeaderOpt($key, $value)
    {
        if (!$this->__header) {
            $this->__header = [];
        }

        $this->__header[$key] = $value;
        return $this;
    }

    public function setHeaderTitle($title)
    {
        return $this->setHeaderOpt('title', $title);
    }
    public function setHeaderHint($hint)
    {
        return $this->setHeaderOpt('hint', $hint);
    }

    public function setHeaderInfo($info)
    {
        return $this->setHeaderOpt('info', $info);
    }

    public function setHeaderSuccess($success)
    {
        return $this->setHeaderOpt('success', $success);
    }

    public function setHeaderDanger($danger)
    {
        return $this->setHeaderOpt('danger', $danger);
    }

    public function setHeaderPath($path)
    {
        return $this->setHeaderOpt('path', $path);
    }

    public function setBackPath($path)
    {
        return $this->setHeaderOpt('back', $path);
    }

    public function setHeaderCounters($counter, $counting, $count = 0, $type = 'info')
    {
        if (!$this->__header || !is_array($this->__header)) {
            $this->__header = [];
        }

        if (!isset($this->__header['counters']) || !is_array($this->__header['counters'])) {
            $this->__header['counters'] = [];
        }
        $this->__header['counters'][$counter] = [
            'label' => $counting,
            'count' => $count,
            'type' => $type,
        ];
        return $this;
    }

    public function setQRCounter($counter, $label, $code, $description = null)
    {
        if (!$this->__header || !is_array($this->__header)) {
            $this->__header = [];
        }

        if (!isset($this->__header['counters']) || !is_array($this->__header['counters'])) {
            $this->__header['counters'] = [];
        }
        $this->__header['counters'][$counter] = [
            'label' => $label,
            'code' => $code,
            'type' => 'qr',
            'description' => $description,
        ];
        return $this;
    }

    public function setConfirmation($title, $description = null, $success = 'deleteRowConfirm', $cancel = null)
    {
        $this->__confirmation = [
            'title' => $title,
            'description' => $description,
            'success' => $success,
            'cancel' => $cancel,
        ];
    }

    public function clearConfirmation()
    {
        $this->__confirmation = null;
        return $this;
    }

    public function setEditorDialog($title, $description, $submit, $fields = [], $data = [], $cancel = 'clearEditorDialog', $validator = 'validateEditorDialog')
    {
        $this->dataEditorFields = [];
        $this->dataEditorFiles = [];
        foreach ($fields as $f) {
            $f['col'] = 12;
            $this->dataEditorFields[$f['key']] = $f;
        }

        $this->__editorDialog = [
            'title' => $title,
            'description' => $description,
            'submit' => $submit,
            'cancel' => $cancel,
            'fields' => $this->dataEditorFields,
            'data' => $data,
            'validator' => $validator,
            'dialog' => $this->dailogComponent,
        ];
    }

    public function clearEditorDialog()
    {
        $this->__editorDialog = null;
        $this->dataEditorFields = [];
    }

    public function validateEditorDialog()
    {
        // dd($this->__editorDialog);
        // $fields = collect($this->__editorDialog['fields']);
        $fields = collect($this->dataEditorFields);
        $validation = $fields->pluck('validation', 'key')->toArray();
        // $data = $fields->merge(collect($this->dataEditorFiles));
        $data = $fields->pluck('value', 'key')->toArray();
        foreach ($this->dataEditorFiles as $key => $file) {
            $data[$key] = $file;
        }

        Validator::make($data, $validation)->validate();
        call_user_func([$this, $this->__editorDialog['submit']], $this->__editorDialog['data'], $data);
    }

    public function contextMenu()
    {
        return new MenuItem('context-menu', 'Context Menu');
    }

    public function refresh() {}

    abstract public function page();

    public function render()
    {
        return $this->page()
            ->layout($this->layout, ['__header' => $this->__header])
            ->with(['rid' => uniqid('RID')]);
    }
}
