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
                <document>tm_reviewreminder_entity</document>
                <to>swissup_reviewreminder_entity</to>
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
            <ignore>
                <datatype>tm_reviewreminder_entity.status</datatype>
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
                <datatype>swissup_reviewreminder_entity.status</datatype>
            </ignore>
            ...
            ...
            ...
        </field_rules>
    </destination>
</map>
~~~