<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Util\Logger;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;

class LogManagement
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Request
     */
    private $request;

    /**
     * LogManagement constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
        $this->setRequest($this->getContainer()->get('request'));
    }

    /**
     * @return ContainerInterface
     */
    private function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     */
    private function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return Request
     */
    private function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    private function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Generate error data log
     * @param \Exception $exception
     * @param array $params
     * @return array
     */
    public function getCriticalData(\Exception $exception, array $params = []) : array
    {
        $errorData = $this->getTrackingData();

        $hostName = $this->getRequest()->getHeader('HTTP_HOST');
        $hostName = end($hostName);

        $errorData = array_merge($errorData, [
            'severity' => '',
            'timestamp' => date('Y-m-d\TH:i:s.Z\Z', time()),
            'hostname' => $hostName,
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'pid' => getmypid()
        ]);

        return array_merge($errorData, $this->getExtraData($params));
    }

    /**
     * @param array $params
     * @return array
     */
    public function getInfoData(array $params = []) : array
    {
        $hostName = $this->getRequest()->getHeader('HTTP_HOST');
        $hostName = end($hostName);

        return array_merge(
            array_merge($this->getTrackingData(), [
                'severity' => '',
                'timestamp' => date('Y-m-d\TH:i:s.Z\Z', time()),
                'hostname' => $hostName,
        ]), $this->getExtraData($params, false));
    }

    /**
     * Generate tracking data for log information
     *
     * @return array
     */
    public function getTrackingData() : array
    {
        $trackingId = $this->getRequest()->getHeader('HTTP_X_FS_CORRELATION_ID');
        $trackingId = end($trackingId);

        $trackingName = $this->getRequest()->getHeader('HTTP_X_FS_REQUESTER_NAME');
        $trackingName = end($trackingName);

        return [
            'track' => [
                'id' => $trackingId,
                'name' => $trackingName
            ]
        ];
    }

    /**
     * @param array $params
     * @return array
     */
    public function getErrorData(array $params = []) : array
    {
        return $this->getInfoData($params);
    }

    /**
     * Get extra params log
     *
     * @param array $extra
     * @return array
     */
    public function getExtraData(array $extra = [], bool $request = true)
    {
        if (count($this->getRequest()->getParams()) && $request) {
            $extra['request'] = base64_encode(json_encode($this->getRequest()->getParams()));
        }

        return $extra;
    }
}
