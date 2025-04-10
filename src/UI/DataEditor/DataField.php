<?php

namespace SPR\ServiceSDK\UI\DataEditor;


class DataField implements DataEditorTypes
{
    public $data;


    public function __construct()
    {
        $this->data = array();
    }

    public function getLabel()
    {
        return $this->data["label"];
    }

    public function getType()
    {
        return $this->data["type"];
    }

    public function getKey()
    {
        return $this->data["key"];
    }

    public function getValidation()
    {
        return $this->data["validation"];
    }

    public function getDescription()
    {
        return $this->data["description"];
    }

    public function getValue()
    {
        return $this->data["value"];
    }

    public function getCol()
    {
        return $this->data["col"];
    }

    public function getOpt()
    {
        return $this->data["opt"];
    }

    public function getFlags()
    {
        return $this->data["flags"];
    }

    // Setter methods
    public function setLabel($label)
    {
        $this->data["label"] = $label;
        return $this;
    }

    public function setType($type)
    {
        $this->data["type"] = $type;
        return $this;
    }

    public function setKey($key)
    {
        $this->data["key"] = $key;
        return $this;
    }

    public function setValidation($validation)
    {
        $this->data["validation"] = $validation;
        return $this;
    }

    public function setDescription($description)
    {
        $this->data["description"] = $description;
        return $this;
    }

    public function setValue($value)
    {
        $this->data["value"] = $value;
        return $this;
    }

    public function setCol($col)
    {
        $this->data["col"] = $col;
        return $this;
    }

    public function setOpt($opt)
    {
        if (count($opt) && !@$this->data['value']) {
            $this->setValue(@$opt[0]);
        }
        $this->data["opt"] = $opt;
        return $this;
    }

    public function setFlags($flags)
    {
        $this->data["flags"] = $flags;
        return $this;
    }

    public function toArray()
    {
        return $this->data;
    }
}
