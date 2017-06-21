Add to *map.xml*:

~~~xml
<?xml version="1.0" encoding="UTF-8"?>
<map xmlns:xs="http://www.w3.org/2001/XMLSchema-instance" xs:noNamespaceSchemaLocation="../../map.xsd">
    <source>
        <document_rules>
            ...
            ...
            ...
            <!-- rename table in M1 as it is in M2 -->
            <rename>
                <document>tm_soldtogether_customer</document>
                <to>swissup_soldtogether_customer</to>
            </rename>
            <rename>
                <document>tm_soldtogether_order</document>
                <to>swissup_soldtogether_order</to>
            </rename>
            ...
            ...
            ...
        </document_rules>
        <field_rules>
            ...
            ...
            ...
            <!-- map and ignore fields from M1 -->
            <move>
                <field>tm_soldtogether_customer.related_product_id</field>
                <to>swissup_soldtogether_customer.related_id</to>
            </move>
            <move>
                <field>tm_soldtogether_order.related_product_id</field>
                <to>swissup_soldtogether_order.related_id</to>
            </move>
            <ignore>
                <datatype>tm_soldtogether_customer.relation_id</datatype>
            </ignore>
            <ignore>
                <datatype>tm_soldtogether_customer.is_admin</datatype>
            </ignore>
            <ignore>
                <datatype>tm_soldtogether_order.relation_id</datatype>
            </ignore>
            <ignore>
                <datatype>tm_soldtogether_order.is_admin</datatype>
            </ignore>
            ...
            ...
            ...
        </field_rules>
    </source>
    <destination>
        <document_rules>
            ...
            ...
            ...
        </document_rules>
        <field_rules>
            ...
            ...
            ...
            <ignore>
                <field>swissup_soldtogether_customer.store_id</field>
            </ignore>
            <ignore>
                <field>swissup_soldtogether_customer.product_name</field>
            </ignore>
            <transform>
                <field>swissup_soldtogether_customer.product_name</field>
                <handler class="\Swissup\DataMigration\Handler\SoldTogether\ProductName">
                    <param name="productIdFieldName" value="product_id" />
                </handler>
            </transform>
            <ignore>
                <field>swissup_soldtogether_customer.related_name</field>
            </ignore>
            <transform>
                <field>swissup_soldtogether_customer.related_name</field>
                <handler class="\Swissup\DataMigration\Handler\SoldTogether\ProductName">
                    <param name="productIdFieldName" value="related_id" />
                </handler>
            </transform>
            <ignore>
                <field>swissup_soldtogether_order.store_id</field>
            </ignore>
            <ignore>
                <field>swissup_soldtogether_order.product_name</field>
            </ignore>
            <transform>
                <field>swissup_soldtogether_order.product_name</field>
                <handler class="\Swissup\DataMigration\Handler\SoldTogether\ProductName">
                    <param name="productIdFieldName" value="product_id" />
                </handler>
            </transform>
            <ignore>
                <field>swissup_soldtogether_order.related_name</field>
            </ignore>
            <transform>
                <field>swissup_soldtogether_order.related_name</field>
                <handler class="\Swissup\DataMigration\Handler\SoldTogether\ProductName">
                    <param name="productIdFieldName" value="related_id" />
                </handler>
            </transform>
            <ignore>
                <datatype>swissup_soldtogether_customer.relation_id</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_soldtogether_customer.is_admin</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_soldtogether_order.relation_id</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_soldtogether_order.is_admin</datatype>
            </ignore>
            ...
            ...
            ...
        </field_rules>
    </destination>
</map>
~~~