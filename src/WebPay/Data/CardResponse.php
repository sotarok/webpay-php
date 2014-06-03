<?php

namespace WebPay\Data;

use WebPay\InvalidRequestException;
use WebPay\AbstractData;

class CardResponse extends AbstractData {

    public function __construct(array $params)
    {
        $this->fields = array('object', 'exp_month', 'exp_year', 'fingerprint', 'last4', 'type', 'cvc_check', 'name', 'country');
        $params = $this->normalize($this->fields, $params);
        $this->attributes = $params;
    }

    public function __set($key, $value)
    {
        throw new \Exception('This class is immutable');
    }
}
