<?php

namespace App\Http\Controllers\Api\V1;

use App\Transformers\AdvisoryTransformer;
use App\Http\Requests\Api\V1\AdvisoryRequest;
use App\Models\Advisory;
use Illuminate\Http\Request;

class AdvisoryController extends Controller
{
    public function store(AdvisoryRequest $request, Advisory $advisory)
    {
        $advisory->fill($request->all());
        $advisory->user_id = $this->user()->id;
        $advisory->create_time = $_SERVER['REQUEST_TIME'];
        $advisory->save();

        return $this->response->item($advisory, new AdvisoryTransformer())
            ->setStatusCode(201);
    }

    public function update(AdvisoryRequest $request, Advisory $advisory)
    {
        $this->authorize('update', $advisory);

        $advisory->update($request->all());
        
        return $this->response->item($advisory, new AdvisoryTransformer());
    }

    public function destroy(Advisory $advisory)
    {
        $this->authorize('destroy', $advisory);

        $advisory->delete();

        return $this->response->noContent();
    }

    public function show(Advisory $advisory)
    {
        return $this->response->item($advisory, new AdvisoryTransformer());
    }

    public function index(Request $request, Advisory $advisory)
    {
        $query = $advisory->query();
        
        if ($classify_id = $request->classify_id) {
            $query->where('classify_id', $classify_id);
        }

        switch ($request->order) {
            case 'time':
                $query->orderBy('create_time', 'desc');
                break;
        }

        $advisorys = $query->paginate(10);

        return $this->response->paginator($advisorys, new AdvisoryTransformer());
    }
}
