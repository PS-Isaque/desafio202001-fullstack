<?php

namespace App\v1\Controller;

use App\v1\Controller\Core\BaseController;
use App\v1\Manager\AddressManager;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

/**
 * Class AddressController
 * @package App\v1\Controller
 * @OA\Schema(schema="AddressCreationObject", required={"address"},
 *     @OA\Property(property="address", type="object", required={"street", "number", "neighborhood", "city", "state", "zipcode"}, description="Address object.",
 *          @OA\Property(property="address.street", type="string", example="Boston Street", description="The street of address."),
 *          @OA\Property(property="address.number", type="string", example=513, description="The number of address."),
 *          @OA\Property(property="address.complement", type="string", example="Apto 8", description="The complement of address."),
 *          @OA\Property(property="address.neighborhood", type="string", example="Paradise", description="The neighborhood of address."),
 *          @OA\Property(property="address.city", type="string", example="Boston", description="The city of address."),
 *          @OA\Property(property="address.state", type="string", example="Massachusetts", description="The state of address."),
 *          @OA\Property(property="address.zipcode", type="number", example=25874125, description="The zipcode of address."),
 *      ),
 * ),
 * @OA\Schema(schema="AddressResponseOK", type="object", @OA\Property(property="message", description="A message with service success description.", type="string", example="success.")),
 * @OA\Schema(schema="AddressNotFoundError", type="object",
 *      @OA\Property(property="message",description="Message with an error description",type="string",example="Address was not found"),
 *      @OA\Property(property="error",description="Error code. For this property, we have the following errors scenarios:<br/>802 - ADDRESS NOT FOUND",type="integer",example="802")
 * ),
 * @OA\Schema(schema="AddressResponseObject",
 *     allOf={
 *      @OA\Schema(ref="#/components/schemas/Address"),
 *      @OA\Schema(@OA\Property(property="message", type="object", @OA\Property(property="type", type="string", example="address")))
 *  }
 * )
 */
