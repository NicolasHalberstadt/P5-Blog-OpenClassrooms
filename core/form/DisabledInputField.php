<?php
/* User: nicolashalberstadt 
* Date: 29/12/2020 
* Time: 10:19
*/

namespace app\core\form;

use nicolashalberstadt\phpmvc\form\BaseField;
use nicolashalberstadt\phpmvc\Model;

/**
 * Class DisabledInputField
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core\form
 */
class DisabledInputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;

    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }


    public function renderInput(): string
    {
        return sprintf(' <input type="%s" name="%s" value="%s" class="form-control%s" disabled>',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }
}
