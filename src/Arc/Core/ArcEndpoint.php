<?php


namespace SPR\ServiceSDK\Arc\Core;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SPR\ServiceSDK\Arc\Core\IArcDefinition;
use SPR\ServiceSDK\Arc\Core\IArcEndpoint;

abstract class ArcEndpoint extends Controller implements IArcDefinition,IArcEndpoint
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    abstract public function authorise():bool;

    abstract public function query(): array;

    abstract public function data(): array;


    public function __invoke(Request $request)
    {
        $query = Validator::make($request->query(), $this->query())->validate();
        $data = Validator::make($request->post(), $this->data())->validate();

        return $this->endpoint($query,$data);
    }
}
