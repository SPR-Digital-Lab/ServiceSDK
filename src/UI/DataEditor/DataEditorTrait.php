<?php

namespace SPR\ServiceSDK\UI\DataEditor;

use Illuminate\Support\Facades\Validator;

trait DataEditorTrait
{
    public $dataEditorValues;
    public $dataEditorFiles;

    public $saveButton = 'Save Changes';
    public $cancelButton = null;

    public $UUID;

    public $title;

    public $inSupportWindow = false;

    public $directInit = true;

    public function mountDataEditorTrait($uuid = null)
    {
        // dd($uuid);
        $this->UUID = $uuid;
        $this->clearFields();
        $this->clearValues();
        if ($this->directInit) {
            $this->init();
        }
        $this->inSupportWindow = inSupportWindow();
    }

    public function init() {}

    public function clearFields()
    {
        $this->dataEditorFields = collect();
        $this->dataEditorFiles = [];
    }

    public function clearValues()
    {
        $this->dataEditorValues = collect();
    }

    public function addField($key, $label = null, $description = null, $type = DataField::TYPE_STRING, $validation = [], $default = null, $col = 4, $opt = [], $flags = [])
    {
        $this->dataEditorFields->put($key, [
            'label' => $label ?? $key,
            'type' => $type,
            'key' => $key,
            'validation' => $validation,
            'description' => $description,
            'value' => $default ?? (count($opt) && !@$flags['clean'] ? array_keys($opt)[0] : null),
            'col' => $col,
            'opt' => $opt,
            'flags' => $flags,
        ]);
    }

    public function removeDataFile($name)
    {
        unset($this->dataEditorFiles[$name]);
    }

    public function removeField($key)
    {
        $this->dataEditorFields->forget($key);
    }

    public function getField($key)
    {
        return $this->dataEditorFields->get($key);
    }

    public function updateField($key, $data = [])
    {
        $field = $this->getField($key);
        $field = array_merge($field, $data);
        $this->dataEditorFields->put($key, $field);
    }

    public function save() {}

    public function cancel() {}

    public function validateDataFieldsSafe()
    {
        return collect($this->validateDataFields())->map(function ($v, $k) {
            if (is_string($v) && empty($v)) return null;
            else return $v;
        });
    }

    public function validateDataFields()
    {
        $fields = collect($this->dataEditorFields);
        $fields = $fields->filter(function ($v) {
            return $v['type'] != DataEditor::TYPE_HEADER;
        });
        $data = $fields->pluck('value', 'key')->toArray();
        $data = array_merge($data, $this->dataEditorFiles);
        // dd($data);
        $validation = $fields->pluck('validation', 'key')->toArray();

        $tableFields = $fields->filter(function ($i) {
            return $i['type'] == DataEditorTypes::TYPE_TABLE;
        });
        $tableFields = $tableFields->map(function ($i) {
            $vds = @$i['flags']['validate'] ?? [];
            $vv = [];
            foreach ($vds as $k => $v) {
                $vv["{$i['key']}.*.{$k}"] = $v;
            }
            return $vv;
        })->values();
        $tableFields = $tableFields->reduce(function ($c, $t) {
            return array_merge($t, $c);
        }, []);
        $validation = array_merge($validation, $tableFields);
        return Validator::make($data, $validation)->validate();
    }
}
