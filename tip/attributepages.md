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
                <document>tm_attributepages_entity</document>
                <to>swissup_attributepages_entity</to>
            </rename>
            <rename>
                <document>tm_attributepages_entity_store</document>
                <to>swissup_attributepages_store</to>
            </rename>
            ...
            ...
            ...
        </document_rules>
    </source>
</map>
~~~
