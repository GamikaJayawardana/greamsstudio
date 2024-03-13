/*
* Initialize Modules
*/
;(function($, window, document, undefined){

    $( window ).on( 'elementor:init', function() {
		// Add "modina-core" specific css class to elementor body
        $('.elementor-editor-active').addClass('modina-core');

        if ( window.elementor ) {
     
            // Add item to contextMenu on Elementor load
            elementor.hooks.addFilter( 'element/view', function( groups_prototype, element ) {

                if ( element.get('elType') === 'column' ) {
                    return groups_prototype.extend( {
                        getContextMenuGroups: function () {
                            return groups_prototype.prototype.getContextMenuGroups.apply(this, arguments);
                        }
                    } )
                }

                return groups_prototype;
            } );

            // Add item to contextMenu on new column
            elementor.hooks.addFilter( 'elements/column/contextMenuGroups', addItemToContextMenu )


        }

    /**
     * Adds new item to context menu
     * */
     function addItemToContextMenu( groups, element ) {
        // Find index of Elementor default clipboard
        var clipboard_index = groups.findIndex( function ( item ) {
            return 'addNew' === item.name;
        } );

        // Push new context item inside clipboard
        groups[clipboard_index].actions.push( {
            name: 'euis-add-nested-section',
            title: 'Add Nested Section',
            icon: 'eicon-clone',
            callback: function() {
                insertNestedSection( element );
            },
            isEnabled: function() {
                return true;
            }
        } );
        return groups
    }
    /**
     * Inserts new inner section inside parent column or section
     * */
    function insertNestedSection( element ) {

        var element_view = element.getContainer().view;

        if ( element_view.getElementType() === 'column' ) {
            // Insert new inner section
            element_view.addElement( {
                elType: 'section',
                isInner: true,
                settings: {},
                elements: [{
                    id: elementor.helpers.getUniqueID(),
                    elType: 'column',
                    isInner: true,
                    settings: {
                        _column_size: 100
                    },
                    elements: []
                }]
            } );
        }
    }

    // Make our custom css visible in the panel's front-end
    if( typeof elementorPro == 'undefined' ) {
        elementor.hooks.addFilter( 'editor/style/styleText', function( css, context ){
            if ( ! context ) {
                return;
            }
            var model = context.model,
                customCSS = model.get('settings').get('modina_core_custom_css');

            var selector = '.elementor-element.elementor-element-' + model.get('id');

            if ('document' === model.get('elType')) {
                selector = elementor.config.document.settings.cssWrapperSelector;
            }

            if (customCSS) {
                css += customCSS.replace(/selector/g, selector);
            }

            return css;
        });
    }
} );
"use strict";!function(n){var e=function(){function n(){"elementor"in window&&"elementorFrontend"in window&&(this.document=elementor.documents.currentDocument,this.breakpoints=elementorFrontend.config.breakpoints,this.init())}var e=n.prototype;return e.init=function(){var n=this;this.document.container.children.forEach(function(e){n.updateBreakPointCSS(e)}),elementor.hooks.addAction("panel/open_editor/widget",function(e,t,o){n.delay(function(){n.addDevice(o)})}),elementor.hooks.addAction("panel/open_editor/section",function(e,t,o){n.delay(function(){n.runFromRootSection(o)})}),elementor.hooks.addAction("panel/open_editor/column",function(e,t,o){n.delay(function(){n.runFromRootSection(o)})})},e.delay=function(n,e,t){void 0===e&&(e=10),void 0===t&&(t=20);var o=setInterval(function(){n(),0>=t&&clearInterval(o)},e)},e.runFromRootSection=function(n){var e=this.getRootSection(n.container);e&&this.updateBreakPointCSS(e)},e.updateBreakPointCSS=function(n){var e=this;n.view&&this.addDevice(n.view),n.children.forEach(function(n){e.updateBreakPointCSS(n)})},e.getRootSection=function(n){return n.parent||console.log("Something went wrong"),n.parent&&"document"==n.parent.type&&"section"==n.type?n:this.getRootSection(n.parent)},e.addDevice=function(n){var e=n.controlsCSSParser.stylesheet;for(var t in this.breakpoints)if(!["xs","sm","md","lg","xxl"].includes(t)){var o=this.breakpoints[t].input1;void 0===o&&(o=this.breakpoints[t]),e.addDevice(t,o)}this.renderStyles(n)},e.renderStyles=function(n){n.renderStyles()},n}();n(window).load(function(){new e})}(jQuery);




})(jQuery, window, document);


 
