<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Passwords;

/**
 * PasswordsSearch represents the model behind the search form about `app\models\Passwords`.
 */
class PasswordsSearch extends Passwords
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkpassword', 'password', 'fkuser'], 'integer'],
            [['descripcion', 'creado_en', 'actualizado_en'], 'safe'],
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
        $query = Passwords::find();

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
            'pkpassword' => $this->pkpassword,
            'password' => $this->password,
            'creado_en' => $this->creado_en,
            'actualizado_en' => $this->actualizado_en,
            'fkuser' => $this->fkuser,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
