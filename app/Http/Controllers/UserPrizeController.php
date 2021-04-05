<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeUserPrizeRequest;
use App\Models\User;
use App\Models\UserPrize;
use App\Services\UserPrizeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserPrizeController extends Controller
{
    protected $userPrizeService;

    /**
     * UserPrizeController constructor.
     * @param  UserPrizeService  $userPrizeService
     */
    public function __construct(UserPrizeService $userPrizeService)
    {
        $this->userPrizeService = $userPrizeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $userPrizes = $this->userPrizeService->allByUser($user);

        return view('dashboard', ['userPrizes' => $userPrizes]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|Factory|View|Response
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $prize = $this->userPrizeService->addRandomPrize($user);

        return view('get-price', ['prize' => $prize]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ChangeUserPrizeRequest  $request
     * @param  UserPrize  $userPrize
     * @return Application|Factory|View|Response
     */
    public function destroy(ChangeUserPrizeRequest $request, UserPrize $userPrize)
    {
        $this->userPrizeService->delete($userPrize);

        return view('prize-deleted');
    }

    /**
     * @param  ChangeUserPrizeRequest  $request
     * @param  UserPrize  $userPrize
     * @return Application|Factory|View|Response
     */
    public function deliver(ChangeUserPrizeRequest $request, UserPrize $userPrize)
    {
        $this->userPrizeService->deliver($userPrize);

        return view('prize-delivered');
    }

    /**
     * @param  ChangeUserPrizeRequest  $request
     * @param  UserPrize  $userPrize
     * @return Application|Factory|View|Response
     */
    public function convert(ChangeUserPrizeRequest $request, UserPrize $userPrize)
    {
        $this->userPrizeService->convert($userPrize);

        return view('prize-converted');
    }
}
