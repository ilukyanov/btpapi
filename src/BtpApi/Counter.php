<?php

namespace BtpApi;

class Counter
{
    protected $req;
    protected $data = array();
    protected $ts;

    /**
     * @param Request $req
     * @param array $data - параметры
    'service'   => Название сервиса
    'srv'       => Адрес сервера
    'op'        => Название операции
     */
    public function __construct(Request $req, array $data)
    {
        $this->req = $req;
        if (empty($data['service'])) {
            $service = preg_replace('~\.(\d+)~', '', $data['srv']);
            $service = preg_replace('~([._](tcp|udp|json|test))~', '', $service);
            $service = preg_replace('~(\d+)$~', '', $service);

            $data['service'] = $service;
        }
        $this->data = $data;
        $this->ts = microtime(true);
    }

    public function __destruct()
    {
        $this->stop();
    }

    public function stop()
    {
        if ($this->data) {
            $tmp = $this->data + array('ts' => round(1000000 * (microtime(true) - $this->ts)));
            $this->req->append($tmp);
            $this->data = null;
        }
    }

    public function setOperation($operation)
    {
        $this->data["op"] = $operation;
    }
}
