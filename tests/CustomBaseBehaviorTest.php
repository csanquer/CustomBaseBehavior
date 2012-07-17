<?php

namespace Bookstore;

class MyAwesomeBehaviorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!class_exists('Book')) {
            $schema = <<<EOF
<database name="bookstore" defaultIdMethod="native" namespace="Bookstore">
    <table name="book">
        <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
        <column name="title" type="VARCHAR" required="true" />

        <behavior name="custom_base">
            <parameter name="base_object" value="Bookstore\MyCustomBaseObject" />
            <parameter name="base_peer" value="Bookstore\MyCustomBasePeer" />
            <parameter name="base_query" value="Bookstore\MyCustomBaseQuery" />
        </behavior>
    </table>
</database>
EOF;
            $builder = new \PropelQuickBuilder();
            $config  = $builder->getConfig();
            $config->setBuildProperty('behavior.custom_base.class', __DIR__.'/../src/CustomBaseBehavior');
            $builder->setConfig($config);
            $builder->setSchema($schema);
            $con = $builder->build();
            
//            var_dump($builder->getClasses());
        }
    }
    
    public function testCustomBase()
    {
        $this->assertEquals('Bookstore\\om\\BaseBook', get_parent_class('Bookstore\\Book'));
        $this->assertEquals('Bookstore\\MyCustomBaseObject', get_parent_class('Bookstore\\om\\BaseBook'));
        $this->assertEquals('BaseObject', get_parent_class('Bookstore\\MyCustomBaseObject'));
        
        $this->assertEquals('Bookstore\\om\\BaseBookPeer', get_parent_class('Bookstore\\BookPeer'));
        $this->assertEquals('Bookstore\\MyCustomBasePeer', get_parent_class('Bookstore\\om\\BaseBookPeer'));
        
        $this->assertEquals('Bookstore\\om\\BaseBookQuery', get_parent_class('Bookstore\\BookQuery'));
        $this->assertEquals('Bookstore\\MyCustomBaseQuery', get_parent_class('Bookstore\\om\\BaseBookQuery'));
        $this->assertEquals('ModelCriteria', get_parent_class('Bookstore\\MyCustomBaseQuery'));
    }
}

class MyCustomBaseObject extends \BaseObject
{
    
}

class MyCustomBasePeer
{
    
}

class MyCustomBaseQuery extends \ModelCriteria
{

}
