CustomBaseBehavior
==================

[![Build Status](https://secure.travis-ci.org/csanquer/CustomBaseBehavior.png?branch=master)](http://travis-ci.org/csanquer/CustomBaseBehavior)

License
-------

MIT License

copyright (c) 2012 Charles Sanquer

Functionality
-------------

Propel Behavior to customize generated Parent Base classes

The normal propel inheritance with generated base classes follow this schema : 

![Normal inheritance schema](https://github.com/csanquer/CustomBaseBehavior/raw/master/doc/normal_base.jpg)

With CustomBaseBehavior you can change the parent classes of the base generated classes and share common methods between model objects

![Customized inheritance schema](https://github.com/csanquer/CustomBaseBehavior/raw/master/doc/custom_base.jpg)

Requirements
------------

This behavior requires [Propel](https://github.com/propelorm/Propel) >=1.6.0

Installation
------------

You can use [composer](http://getcomposer.org/)  and [packagist.org](http://packagist.org/) package [csanquer/custom-base-behavior](http://packagist.org/packages/csanquer/custom-base-behavior)

Or just download and copy the behavior to a specific path. 

Then register the behavior class by adding the following to the bottom of the `build.properties` file in you project folder:

```ini
# check that you have behaviors enabled
propel.builder.addBehaviors = true

# and add the custom behavior
propel.behavior.custom_base.class = path.to.CustomBehavior
```

Enable the behavior in your schema.xml:

```xml
<table name="book">
  <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
  <column name="title" type="VARCHAR" required="true" />

  <behavior name="custom_base">
    <parameter name="base_object" value="MyCustomBaseObject" /> <!-- default = "BaseObject" -->
    <parameter name="base_peer" value="MyCustomBasePeer" />     <!-- default = "" -->
    <parameter name="base_query" value="MyCustomBaseQuery" />   <!-- default = "ModelCriteria" -->
  </behavior>
</table>
```

Base classes can use namespaces ( with \, / or dot character).

Your custom Base Object class should extend Propel BaseObject and your custom Base Query class should extend Propel ModelCriteria.

Tests
-----

To run tests

```bash
curl -s http://getcomposer.org/installer | php
php composer.phar --dev install
phpunit
```
