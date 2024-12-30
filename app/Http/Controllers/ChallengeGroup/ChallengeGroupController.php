<?php

namespace App\Http\Controllers\ChallengeGroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeGroup\CreateChallengeGroupRequest;
use App\Http\Resources\ChallengeGroup\ChallengeGroupResource;
use App\Models\ChallengeGroups\ChallengeGroup;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeGroupController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function create(CreateChallengeGroupRequest $request): JsonResource
    {
        $this->authorize('create', ChallengeGroup::class);
        $challenge_group = ChallengeGroup::create([
            'created_by' => auth()->id(),
            'name' => $request->input('name'),
            'end_date' => $request->input('end_date'),
        ]);
        return new ChallengeGroupResource($challenge_group);
    }
}
