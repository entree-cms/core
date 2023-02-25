<?php
declare(strict_types=1);

namespace EntreeCore\Model\Behavior;

use ArrayObject;
use Cake\Event\EventInterface;
use Cake\Http\Exception\InternalErrorException;
use Cake\ORM\Behavior;

/**
 * Nullable behavior
 */
class NullableBehavior extends Behavior
{
    /**
     * @var array<string, mixed> Default configuration.
     */
    protected $_defaultConfig = [
        'fields' => null,
    ];

    /**
     * initialize callback
     *
     * @param array $config The config
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        if ($this->getConfig('fields') === null) {
            $this->setConfig('fields', $this->getNullableFields());
        }

        if (!is_array($this->getConfig('fields'))) {
            throw new InternalErrorException('The "fields" param is invalid');
        }
    }

    /**
     * beforeMarshal callback
     *
     * @param \Cake\Event\EventInterface $event The event
     * @param \ArrayObject $data The data
     * @param \ArrayObject $options The options
     * @return void
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        // Convert blank string into NULL
        foreach ($this->getConfig('fields') as $field) {
            $value = $data[$field] ?? null;
            if (is_string($value) && trim($value) === '') {
                $data[$field] = null;
            }
        }
    }

    // *********************************************************
    // * Internal methods
    // *********************************************************

    /**
     * Get nullabel fields.
     *
     * @return array
     */
    protected function getNullableFields(): array
    {
        $fields = [];

        $schema = $this->table()->getSchema();
        foreach ($schema->columns() as $field) {
            if ($schema->isNullable($field)) {
                $fields[] = $field;
            }
        }

        return $fields;
    }
}
