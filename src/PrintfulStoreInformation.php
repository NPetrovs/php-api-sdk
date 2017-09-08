<?php

namespace Printful;

use Printful\Structures\Order\PackingSlipItem;
use Printful\Structures\Store\Store;
use Printful\Structures\Store\StoreStatistics;
use Printful\Structures\Store\StoreCarriersServicesList;

class PrintfulStoreInformation
{
    /** @var PrintfulApiClient */
    private $printfulClient;

    /**
     * @param PrintfulApiClient $printfulClient
     */
    public function __construct(PrintfulApiClient $printfulClient)
    {
        $this->printfulClient = $printfulClient;
    }

    /**
     * @return Store|static
     */
    public function get()
    {
        $raw = $this->printfulClient->get('store');
        return Store::fromArray($raw);
    }

    /**
     * @param PackingSlipItem $parameters
     * @return PackingSlipItem
     */
    public function postPackingSlip(PackingSlipItem $parameters)
    {
        $request = [
            'email' => $parameters->email,
            'phone' =>  $parameters->phone,
            'message' => $parameters->message,
        ];

        $raw = $this->printfulClient->post('store/packing-slip', $request);
        return PackingSlipItem::fromArray($raw['packing_slip']);
    }

    /**
     * @return StoreStatistics
     */
    public function getStoreStatistics()
    {
        $raw = $this->printfulClient->get('store/statistics');
        return StoreStatistics::fromArray($raw['store_statistics']);
    }

    /**
     * @return StoreCarriersServicesList
     */
    public function getCarriersServices()
    {
        $raw = $this->printfulClient->get('store/carriers-services');
        return StoreCarriersServicesList::fromArray($raw);
    }

    /**
     * @param $carrierStatus
     * @return StoreCarriersServicesList
     */
    public function postCarriersServiceStatus($carrierStatus)
    {
        $raw = $this->printfulClient->post('store/carriers-services', $carrierStatus);
        return StoreCarriersServicesList::fromArray($raw);
    }
}