<?php

namespace app\models;

use dektrium\user\models\User;
use yii\data\ActiveDataProvider;

class UsersSearch extends User
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
            [['id','username', 'email',  'created_at', 'last_login_at'], 'safe'],
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
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}