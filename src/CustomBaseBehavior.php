<?php

/**
 * CustomBaseBehavior
 *
 * @author Charles SANQUER - <charles.sanquer@gmail.com>
 */
class CustomBaseBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'base_object' => 'BaseObject',
        'base_peer' => '',
        'base_query' => 'ModelCriteria',
    );

    protected function cleanfullyQualifiedClassName($fullyQualifiedClassName)
    {
        return trim(str_replace(array('.', '/'), '\\', $fullyQualifiedClassName), '\\');
    }

    protected function getClassName($fullyQualifiedClassName)
    {
        $className = $fullyQualifiedClassName;
        if (($pos = strrpos($fullyQualifiedClassName, '\\')) !== false) {
            $className = substr($fullyQualifiedClassName, $pos + 1);
            $namespace = substr($fullyQualifiedClassName, 0, $pos);
        }

        return $className;
    }

    public function parentClass($builder)
    {
        switch (get_class($builder)) {
            case 'PHP5PeerBuilder':
                $class = $this->getParameter('base_peer');
                break;
            
            case 'QueryBuilder':
                $class = $this->getParameter('base_query');
                break;
            
            case 'PHP5ObjectBuilder':
                $class = $this->getParameter('base_object');
                break;
        }

        if (!empty($class)) {
            $class = $this->cleanfullyQualifiedClassName($class);
            $builder->declareClass($class);

            return $this->getClassName($class);
        }
    }
}