class AddressController extends BaseController
{
    /**
     * @OA\Post(
     *  path="/address/create",
     *  description="This service is responsible generate a address according the request body received",
     *  operationId="Address Generation",
     *  tags={"Address"},
     *      @OA\RequestBody(description="Specification of the request body needed on this service.", required=true,
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressCreationObject"))
     *      ),
     *      @OA\Response(response="200",description="Request success",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressResponseObject"))
     *      ),
     *      @OA\Response(response="500",description="Internal Server Error",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/InternalServerError"))
     *      ),
     *      @OA\Response(response="400", description="Payload validation errors. All request body has specific validation rules. When some validation error happens, the response will be like bellow.",
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(type="object",
     *                  @OA\Property(property="message",type="string",example="Some errors was found to generate address", description="Payload validation errors"),
     *                  @OA\Property(property="errors",type="object",description="Messages of all validation errors",
     *                      @OA\Property(property="address",description="Errors validation message of address field",type="array",
     *                          @OA\Items(type="string",example="The address field is required.")
     *                      ),
     *                      @OA\Property(property="address.street",description="Errors validation message of street field",type="array",
     *                          @OA\Items(type="string",example="The street field is required.")
     *                      ),
     *                      @OA\Property(property="address.number",description="Errors validation message of number field",type="array",
     *                          @OA\Items(type="string",example="The number field is required.")
     *                      ),
     *                      @OA\Property(property="address.neighborhood",description="Errors validation message of neighborhood field",type="array",
     *                          @OA\Items(type="string",example="neighborhood field is required.")
     *                      ),
     *                      @OA\Property(property="address.city",description="Errors validation message of city field",type="array",
     *                          @OA\Items(type="string",example="city field is required.")
     *                      ),
     *                      @OA\Property(property="address.state",description="Errors validation message of state field",type="array",
     *                          @OA\Items(type="string",example="state field is required.")
     *                      ),
     *                      @OA\Property(property="address.zipcode",description="Errors validation message of zipcode field",type="array",
     *                          @OA\Items(type="string",example="zipcode field is required.")
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     * )
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function create(Request $request, Response $response): Response
    {
        $validator = $this->getRequestManager()->validate($request->getParams());

        if ($validator->passes()) {
            $addressParams = $request->getParams();

            $address = AddressManager::save($addressParams);
            $responseData = array_merge($address->toArray(), ['message' => ['type' => 'address']]);

            return $response->withJson($responseData)->withStatus(StatusCode::HTTP_OK);
        } else {
            return $response->withJson(
                [
                    'message' => 'Some errors was found to generate address',
                    'errors' => $validator->errors()]
            )->withStatus(StatusCode::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @OA\Post(
     *  path="/address/update",
     *  description="This service is responsible update a address according the request body received",
     *  operationId="Address Generation",
     *  tags={"Address"},
     *      @OA\RequestBody(description="Specification of the request body needed on this service.", required=true,
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressCreationObject"))
     *      ),
     *      @OA\Response(response="200",description="Request success",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressResponseObject"))
     *      ),
     *      @OA\Response(response="500",description="Internal Server Error",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/InternalServerError"))
     *      ),
     *      @OA\Response(response="400", description="Payload validation errors. All request body has specific validation rules. When some validation error happens, the response will be like bellow.",
     *          @OA\MediaType(mediaType="application/json",
     *                @OA\Schema(type="object",
     *                  @OA\Property(property="message",type="string",example="Some errors was found to generate address", description="Payload validation errors"),
 *                      @OA\Property(property="errors",type="object",description="Messages of all validation errors",
     *                      @OA\Property(property="address",description="Errors validation message of address field",type="array",
     *                          @OA\Items(type="string",example="The address field is required.")
     *                      ),
     *                      @OA\Property(property="address.street",description="Errors validation message of street field",type="array",
     *                          @OA\Items(type="string",example="The street field is required.")
     *                      ),
     *                      @OA\Property(property="address.number",description="Errors validation message of number field",type="array",
     *                          @OA\Items(type="string",example="The number field is required.")
     *                      ),
     *                      @OA\Property(property="address.neighborhood",description="Errors validation message of neighborhood field",type="array",
     *                          @OA\Items(type="string",example="neighborhood field is required.")
     *                      ),
     *                      @OA\Property(property="address.city",description="Errors validation message of city field",type="array",
     *                          @OA\Items(type="string",example="city field is required.")
     *                      ),
     *                      @OA\Property(property="address.state",description="Errors validation message of state field",type="array",
     *                          @OA\Items(type="string",example="state field is required.")
     *                      ),
     *                      @OA\Property(property="address.zipcode",description="Errors validation message of zipcode field",type="array",
     *                          @OA\Items(type="string",example="zipcode field is required.")
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     * )
     *
     * @param Request $request
     * @param Response $response
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function update(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        $validator = $this->getRequestManager()->validate($request->getParams());

        if ($validator->passes()) {
            $addressParams = $request->getParams();

            $address = AddressManager::update($id, $addressParams);
            if($address) {
                $responseData = $address->toArray();
                return $response->withJson($responseData)->withStatus(StatusCode::HTTP_OK);
            }else{
                $responseData = AddressManager::ERROR_MESSAGES[AddressManager::ADDRESS_NOT_FOUND];
                return $response->withJson($responseData)->withStatus(StatusCode::HTTP_NOT_FOUND);
            }
        } else {
            return $response->withJson(
                [
                    'message' => 'Some errors was found to update address',
                    'errors' => $validator->errors()]
            )->withStatus(StatusCode::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @OA\Get(
     * path="/get?id=value",
     * description="This service is responsible for consulting a address.",
     * operationId="Address Search",
     * tags={"Address"},
     *      @OA\Parameter(name="id", in="query", required=true, description="The address id you wish to consult", @OA\Schema(type="number")),
     *      @OA\Response(response="500",description="Internal Server Error",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/InternalServerError"))
     *      ),
     *      @OA\Response(response="404",description="If a address not be found, the service will return this error.",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressNotFoundError"))
     *      ),
     *      @OA\Response(response="200",description="Request success",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressResponseObject"))
     *      )
     * )
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function show(Request $request, Response $response): Response
    {
        $id = $request->getAttribute('id');
        if ($address = AddressManager::getAddress($id)) {
            $statusCode = StatusCode::HTTP_OK;
            $defaultResponse = $address;
        } else {
            $statusCode = StatusCode::HTTP_NOT_FOUND;
            $defaultResponse = AddressManager::ERROR_MESSAGES[AddressManager::ADDRESS_NOT_FOUND];
        }

        return $response->withStatus($statusCode)->withJson($defaultResponse);
    }

    /**
     * @OA\Get(
     * path="/all",
     * description="This service is responsible for listing all addresses.",
     * operationId="All Addresses",
     * tags={"Address"},
     *      @OA\Response(response="500",description="Internal Server Error",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/InternalServerError"))
     *      ),
     *      @OA\Response(response="200",description="Request success",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressResponseObject"))
     *      )
     * )
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function all(Request $request, Response $response): Response
    {
        $address = AddressManager::getAllAddresses();
        return $response->withStatus(200)->withJson($address);
    }

    /**
     * @OA\Delete(
     * path="/{id}",
     * description="This service is responsible to delete a address.",
     * operationId="Address Delete",
     * tags={"Address"},
     *      @OA\Parameter(name="id", in="path", required=true, description="The id of address", @OA\Schema(type="string")),
     *      @OA\Response(response="500",description="Internal Server Error",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/InternalServerError"))
     *      ),
     *      @OA\Response(response="404",description="If a address not be found, the service will return this error.",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressNotFoundError"))
     *      ),
     *      @OA\Response(response="200",description="Request success",
     *          @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/AddressResponseObject"))
     *      )
     * )
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function delete(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');

        $address = AddressManager::deleteAddress($id);

        if($address){
            $defaultResponse = AddressManager::ADDRESS_DELETED;
            $statusCode = StatusCode::HTTP_OK;
        } else {
            $statusCode = StatusCode::HTTP_NOT_FOUND;
            $defaultResponse = AddressManager::ERROR_MESSAGES[AddressManager::ADDRESS_NOT_FOUND];
        }
        return $response->withStatus($statusCode)->withJson($defaultResponse);
    }
}
