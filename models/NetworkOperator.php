<?php

namespace vendor\istt\numberingplans\models;

use Yii;

/**
 * This is the model class for table "oc_cfg_operators".
 *
 * @property integer $operator_id
 * @property string $operator_name
 * @property string $operator_name_short
 * @property integer $country_id
 *
 * @property OperatorMnc $operatorMnc
 * @property OperatorNdc $operatorNdc
 * @property Countries $country
 * @property OperatorsInList $operatorsInList
 * @property OperatorsLists[] $operatorLists
 */
class NetworkOperator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%operators}}';
    }

    /**
    * @inheritdoc
    */
    public static function getDb(){
    	if (\Yii::$app->has('npDb') && \Yii::$app->npDb instanceof \yii\db\Connection)
    		return \Yii::$app->npDb;
    	else
    		return \Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id'], 'required'],
            [['country_id'], 'integer'],
            [['operator_name'], 'string', 'max' => 255],
            [['operator_name_short'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'operator_id' => Yii::t('np', 'Operator ID'),
            'operator_name' => Yii::t('np', 'Operator Name'),
            'operator_name_short' => Yii::t('np', 'Operator Name Short'),
            'country_id' => Yii::t('np', 'Country ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorMnc()
    {
        return $this->hasOne(OperatorMnc::className(), ['operator_id' => 'operator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorNdc()
    {
        return $this->hasOne(OperatorNdc::className(), ['operator_id' => 'operator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['country_id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorsInList()
    {
        return $this->hasOne(OperatorsInList::className(), ['operator_id' => 'operator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorLists()
    {
        return $this->hasMany(OperatorsLists::className(), ['operator_list_id' => 'operator_list_id'])->viaTable('oc_cfg_operators_in_list', ['operator_id' => 'operator_id']);
    }
}
