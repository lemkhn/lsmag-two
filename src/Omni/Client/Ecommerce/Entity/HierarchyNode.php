<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class HierarchyNode extends HierarchyPoint
{

    /**
     * @property ArrayOfHierarchyLeaf $Leafs
     */
    protected $Leafs = null;

    /**
     * @property ArrayOfHierarchyNode $Nodes
     */
    protected $Nodes = null;

    /**
     * @property int $ChildrenOrder
     */
    protected $ChildrenOrder = null;

    /**
     * @property int $Indentation
     */
    protected $Indentation = null;

    /**
     * @property int $PresentationOrder
     */
    protected $PresentationOrder = null;

    /**
     * @param ArrayOfHierarchyLeaf $Leafs
     * @return $this
     */
    public function setLeafs($Leafs)
    {
        $this->Leafs = $Leafs;
        return $this;
    }

    /**
     * @return ArrayOfHierarchyLeaf
     */
    public function getLeafs()
    {
        return $this->Leafs;
    }

    /**
     * @param ArrayOfHierarchyNode $Nodes
     * @return $this
     */
    public function setNodes($Nodes)
    {
        $this->Nodes = $Nodes;
        return $this;
    }

    /**
     * @return ArrayOfHierarchyNode
     */
    public function getNodes()
    {
        return $this->Nodes;
    }

    /**
     * @param int $ChildrenOrder
     * @return $this
     */
    public function setChildrenOrder($ChildrenOrder)
    {
        $this->ChildrenOrder = $ChildrenOrder;
        return $this;
    }

    /**
     * @return int
     */
    public function getChildrenOrder()
    {
        return $this->ChildrenOrder;
    }

    /**
     * @param int $Indentation
     * @return $this
     */
    public function setIndentation($Indentation)
    {
        $this->Indentation = $Indentation;
        return $this;
    }

    /**
     * @return int
     */
    public function getIndentation()
    {
        return $this->Indentation;
    }

    /**
     * @param int $PresentationOrder
     * @return $this
     */
    public function setPresentationOrder($PresentationOrder)
    {
        $this->PresentationOrder = $PresentationOrder;
        return $this;
    }

    /**
     * @return int
     */
    public function getPresentationOrder()
    {
        return $this->PresentationOrder;
    }


}

