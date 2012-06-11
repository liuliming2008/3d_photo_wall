<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{categories}}':
 * @property integer $category__auto_id
 * @property string $category_lang
 * @property integer $category_id
 * @property integer $category_parent
 * @property string $category_name
 * @property string $category_safe_name
 * @property integer $rgt
 * @property integer $lft
 * @property integer $category_enabled
 * @property integer $category_order
 * @property string $category_desc
 * @property string $category_keywords
 * @property string $category_author_level
 * @property string $category_author_group
 * @property string $category_votes
 * @property string $category_karma
 */
class Categories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Categories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{categories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, category_parent, rgt, lft, category_enabled, category_order', 'numerical', 'integerOnly'=>true),
			array('category_lang', 'length', 'max'=>2),
			array('category_name, category_safe_name', 'length', 'max'=>64),
			array('category_desc, category_keywords, category_author_group', 'length', 'max'=>255),
			array('category_author_level', 'length', 'max'=>6),
			array('category_votes, category_karma', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category__auto_id, category_lang, category_id, category_parent, category_name, category_safe_name, rgt, lft, category_enabled, category_order, category_desc, category_keywords, category_author_level, category_author_group, category_votes, category_karma', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'category__auto_id' => 'Category Auto',
			'category_lang' => 'Category Lang',
			'category_id' => 'Category',
			'category_parent' => 'Category Parent',
			'category_name' => 'Category Name',
			'category_safe_name' => 'Category Safe Name',
			'rgt' => 'Rgt',
			'lft' => 'Lft',
			'category_enabled' => 'Category Enabled',
			'category_order' => 'Category Order',
			'category_desc' => 'Category Desc',
			'category_keywords' => 'Category Keywords',
			'category_author_level' => 'Category Author Level',
			'category_author_group' => 'Category Author Group',
			'category_votes' => 'Category Votes',
			'category_karma' => 'Category Karma',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('category__auto_id',$this->category__auto_id);
		$criteria->compare('category_lang',$this->category_lang,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('category_parent',$this->category_parent);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('category_safe_name',$this->category_safe_name,true);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('category_enabled',$this->category_enabled);
		$criteria->compare('category_order',$this->category_order);
		$criteria->compare('category_desc',$this->category_desc,true);
		$criteria->compare('category_keywords',$this->category_keywords,true);
		$criteria->compare('category_author_level',$this->category_author_level,true);
		$criteria->compare('category_author_group',$this->category_author_group,true);
		$criteria->compare('category_votes',$this->category_votes,true);
		$criteria->compare('category_karma',$this->category_karma,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}