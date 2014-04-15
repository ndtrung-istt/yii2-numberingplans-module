<?php

namespace vendor\istt\numberingplans\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\istt\numberingplans\models\NetworkCode;

/**
 * NetworkCodeSearch represents the model behind the search form about `vendor\istt\numberingplans\models\NetworkCode`.
 */
class NetworkCodeSearch extends Model
{
    public $operator_id;
    public $mnc;

    public function rules()
    {
        return [
            [['operator_id'], 'integer'],
            [['mnc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'operator_id' => Yii::t('np', 'Operator ID'),
            'mnc' => Yii::t('np', 'Mnc'),
        ];
    }

    public function search($params)
    {
        $query = NetworkCode::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'operator_id' => $this->operator_id,
        ]);

        $query->andFilterWhere(['like', 'mnc', $this->mnc]);

        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
