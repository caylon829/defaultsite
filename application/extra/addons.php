<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'ems_send' => 
    array (
      0 => 'faems',
    ),
    'ems_notice' => 
    array (
      0 => 'faems',
    ),
    'leesignhook' => 
    array (
      0 => 'leesign',
    ),
    'response_send' => 
    array (
      0 => 'loginvideo',
    ),
  ),
  'route' => 
  array (
    '/leesign$' => 'leesign/index/index',
  ),
);