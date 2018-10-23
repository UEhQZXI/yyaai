<?php

namespace App\Http\Controllers\Api\V1;

use App\Transformers\AdvisoryTransformer;
use App\Http\Requests\Api\V1\AdvisoryRequest;
use App\Models\Advisory;
use App\Models\User;
use Illuminate\Http\Request;

class AdvisoryController extends Controller
{
    public function store(AdvisoryRequest $request, Advisory $advisory)
    {
        $advisory->fill($request->all());
        $advisory->user_id = $this->user()->id;
        $advisory->create_time = $_SERVER['REQUEST_TIME'];
        $advisory->save();

        // return $this->response->item($advisory, new AdvisoryTransformer())
        //     ->setStatusCode(201);
        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    public function update(AdvisoryRequest $request, Advisory $advisory)
    {
        $this->authorize('update', $advisory);

        $advisory->update($request->all());

        // return $this->response->item($advisory, new AdvisoryTransformer());
        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    public function destroy(Advisory $advisory)
    {
        $this->authorize('destroy', $advisory);

        $advisory->delete();

        // return $this->response->noContent();
        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    public function show(Advisory $advisory)
    {
        $advisory = Advisory::where('id', $advisory->id)->get();
        // return $this->response->item($advisory, new AdvisoryTransformer());
        return $this->response->array(['message' => 'success', 'data' => $advisory]);
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

        $query->with(['user' => function ($query) {
            $query->select(['id', 'name', 'avatar', 'sex', 'birthday', 'integral', 'fans'])->get();
        }, 'articleClassify']);

        $advisorys = $query->paginate(10);

//        $advisorys = $this->response->paginator($advisorys, new AdvisoryTransformer());
        return $this->response->array(['message' => 'success', 'data' => $advisorys]);
    }

    public function userIndex(User $user, Request $request)
    {
        $advisorys =  $user->advisory()->paginate(10);

        return $this->response->array(['message' => 'success', 'data' => $advisorys]);
    }

}
