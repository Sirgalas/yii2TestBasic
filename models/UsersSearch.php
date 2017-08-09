<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.08.17
 * Time: 9:50
 */

namespace app\models;

use dektrium\user\models\UserSearch ;
use yii\data\ActiveDataProvider;

class UsersSearch extends  UserSearch
{
    /** @var int */
    public $id;
    /** @var string */
    public $username;

    /** @var string */
    public $email;

    /** @var int */
    public $created_at;

    /** @var int */
    public $last_login_at;



    public function rules()
    {
        return [
            'fieldsSafe' => [['username', 'email', 'id', 'created_at', 'last_login_at'], 'safe'],
        ];
    }
    public function search($params)
    {
        $query = $this->finder->getUserQuery();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at !== null) {
            $date = strtotime($this->created_at);
            $query->andFilterWhere(['between', 'created_at', $date, $date + 3600 * 24]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['registration_ip' => $this->registration_ip]);

        return $dataProvider;
    }
}