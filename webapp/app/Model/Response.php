<?php
class Response extends AppModel
{
  var $belongsTo = array(
      'ResponseType' => array(
          'className' => 'ResponseType',
          'foreignKey' => 'response_type_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      )
  );
}
