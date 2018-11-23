<?php


namespace App\Http\Controllers;


use App\Components\BlackMarketPost\Services\BlackMarketPostServiceContract;
use App\Http\Requests\BlackMarketValidationRequest;

class BlackMarketPostController extends Controller
{

    public function list(BlackMarketPostServiceContract $blackMarketService)
    {
        return
            $this->sendResponse($blackMarketService->list());
    }

    public function destroy(BlackMarketPostServiceContract $blackMarketService, $postId)
    {
        return
            $this->sendResponse($blackMarketService->destroy($postId));
    }

    public function store(BlackMarketValidationRequest $request, BlackMarketPostServiceContract $blackMarketService)
    {
        return
            $this->sendResponse($blackMarketService->store($request->validated()));
    }

    public function update(
        BlackMarketPostServiceContract $blackMarketService,
        $postId,
        BlackMarketValidationRequest $request
    ) {

        return
            $this->sendResponse($blackMarketService->update($request->validated(), $postId));

    }

    public function usersAds(BlackMarketPostServiceContract $blackMarketService, $userId)
    {
        return $this->sendResponse($blackMarketService->usersAds($userId));
    }


}