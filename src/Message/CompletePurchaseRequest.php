<?php

namespace Omnipay\Bardo\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Bardo Complete Purchase Request
 */
class CompletePurchaseRequest extends AbstractRequest
{
	protected $endpoint = 'https://pay.bardo-gateway.com/trm/TransactionHandler.ashx';
    public function getData()
    {
	    $this->validate('transactionId', 'username', 'password', 'clientid');

	    $data = array();
	    $data['SHOP_NUMBER'] = $this->getTransactionId();
	    $data['UserName'] = $this->getParameter('username');
	    $data['Password'] = $this->getParameter('password');
	    $data['ClientId'] = $this->getParameter('clientid');
	    return $data;

    }

    public function sendData($data)
    {
	    // don't throw exceptions for 4xx errors
	    $this->httpClient->getEventDispatcher()->addListener(
		    'request.error',
		    function ($event) {
			    if ($event['response']->isClientError()) {
				    $event->stopPropagation();
			    }
		    }
	    );
	    $search = $this->httpClient->post($this->getEndpoint())
		    ->addPostFields($data)
		    ->send();

        return $this->response = new CompletePurchaseResponse($this, $search->json());

    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

	public function setUsername($value)
	{
		$this->setParameter('username', $value);
	}

	public function getUsername()
	{
		$this->getParameter('username');
	}

	public function setPassword($value)
	{
		$this->setParameter('password', $value);
	}

	public function getPassword()
	{
		$this->getParameter('password');
	}
	public function setClientId($value)
	{
		$this->setParameter('clientid', $value);
	}
	public function getClientId()
	{
		$this->getParameter('clientid');
	}
}
