<?php
namespace Crm\Model\Storage;

interface Record {

    public function getStorageKey();

    public function getStorageFields();

    public function getPrimaryKey();

}