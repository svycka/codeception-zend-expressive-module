<?php

namespace App;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\UploadedFile;
use \Codeception\Util\ReflectionHelper;

class RestAction implements RequestHandlerInterface
{
    /**
     * Handle the request and return a response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tokenHeader = $request->getHeader('X-Auth-Token');
        if (count($tokenHeader) > 0) {
            $tokenHeaderValue = $tokenHeader[0];
        } else {
            $tokenHeaderValue = null;
        }
        $data = array(
            'requestMethod' => $request->getMethod(),
            'requestUri' => $request->getRequestTarget(),
            'queryParams' => $request->getQueryParams(),
            'formParams' => $request->getParsedBody(),
            'rawBody' => (string)$request->getBody(),
            'headers' => $request->getHeaders(),
            'X-Auth-Token' => $tokenHeaderValue,
            'files' => $this->filesToArray($request->getUploadedFiles()),
        );
        return new JsonResponse($data);
    }

    private function filesToArray(array $files)
    {
        $result = [];
        foreach ($files as $fieldName => $uploadedFile) {
            /**
             * @var $uploadedFile UploadedFile|array
             */
            if (is_array($uploadedFile)) {
                $result[$fieldName] = $this->filesToArray($uploadedFile);
            } else {
                $result[$fieldName] = [
                    'name' => $uploadedFile->getClientFilename(),
                    'tmp_name' => ReflectionHelper::readPrivateProperty($uploadedFile, 'file'),
                    'size' => $uploadedFile->getSize(),
                    'type' => $uploadedFile->getClientMediaType(),
                    'error' => $uploadedFile->getError(),
                ];
            }
        }
        return $result;
    }
}
