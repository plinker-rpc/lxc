<?php
namespace Plinker\LXC;

use Opis\Closure\SerializableClosure;

class Manager {

    public function __construct(array $config = array())
    {
        $this->config = $config;
    }

    function this($params = array())
    {
        return $this;
    }
    
    function hello($params = array())
    {
        return $this;
    }
    
    function helloClosure($params = array())
    {
        $test = function ($what) {
            return $what.' - Thanks buddy...';
        };

        return new SerializableClosure($test);
    }

}
