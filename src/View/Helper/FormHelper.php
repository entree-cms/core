<?php
declare(strict_types=1);

namespace EntreeCore\View\Helper;

use Cake\Http\Exception\InternalErrorException;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\FormHelper as BaseFormHelper;

class FormHelper extends BaseFormHelper
{
    /**
     * @var array Default Options for exControl method
     */
    public const EX_CONTROL_DEFAULT_OPTIONS = [
        'class' => null,
        'container' => null,
        'error' => null,
        'id' => null,
        'append' => null,
        'prepend' => null,
        'inputContainer' => null,
        'label' => null,
        'options' => null,
        'required' => null,
        'type' => null,
        'val' => null,
    ];

    /**
     * Generate a form control element
     *
     * @param string $field The field name
     * @param array<string, mixed> $options The form control options
     * @return string
     */
    public function exControl(string $field, array $options = []): string
    {
        $options += static::EX_CONTROL_DEFAULT_OPTIONS;
        $options['id'] = $options['id'] ?? $this->_domId($field);
        $options['required'] = $options['required'] ?? $this->context()->isRequired($field);

        $templateVars = [
            'class' => $this->makeClass($options['container']['class'] ?? null),
            'label' => $this->makeExLabelHtml($field, $options),
            'input' => $options['input'] ?? $this->exInput($field, $options),
            'translations' => $this->makeTranslationsHtml($field, $options),
        ];

        return $this->getView()->element('EntreeCore.form/ex_control', $templateVars);
    }

    /**
     * Generate a input field element
     *
     * @param string $field The field name
     * @param array<string, mixed> $options The form control options
     * @return string
     */
    public function exInput(string $field, array $options = []): string
    {
        $options += static::EX_CONTROL_DEFAULT_OPTIONS;
        $options['id'] = $options['id'] ?? $this->_domId($field);
        $options['required'] = $options['required'] ?? $this->context()->isRequired($field);

        $templateVars = [
            'input' => $this->makeExInputHtml($field, $options),
            'error' => $this->getErrorMessage($field, $options),
            'append' => $options['append'],
            'prepend' => $options['prepend'],
        ];
        $templateVars += $options['inputContainer'] ?? [];

        return $this->getView()->element('EntreeCore.form/ex_input_container', $templateVars);
    }

    // *********************************************************
    // * Internal methods
    // *********************************************************

    /**
     * Get error messages
     *
     * @param string $field The field name
     * @param array<string, mixed> $options The form control optionss
     * @return ?string
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    protected function getErrorMessage($field, $options): ?string
    {
        $error = $options['error'] ?? $this->context()->error($field);

        if ($options['type'] === 'hidden' || $error === false) {
            return null;
        }

        if (is_array($error)) {
            $error = implode("\n", $error);
        }

        if (!is_string($error)) {
            throw new InternalErrorException();
        }

        return $error;
    }

    /**
     * Make value of class property
     *
     * @param string|array|null $classes Classes
     * @return string
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    protected function makeClass($classes): string
    {
        if ($classes === null) {
            return '';
        }

        if (is_string($classes)) {
            $classes = explode(' ', $classes);
        }
        if (!is_array($classes)) {
            throw new InternalErrorException();
        }

        $classes = array_map('trim', $classes);

        return implode(' ', $classes);
    }

    /**
     * Make value of name property
     *
     * @param string $field The field name
     * @return string
     */
    protected function makeInputName($field)
    {
        $hasBlackets = substr($field, -2) === '[]';

        $field = $hasBlackets ? substr($field, 0, -2) : $field;
        $parts = explode('.', $field);
        foreach ($parts as $i => $value) {
            $parts[$i] = $i === 0 ? $value : "[{$value}]";
        }

        $suffix = $hasBlackets ? '[]' : '';

        return implode('', $parts) . $suffix;
    }

    /**
     * Make value of class attribute for input tag
     *
     * @param string $field The field name
     * @param array<string, mixed> $options Options list
     * @return ?string
     * @throws \Cake\Http\Exception\InternalErrorException
     */
    protected function makeInputClass($field, $options)
    {
        $classes = $options['class'] ?? [];
        if (is_string($classes)) {
            $classes = explode(' ', $classes);
        }
        if (!is_array($classes)) {
            throw new InternalErrorException();
        }

        $type = $options['type'] ?? null;
        $isSelectType = $type === 'select' || isset($options['options']);
        $classes[] = $isSelectType ? 'form-select' : 'form-control';

        if (isset($options['error']) || $this->context()->hasError($field)) {
            $classes[] = 'is-invalid';
        }

        return $this->makeClass($classes);
    }

    /**
     * Make input field HTML
     *
     * @param string $field The name of the field to generate label for.
     * @param array<string, mixed> $options Options list
     * @return string
     */
    protected function makeExInputHtml($field, $options)
    {
        $options['class'] = $this->makeInputClass($field, $options);
        unset($options['container']);
        unset($options['inputContainer']);

        if (!isset($options['type']) && isset($options['options'])) {
            $options['type'] = 'select';
        }

        return $this->getView()->element('EntreeCore.form/ex_input', compact('field', 'options'));
    }

    /**
     * Make label HTML
     *
     * @param string $field The field name
     * @param array<string, mixed> $options Options list
     * @return string|null
     */
    protected function makeExLabelHtml($field, $options)
    {
        $options += [
            'id' => null,
            'label' => null,
            'type' => null,
            'required' => null,
        ];

        if ($options['type'] === 'hidden') {
            return null;
        }

        $label = $options['label'] ?? null;

        $labelText = null;
        if (is_array($label) && isset($label['text'])) {
            $labelText = $label['text'];
            unset($label['text']);
        } elseif (is_string($label)) {
            $labelText = $label;
        }

        $labelClass = null;
        if (is_array($label) && isset($label['class'])) {
            $labelClass = $label['class'];
            unset($label['class']);
        }

        $required = $options['required'] ?? null;

        $attrs = [];
        if (is_array($label)) {
            $attrs = array_merge($attrs, $label);
        }

        $for = $options['id'] ?? null;
        if ($for !== null && $for !== '') {
            $attrs['for'] = $for;
        }

        return $this->getView()->element('EntreeCore.form/ex_label', compact(
            'attrs',
            'labelClass',
            'labelText',
            'required',
        ));
    }

    /**
     * Make translation fields HTML
     *
     * @param string $field The field name
     * @param array<string, mixed> $options Options list
     * @return string|null
     */
    protected function makeTranslationsHtml($field, $options)
    {
        $context = $this->context();
        if (!method_exists($context, 'entity')) {
            return null;
        }

        $entity = $context->entity();

        $table = TableRegistry::get($entity->getSource());
        if (
            !method_exists($table, 'isTranslationEnabled')
            || !property_exists($table, 'translationFields')
            || !$table->isTranslationEnabled()
            || !in_array($field, $table::$translationFields)
        ) {
            return null;
        }

        return $this->getView()->element('EntreeCore.form/ex_translations', [
            'entity' => $entity,
            'field' => $field,
        ]);
    }
}
