## Wiser Brand Order Grid Module

#### Overview

   This module adds two columns to the Order grid (table and form) 'coupon_code' and 'discount_amount'
 

#### Technical
   - columns added by the Declarative Schema - etc/db_schema.xml;
   - for columns synchronization between sales_order and sales_order_grid tables utilizes core virtual class - Magento\Sales\Model\ResourceModel\Order\Grid (check di.xml)  
   - the Setup/Patch/Data/OrderGridPatch class copies columns data for existing orders during the module installation. 
   