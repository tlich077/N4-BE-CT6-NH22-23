/*! KeyTable 2.6.1
 * Â©2009-2021 SpryMedia Ltd - datatables.net/license
 */

/**
 * @summary     KeyTable
 * @description Spreadsheet like keyboard navigation for DataTables
 * @version     2.6.1
 * @file        dataTables.keyTable.js
 * @author      SpryMedia Ltd (www.sprymedia.co.uk)
 * @contact     www.sprymedia.co.uk/contact
 * @copyright   Copyright 2009-2021 SpryMedia Ltd.
 *
 * This source file is free software, available under the following license:
 *   MIT license - http://datatables.net/license/mit
 *
 * This source file is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 *
 * For details please refer to: http://www.datatables.net
 */

(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( ['jquery', 'datatables.net'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		// CommonJS
		module.exports = function (root, $) {
			if ( ! root ) {
				root = window;
			}

			if ( ! $ || ! $.fn.dataTable ) {
				$ = require('datatables.net')(root, $).$;
			}

			return factory( $, root, root.document );
		};
	}
	else {
		// Browser
		factory( jQuery, window, document );
	}
}(function( $, window, document, undefined ) {
'use strict';
var DataTable = $.fn.dataTable;
var namespaceCounter = 0;
var editorNamespaceCounter = 0;


var KeyTable = function ( dt, opts ) {
	// Sanity check that we are using DataTables 1.10 or newer
	if ( ! DataTable.versionCheck || ! DataTable.versionCheck( '1.10.8' ) ) {
		throw 'KeyTable requires DataTables 1.10.8 or newer';
	}

	// User and defaults configuration object
	this.c = $.extend( true, {},
		DataTable.defaults.keyTable,
		KeyTable.defaults,
		opts
	);

	// Internal settings
	this.s = {
		/** @type {DataTable.Api} DataTables' API instance */
		dt: new DataTable.Api( dt ),

		enable: true,

		/** @type {bool} Flag for if a draw is triggered by focus */
		focusDraw: false,

		/** @type {bool} Flag to indicate when waiting for a draw to happen.
		  *   Will ignore key presses at this point
		  */
		waitingForDraw: false,

		/** @type {object} Information about the last cell that was focused */
		lastFocus: null,

		/** @type {string} Unique namespace per instance */
		namespace: '.keyTable-'+(namespaceCounter++),

		/** @type {Node} Input element for tabbing into the table */
		tabInput: null
	};

	// DOM items
	this.dom = {

	};

	// Check if row reorder has already been initialised on this table
	var settings = this.s.dt.settings()[0];
	var exisiting = settings.keytable;
	if ( exisiting ) {
		return exisiting;
	}

	settings.keytable = this;
	this._constructor();
};


$.extend( KeyTable.prototype, {
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * API methods for DataTables API interface
	 */

	/**
	 * Blur the table's cell focus
	 */
	blur: function ()
	{
		this._blur();
	},

	/**
	 * Enable cell focus for the table
	 *
	 * @param  {string} state Can be `true`, `false` or `-string navigation-only`
	 */
	enable: function ( state )
	{
		this.s.enable = state;
	},

	/**
	 * Get enable status
	 */
	enabled: function () {
		return this.s.enable;
	},

	/**
	 * Focus on a cell
	 * @param  {integer} row    Row index
	 * @param  {integer} column Column index
	 */
	focus: function ( row, column )
	{
		this._focus( this.s.dt.cell( row, column ) );
	},

	/**
	 * Is the cell focused
	 * @param  {object} cell Cell index to check
	 * @returns {boolean} true if focused, false otherwise
	 */
	focused: function ( cell )
	{
		var lastFocus = this.s.lastFocus;

		if ( ! lastFocus ) {
			return false;
		}

		var lastIdx = this.s.lastFocus.cell.index();
		return cell.row === lastIdx.row && cell.column === lastIdx.column;
	},


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

	/**
	 * Initialise the KeyTable instance
	 *
	 * @private
	 */
	_constructor: function ()
	{
		this._tabInput();

		var that = this;
		var dt = this.s.dt;
		var table = $( dt.table().node() );
		var namespace = this.s.namespace;
		var editorBlock = false;

		// Need to be able to calculate the cell positions relative to the table
		if ( table.css('position') === 'static' ) {
			table.css( 'position', 'relative' );
		}

		// Click to focus
		$( dt.table().body() ).on( 'click'+namespace, 'th, td', function (e) {
			if ( that.s.enable === false ) {
				return;
			}

			var cell = dt.cell( this );

			if ( ! cell.any() ) {
				return;
			}

			that._focus( cell, null, false, e );
		} );

		// Key events
		$( document ).on( 'keydown'+namespace, function (e) {
			if ( ! editorBlock ) {
				that._key( e );
			}
		} );

		// Click blur
		if ( this.c.blurable ) {
			$( document ).on( 'mousedown'+namespace, function ( e ) {
				// Click on the search input will blur focus
				if ( $(e.target).parents( '.dataTables_filter' ).length ) {
					that._blur();
				}

				// If the click was inside the DataTables container, don't blur
				if ( $(e.target).parents().filter( dt.table().container() ).length ) {
					return;
				}

				// Don't blur in Editor form
				if ( $(e.target).parents('div.DTE').length ) {
					return;
				}

				// Or an Editor date input
				if (
					$(e.target).parents('div.editor-datetime').length ||
					$(e.target).parents('div.dt-datetime').length 
				) {
					return;
				}

				//If the click was inside the fixed columns container, don't blur
				if ( $(e.target).parents().filter('.DTFC_Cloned').length ) {
					return;
				}

				that._blur();
			} );
		}

		if ( this.c.editor ) {
			var editor = this.c.editor;

			// Need to disable KeyTable when the main editor is shown
			editor.on( 'open.keyTableMain', function (e, mode, action) {
				if ( mode !== 'inline' && that.s.enable ) {
					that.enable( false );

					editor.one( 'close'+namespace, function () {
						that.enable( true );
					} );
				}
			} );

			if ( this.c.editOnFocus ) {
				dt.on( 'key-focus'+namespace+' key-refocus'+namespace, function ( e, dt, cell, orig ) {
					that._editor( null, orig, true );
				} );
			}

			// Activate Editor when a key is pressed (will be ignored, if
			// already active).
			dt.on( 'key'+namespace, function ( e, dt, key, cell, orig ) {
				that._editor( key, orig, false );
			} );

			// Active editing on double click - it will already have focus from
			// the click event handler above
			$( dt.table().body() ).on( 'dblclick'+namespace, 'th, td', function (e) {
				if ( that.s.enable === false ) {
					return;
				}

				var cell = dt.cell( this );

				if ( ! cell.any() ) {
					return;
				}

				if ( that.s.lastFocus && this !== that.s.lastFocus.cell.node() ) {
					return;
				}

				that._editor( null, e, true );
			} );

			// While Editor is busy processing, we don't want to process any key events
			editor
				.on('preSubmit', function () {
					editorBlock = true;
				} )
				.on('preSubmitCancelled', function () {
					editorBlock = false;
				} )
				.on('submitComplete', function () {
					editorBlock = false;
				} );
		}

		// Stave saving
		if ( dt.settings()[0].oFeatures.bStateSave ) {
			dt.on( 'stateSaveParams'+namespace, function (e, s, d) {
				d.keyTable = that.s.lastFocus ?
					that.s.lastFocus.cell.index() :
					null;
			} );
		}

		dt.on( 'column-visibility'+namespace, function (e) {
			that._tabInput();
		} );

		// Redraw - retain focus on the current cell
		dt.on( 'draw'+namespace, function (e) {
			that._tabInput();

			if ( that.s.focusDraw ) {
				return;
			}

			var lastFocus = that.s.lastFocus;

			if ( lastFocus ) {
				var relative = that.s.lastFocus.relative;
				var info = dt.page.info();
				var row = relative.row + info.start;

				if ( info.recordsDisplay === 0 ) {
					return;
				}

				// Reverse if needed
				if ( row >= info.recordsDisplay ) {
					row = info.recordsDisplay - 1;
				}

				that._focus( row, relative.column, true, e );
			}
		} );

		// Clipboard support
		if ( this.c.clipboard ) {
			this._clipboard();
		}

		dt.on( 'destroy'+namespace, function () {
			that._blur( true );

			// Event tidy up
			dt.off( namespace );

			$( dt.table().body() )
				.off( 'click'+namespace, 'th, td' )
				.off( 'dblclick'+namespace, 'th, td' );

			$( document )
				.off( 'mousedown'+namespace )
				.off( 'keydown'+namespace )
				.off( 'copy'+namespace )
				.off( 'paste'+namespace );
		} );

		// Initial focus comes from state or options
		var state = dt.state.loaded();

		if ( state && state.keyTable ) {
			// Wait until init is done
			dt.one( 'init', function () {
				var cell = dt.cell( state.keyTable );

				// Ensure that the saved cell still exists
				if ( cell.any() ) {
					cell.focus();
				}
			} );
		}
		else if ( this.c.focus ) {
			dt.cell( this.c.focus ).focus();
		}
	},


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private methods
	 */

	/**
	 * Blur the control
	 *
	 * @param {boolean} [noEvents=false] Don't trigger updates / events (for destroying)
	 * @private
	 */
	_blur: function (noEvents)
	{
		if ( ! this.s.enable || ! this.s.lastFocus ) {
			return;
		}

		var cell = this.s.lastFocus.cell;

		$( cell.node() ).removeClass( this.c.className );
		this.s.lastFocus = null;

		if ( ! noEvents ) {
			this._updateFixedColumns(cell.index().column);

			this._emitEvent( 'key-blur', [ this.s.dt, cell ] );
		}
	},


	/**
	 * Clipboard interaction handlers
	 *
	 * @private
	 */
	_clipboard: function () {
		var dt = this.s.dt;
		var that = this;
		var namespace = this.s.namespace;

		// IE8 doesn't support getting selected text
		if ( ! window.getSelection ) {
			return;
		}

		$(document).on( 'copy'+namespace, function (ejq) {
			var e = ejq.originalEvent;
			var selection = window.getSelection().toString();
			var focused = that.s.lastFocus;

			// Only copy cell text to clipboard if there is no other selection
			// and there is a focused cell
			if ( ! selection && focused ) {
				e.clipboardData.setData(
					'text/plain',
					focused.cell.render( that.c.clipboardOrthogonal )
				);
				e.preventDefault();
			}
		} );

		$(document).on( 'paste'+namespace, function (ejq) {
			var e = ejq.originalEvent;
			var focused = that.s.lastFocus;
			var activeEl = document.activeElement;
			var editor = that.c.editor;
			var pastedText;

			if ( focused && (! activeEl || activeEl.nodeName.toLowerCase() === 'body') ) {
				e.preventDefault();

				if ( window.clipboardData && window.clipboardData.getData ) {
					// IE
					pastedText = window.clipboardData.getData('Text');
				}
				else if ( e.clipboardData && e.clipboardData.getData ) {
					// Everything else
					pastedText = e.clipboardData.getData('text/plain');
				}

				if ( editor ) {
					// Got Editor - need to activate inline editing,
					// set the value and submit
					editor
						.inline( focused.cell.index() )
						.set( editor.displayed()[0], pastedText )
						.submit();
				}
				else {
					// No editor, so just dump the data in
					focused.cell.data( pastedText );
					dt.draw(false);
				}
			}
		} );
	},


	/**
	 * Get an array of the column indexes that KeyTable can operate on. This
	 * is a merge of the user supplied columns and the visible columns.
	 *
	 * @private
	 */
	_columns: function ()
	{
		var dt = this.s.dt;
		var user = dt.columns( this.c.columns ).indexes();
		var out = [];

		dt.columns( ':visible' ).every( function (i) {
			if ( user.indexOf( i ) !== -1 ) {
				out.push( i );
			}
		} );

		return out;
	},


	/**
	 * Perform excel like navigation for Editor by triggering an edit on key
	 * press
	 *
	 * @param  {integer} key Key code for the pressed key
	 * @param  {object} orig Original event
	 * @private
	 */
	_editor: function ( key, orig, hardEdit )
	{
		// If nothing focused, we can't take any action
		if (! this.s.lastFocus) {
			return;	
		}

		// DataTables draw event
		if (orig && orig.type === 'draw') {
			return;
		}

		var that = this;
		var dt = this.s.dt;
		var editor = this.c.editor;
		var editCell = this.s.lastFocus.cell;
		var namespace = this.s.namespace + 'e' + editorNamespaceCounter++;

		// Do nothing if there is already an inline edit in this cell
		if ( $('div.DTE', editCell.node()).length ) {
			return;
		}

		// Don't activate Editor on control key presses
		if ( key !== null && (
			(key >= 0x00 && key <= 0x09) ||
			key === 0x0b ||
			key === 0x0c ||
			(key >= 0x0e && key <= 0x1f) ||
			(key >= 0x70 && key <= 0x7b) ||
			(key >= 0x7f && key <= 0x9f)
		) ) {
			return;
		}

		if ( orig ) {
			orig.stopPropagation();

			// Return key should do nothing - for textareas it would empty the
			// contents
			if ( key === 13 ) {
				orig.preventDefault();
			}
		}

		var editInline = function () {
			editor
				.one( 'open'+namespace, function () {
					// Remove cancel open
					editor.off( 'cancelOpen'+namespace );

					// Excel style - select all text
					if ( ! hardEdit ) {
						$('div.DTE_Field_InputControl input, div.DTE_Field_InputControl textarea').select();
					}

					// Reduce the keys the Keys listens for
					dt.keys.enable( hardEdit ? 'tab-only' : 'navigation-only' );

					// On blur of the navigation submit
					dt.on( 'key-blur.editor', function (e, dt, cell) {
						if ( editor.displayed() && cell.node() === editCell.node() ) {
							editor.submit();
						}
					} );

					// Highlight the cell a different colour on full edit
					if ( hardEdit ) {
						$( dt.table().container() ).addClass('dtk-focus-alt');
					}

					// If the dev cancels the submit, we need to return focus
					editor.on( 'preSubmitCancelled'+namespace, function () {
						setTimeout( function () {
							that._focus( editCell, null, false );
						}, 50 );
					} );

					editor.on( 'submitUnsuccessful'+namespace, function () {
						that._focus( editCell, null, false );
					} );

					// Restore full key navigation on close
					editor.one( 'close'+namespace, function () {
						dt.keys.enable( true );
						dt.off( 'key-blur.editor' );
						editor.off( namespace );
						$( dt.table().container() ).removeClass('dtk-focus-alt');

						if (that.s.returnSubmit) {
							that.s.returnSubmit = false;
							that._emitEvent( 'key-return-submit', [dt, editCell] );
						}
					} );
				} )
				.one( 'cancelOpen'+namespace, function () {
					// `preOpen` can cancel the display of the form, so it
					// might be that the open event handler isn't needed
					editor.off( namespace );
				} )
				.inline( editCell.index() );
		};

		// Editor 1.7 listens for `return` on keyup, so if return is the trigger
		// key, we need to wait for `keyup` otherwise Editor would just submit
		// the content triggered by this keypress.
		if ( key === 13 ) {
			hardEdit = true;

			$(document).one( 'keyup', function () { // immediately removed
				editInline();
			} );
		}
		else {
			editInline();
		}
	},


	/**
	 * Emit an event on the DataTable for listeners
	 *
	 * @param  {string} name Event name
	 * @param  {array} args Event arguments
	 * @private
	 */
	_emitEvent: function ( name, args )
	{
		this.s.dt.iterator( 'table', function ( ctx, i ) {
			$(ctx.nTable).triggerHandler( name, args );
		} );
	},


	/**
	 * Focus on a particular cell, shifting the table's paging if required
	 *
	 * @param  {DataTables.Api|integer} row Can be given as an API instance that
	 *   contains the cell to focus or as an integer. As the latter it is the
	 *   visible row index (from the whole data set) - NOT the data index
	 * @param  {integer} [column] Not required if a cell is given as the first
	 *   parameter. Otherwise this is the column data index for the cell to
	 *   focus on
	 * @param {boolean} [shift=true] Should the viewport be moved to show cell
	 * @private
	 */
	_focus: function ( row, column, shift, originalEvent )
	{
		var that = this;
		var dt = this.s.dt;
		var pageInfo = dt.page.info();
		var lastFocus = this.s.lastFocus;

		if ( ! originalEvent) {
			originalEvent = null;
		}

		if ( ! this.s.enable ) {
			return;
		}

		if ( typeof row !== 'number' ) {
			// Its an API instance - check that there is actually a row
			if ( ! row.any() ) {
				return;
			}

			// Convert the cell to a row and column
			var index = row.index();
			column = index.column;
			row = dt
				.rows( { filter: 'applied', order: 'applied' } )
				.indexes()
				.indexOf( index.row );
			
			// Don't focus rows that were filtered out.
			if ( row < 0 ) {
				return;
			}

			// For server-side processing normalise the row by adding the start
			// point, since `rows().indexes()` includes only rows that are
			// available at the client-side
			if ( pageInfo.serverSide ) {
				row += pageInfo.start;
			}
		}

		// Is the row on the current page? If not, we need to redraw to show the
		// page
		if ( pageInfo.length !== -1 && (row < pageInfo.start || row >= pageInfo.start+pageInfo.length) ) {
			this.s.focusDraw = true;
			this.s.waitingForDraw = true;

			dt
				.one( 'draw', function () {
					that.s.focusDraw = false;
					that.s.waitingForDraw = false;
					that._focus( row, column, undefined, originalEvent );
				} )
				.page( Math.floor( row / pageInfo.length ) )
				.draw( false );

			return;
		}

		// In the available columns?
		if ( $.inArray( column, this._columns() ) === -1 ) {
			return;
		}

		// De-normalise the server-side processing row, so we select the row
		// in its displayed position
		if ( pageInfo.serverSide ) {
			row -= pageInfo.start;
		}

		// Get the cell from the current position - ignoring any cells which might
		// not have been rendered (therefore can't use `:eq()` selector).
		var cells = dt.cells( null, column, {search: 'applied', order: 'applied'} ).flatten();
		var cell = dt.cell( cells[ row ] );

		if ( lastFocus ) {
			// Don't trigger a refocus on the same cell
			if ( lastFocus.node === cell.node() ) {
				this._emitEvent( 'key-refocus', [ this.s.dt, cell, originalEvent || null ] );
				return;
			}

			// Otherwise blur the old focus
			this._blur();
		}

		// Clear focus from other tables
		this._removeOtherFocus();

		var node = $( cell.node() );
		node.addClass( this.c.className );

		this._updateFixedColumns(column);

		// Shift viewpoint and page to make cell visible
		if ( shift === undefined || shift === true ) {
			this._scroll( $(window), $(document.body), node, 'offset' );

			var bodyParent = dt.table().body().parentNode;
			if ( bodyParent !== dt.table().header().parentNode ) {
				var parent = $(bodyParent.parentNode);

				this._scroll( parent, parent, node, 'position' );
			}
		}

		// Event and finish
		this.s.lastFocus = {
			cell: cell,
			node: cell.node(),
			relative: {
				row: dt.rows( { page: 'current' } ).indexes().indexOf( cell.index().row ),
				column: cell.index().column
			}
		};

		this._emitEvent( 'key-focus', [ this.s.dt, cell, originalEvent || null ] );
		dt.state.save();
	},


	/**
	 * Handle key press
	 *
	 * @param  {object} e Event
	 * @private
	 */
	_key: function ( e )
	{
		// If we are waiting for a draw to happen from another key event, then
		// do nothing for this new key press.
		if ( this.s.waitingForDraw ) {
			e.preventDefault();
			return;
		}

		var enable = this.s.enable;
		this.s.returnSubmit = (enable === 'navigation-only' || enable === 'tab-only') && e.keyCode === 13
			? true
			: false;

		var navEnable = enable === true || enable === 'navigation-only';
		if ( ! enable ) {
			return;
		}

		if ( (e.keyCode === 0 || e.ctrlKey || e.metaKey || e.altKey) && !(e.ctrlKey && e.altKey) ) {
			return;
		}

		// If not focused, then there is no key action to take
		var lastFocus = this.s.lastFocus;
		if ( ! lastFocus ) {
			return;
		}

		// And the last focus still exists!
		if ( ! this.s.dt.cell(lastFocus.node).any() ) {
			this.s.lastFocus = null;
			return;
		}

		var that = this;
		var dt = this.s.dt;
		var scrolling = this.s.dt.settings()[0].oScroll.sY ? true : false;

		// If we are not listening for this key, do nothing
		if ( this.c.keys && $.inArray( e.keyCode, this.c.keys ) === -1 ) {
			return;
		}

		switch( e.keyCode ) {
			case 9: // tab
				// `enable` can be tab-only
				this._shift( e, e.shiftKey ? 'left' : 'right', true );
				break;

			case 27: // esc
				if ( this.s.blurable && enable === true ) {
					this._blur();
				}
				break;

			case 33: // page up (previous page)
			case 34: // paglerainetimes.co.uk,wakefieldexpress.co.uk,spenboroughguardian.co.uk,dromoreleader.co.uk,farminglife.com,pontefractandcastlefordexpress.co.uk,londonderrysentinel.co.uk,morleyobserver.co.uk,lurganmail.co.uk,mirfieldreporter.co.uk,midulstermail.co.uk,hemsworthandsouthelmsallexpress.co.uk,dewsburyreporter.co.uk,newtownabbeytoday.co.uk,portadowntimes.co.uk,batleynews.co.uk,tyronetimes.co.uk,whitbygazette.co.uk,lisburntoday.co.uk,thescarboroughnews.co.uk,dissexpress.co.uk,pocklingtonpost.co.uk,fenlandcitizen.co.uk,haverhillecho.co.uk,lynnnews.co.uk,hucknalldispatch.co.uk,ilkestonadvertiser.co.uk,chad.co.uk,matlockmercury.co.uk,newmarketjournal.co.uk,spaldingtoday.co.uk,suffolkfreepress.co.uk,ripleyandheanornews.co.uk,bostonstandard.co.uk,bournelocal.co.uk,hartlepoolmail.co.uk,houghtonstar.co.uk#@#.trc_rbox_border_elm .syndicatedItem","granthamjournal.co.uk,horncastlenews.co.uk,louthleader.co.uk,morpethherald.co.uk,marketrasenmail.co.uk,newsguardian.co.uk,newspostleader.co.uk,meltontimes.co.uk,peterboroughtoday.co.uk,northumberlandgazette.co.uk,rutland-times.co.uk,peterleestar.co.uk,skegnessstandard.co.uk,sleafordstandard.co.uk,stamfordmercury.co.uk,seahamstar.co.uk,banburyguardian.co.uk,daventryexpress.co.uk,harboroughmail.co.uk,derbyshiretimes.co.uk,leamingtoncourier.co.uk,kenilworthweeklynews.co.uk,lutterworthmail.co.uk,shieldsgazette.com,eastwoodadvertiser.co.uk,northamptonchron.co.uk,buxtonadvertiser.co.uk,sunderlandecho.com,worksopguardian.co.uk,northantstelegraph.co.uk,washingtonstar.co.uk,thornegazette.co.uk,southyorkshiretimes.co.uk,berwickshirenews.co.uk,gainsboroughstandard.co.uk,carricktoday.co.uk,retfordtoday.co.uk,epworthbells.co.uk,gallowaygazette.co.uk,doncasterfreepress.co.uk,thestar.co.uk,hawick-news.co.uk,sheffieldtelegraph.co.uk,tringtoday.co.uk,belpernews.co.uk,selkirkweekendadvertiser.co.uk,thametoday.co.uk,miltonkeynes.co.uk,thesouthernreporter.co.uk,lutontoday.co.uk,blackpoolgazette.co.uk,leightonbuzzardonline.co.uk,hemeltoday.co.uk,dunstabletoday.co.uk,fleetwoodtoday.co.uk,bucksherald.co.uk,buckinghamtoday.co.uk,biggleswadetoday.co.uk,lythamstannesexpress.co.uk,bedfordtoday.co.uk,burnleyexpress.net,warwickcourier.co.uk,rugbyadvertiser.co.uk,clitheroeadvertiser.co.uk,pendletoday.co.uk,iomtoday.co.im,berkhamstedtoday.co.uk,chorley-guardian.co.uk,garstangcourier.co.uk,lep.co.uk,leylandguardian.co.uk,longridgenews.co.uk,sthelensreporter.co.uk,wigantoday.net,lancasterguardian.co.uk,thevisitor.co.uk,brechinadvertiser.co.uk,buchanobserver.co.uk,deesidepiper.co.uk,donsidepiper.co.uk,ellontimes.co.uk,forfardispatch.co.uk,fraserburghherald.co.uk,guideandgazette.co.uk,inverurieherald.co.uk,kincardineshireobserver.co.uk,kirriemuirherald.co.uk,mearnsleader.co.uk,montrosereview.co.uk,stornowaygazette.co.uk,buteman.co.uk,buryfreepress.co.uk,carlukegazette.co.uk,cumbernauld-news.co.uk,falkirkherald.co.uk,fifetoday.co.uk,glasgowsouthandeastwoodextra.co.uk,kirkintilloch-herald.co.uk,midhurstandpetworth.co.uk,ryeandbattleobserver.co.uk,shorehamherald.co.uk,sussexexpress.co.uk,wscountytimes.co.uk,westsussextoday.co.uk,linlithgowgazette.co.uk,worthingherald.co.uk,harrogateadvertiser.co.uk,ripongazette.co.uk,northyorkshirenews.com,milngavieherald.co.uk,wetherbynews.co.uk,brighouseecho.co.uk,halifaxcourier.co.uk,motherwelltimes.co.uk,hebdenbridgetimes.co.uk,todmordennews.co.uk,yorkshireeveningpost.co.uk,yorkshirepost.co.uk,beverleyguardian.co.uk,eastlothiannews.co.uk,bridlingtonfreepress.co.uk,driffieldtoday.co.uk,fileymercury.co.uk,midlothianadvertiser.co.uk,maltonmercury.co.uk,scotsman.com,haylingtoday.co.uk,portsmouth.co.uk,bexhillobserver.net,bognor.co.uk,chichester.co.uk,crawleyobserver.co.uk,eastbourneherald.co.uk,hastingsobserver.co.uk,littlehamptongazette.co.uk,midsussextimes.co.uk,dinningtontoday.co.uk,bakewelltoday.co.uk,larnetimes.co.uk,lakelandecho.co.uk,jarrowandhebburngazette.com,billboard.com,moviefone.com,aol.co.uk,giantbomb.com,estadao.com.br,comicvine.com,gamerescape.com,warpedspeed.com,atarde.uol.com.br,investing.com,oregonlive.com,syracuse.com,al.com,mlive.com,pennlive.com,nj.com,silive.com,masslive.com,cl9{Áùeveland.com,lehighvalleylive.com,gulflive.com,newyorkupstate.com,bt.com,20minutes.fr,onlyinyourstate.com,wiat.com,wkrg.com,kron4.com,fox21news.com,wtnh.com,wfla.com,wjbf.com,wrbl.com,wsav.com,khon2.com,wane.com,wishtv.com,wlfi.com,wthitv.com,kwqc.com,kimt.com,ksn.com,klfy.com,wwlp.com,woodtv.com,wlns.com,whlt.com,wjtv.com,kasa.com,news10.com,wivb.com,wnct.com,nbc4i.com,wdtn.com,wkbn.com,koin.com,abc27.com,wpri.com,wbtw.com,wspa.com,wjhl.com,wkrn.com,kxan.com,wavy.com,wsls.com,wric.com,wbay.com,wate.com,ksnt.com,krqe.com,wncn.com,counton2.com,carolinascw.com,srpressgazette.com,powerlineblog.com,winemag.com,powershow.com,breakingnews.ie,pandacat.me,aol.com,lifed.com,cbs.com,techrepublic.com,tvguide.com,chowhound.com,rotter.net,viralsection.com,tylerpaper.com,funcage.com,reshareable.tv,amharictube.com,trumpetherald.com,weknowmemes.com,prizegrab.com,laboiteverte.fr,cnet.de,nextplz.fr,infos.fr,matchendirect.fr,iphon.fr,maison-et-domotique.com,planetepsg.com,logitheque.com,matchtoi.com,tagtele.com,economiematin.fr,talkingpointsmemo.com,maxpreps.com,sourceforge.net,knowable.com,tasteofhome.com,fox13memphis.com,wsoctv.com,wpxi.com,wftv.com,fox23.com,kiro7.com,actionnewsjax.com,wsbtv.com,fox30jax.com,hottopics.tv,jessejones.com,ilmeteo.it,ajc.com,palmbeachpost.com,daytondailynews.com,statesman.com,journal-news.com,springfieldnewssun.com,austin360.com,accessatlanta.com,dayton.com,aajtak.intoday.in,healthyeating.sfgate.com,petapixel.com,sny.tv,thewrap.com,rugbyrama.fr,examiner.com,remedioscaserosdehoy.com,indiatoday.intoday.in,mmajunkie.com,alphr.com,cotemaison.fr,classicandperformancecar.com,yourdailydish.com,pawmygosh.com,thairath.co.th,int.soccerway.com,bizportal.co.il,ipnoze.com,megacurioso.com.br,tv-replay.fr,public.fr,edgetrends.com,inn.co.il,deals.kinja.com,buzzamin.com,viralguppy.com,sharedable.com,funnie.st,santeplusmag.com,designtaxi.com,heleneetlesgarcons.actifforum.com,whio.com,gocarolinas.com,icflorida.com,viva.co.nz,buzzbeagle.com,likesharetweet.com,viralwalrus.com,semesterz.com,sportingz.com,urbanjoker.com,muscleandfitness.com,majorten.com,infomoney.com.br,huffingtonpost.ca,hotslogs.com,disqusads.com,chinatimes.com,incroyable.co,isportsweb.com,queerty.com,gatestoneinstitute.org,topcinq.fr,texasguntrader.com,vanguardia.com,vermoegenmagazin.de,twitlonger.com,tudointeressante.com.br,toprankingtips.com,freshome.com,thescienceexplorer.com,telquel.ma,taringa.net,supercurioso.com,pblv-plusbellelavie.fr,ads.socialtheater.com,americangg.net,allnewspipeline.com,viral4real.com,airlive.net,buzzsharer.com,proceso.com.mx,estaily.com,physicsandmathstutor.com,officialhuskylovers.com,pcastuces.com,orzzzz.com,baltimoreravens.com,guitarplayer.com,site-annonce.fr,kgbanswers.com,topfunf.de,hbowatch.com,hinkhoj.com,frontpagemag.com,intellectualtakeout.org,iranianuk.com,movsflix.com,dramaonline.com,basket-infos.com,dreuz.info,luxgallery.it,manatelugu.in,elclubdelospoetasmuertos.net,generalquizz.com,4shared.com,bigstory.ap.org,rare.us,clark.com,sublimly.com,frankiesfacts.com,tomorrowoman.com,afternoonspecial.com,dailydisclosure.com,history.com,malaysiakini.com,infoescola.com,brasil247.com,rougeframboise.com,rockpapershotgun.com,vg247.com,realclearpolitics.com,n4bb.com,vrfocus.com,wowinterface.com,esoui.com,maduradas.com,photographyblog.com,howtogeek.com,onlinevideoconverter.com,thegrumpyfish.com,teamrock.com,ginjfo.com,thisisinsider.com,huffingtonpost.kr,mouse.co.il,pref.com,football.fr,eurosport.co.uk,eurosport.de,eurosport.es,eurosport.com,eurosport.ru,homeguides.sfgate.com,dailymix.info,games2rule.com,secure-surf.com,collegehumor.com,dorkly.com,nowgamer.com,nzblokes.co.nz,oklm.com,theweatheroutlook.com,zimbabwesituation.com,tehelka.com,seriable.com,art-sheep.com,peuple-vert.fr,psychologies.co.uk,soccerlens.com,setopati.com,gamaniak.com,autonews.fr,hoganstand.com,fier-panda.fr,tele7jeux.fr,negronews.fr,piwee.net,hellosearch.fr,football-espana.net,mens-den.com,parc-attraction-loisirs.fr,buddymd.com,tous-testeurs.com,games-answers.info,motoring.co.uk,themobileindian.com,ch-quizz.com,fastonetwo.com,unrealfacts.com,echantillonsclub.com,shekulli.com.al,meilleurcoiffeur.com,humanevents.com,sobadsogood.com,kabylie-news.com,footballdb.com,cuteoverload.com,footballdatabase.eu,nehandaradio.com,jiujitsutimes.com,scribium.com,doyouremember.com,espritsciencemetaphysiques.com,virgin.com,arch2o.com,colombiareports.com,rushlane.com,conscience-et-eveil-spirituel.com,nyasatimes.com,modernnotion.com,slopeofhope.com,moonbattery.com,feelnumb.com,411mania.com,nairobiwire.com,caribbean360.com,mrnoggin.com,exolas.com,clubcivic.com,clubintegra.com,hometipsworld.com,emergencyemail.org,offgridworld.com,nerdreactor.com,cracked.com,forums.hipinion.com,militarybenefits.info,nwherald.com,thatoregonlife.com,chartattack.com,energeticcity.ca,themeowpost.com,commdiginews.com,medievalists.net,fastcar.co.uk,telesatellite.com,rachfeed.com,trak.in,pinoytrending.altervista.org,actu-mag.fr,mysticscripts.com,newsinlevels.com,lesaviezvous.net,tremeritus.com,parischampions.fr,naldotech.com,sportzwiki.com,troca-se.pt,holahola.cc,brilliantmaps.com,25cineframes.com,cumbriacrack.com,lemeilleurdupsg.com,mountakhab.net,dailypakistan.com.pk,urbanhit.fr,europe-israel.org,stips.co.il,apglitz.com,veritenews.com,australiannationalreview.com,thewowstyle.com,99traveltips.com,dramayou.com,web-emulation.com,buzzarena.com,africaranking.com,officechai.com,mysansar.com,femalefirst.co.uk,maxjoke.net,alliancefr.com,parisactu.fr,fansdesannees80.com,tankler.com,urdogs.com,secretldn.com,happydieter.net,101usa.com,vegetarianplate.com,animedigitalnetwork.fr,pixwords-help.info,jsonline.com,mensfitness-magazine.fr,satyavijayi.com,buonapesca.it,aficia.info,noticias-frescas.com,albertespinola.com,placasrojas.me,offsideplanet.com,buenamente.com,evous.fr,1001web.fr,ohyeea.com,thebadbuzz.com,astuces-de-mamie.com,aapa.pk,achhikhabar.com,shintranslations.com,maxaboutsms.com,noticiasaominuto.com.br,okbob.net,zeri.info,whitewolfpack.com,es.paperblog.com,sevillasecreta.co,barcelonasecreta.com,secretnyc.co,zoneasoluces.fr,perfscience.com,grands-mamans.com,mangaforever.net,maligue2.fr,iphonote.com,money.ro,littlemeows.com,maliactu.net,forwellness.co.il#@#.trc_rbox_border_elm .syndicatedItem","!","millenium.gg,xatakahome.com,compradiccion.com,decoracion.trendencias.com,3djuegospc.com,3djuegosguias.com,poprosa.com,xatakafo