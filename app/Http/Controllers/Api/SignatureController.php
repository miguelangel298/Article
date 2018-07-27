<?php

namespace App\Http\Controllers\Api;
use App\Singature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SignatureResource;
class SignatureController extends Controller
{

  /*
    * Name: SignatureController@index
    * Parameters: []
    * Description: He invoked the model to obtain the records.
    * Return: Array.
  */

    public function index() {

      $signatures = Singature::latest()
        ->paginate(6);

      return SignatureResource::collection($signatures);
    }

    /*
      * Name: SignatureController@show
      * Parameters: [$singature]
      * Description: .
      * Return: Array.
    */

    public function show(Singature $singature) {

      return new SignatureResource($signature);

    }

    /*
      * Name: SignatureController@store
      * Parameters: [name, email, body]
      * Description: validate the data sent by the post request to be able to perform the Singature registration.
      * Return: any.
    */

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
