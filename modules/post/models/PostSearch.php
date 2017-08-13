<?php

namespace app\modules\post\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\post\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\modules\post\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public $date_from;
    public $date_to;

    public function rules()
    {
        return [
            [['id', 'update_at'], 'integer'],
            [['title', 'alias', 'content', 'preview','status'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
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
        $query = Post::find();

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
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'status'    => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);
        return $dataProvider;
    }
}
