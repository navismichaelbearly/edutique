/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.removeButtons = 'Source,Preview,Print,Undo, Language,Redo,Image,Anchor,Indent,IFrame,About,Flash,Find,FloatingSpace,NewPage,Save,Smiley,Table,Forms,TableSelection,TableTools,Templates';
	config.removePlugins = 'elementspath,save,flash,iframe,smiley,tabletools,find,templates,about,maximize,showblocks,newpage,language';

config.removeButtons = 'Checkbox,Radio,Indent,Outdent,Copy,Cut,Paste,Print,Form,TextField,Textarea,Button,SelectAll,PasteText,PasteFromWord,Select,HiddenField,BidiLtr,BidiRtl,ImageButton,Scayt,HorizontalRule';
config.height = '50px';
 config.contentsCss = 'http://www.wilsea.com/ckeditor2/fonts/fonts.css';
          config.contentsCss = 'http://fonts.googleapis.com/css?family=Lobster';
          config.contentsCss = 'http://fonts.googleapis.com/css?family=Cardo:400,400italic,700';
		  config.contentsCss = 'https://fonts.googleapis.com/css2?family=Arima&family=Inter&family=Open+Sans&family=Oswald&family=Poppins&family=Roboto+Condensed&display=swap';
		  
//the next line add the new font to the combobox in CKEditor
         config.font_names =  'Hoefler Text/Hoefler Text;'+config.font_names;
         config.font_names =  'Cardo; serif;'+config.font_names;
         config.font_names =  'serif;sans serif;monospace;cursive;fantasy;Lobster;'+config.font_names;
		 config.font_names =  'Poppins; Arima; Inter; Roboto Condensed; Open Sans; sans-serif; '+config.font_names;
		 
		 CKEDITOR.on('instanceReady', function (ev) {
        ev.editor.dataProcessor.writer.setRules('br',
         {
             indent: false,
             breakBeforeOpen: false,
             breakAfterOpen: false,
             breakBeforeClose: false,
             breakAfterClose: false
         });
    });

    config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_BR;
	    CKEDITOR.on('instanceReady', function(evt) {

    if (evt.editor.getData() === "") {

    evt.editor.setData('<span style="font-family: Arial;font-size:12px;">&shy;</span>');

    }

    });

};



