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
                <document>easyslide</document>
                <to>swissup_easyslide_slider</to>
            </rename>
            <rename>
                <document>easyslide_slides</document>
                <to>swissup_easyslide_slides</to>
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
                <field>easyslide.easyslide_id</field>
                <to>swissup_easyslide_slider.slider_id</to>
            </move>
            <move>
                <field>easyslide.status</field>
                <to>swissup_easyslide_slider.is_active</to>
            </move>
            <ignore>
                <field>easyslide.autoglide</field>
            </ignore>
            <ignore>
                <field>easyslide.controls_type</field>
            </ignore>
            <ignore>
                <field>easyslide.created_time</field>
            </ignore>
            <ignore>
                <field>easyslide.duration</field>
            </ignore>
            <ignore>
                <field>easyslide.effect</field>
            </ignore>
            <ignore>
                <field>easyslide.frequency</field>
            </ignore>
            <ignore>
                <field>easyslide.width</field>
            </ignore>
            <ignore>
                <field>easyslide.height</field>
            </ignore>
            <ignore>
                <field>easyslide.modified_time</field>
            </ignore>
            <ignore>
                <field>easyslide.nivo_options</field>
            </ignore>
            <ignore>
                <field>easyslide.slider_type</field>
            </ignore>
            <ignore>
                <field>easyslide.theme</field>
            </ignore>
            <move>
                <field>easyslide_slides.desc_pos</field>
                <to>swissup_easyslide_slides.desc_position</to>
            </move>
            <move>
                <field>easyslide_slides.background</field>
                <to>swissup_easyslide_slides.desc_background</to>
            </move>
            <move>
                <field>easyslide_slides.is_enabled</field>
                <to>swissup_easyslide_slides.is_active</to>
            </move>
            <move>
                <!-- workaround; proper mapping will be made in destination handler -->
                <field>easyslide_slides.target_mode</field>
                <to>swissup_easyslide_slides.title</to>
            </move>
            <ignore>
                <datatype>easyslide.status</datatype>
            </ignore>
            <ignore>
                <datatype>easyslide_slides.desc_pos</datatype>
            </ignore>
            <ignore>
                <datatype>easyslide_slides.background</datatype>
            </ignore>
            <ignore>
                <datatype>easyslide_slides.target_mode</datatype>
            </ignore>
            <ignore>
                <datatype>easyslide_slides.sort_order</datatype>
            </ignore>
            <ignore>
                <datatype>easyslide_slides.is_enabled</datatype>
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
                <field>swissup_easyslide_slider.slider_config</field>
            </ignore>
            <transform>
                <field>swissup_easyslide_slider.slider_config</field>
                <handler class="\Swissup\DataMigration\Handler\EasySlide\Slider" />
            </transform>
            <transform>
                <field>swissup_easyslide_slides.title</field>
                <handler class="\Swissup\DataMigration\Handler\EasySlide\Slides" />
            </transform>
            <transform>
                <field>swissup_easyslide_slides.desc_position</field>
                <handler class="\Migration\Handler\Convert">
                    <param name="map" value="[1:top;2:right;3:bottom;4:left;5:bottom]" />
                    <param name="defaultValue" value="bottom" />
                </handler>
            </transform>
            <transform>
                <field>swissup_easyslide_slides.desc_background</field>
                <handler class="\Migration\Handler\Convert">
                    <param name="map" value="[1:light;2:dark;3:transparent]" />
                    <param name="defaultValue" value="light" />
                </handler>
            </transform>
            <transform>
                <field>swissup_easyslide_slides.target</field>
                <handler class="\Migration\Handler\Convert">
                    <param name="map" value="[0:_self;1:_blank;2:_self]" />
                    <param name="defaultValue" value="_self" />
                </handler>
            </transform>
            <ignore>
                <datatype>swissup_easyslide_slider.is_active</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_easyslide_slides.title</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_easyslide_slides.desc_position</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_easyslide_slides.desc_background</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_easyslide_slides.target</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_easyslide_slides.sort_order</datatype>
            </ignore>
            <ignore>
                <datatype>swissup_easyslide_slides.is_active</datatype>
            </ignore>
            ...
            ...
            ...
        </field_rules>
    </destination>
</map>
~~~
