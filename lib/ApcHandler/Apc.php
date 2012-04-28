<?php
namespace ApcHandler;
/**
 * @about This library handles the functions of the APC for PHP object-oriented paradigm
 * @Author kinncj <kinncj@gmail.com>
 * @license Copyright (c) 2012, Kinn Coelho Julião.
All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

 * Redistributions of source code must retain the above copyright notice,
this list of conditions and the following disclaimer.

 * Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

 * Neither the name of Thiago Rigo nor the names of its
contributors may be used to endorse or promote products derived from this
software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 
 */
class Apc
{

    private $keys = array();
    private $ApcKeyName = "apchandler:";
    private static $instance;

    /**
     * 
     * @param Key $key
     */
    public function addKey(Key $key)
    {
        $this->keys[] = $key;
        return $this;
    }

    /**
     * 
     * @param Key $key
     */
    public function removeKey(Key $key)
    {
        $keyName = $this->ApcKeyName . $key->getName();
        if ($this->KeyExists($key)) {
            unset($key);
            return apc_delete("{$keyName}");
        }
        return false;
    }

    /**
     * 
     * @param Key $key
     * @return Ambigous <boolean, \ApcHandler\Key>
     */
    public function getKey(Key $key)
    {
        return $this->getApcKey($key);
    }

    /**
     * 
     * @param Key $key
     */
    private function getApcKey(Key $key)
    {
        $keyName = $this->ApcKeyName . $key->getName();
        $keyValue = apc_fetch("{$keyName}");
        if ($this->keyExists($key)) {
            return new Key("{$keyName}", $keyValue);
        }
        return false;
    }

    /**
     * 
     * @param Key $key
     */
    private function KeyExists(Key $key)
    {
        $keyName = $this->ApcKeyName . $key->getName();
        apc_fetch("{$keyName}", $keyExists);
        return $keyExists;
    }

    /**
     * 
     * @return boolean|\ApcHandler\Apc
     */
    public function store()
    {
        foreach ($this->keys as $key) {
            $keyName = $this->ApcKeyName . $key->getName();
            $check = apc_store("{$keyName}", $key->getValue(false));
            if ($check === false) {
                return $check;
            }
        }
        return $this;
    }

}
