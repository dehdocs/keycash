<?php
$nameSpace = 'Proposal\Http\Controllers';

Route::group([
    'namespace'     => $nameSpace,
    'prefix'        => 'proposal',
    'middleware'    => 'web'
],function () {

    Route::get('/', 'ProposalController@index')->name('proposal-index');
    Route::get('create', 'ProposalController@create')->name('proposal-create');
    Route::post('create', 'ProposalController@postCreate')->name('save-proposal');

    Route::get('list', 'ProposalController@list')->name('proposal-list');
    Route::get('view/{proposal}', 'ProposalController@view')->name('proposal-view');
    Route::get('edit/{proposal}', 'ProposalController@edit')->name('proposal-edit');
});

