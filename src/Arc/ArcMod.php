<?php


namespace SPR\ServiceSDK\Arc;

use SPR\ServiceSDK\Arc\Core\IArcDefinition;
use SPR\ServiceSDK\Arc\Operations\ReadableEndpoint;

abstract class ArcMod implements IArcDefinition
{

    public abstract function version(): int;

    public abstract function mod(): string;

    public abstract function readables(): array;

    public abstract function writables(): array;


    public function reflect()
    {
        $mod = $this->mod();
        $version = $this->version();
        $name = $this->name();
        $description = $this->description();

        $readables = [];
        $writables = [];

        foreach ($this->readables() as $readable) {
            $readable = app($readable);
            $readables[] = [
                "signature" => $readable->signature(),
                "name" => $readable->name(),
                "description" => $readable->description(),
                "query" => $readable->query(),
                "data" => $readable->data(),
            ];
        }

        foreach ($this->writables() as $writable) {
            $writable = app($writable);
            $writables[] = [
                "signature" => $writable->signature(),
                "name" => $writable->name(),
                "description" => $writable->description(),
                "query" => $writable->query(),
                "data" => $writable->data(),
            ];
        }
        return [
            "mod" => $mod,
            "version" => $version,
            "name" => $name,
            "description" => $description,
            "readables" => $readables,
            "writables" => $writables,
        ];
    }
}
