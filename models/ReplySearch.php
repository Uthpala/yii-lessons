<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reply;

/**
 * ReplySearch represents the model behind the search form about `app\models\Reply`.
 */
class ReplySearch extends Reply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'comment_id', 'thread_id' ], 'integer'],
            [['reply', 'created_at'], 'safe'],
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
        $query = Reply::find();

        if( $params['r'] == 'reply/chart'){
            $query->groupBy('comment_id');
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $createdAt = explode( ' - ',$this->created_at);
        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'comment_id' => $this->comment_id,
            'thread_id' => $this->thread_id,
        ]);

        $query->andFilterWhere(['like', 'reply', $this->reply]);
        if( count( $createdAt ) > 1){
            $this->createdAt = $createdAt[0] .' to '.$createdAt[1];
            $query->andFilterWhere(['>=', 'created_at', $createdAt[0]]);
            $query->andFilterWhere(['<=', 'created_at', $createdAt[1]]);
        }
        return $dataProvider;
    }
}
