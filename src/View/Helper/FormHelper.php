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

        $templateVars = [
            'class' => $this->makeClass($options['container']['class'] ?? null),
            'label' => $this->makeExLabelHtml($field, $options),
            'input' => $this->exInput($field, $options),
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

        $templateVars = [
            'input' => $this->makeExInputHtml($field, $options),
            'error' => $this->getErrorMessage($field, $options),
            'append' => $options['append'],
            'prepend' => $options['prepend'],
        ];

        return $this->getView()->element('EntreeCore.form/ex_input_container', $templateVars);
    }

    // *********************************************************
    // * Protected User-defined functions
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
     * Get input element relative path without extension
     *
     * @param string $type Input type
     * @return string
     */
    protected function getInputElement($type)
    {
        if (in_array($type, ['select'])) {
            return "EntreeCore.form/ex_{$type}";
        }

        return 'EntreeCore.form/ex_input';
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
     * Make attributes for input, select, textarea tag
     *
     * @param string $field The field name
     * @param array<string, mixed> $options Options list
     * @return array
     */
    protected function makeInputAttributes($field, $options)
    {
        $attrs = array_filter($options, function ($value, $name) {
            return !in_array($name, array_keys(static::EX_CONTROL_DEFAULT_OPTIONS))
                && $value !== false;
        }, ARRAY_FILTER_USE_BOTH);

        $val = $options['val'] ?? $this->getView()
            ->getRequest()
            ->getData($field, $this->context()->val($field));
        if (!in_array($val, [false, null], true)) {
            $attrs['value'] = (string)$val;
        }

        $required = $options['required'] ?? null;
        if ($required === true) {
            $attrs['required'] = 'required';
        }

        foreach ($attrs as $name => $value) {
            if ($value === true) {
                $attrs[$name] = $name;
            }
        }

        return $attrs;
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

        if (isset($options['error']) || $this->context()->hasError($field)) {
            $classes[] = 'is-invalid';
        }

        return $this->makeClass($classes);
    }

    /**
     * Make input options parameter
     *
     * @param array<string, mixed> $options Options list
     * @return array
     */
    protected function makeInputOptions($options)
    {
        $options = $options['options'] ?? null;
        if (!is_array($options)) {
            return [];
        }

        foreach ($options as $key => $option) {
            $attrs = null;
            if (is_array($option)) {
                $value = $option['value'];
                $text = $option['text'];
                $attrs = array_filter($option, function ($key) {
                    return !in_array($key, ['value', 'text']);
                }, ARRAY_FILTER_USE_KEY);
            } else {
                $value = $key;
                $text = $option;
            }
            $options[$key] = compact('value', 'text');
        }

        return $options;
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
        $type = $options['type'] ?? null;
        if ($type === null) {
            $type = isset($options['options']) ? 'select' : 'type';
        }

        $inputElement = $options['inputElement'] ?? $this->getInputElement($type);

        $templateVars = [
            'name' => $options['name'] ?? $this->makeInputName($field),
            'attrs' => $this->makeInputAttributes($field, $options),
            'class' => $this->makeInputClass($field, $options),
            'options' => $this->makeInputOptions($options),
            'type' => $type,
        ];

        return $this->getView()->element($inputElement, $templateVars);
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
