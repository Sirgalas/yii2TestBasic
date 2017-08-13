<?php

namespace app\modules\message\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\message\models\MessageUser;

/**
 * MessageUserSearh represents the model behind the search form about `app\modules\message\models\MessageUser`.
 */
class MessageUserSearh extends MessageUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_post', 'id_user'], 'integer'],
            [['viewd'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MessageUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_post' => $this->id_post,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'viewd', $this->viewd]);

        return $dataProvider;
    }
}
