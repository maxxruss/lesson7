<?php

namespace app\models\search;

use app\models\Note;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Access;

/**
 * AccessSearch represents the model behind the search form about `app\models\Access`.
 */
class AccessSearch extends Access
{
    /**
     * @var string
     */
    public $noteCreator;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'note_id', 'user_id'], 'integer'],
            [['noteCreator'], 'safe'],
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
    public function searchIndex($params)
    {
        $query = Access::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['note', 'note.user']);

        $query->where("evrnt_note.creator=".Yii::$app->user->id);

        $dataProvider->sort->attributes['noteCreator'] = [
            'asc' => ['evrnt_note.creator' => SORT_ASC],
            'desc' => ['evrnt_note.creator' => SORT_DESC],
        ];

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'evrnt_access.id' => $this->id,
            'evrnt_access.note_id' => $this->note_id
        ]);

        $query->andWhere('evrnt_user.name LIKE "%' . $this->noteCreator . '%" ' .
            'OR evrnt_user.surname LIKE "%' . $this->noteCreator . '%"'
        );

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchFriends($params)
    {
        $query = Access::find();//->withUser(Yii::$app->user->id);

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
            'event_id' => $this->note_id,
            'user_id' => $this->user_id,
        ]);

        $query->groupBy($this->id);

        return $dataProvider;
    }
}
