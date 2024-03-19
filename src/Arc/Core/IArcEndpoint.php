<?php


namespace SPR\ServiceSDK\Arc\Core;
interface IArcEndpoint
{
	public function signature():string;
	public function endpoint(array $query, array $data):array;
}
