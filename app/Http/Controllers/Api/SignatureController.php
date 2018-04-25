<?php

namespace App\Http\Controllers\Api;
use App\Singature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SignatureResource;
class SignatureController extends Controller
{
    public function index() {
      $signatures = Singature::latest()
      ->paginate(5);

      return SignatureResource::collection($signatures);
    }

    public function show(Singature $singature) {
      return new SignatureResource($signature);
    }

    public function store(Request $request) {
      $signature = $this->validate($request, [
        'name' => 'required|min:3|max:50',
        'email' => 'request|email',
        'body' => 'request|min:3'
      ]);

      $signature = Singature::create($signature);

      return new SignatureController($signature);
    }
}
