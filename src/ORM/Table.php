<?php
declare(strict_types=1);

namespace EntreeCore\ORM;

use Cake\Core\Configure;
use Cake\ORM\Table as BaseTable;

/**
 * Base table class
 */
class Table extends BaseTable
{
    /**
     * @var array Fields to translate
     */
    public static $translationFields = [];

    /**
     * @var bool Using translate behavior
     */
    private $usingTranslation = false;

    /**
     * initialize callback
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        if (count(static::$translationFields) > 0) {
            $this->usingTranslation = Configure::read('Entree.translate', false) === true;
        }

        if ($this->usingTranslation === true) {
            $this->addBehavior('Translate', [
                'fields' => static::$translationFields,
                'validator' => 'translated',
            ]);
        }
    }

    // *********************************************************
    // * User-defined functions
    // *********************************************************

    /**
     * Get using translation
     *
     * @return bool
     */
    public function isTranslationEnabled()
    {
        return $this->usingTranslation;
    }
}
