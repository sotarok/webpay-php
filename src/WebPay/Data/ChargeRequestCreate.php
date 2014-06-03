<?php

namespace WebPay\Data;

use WebPay\InvalidRequestException;
use WebPay\AbstractData;
use WebPay\Data\CardRequest;

class ChargeRequestCreate extends AbstractData {

    public static function create($params)
    {
        if ((is_object($params) && $params instanceof ChargeRequestCreate)) {
            return $params;
        }
        if (is_array($params)) {
            return new ChargeRequestCreate($params);
        }
        throw new InvalidRequestException('ChargeRequestCreate does not accept the given value', $params);
    }

    public function __construct(array $params)
    {
        $this->fields = array('amount', 'currency', 'customer', 'card', 'description', 'capture', 'expire_days', 'uuid');
        $params = $this->normalize($this->fields, $params);
        $params['card'] = is_array($params['card']) ? new CardRequest($params['card']) : $params['card'];
        $this->attributes = $params;
    }

    public function __set($key, $value)
    {
        $underscore = $this->decamelize($key);
        if ($underscore === 'card') { $value = is_array($value) ? new CardRequest($value) : $value; }
        $this->attributes[$underscore] = $value;
    }
}
