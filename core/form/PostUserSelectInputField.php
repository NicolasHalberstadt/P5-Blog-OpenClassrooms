<?php
/* User: nicolashalberstadt
* Date: 06/01/2021
* Time: 19:05
*/

namespace app\core\form;

use app\core\App;
use app\models\User;
use nicolashalberstadt\phpmvc\form\BaseField;
use nicolashalberstadt\phpmvc\Model;

/**
 * Class PostUserSelectInputField
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core\form
 */
class PostUserSelectInputField extends BaseField
{

    private User $user;
    
    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model, $attribute);
        $this->user = new User();
    }

    public function renderInput(): string
    {
        $author = $this->user::findOne(['id' => $this->model->{$this->attribute}]);
        if (!$author) {
            $author = $this->user::findOne(['id' => App::$app->user->id]);
        }
        $authorId = $author->id;
        $authorName = $author->getDisplayName();
        $dbUsers = $this->user::findAll();
        $users = [];
        $options = [];
        // remove post's author from users
        foreach ($dbUsers as $user) {
            if ($author->id !== $user['id'] && $user['status'] = 1 && $user['type'] != 1) {
                $users[] = $user;
            }
        }
        // transform user array to object
        foreach ($users as $user) {
            $user = $this->user::findOne(['id' => $user['id']]);
            $userName = $user->getDisplayName();
            $options[] = '<option value="' . $user->id . '">' . $user->id . ': ' . $userName . '</option>';
        }
        $options = implode($options);
        return '<select name="' . $this->attribute . '" class="form-control">
                <option value="' . $authorId . '">' . $authorId . ': ' . $authorName . '</option>
                ' . $options . '
                </select>';
    }
}
