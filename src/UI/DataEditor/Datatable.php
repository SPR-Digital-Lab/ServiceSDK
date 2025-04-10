<?php

namespace SPR\ServiceSDK\UI\Glide;

use App\Glide\Pages\DashPage;
use App\Glide\Pages\UserPage;
use App\System\Menu\MenuItem;
use Carbon\Carbon;
use Illuminate\Support\Str;

abstract class Datatable extends DashPage
{
    public $datatableOrderBy;
    public $datatableFilters;
    public $datatableSearch;

    public $columns;

    public $allowedColumns = [];
    public $UUID;
    public $entity;

    public $orderByColumnIndex = -1;
    public $orderByColumnOrder = "desc";

    public $tableID = false;

    public function mount($uuid = null, $entity = null)
    {
        // dd($uuid);
        $this->UUID = $uuid;
        $this->entity = $entity;
        $this->datatableSearch = null;
        $this->datatableFilters = collect();
        $this->datatableOrderBy = collect();
        $this->preload();
        if (!$this->tableID) {
            $this->tableID = "table_" . Str::random(8);
        }
        // $this->loadColumns();
        $this->init();
    }

    public function preload() {}

    public function loadColumns()
    {
        $col = $this->query()->first();
        $this->clearColumns();
        if ($col) {
            $ref = $col->toArray();
            foreach ($ref as $k => $v) {
                $col = $this->generateColumn($k);
                if ($col)
                    $this->addColumn($col);
            }
        }
    }

    public function loadAllowedColumns()
    {
        // $col = $this->query()->first();
        $this->clearColumns();
        // if ($col) {
        foreach ($this->allowedColumns as $k) {
            $col = $this->generateColumn($k);
            if ($col)
                $this->addColumn($col);
        }
        // }
    }

    // public function sortWith

    public function formatValue($col, $row)
    {
        if ($row[$col['key']] instanceof Carbon) {
            return $row[$col['key']]->diffForHumans();
        } else if ($col['key'] == "system") {
            return $row[$col['key']] ? "<b class='text-danger fw-bold'>SYSTEM</b>" : "<b class='text-success fw-bold'>USER</b>";
        }
        return $row[$col['key']];
    }

    public function formatSearch($col, $row)
    {
        return "{$col['key']}:" . strtolower(trim(strip_tags($this->formatValue($col, $row))));
    }

    public function formatColumn($col)
    {
        return @$col['label'] ?? format_db_column($col['key']);
    }

    // public function

    public function deleteRow($index) {}

    public function editRow($index) {}

    public function deleteRowConfirm($index = null) {}

    public function generateColumn($key)
    {
        if (count($this->allowedColumns)) {
            if (in_array($key, $this->allowedColumns)) {
                return [
                    "key" => $key,
                ];
            } else
                return null;
        } else
            return [
                "key" => $key,
            ];
    }

    public function generateUniqueID($row)
    {
        return $row['id'];
    }

    public function findByUniqueID($id) {}

    public function clearColumns()
    {
        $this->columns = collect();
    }

    public function init() {}

    public function addColumn($row)
    {
        $this->columns->add($row);
    }

    public function addColumnSafe($row_key)
    {
        $this->columns->add($this->generateColumn($row_key));
    }

    public function removeColumn($key)
    {
        $this->columns = $this->columns->filter(function ($i) use ($key) {
            if ($i['key'] != $key)
                return true;
            else
                return false;
        });
    }

    public function getColumn($key)
    {
        $this->columns->where('key', $key)->first();
    }

    public function generateRowMenu($row)
    {
        return new MenuItem($this->generateUniqueID($row), "Options");
    }

    public function data()
    {
        return $this->query()->get();
    }

    abstract public function query();

    public function page()
    {
        return view('livewire.glide.datatable', ['list' => $this->data()]);
    }
}
