<?php


namespace App\Utility;


use App\Models\ToDoListProviderResponseModels\ToDoListApiResponseModel;
use GuzzleHttp\Client;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

trait ToDoClient
{

    private $bodyRequiredMethods = ['POST', 'post', 'PUT', 'put'];
    private $queryStringMethods = ['GET', 'get', 'DELETE', 'delete'];
    private $response;

    public function callService($method, $baseUrl, $endpoint, $requestBody = null) : ToDoListApiResponseModel {

        /* Create client and call api. */
        $client = new Client();
        $requestUrl = $baseUrl.$endpoint;

        /* Get toDoApiResponseModel instance. */
        $toDoApiResponseModel = new ToDoListApiResponseModel();

        try {

            /* Check and do request. */
            if (in_array($method, $this->bodyRequiredMethods) == is_null($requestBody))
                abort(400,"Need request body.");
            elseif (in_array($method, $this->bodyRequiredMethods))
                $this->response = $client->request($method, $requestUrl, ['body' => $requestBody]);
            elseif (in_array($method, $this->queryStringMethods))
                $this->response = $client->request($method, $requestUrl);

            /* Set response model from api call response. */
            $toDoApiResponseModel->setHeaders($this->response->getHeaders());
            $toDoApiResponseModel->setStatusCode($this->response->getStatusCode());
            $toDoApiResponseModel->setResponseBody(json_decode($this->response->getBody()->getContents()));
        }
        catch (\Exception $exception) {

            /* Log exception and resume. */
            Log::alert($exception);
            $toDoApiResponseModel->setStatusCode(503);

        } finally {
            return $toDoApiResponseModel;
        }
    }
}
