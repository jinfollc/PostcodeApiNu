<?php
namespace PostcodeApiNu;

use Doctrine\Common\Cache\Cache;

class CachedService implements ServiceInterface
{
    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * @var \Doctrine\Common\Cache\Cache
     */
    protected $cache;

    public function __construct(ServiceInterface $service, Cache $cache)
    {
        $this->service = $service;
        $this->cache = $cache;
    }

    /**
     * @param $postalCode
     * @param null $number
     * @return array
     * @throws \RuntimeException
     */

    public function find($postalCode, $number = null)
    {
        $cacheKey = md5($postalCode . '_' . $number);
        if ($this->cache->contains($cacheKey)) {
            return unserialize($this->cache->fetch($cacheKey));
        }

        $result = $this->service->find($postalCode, $number);
        $this->cache->save($cacheKey, serialize($result));

        return $result;
    }
}
