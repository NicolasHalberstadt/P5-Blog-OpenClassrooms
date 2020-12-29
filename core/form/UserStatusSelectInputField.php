<?php
/* User: nicolashalberstadt 
* Date: 29/12/2020 
* Time: 11:06
*/

namespace app\core\form;

use nicolashalberstadt\phpmvc\form\BaseField;
use nicolashalberstadt\phpmvc\Model;

/**
 * Class UserStatusSelectInputField
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core\form
 */
class UserStatusSelectInputField extends BaseField
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
    
    public function renderInput(): string
    {
        $userStatus = [];
        $currentName = '';
        $currentStatus = $this->model->{$this->attribute};
        switch ($currentStatus) {
            case 0:
                $userStatus = [1 => 'Active', 2 => 'Deleted'];
                $currentName = 'Inactive';
                break;
            case 1:
                $userStatus = [0 => 'Inactive', 2 => 'Deleted'];
                $currentName = 'Active';
                break;
            case 2:
                $userStatus = [0 => 'Inactive', 1 => 'Active'];
                $currentName = 'Deleted';
                break;
        }
        $options = [];
        foreach ($userStatus as $i => $status) {
            $options[] = '<option value="' . $i . '">' . $i . ': ' . $status . '</option>';
        }
        $options = implode($options);
        return '<select name="' . $this->attribute . '" class="form-control">
                <option value="' . $currentStatus . '">' . $currentStatus . ': ' . $currentName . '</option>
                ' . $options . '
                </select>';
    }
}