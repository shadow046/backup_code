(()=>{"use strict";var e={800:(e,t,o)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.config=t.loadMessageBundle=t.localize=t.format=t.setPseudo=t.isPseudo=t.isDefined=t.BundleFormat=t.MessageFormat=void 0;var r,n,i,a=o(926);function s(e){return void 0!==e}function l(e,o){return t.isPseudo&&(e="［"+e.replace(/[aouei]/g,"$&$&")+"］"),0===o.length?e:e.replace(/\{(\d+)\}/g,(function(e,t){var r=t[0],n=o[r],i=e;return"string"==typeof n?i=n:"number"!=typeof n&&"boolean"!=typeof n&&null!=n||(i=String(n)),i}))}(i=t.MessageFormat||(t.MessageFormat={})).file="file",i.bundle="bundle",i.both="both",(n=t.BundleFormat||(t.BundleFormat={})).standalone="standalone",n.languagePack="languagePack",function(e){e.is=function(e){var t=e;return t&&s(t.key)&&s(t.comment)}}(r||(r={})),t.isDefined=s,t.isPseudo=!1,t.setPseudo=function(e){t.isPseudo=e},t.format=l,t.localize=function(e,t){for(var o=[],r=2;r<arguments.length;r++)o[r-2]=arguments[r];return l(t,o)},t.loadMessageBundle=function(e){return a.default().loadMessageBundle(e)},t.config=function(e){return a.default().config(e)}},926:(e,t)=>{var o;function r(){if(void 0===o)throw new Error("No runtime abstraction layer installed");return o}Object.defineProperty(t,"__esModule",{value:!0}),function(e){e.install=function(e){if(void 0===e)throw new Error("No runtime abstraction layer provided");o=e}}(r||(r={})),t.default=r},472:(e,t,o)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.config=t.loadMessageBundle=void 0;var r=o(622),n=o(747),i=o(926),a=o(800),s=o(800);Object.defineProperty(t,"MessageFormat",{enumerable:!0,get:function(){return s.MessageFormat}}),Object.defineProperty(t,"BundleFormat",{enumerable:!0,get:function(){return s.BundleFormat}});var l,u,c=Object.prototype.toString;function d(e){return"[object Number]"===c.call(e)}function f(e){return"[object String]"===c.call(e)}function g(e){return JSON.parse(n.readFileSync(e,"utf8"))}function p(e){return function(t,o){for(var r=[],n=2;n<arguments.length;n++)r[n-2]=arguments[n];return d(t)?t>=e.length?void console.error("Broken localize call found. Index out of bounds. Stacktrace is\n: "+new Error("").stack):a.format(e[t],r):f(o)?(console.warn("Message "+o+" didn't get externalized correctly."),a.format(o,r)):void console.error("Broken localize call found. Stacktrace is\n: "+new Error("").stack)}}function m(e,t){return l[e]=t,t}function h(e){try{return function(e){var t=g(r.join(e,"nls.metadata.json")),o=Object.create(null);for(var n in t){var i=t[n];o[n]=i.messages}return o}(e)}catch(e){return void console.log("Generating default bundle from meta data failed.",e)}}function v(e,t){var o;if(!0===u.languagePackSupport&&void 0!==u.cacheRoot&&void 0!==u.languagePackId&&void 0!==u.translationsConfigFile&&void 0!==u.translationsConfig)try{o=function(e,t){var o,i,a,s=r.join(u.cacheRoot,e.id+"-"+e.hash+".json"),l=!1,c=!1;try{return o=JSON.parse(n.readFileSync(s,{encoding:"utf8",flag:"r"})),i=s,a=new Date,n.utimes(i,a,a,(function(){})),o}catch(e){if("ENOENT"===e.code)c=!0;else{if(!(e instanceof SyntaxError))throw e;console.log("Syntax error parsing message bundle: "+e.message+"."),n.unlink(s,(function(e){e&&console.error("Deleting corrupted bundle "+s+" failed.")})),l=!0}}if(!(o=function(e,t){var o=u.translationsConfig[e.id];if(o){var n=g(o).contents,i=g(r.join(t,"nls.metadata.json")),a=Object.create(null);for(var s in i){var l=i[s],c=n[e.outDir+"/"+s];if(c){for(var d=[],p=0;p<l.keys.length;p++){var m=l.keys[p],h=c[f(m)?m:m.key];void 0===h&&(h=l.messages[p]),d.push(h)}a[s]=d}else a[s]=l.messages}return a}}(e,t))||l)return o;if(c)try{n.writeFileSync(s,JSON.stringify(o),{encoding:"utf8",flag:"wx"})}catch(e){if("EEXIST"===e.code)return o;throw e}return o}(e,t)}catch(e){console.log("Load or create bundle failed ",e)}if(!o){if(u.languagePackSupport)return h(t);var i=function(e){for(var t=u.language;t;){var o=r.join(e,"nls.bundle."+t+".json");if(n.existsSync(o))return o;var i=t.lastIndexOf("-");t=i>0?t.substring(0,i):void 0}if(void 0===t&&(o=r.join(e,"nls.bundle.json"),n.existsSync(o)))return o}(t);if(i)try{return g(i)}catch(e){console.log("Loading in the box message bundle failed.",e)}o=h(t)}return o}function b(e){if(!e)return a.localize;var t=r.extname(e);if(t&&(e=e.substr(0,e.length-t.length)),u.messageFormat===a.MessageFormat.both||u.messageFormat===a.MessageFormat.bundle){var o=function(e){for(var t,o=r.dirname(e);t=r.join(o,"nls.metadata.header.json"),!n.existsSync(t);){var i=r.dirname(o);if(i===o){t=void 0;break}o=i}return t}(e);if(o){var i=r.dirname(o),s=l[i];if(void 0===s)try{var c=JSON.parse(n.readFileSync(o,"utf8"));try{var d=v(c,i);s=m(i,d?{header:c,nlsBundle:d}:null)}catch(e){console.error("Failed to load nls bundle",e),s=m(i,null)}}catch(e){console.error("Failed to read header file",e),s=m(i,null)}if(s){var f=e.substr(i.length+1).replace(/\\/g,"/"),h=s.nlsBundle[f];return void 0===h?(console.error("Messages for file "+e+" not found. See console for details."),function(){return"Messages not found."}):p(h)}}}if(u.messageFormat===a.MessageFormat.both||u.messageFormat===a.MessageFormat.file)try{var b=g(function(e){var t;if(u.cacheLanguageResolution&&t)t=t;else{if(a.isPseudo||!u.language)t=".nls.json";else for(var o=u.language;o;){var r=".nls."+o+".json";if(n.existsSync(e+r)){t=r;break}var i=o.lastIndexOf("-");i>0?o=o.substring(0,i):(t=".nls.json",o=null)}u.cacheLanguageResolution&&(t=t)}return e+t}(e));return Array.isArray(b)?p(b):a.isDefined(b.messages)&&a.isDefined(b.keys)?p(b.messages):(console.error("String bundle '"+e+"' uses an unsupported format."),function(){return"File bundle has unsupported format. See console for details"})}catch(e){"ENOENT"!==e.code&&console.error("Failed to load single file bundle",e)}return console.error("Failed to load message bundle for file "+e),function(){return"Failed to load message bundle. See console for details."}}function y(e){return e&&(f(e.locale)&&(u.locale=e.locale.toLowerCase(),u.language=u.locale,l=Object.create(null)),void 0!==e.messageFormat&&(u.messageFormat=e.messageFormat),e.bundleFormat===a.BundleFormat.standalone&&!0===u.languagePackSupport&&(u.languagePackSupport=!1)),a.setPseudo("pseudo"===u.locale),b}!function(){if(u={locale:void 0,language:void 0,languagePackSupport:!1,cacheLanguageResolution:!0,messageFormat:a.MessageFormat.bundle},f(process.env.VSCODE_NLS_CONFIG))try{var e=JSON.parse(process.env.VSCODE_NLS_CONFIG),t=void 0;if(e.availableLanguages){var o=e.availableLanguages["*"];f(o)&&(t=o)}if(f(e.locale)&&(u.locale=e.locale.toLowerCase()),void 0===t?u.language=u.locale:"en"!==t&&(u.language=t),function(e){return!0===e||!1===e}(e._languagePackSupport)&&(u.languagePackSupport=e._languagePackSupport),f(e._cacheRoot)&&(u.cacheRoot=e._cacheRoot),f(e._languagePackId)&&(u.languagePackId=e._languagePackId),f(e._translationsConfigFile)){u.translationsConfigFile=e._translationsConfigFile;try{u.translationsConfig=g(u.translationsConfigFile)}catch(t){if(e._corruptedFile){var i=r.dirname(e._corruptedFile);n.exists(i,(function(t){t&&n.writeFile(e._corruptedFile,"corrupted","utf8",(function(e){console.error(e)}))}))}}}}catch(e){}a.setPseudo("pseudo"===u.locale),l=Object.create(null)}(),t.loadMessageBundle=b,t.config=y,i.default.install(Object.freeze({loadMessageBundle:b,config:y}))},61:(e,t,o)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.registerAPICommands=t.ApiImpl=void 0;const r=o(549),n=o(462);t.ApiImpl=class{constructor(e){this._model=e}pickRemoteSource(e){return(0,n.pickRemoteSource)(this._model,e)}registerRemoteSourceProvider(e){return this._model.registerRemoteSourceProvider(e)}},t.registerAPICommands=function(e){const t=[];return t.push(r.commands.registerCommand("git-base.api.getRemoteSources",(t=>{if(e.model)return(0,n.pickRemoteSource)(e.model,t)}))),r.Disposable.from(...t)}},463:(e,t,o)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.GitBaseExtensionImpl=void 0;const r=o(549),n=o(61);t.GitBaseExtensionImpl=class{constructor(e){this.enabled=!1,this._onDidChangeEnablement=new r.EventEmitter,this.onDidChangeEnablement=this._onDidChangeEnablement.event,this._model=void 0,e&&(this.enabled=!0,this._model=e)}set model(e){this._model=e;const t=!!e;this.enabled!==t&&(this.enabled=t,this._onDidChangeEnablement.fire(this.enabled))}get model(){return this._model}getAPI(e){if(!this._model)throw new Error("Git model not found");if(1!==e)throw new Error(`No API version ${e} found.`);return new n.ApiImpl(this._model)}}},183:(e,t,o)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.throttle=t.debounce=void 0;const r=o(56);function n(e){return(t,o,r)=>{let n=null,i=null;if("function"==typeof r.value?(n="value",i=r.value):"function"==typeof r.get&&(n="get",i=r.get),!i||!n)throw new Error("not supported");r[n]=e(i,o)}}t.debounce=function(e){return n(((t,o)=>{const r=`$debounce$${o}`;return function(...o){clearTimeout(this[r]),this[r]=setTimeout((()=>t.apply(this,o)),e)}}))},t.throttle=n((function(e,t){const o=`$throttle$current$${t}`,n=`$throttle$next$${t}`,i=function(...t){if(this[n])return this[n];if(this[o])return this[n]=(0,r.done)(this[o]).then((()=>(this[n]=void 0,i.apply(this,t)))),this[n];this[o]=e.apply(this,t);const a=()=>this[o]=void 0;return(0,r.done)(this[o]).then(a,a),this[o]};return i}))},194:(e,t,o)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.Model=void 0;const r=o(549),n=o(56);t.Model=class{constructor(){this.remoteSourceProviders=new Set,this._onDidAddRemoteSourceProvider=new r.EventEmitter,this.onDidAddRemoteSourceProvider=this._onDidAddRemoteSourceProvider.event,this._onDidRemoveRemoteSourceProvider=new r.EventEmitter,this.onDidRemoveRemoteSourceProvider=this._onDidRemoveRemoteSourceProvider.event}registerRemoteSourceProvider(e){return this.remoteSourceProviders.add(e),this._onDidAddRemoteSourceProvider.fire(e),(0,n.toDisposable)((()=>{this.remoteSourceProviders.delete(e),this._onDidRemoveRemoteSourceProvider.fire(e)}))}getRemoteProviders(){return[...this.remoteSourceProviders.values()]}}},462:function(e,t,o){var r=this&&this.__decorate||function(e,t,o,r){var n,i=arguments.length,a=i<3?t:null===r?r=Object.getOwnPropertyDescriptor(t,o):r;if("object"==typeof Reflect&&"function"==typeof Reflect.decorate)a=Reflect.decorate(e,t,o,r);else for(var s=e.length-1;s>=0;s--)(n=e[s])&&(a=(i<3?n(a):i>3?n(t,o,a):n(t,o))||a);return i>3&&a&&Object.defineProperty(t,o,a),a};Object.defineProperty(t,"__esModule",{value:!0}),t.pickRemoteSource=void 0;const n=o(549),i=o(472),a=o(183),s=i.loadMessageBundle(o(622).join(__dirname,"remoteSource.ts"));async function l(e){const t=await new Promise((t=>{e.onDidAccept((()=>t(e.selectedItems[0]))),e.onDidHide((()=>t(void 0))),e.show()}));return e.hide(),t}class u{constructor(e){this.provider=e}ensureQuickPick(){this.quickpick||(this.quickpick=n.window.createQuickPick(),this.quickpick.ignoreFocusOut=!0,this.provider.supportsQuery?(this.quickpick.placeholder=this.provider.placeholder??s(0,null),this.quickpick.onDidChangeValue(this.onDidChangeValue,this)):this.quickpick.placeholder=this.provider.placeholder??s(1,null))}onDidChangeValue(){this.query()}async query(){try{const e=await this.provider.getRemoteSources(this.quickpick?.value)||[];this.ensureQuickPick(),this.quickpick.show(),0===e.length?this.quickpick.items=[{label:s(2,null),alwaysShow:!0}]:this.quickpick.items=e.map((e=>({label:e.icon?`$(${e.icon}) ${e.name}`:e.name,description:e.description||("string"==typeof e.url?e.url:e.url[0]),detail:e.detail,remoteSource:e,alwaysShow:!0})))}catch(e){this.quickpick.items=[{label:s(3,null,e.message),alwaysShow:!0}],console.error(e)}finally{this.quickpick.busy=!1}}async pick(){return await this.query(),(await l(this.quickpick))?.remoteSource}}async function c(e,t={}){const o=new u(e),r=await o.pick();let i;if(r&&("string"==typeof r.url?i=r.url:r.url.length>0&&(i=await n.window.showQuickPick(r.url,{ignoreFocusOut:!0,placeHolder:s(9,null)}))),!i||!t.branch)return i;if(!e.getBranches)return{url:i};const a=await e.getBranches(i);if(!a)return{url:i};const l=await n.window.showQuickPick(a,{placeHolder:s(10,null)});return l?{url:i,branch:l}:{url:i}}r([(0,a.debounce)(300)],u.prototype,"onDidChangeValue",null),r([a.throttle],u.prototype,"query",null),t.pickRemoteSource=async function(e,t={}){const o=n.window.createQuickPick();if(o.ignoreFocusOut=!0,o.title=t.title,t.providerName){const o=e.getRemoteProviders().filter((e=>e.name===t.providerName))[0];if(o)return await c(o,t)}const r=e.getRemoteProviders().map((e=>({label:(e.icon?`$(${e.icon}) `:"")+(t.providerLabel?t.providerLabel(e):e.name),alwaysShow:!0,provider:e}))),i=[];if(t.showRecentSources)for(const{provider:e}of r){const t=(await(e.getRecentRemoteSources?.())??[]).map((e=>({...e,label:(e.icon?`$(${e.icon}) `:"")+e.name,url:"string"==typeof e.url?e.url:e.url[0]})));i.push(...t)}const a=[{kind:n.QuickPickItemKind.Separator,label:s(4,null)},...r,{kind:n.QuickPickItemKind.Separator,label:s(5,null)},...i.sort(((e,t)=>t.timestamp-e.timestamp))];o.placeholder=t.placeholder??(0===r.length?s(6,null):s(7,null));const u=e=>{if(e){const r=("string"==typeof t.urlLabel?t.urlLabel:t.urlLabel?.(e))??s(8,null);o.items=[{label:r,description:e,alwaysShow:!0,url:e},...a]}else o.items=a};o.onDidChangeValue(u),u();const d=await l(o);if(d){if(d.url)return d.url;if(d.provider)return await c(d.provider,t)}}},56:(e,t)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.Versions=t.done=t.toDisposable=void 0,t.toDisposable=function(e){return{dispose:e}},t.done=function(e){return e.then((()=>{}))},function(e){function t(e,t,o,r){return{major:"string"==typeof e?parseInt(e,10):e,minor:"string"==typeof t?parseInt(t,10):t,patch:null==o?0:"string"==typeof o?parseInt(o,10):o,pre:r}}function o(e){const[o,r]=e.split("-"),[n,i,a]=o.split(".");return t(n,i,a,r)}e.compare=function(e,t){return"string"==typeof e&&(e=o(e)),"string"==typeof t&&(t=o(t)),e.major>t.major?1:e.major<t.major?-1:e.minor>t.minor?1:e.minor<t.minor?-1:e.patch>t.patch?1:e.patch<t.patch?-1:void 0===e.pre&&void 0!==t.pre?1:void 0!==e.pre&&void 0===t.pre?-1:void 0!==e.pre&&void 0!==t.pre?e.pre.localeCompare(t.pre):0},e.from=t,e.fromString=o}(t.Versions||(t.Versions={}))},747:e=>{e.exports=require("fs")},622:e=>{e.exports=require("path")},549:e=>{e.exports=require("vscode")}},t={};function o(r){var n=t[r];if(void 0!==n)return n.exports;var i=t[r]={exports:{}};return e[r].call(i.exports,i,i.exports,o),i.exports}var r={};(()=>{var e=r;Object.defineProperty(e,"__esModule",{value:!0}),e.activate=void 0;const t=o(61),n=o(463),i=o(194);e.activate=function(e){const o=new n.GitBaseExtensionImpl(new i.Model);return e.subscriptions.push((0,t.registerAPICommands)(o)),o}})();var n=exports;for(var i in r)n[i]=r[i];r.__esModule&&Object.defineProperty(n,"__esModule",{value:!0})})();
//# sourceMappingURL=https://ticino.blob.core.windows.net/sourcemaps/57fd6d0195bb9b9d1b49f6da5db789060795de47/extensions/git-base/dist/extension.js.map