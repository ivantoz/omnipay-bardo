<?php

namespace Omnipay\Bardo\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Bardo Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
	public function __construct(RequestInterface $request, $data)
	{
		if (!is_array($data)) {
			parse_str($data, $data);
		}

		parent::__construct($request, $data);
	}

	public function isSuccessful()
	{

		return isset($this->data['TransactionStatus']) &&  $this->data['TransactionStatus'] === "00" || $this->data['TransactionStatus']=== "M0"  || $this->data['TransactionStatus']=== "M2" || $this->data['TransactionStatus']=== "K0" || $this->data['TransactionStatus']=== "K2";
	}

	public function getTransactionReference()
	{
		return isset($this->data['BardoNumber']) ? $this->data['BardoNumber'] : null;
	}

	public function getMessage()
	{
		return isset($this->data['ResponseMessage']) ? $this->data['ResponseMessage'] : null;
	}
	public function getTransactionDate()
	{
		return isset($this->data['TransactionDate']) ? $this->data['TransactionDate'] : null;


	}
	public function getTransactionAmount()
	{

		return isset($this->data['TransactionAmount']) ? $this->data['TransactionAmount'] : null;
	}

	public function getTransactionStatus()
	{
		return isset($this->data['TransactionStatus']) ? $this->data['TransactionStatus'] : null;

	}

}
