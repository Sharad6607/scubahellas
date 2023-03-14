/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.skin = 'moono-lisa';
	config.toolbar = 'MyToolbar';
	config.toolbar_MyToolbar =
	[
		//{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },		
		//{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
		// { name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar'] },
		// { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		// { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
				
	];

	config.removePlugins = 'elementspath';
	config.resize_enabled = false;

	config.extraPlugins = 'imageuploader';
	config.filebrowserBrowseUrl =  'http://localhost/chemscience/assets/uploads/upload.php';
	config.filebrowserUploadUrl = 'http://localhost/chemscience/assets/uploads/upload.php';
};
