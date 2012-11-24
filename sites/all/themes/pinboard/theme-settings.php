<?php

function pinboard_form_system_theme_settings_alter(&$form, $form_state) {

  $form['advansed_theme_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advansed Theme Settings'),
  );

  $form['advansed_theme_settings']['tm_value_3'] = array(
    '#type' => 'select',
    '#title' => t('Theme Skin'),
    '#default_value' => theme_get_setting('tm_value_3'),
    '#options' => array (
      'blue' => t('Blue'),
	    'gray' => t('Gray'),
	    'green' => t('Green'),
	    'lime' => t('Lime'),
	    'maroon' => t('Maroon'),
	    'orange' => t('Orange'),
	    'pink' => t('Pink'),
      'purple' => t('Purple'),
      'red' => t('Red'),
      'yellow' => t('Yellow'),
      //'custom' => t('Custom'),
    ),
  );

  $form['advansed_theme_settings']['tm_value_4'] = array(
    '#type' => 'select',
    '#title' => t('Theme Font'),
    '#default_value' => theme_get_setting('tm_value_4'),
    '#options' => array (
      'helvetica' => t('Helvetica Neue'),
      'aller' => t('Aller'),
	    'cabin' => t('Cabin'),
      'carto' => t('Carto'),
      'copse' => t('Copse'),
      'delicious' => t('Delicious'),
      'fontin' => t('Fontin'),
      'mavenpro' => t('Maven Pro'),
      'mido' => t('Mido'),
      'museo' => t('Museo'),
      'ptsans' => t('PT Sans'),
      'qlassik' => t('Qlassik'),
      'quicksand' => t('Quicksand'),
      'titillium' => t('Titillium'),
      'vegur' => t('Vegur'),
    ),
  );

  $form['advansed_theme_settings']['tm_value_5'] = array(
    '#type' => 'select',
    '#title' => t('Theme Background'),
    '#default_value' => theme_get_setting('tm_value_5'),
    '#options' => array (
      '1' => t('Background 1'),
	    '2' => t('Background 2'),
      '3' => t('Background 3'),
      '4' => t('Background 4'),
      '5' => t('Background 5'),
      '6' => t('Background 6'),
      '7' => t('Background 7'),
      '8' => t('Background 8'),
      '9' => t('Background 9'),
      '10' => t('Background 10'),
      '11' => t('Background 11'),
      '12' => t('Background 12'),
      '13' => t('Background 13'),
      '14' => t('Background 14'),
      '15' => t('Background 15'),
      '16' => t('Background 16'),
      '17' => t('Background 17'),
      '18' => t('Background 18'),
      '19' => t('Background 19'),
      '20' => t('Background 20'),
      '21' => t('Background 21'),
      '22' => t('Background 22'),
      '23' => t('Background 23'),
      '24' => t('Background 24'),
      '25' => t('Background 25'),
    ),
  );

/*

  $form['advansed_theme_settings']['socacc'] = array(
    '#type' => 'fieldset',
    '#title' => t('Accounts'),
  );

  $form['advansed_theme_settings']['socacc']['tm_value_0'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter'),
    '#default_value' => theme_get_setting('tm_value_0'),
  );
  $form['advansed_theme_settings']['socacc']['tm_value_1'] = array(
    '#type' => 'textfield',
    '#title' => t('Flikr'),
    '#default_value' => theme_get_setting('tm_value_1'),
  );
*/
}
