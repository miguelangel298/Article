<?php

namespace App\Http\Controllers\Api;
use App\Singature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SignatureResource;
// use Illuminate\Foundation\Validation\ValidatesRequests;
class SignatureController extends Controller
{
    public function index() {

      $signatures = Singature::latest()
        ->paginate(6);

      return SignatureResource::collection($signatures);
    }

    public function show(Singature $singature) {

      return new SignatureResource($signature);

    }

    public function store(Request $request) {

      $signature = $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'body' => 'required|min:3'
        ]);

      $signature = Singature::create($signature);

      return new SignatureResource($signature);
    }
}
