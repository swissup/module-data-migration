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
                <document>tm_askit_item</document>
                <to>swissup_askit_item</to>
            </rename>
            <rename>
                <document>tm_askit_message</document>
                <to>swissup_askit_message</to>
            </rename>
            <rename>
                <document>tm_askit_vote</document>
                <to>swissup_askit_vote</to>
            </rename>
            ...
            ...
            ...
        </document_rules>
        <field_rules>
            ...
            ...
            ...
            <!-- map and ignore datatype mismatch from M1 -->
            <move>
                <field>tm_askit_message.private</field>
                <to>swissup_askit_message.is_private</to>
            </move>
            <ignore>
                <datatype>tm_askit_message.created_time</datatype>
            </ignore>
            <ignore>
                <datatype>tm_askit_message.update_time</datatype>
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
            <transform>
                <field>swissup_askit_message.parent_id</field>
                <handler class="\Swissup\DataMigration\Handler\AskIt\NullToZero" />
            </transform>
            <ignore>
                <datatype>swissup_askit_message.created_time</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_askit_message.update_time</datatype>
            </ignore>
            ...
            ...
            ...
        </field_rules>
    </destination>
</map>
~~~
