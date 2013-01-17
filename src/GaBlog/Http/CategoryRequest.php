<?php
namespace GaBlog\Http;
class CategoryRequest
{
    private $adapter;

    public function setAdapter($ad)
    {
        $this->adapter = $ad;
    }

    public function delete($id)
    {
        $this->adapter->setMethod('POST');
        $this->adapter->setUri('/category');
        $this->adapter->setBody($id);
        $contentJson = $this->adapter->send()->getContent();
        return json_decode($contentJson, true);
    }

    public function insert($data)
    {
        $this->adapter->setMethod('POST');
        $this->adapter->setUri('/category');
        $this->adapter->setBody($data);
        $contentJson = $this->adapter->send()->getContent();
        return json_decode($contentJson, true);
    }
}