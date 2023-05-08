<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController as RC;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ValidatedInput;
use App\Models\Average;

class OperationsController extends RC
{

  public function index(Request $request){

    $validated = $this->validate($request, [
      'numbers' => 'required|array|min:3|max:3',
    ]);

    if ($validated) {
      $numbersToOperate = $request->numbers;
    }

    $addition = $this->addition($numbersToOperate);
    $average = $this->average($numbersToOperate);

    $response = [
        "addition" => $addition,
        "average" => $average
    ];
  
    /**saving the average */
    // $average = new Average();
    // $average->resultaverage = $average;
    // $average->save();


    if (count($response) > 0) {
        return $this->sendResponse($response, "Results");
      } else {
        return $this->sendError(null, "Problem making the operations");
      }
  }

  function addition($data){
    return $sum = $data[0] + $data[1] + $data[2];
  }

  function average($data){
    return $average = ($data[0] + $data[1] + $data[2]) / count($data);
  }

}