<?php
namespace PostcodeApiNu;

interface ServiceInterface
{
    /**
     * @param string $postalCode
     * @param string|int|null $number
     * @return stdClass
     * @throws \RuntimeException
     */
    public function find($postalCode, $number = null);
}
