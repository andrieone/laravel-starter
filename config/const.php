<?php

/*
  |--------------------------------------------------------------------------
  | This config file contains common constants for the whole project
  | For example success / error message for CRUD
  |--------------------------------------------------------------------------
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Common message
    |--------------------------------------------------------------------------
     */
    // success when data created
    'SUCCESS_CREATE_MESSAGE'     => 'Your entry has been successfully saved!', //'入力した内容を保存しました。',
    // failed when data created
    'FAILED_CREATE_MESSAGE'      => 'Sorry, we were unable to save your entry. Please check your entry and try again later', //'入力した内容を保存できませんでした。',
    // success when data updated
    'SUCCESS_UPDATE_MESSAGE'     => 'Your update has been successfully saved!', //'編集した内容を保存しました。',
    // failed when data updated
    'FAILED_UPDATE_MESSAGE'      => 'Sorry, we were unable to save your update. Please check your update and try again later', //'編集した内容を保存できませんでした。',
    // success when data deleted
    'SUCCESS_DELETE_MESSAGE'     => 'Data has been successfully deleted!', // '対象のデータを削除しました。',
    // failed when data deleted
    'FAILED_DELETE_MESSAGE'      => 'Sorry, the data could not be deleted', // '対象のデータを削除できませんでした。',
    // failed when logged in user data deleted
    'FAILED_DELETE_SELF_MESSAGE' => 'Sorry, we could not delete data of currently logged in person', // '現在ログインされている方のデータを削除できませんでした。',

];
