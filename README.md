CustomBaseBehavior
==================

Propel Behavior to customize generated Parent Base classes

License
-------

MIT License
copyright (c) 2012 Charles Sanquer

Requirements
------------

This behavior requires Propel >=1.6.0

Installation
------------

Copy the behavior to a specific path and then register the behavior class by adding the following to the bottom of the `build.properties` file in you project folder:

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
    <parameter name="base_Query" value="MyCustomBaseQuery" />   <!-- default = "ModelCriteria" -->
  </behavior>
</table>
```

Base classes can use namespaces ( with \, / or dot character).

Your custom Base Object class should extend Propel BaseObject and your custom Base Query class should extend Propel ModelCriteria.
