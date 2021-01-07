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
}