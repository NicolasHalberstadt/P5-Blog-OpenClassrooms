<?php
/* User: nicolashalberstadt 
* Date: 29/12/2020 
* Time: 11:06
*/

namespace app\core\form;

use nicolashalberstadt\phpmvc\form\BaseField;
use nicolashalberstadt\phpmvc\Model;

/**
 * Class UserSelectInputField
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core\form
 */
class UserTypeSelectInputField extends BaseField
{
    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model, $attribute);
    }

    // Version without sprintf
    public function renderInput(): string
    {
        $userTypes = [];
        $currentName = '';
        $currentType = $this->model->{$this->attribute};
        switch ($currentType) {
            case 1:
                $userTypes = [2 => 'Editor', 3 => 'Admin'];
                $currentName = 'Member';
                break;
            case 2:
                $userTypes = [1 => 'Member', 3 => 'Admin'];
                $currentName = 'Editor';
                break;
            case 3:
                $userTypes = [1 => 'Member', 2 => 'Editor'];
                $currentName = 'Admin';
                break;
        }
        $options = [];
        foreach ($userTypes as $i => $type) {
            $options[] = '<option value="' . $i . '">' . $i . ': ' . $type . '</option>';
        }

        $options = implode($options);
        return '<select name="' . $this->attribute . '" class="form-control">
                <option value="' . $currentType . '">' . $currentType . ': ' . $currentName . '</option>'
            . $options . '
                </select>';
    }

    /*public function renderInput(): string
    {
        $userTypes = [];
        switch ($this->model->{$this->attribute}) {
            case 0:
                $userTypes = [1, 2];
                break;
            case 1:
                $userTypes = [0, 2];
                break;
            case 2:
                $userTypes = [0, 1];
                break;
        }
        $options = [];
        foreach ($userTypes as $type) {
            $options[] = '<option value="$type">' . $type . '</option>';
        }
        $options = implode($options);
        return sprintf(' <select name="%s" class="form-select%s">
                                <option value="%s">%s</option>
                                %s
                                </select>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->{$this->attribute},
            $this->model->{$this->attribute},
            $options
        );
    }*/


}