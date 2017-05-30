<?php

namespace Ls\Replication\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductGroup extends AbstractDb
{

    public function _construct()
    {
        $this->_init( 'lsr_replication_product_group', 'product_group_id' );
    }


}

