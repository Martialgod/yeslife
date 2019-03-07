<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Symfony\Component\HttpFoundation\Response as HTTP_CODE;

use Illuminate\Http\Request;

class ApiController extends BaseController
{
    //
    //
    
    public function __construct(){

    }

    protected $statusCode = 200; //default status code

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode){
    	$this->statusCode = $statusCode;

    	return $this; //to support method chaining
    }

   /**
    * @return Response
    */
    public function getStatusCode(){
    	return $this->statusCode;
    }


    /**
     * @param String $message
     */
    public function respondNotFound($message = 'Resource Not Found!'){
    	//404
    	return $this->setStatusCode(HTTP_CODE::HTTP_NOT_FOUND)->respondWithError($message);

    }


    /**
     * @param String $message
     */
    public function respondInternalError($message = 'Internal Error!'){
    	//500
    	return $this->setStatusCode(HTTP_CODE::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);

    }

    /**
     * @param String $message
     */
    public function respondCreated($message = 'Succesfully Created!'){

    	//201
    	return $this->setStatusCode(HTTP_CODE::HTTP_CREATED)->respond($message);

    }

    /**
     * @param String $message
     */
    public function respondParameterFailed($message = 'Invalid Paramters!'){
    	//422
    	return $this->setStatusCode(HTTP_CODE::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    
    }


    /**
     * @param  String $message
     * @return Response
     */
    public function respondWithError($message){
    	
    	return $this->respond([
    		'error'=> [
    			'message'=> $message,
    			'status_code'=> $this->getStatusCode()
    		]
    	]);
    }



    /**
     * @param  mixed $data
     * @param  array
     * @return Response
     */
    public function respond($data, $headers = []){

    	return response()->json($data, $this->getStatusCode(), $headers);

    }
   

}
