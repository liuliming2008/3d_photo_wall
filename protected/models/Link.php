<?php

/**
 * This is the model class for table "{{links}}".
 *
 * The followings are the available columns in table '{{links}}':
 * @property integer $link_id
 * @property integer $link_author
 * @property string $link_status
 * @property integer $link_randkey
 * @property integer $link_votes
 * @property integer $link_reports
 * @property integer $link_comments
 * @property string $link_karma
 * @property string $link_modified
 * @property string $link_date
 * @property string $link_published_date
 * @property integer $link_category
 * @property integer $link_lang
 * @property string $link_url
 * @property string $link_url_title
 * @property string $link_title
 * @property string $link_title_url
 * @property string $link_content
 * @property string $link_summary
 * @property string $link_tags
 * @property string $link_field1
 * @property string $link_field2
 * @property string $link_field3
 * @property string $link_field4
 * @property string $link_field5
 * @property string $link_field6
 * @property string $link_field7
 * @property string $link_field8
 * @property string $link_field9
 * @property string $link_field10
 * @property string $link_field11
 * @property string $link_field12
 * @property string $link_field13
 * @property string $link_field14
 * @property string $link_field15
 * @property integer $link_group_id
 * @property string $link_group_status
 * @property integer $link_out
 */
class Link extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Links the static model class
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
		return '{{links}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('link_modified', 'required'),
			array('link_author, link_randkey, link_votes, link_reports, link_comments, link_category, link_lang, link_group_id, link_out', 'numerical', 'integerOnly'=>true),
			array('link_status, link_karma', 'length', 'max'=>10),
			array('link_url', 'length', 'max'=>200),
			array('link_title_url, link_field1, link_field2, link_field3, link_field4, link_field5, link_field6, link_field7, link_field8, link_field9, link_field10, link_field11, link_field12, link_field13, link_field14, link_field15', 'length', 'max'=>255),
			array('link_group_status', 'length', 'max'=>9),
			array('link_date, link_published_date, link_url_title, link_title, link_content, link_summary, link_tags', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('link_id, link_author, link_status, link_randkey, link_votes, link_reports, link_comments, link_karma, link_modified, link_date, link_published_date, link_category, link_lang, link_url, link_url_title, link_title, link_title_url, link_content, link_summary, link_tags, link_field1, link_field2, link_field3, link_field4, link_field5, link_field6, link_field7, link_field8, link_field9, link_field10, link_field11, link_field12, link_field13, link_field14, link_field15, link_group_id, link_group_status, link_out', 'safe', 'on'=>'search'),
		  */
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
			'link_id' => 'Link',
			'link_author' => 'Link Author',
			'link_status' => 'Link Status',
			'link_randkey' => 'Link Randkey',
			'link_votes' => 'Link Votes',
			'link_reports' => 'Link Reports',
			'link_comments' => 'Link Comments',
			'link_karma' => 'Link Karma',
			'link_modified' => 'Link Modified',
			'link_date' => 'Link Date',
			'link_published_date' => 'Link Published Date',
			'link_category' => 'Link Category',
			'link_lang' => 'Link Lang',
			'link_url' => 'Link Url',
			'link_url_title' => 'Link Url Title',
			'link_title' => 'Link Title',
			'link_title_url' => 'Link Title Url',
			'link_content' => 'Link Content',
			'link_summary' => 'Link Summary',
			'link_tags' => 'Link Tags',
			'link_field1' => 'Link Field1',
			'link_field2' => 'Link Field2',
			'link_field3' => 'Link Field3',
			'link_field4' => 'Link Field4',
			'link_field5' => 'Link Field5',
			'link_field6' => 'Link Field6',
			'link_field7' => 'Link Field7',
			'link_field8' => 'Link Field8',
			'link_field9' => 'Link Field9',
			'link_field10' => 'Link Field10',
			'link_field11' => 'Link Field11',
			'link_field12' => 'Link Field12',
			'link_field13' => 'Link Field13',
			'link_field14' => 'Link Field14',
			'link_field15' => 'Link Field15',
			'link_group_id' => 'Link Group',
			'link_group_status' => 'Link Group Status',
			'link_out' => 'Link Out',
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

		$criteria->compare('link_id',$this->link_id);
		$criteria->compare('link_author',$this->link_author);
		$criteria->compare('link_status',$this->link_status,true);
		$criteria->compare('link_randkey',$this->link_randkey);
		$criteria->compare('link_votes',$this->link_votes);
		$criteria->compare('link_reports',$this->link_reports);
		$criteria->compare('link_comments',$this->link_comments);
		$criteria->compare('link_karma',$this->link_karma,true);
		$criteria->compare('link_modified',$this->link_modified,true);
		$criteria->compare('link_date',$this->link_date,true);
		$criteria->compare('link_published_date',$this->link_published_date,true);
		$criteria->compare('link_category',$this->link_category);
		$criteria->compare('link_lang',$this->link_lang);
		$criteria->compare('link_url',$this->link_url,true);
		$criteria->compare('link_url_title',$this->link_url_title,true);
		$criteria->compare('link_title',$this->link_title,true);
		$criteria->compare('link_title_url',$this->link_title_url,true);
		$criteria->compare('link_content',$this->link_content,true);
		$criteria->compare('link_summary',$this->link_summary,true);
		$criteria->compare('link_tags',$this->link_tags,true);
		$criteria->compare('link_field1',$this->link_field1,true);
		$criteria->compare('link_field2',$this->link_field2,true);
		$criteria->compare('link_field3',$this->link_field3,true);
		$criteria->compare('link_field4',$this->link_field4,true);
		$criteria->compare('link_field5',$this->link_field5,true);
		$criteria->compare('link_field6',$this->link_field6,true);
		$criteria->compare('link_field7',$this->link_field7,true);
		$criteria->compare('link_field8',$this->link_field8,true);
		$criteria->compare('link_field9',$this->link_field9,true);
		$criteria->compare('link_field10',$this->link_field10,true);
		$criteria->compare('link_field11',$this->link_field11,true);
		$criteria->compare('link_field12',$this->link_field12,true);
		$criteria->compare('link_field13',$this->link_field13,true);
		$criteria->compare('link_field14',$this->link_field14,true);
		$criteria->compare('link_field15',$this->link_field15,true);
		$criteria->compare('link_group_id',$this->link_group_id);
		$criteria->compare('link_group_status',$this->link_group_status,true);
		$criteria->compare('link_out',$this->link_out);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}