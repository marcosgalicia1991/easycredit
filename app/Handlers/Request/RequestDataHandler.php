<?php

namespace App\Handlers\Request;

class RequestDataHandler implements RequestDataHandlerInterface
{
	public function prepare(array $data)
	{
        return [
            'age' => array_get($data, 'age', 0),
            'amount' => array_get($data, 'amount', 0),
            'credit_card' => $data['credit_card'] ? 1:0,
            'term_id' => array_get($data, 'term_id', 0),
            'total_amount' => array_get($data, 'total_amount', 0),
        ];
    }
}
