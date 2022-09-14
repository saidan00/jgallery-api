<?php

namespace App\Repositories;

use Kreait\Firebase\Database\Reference;

abstract class FirebaseRepository
{
    /**
     * @var Reference
     */
    protected $_reference;

    /**
     * @var \Kreait\Firebase\Database
     */
    protected $_database;

    public function __construct()
    {
        $this->setReference();
    }

    /**
     * get reference
     * @return string
     */
    abstract public function getReference();

    /**
     * Set reference
     */
    public function setReference()
    {
        $this->_database = app('firebase.database');
        $this->_reference = $this->_database->getReference($this->getReference());
    }

    /**
     * Get All
     *
     * @return array
     */
    public function getAll()
    {
        return $this->_reference->getSnapshot()->getValue() ?? [];
    }

    /**
     * Get one
     *
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        $itemRef = $this->_reference->getChild($id);
        $item = $this->setItemId($itemRef);

        return $item;
    }

    /**
     * Create
     *
     * @param array $attributes
     *
     * @return array
     */
    public function create(array $attributes)
    {
        $itemRef = $this->_reference->push($attributes);
        $item = $this->setItemId($itemRef);

        return $item;
    }

    /**
     * Update
     *
     * @param int $id
     * @param array $attributes
     *
     * @return array
     */
    public function update($id, array $attributes)
    {
        $itemRef = $this->_reference->getChild($id)->update($attributes);
        $item = $this->setItemId($itemRef);

        return $item;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->_reference->getChild($id)->remove();
    }

    private function setItemId(Reference $itemRef)
    {
        $snapShot = $itemRef->getSnapshot();
        $item = $snapShot->getValue();
        $item['id'] = $snapShot->getKey();
        return $item;
    }
}
