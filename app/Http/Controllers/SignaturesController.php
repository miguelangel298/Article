<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignaturesController extends Controller
{

  /*
    * Name: SignaturesController@index
    * Parameters: []
    * Description: Call the template that invokes the component.
    * Return: Template.
  */
  public function index () {

    return view('signatures.index');

  }
}
