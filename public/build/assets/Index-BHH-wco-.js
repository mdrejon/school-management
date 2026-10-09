import{A as e,B as t,C as n,Dt as r,F as i,H as a,Mt as o,O as s,Ot as c,Q as l,S as u,U as d,V as f,X as p,Y as m,_ as h,a as g,d as _,f as v,g as y,it as b,mt as x,ot as S,p as C,t as w,v as T,y as E,z as D}from"./vue.runtime.esm-bundler-DMNvs-nP.js";import{a as O,c as ee,l as k,n as A,o as te,t as j,u as M}from"./card-Bn-TWTeh.js";import{Dt as ne,N,Tt as re,V as ie,c as ae,f as P,kt as oe,n as F}from"./app-XANsyWrG.js";import{p as I}from"./AdminHeader-CE9Fv9Az.js";import{t as se}from"./AdminLayout-CglcYJsE.js";import{n as ce,r as le,t as L}from"./column-DvOgiI7P.js";s();var R={name:`UploadIcon`,extends:ee};function ue(e){return me(e)||pe(e)||fe(e)||de()}function de(){throw TypeError(`Invalid attempt to spread non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`)}function fe(e,t){if(e){if(typeof e==`string`)return z(e,t);var n={}.toString.call(e).slice(8,-1);return n===`Object`&&e.constructor&&(n=e.constructor.name),n===`Map`||n===`Set`?Array.from(e):n===`Arguments`||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?z(e,t):void 0}}function pe(e){if(typeof Symbol<`u`&&e[Symbol.iterator]!=null||e[`@@iterator`]!=null)return Array.from(e)}function me(e){if(Array.isArray(e))return z(e)}function z(e,t){(t==null||t>e.length)&&(t=e.length);for(var n=0,r=Array(t);n<t;n++)r[n]=e[n];return r}function he(t,n,r,a,o,s){return i(),E(`svg`,e({width:`14`,height:`14`,viewBox:`0 0 14 14`,fill:`none`,xmlns:`http://www.w3.org/2000/svg`},t.pti()),ue(n[0]||=[y(`path`,{"fill-rule":`evenodd`,"clip-rule":`evenodd`,d:`M6.58942 9.82197C6.70165 9.93405 6.85328 9.99793 7.012 10C7.17071 9.99793 7.32234 9.93405 7.43458 9.82197C7.54681 9.7099 7.61079 9.55849 7.61286 9.4V2.04798L9.79204 4.22402C9.84752 4.28011 9.91365 4.32457 9.98657 4.35479C10.0595 4.38502 10.1377 4.40039 10.2167 4.40002C10.2956 4.40039 10.3738 4.38502 10.4467 4.35479C10.5197 4.32457 10.5858 4.28011 10.6413 4.22402C10.7538 4.11152 10.817 3.95902 10.817 3.80002C10.817 3.64102 10.7538 3.48852 10.6413 3.37602L7.45127 0.190618C7.44656 0.185584 7.44176 0.180622 7.43687 0.175736C7.32419 0.063214 7.17136 0 7.012 0C6.85264 0 6.69981 0.063214 6.58712 0.175736C6.58181 0.181045 6.5766 0.186443 6.5715 0.191927L3.38282 3.37602C3.27669 3.48976 3.2189 3.6402 3.22165 3.79564C3.2244 3.95108 3.28746 4.09939 3.39755 4.20932C3.50764 4.31925 3.65616 4.38222 3.81182 4.38496C3.96749 4.3877 4.11814 4.33001 4.23204 4.22402L6.41113 2.04807V9.4C6.41321 9.55849 6.47718 9.7099 6.58942 9.82197ZM11.9952 14H2.02883C1.751 13.9887 1.47813 13.9228 1.22584 13.8061C0.973545 13.6894 0.746779 13.5241 0.558517 13.3197C0.370254 13.1154 0.22419 12.876 0.128681 12.6152C0.0331723 12.3545 -0.00990605 12.0775 0.0019109 11.8V9.40005C0.0019109 9.24092 0.065216 9.08831 0.1779 8.97579C0.290584 8.86326 0.443416 8.80005 0.602775 8.80005C0.762134 8.80005 0.914966 8.86326 1.02765 8.97579C1.14033 9.08831 1.20364 9.24092 1.20364 9.40005V11.8C1.18295 12.0376 1.25463 12.274 1.40379 12.4602C1.55296 12.6463 1.76817 12.7681 2.00479 12.8H11.9952C12.2318 12.7681 12.447 12.6463 12.5962 12.4602C12.7453 12.274 12.817 12.0376 12.7963 11.8V9.40005C12.7963 9.24092 12.8596 9.08831 12.9723 8.97579C13.085 8.86326 13.2378 8.80005 13.3972 8.80005C13.5565 8.80005 13.7094 8.86326 13.8221 8.97579C13.9347 9.08831 13.998 9.24092 13.998 9.40005V11.8C14.022 12.3563 13.8251 12.8996 13.45 13.3116C13.0749 13.7236 12.552 13.971 11.9952 14Z`,fill:`currentColor`},null,-1)]),16)}R.render=he;var ge=P.extend({name:`message`,style:`
    .p-message {
        display: grid;
        grid-template-rows: 1fr;
        border-radius: dt('message.border.radius');
        outline-width: dt('message.border.width');
        outline-style: solid;
    }

    .p-message-content-wrapper {
        min-height: 0;
    }

    .p-message-content {
        display: flex;
        align-items: center;
        padding: dt('message.content.padding');
        gap: dt('message.content.gap');
    }

    .p-message-icon {
        flex-shrink: 0;
    }

    .p-message-close-button {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-inline-start: auto;
        overflow: hidden;
        position: relative;
        width: dt('message.close.button.width');
        height: dt('message.close.button.height');
        border-radius: dt('message.close.button.border.radius');
        background: transparent;
        transition:
            background dt('message.transition.duration'),
            color dt('message.transition.duration'),
            outline-color dt('message.transition.duration'),
            box-shadow dt('message.transition.duration'),
            opacity 0.3s;
        outline-color: transparent;
        color: inherit;
        padding: 0;
        border: none;
        cursor: pointer;
        user-select: none;
    }

    .p-message-close-icon {
        font-size: dt('message.close.icon.size');
        width: dt('message.close.icon.size');
        height: dt('message.close.icon.size');
    }

    .p-message-close-button:focus-visible {
        outline-width: dt('message.close.button.focus.ring.width');
        outline-style: dt('message.close.button.focus.ring.style');
        outline-offset: dt('message.close.button.focus.ring.offset');
    }

    .p-message-info {
        background: dt('message.info.background');
        outline-color: dt('message.info.border.color');
        color: dt('message.info.color');
        box-shadow: dt('message.info.shadow');
    }

    .p-message-info .p-message-close-button:focus-visible {
        outline-color: dt('message.info.close.button.focus.ring.color');
        box-shadow: dt('message.info.close.button.focus.ring.shadow');
    }

    .p-message-info .p-message-close-button:hover {
        background: dt('message.info.close.button.hover.background');
    }

    .p-message-info.p-message-outlined {
        color: dt('message.info.outlined.color');
        outline-color: dt('message.info.outlined.border.color');
    }

    .p-message-info.p-message-simple {
        color: dt('message.info.simple.color');
    }

    .p-message-success {
        background: dt('message.success.background');
        outline-color: dt('message.success.border.color');
        color: dt('message.success.color');
        box-shadow: dt('message.success.shadow');
    }

    .p-message-success .p-message-close-button:focus-visible {
        outline-color: dt('message.success.close.button.focus.ring.color');
        box-shadow: dt('message.success.close.button.focus.ring.shadow');
    }

    .p-message-success .p-message-close-button:hover {
        background: dt('message.success.close.button.hover.background');
    }

    .p-message-success.p-message-outlined {
        color: dt('message.success.outlined.color');
        outline-color: dt('message.success.outlined.border.color');
    }

    .p-message-success.p-message-simple {
        color: dt('message.success.simple.color');
    }

    .p-message-warn {
        background: dt('message.warn.background');
        outline-color: dt('message.warn.border.color');
        color: dt('message.warn.color');
        box-shadow: dt('message.warn.shadow');
    }

    .p-message-warn .p-message-close-button:focus-visible {
        outline-color: dt('message.warn.close.button.focus.ring.color');
        box-shadow: dt('message.warn.close.button.focus.ring.shadow');
    }

    .p-message-warn .p-message-close-button:hover {
        background: dt('message.warn.close.button.hover.background');
    }

    .p-message-warn.p-message-outlined {
        color: dt('message.warn.outlined.color');
        outline-color: dt('message.warn.outlined.border.color');
    }

    .p-message-warn.p-message-simple {
        color: dt('message.warn.simple.color');
    }

    .p-message-error {
        background: dt('message.error.background');
        outline-color: dt('message.error.border.color');
        color: dt('message.error.color');
        box-shadow: dt('message.error.shadow');
    }

    .p-message-error .p-message-close-button:focus-visible {
        outline-color: dt('message.error.close.button.focus.ring.color');
        box-shadow: dt('message.error.close.button.focus.ring.shadow');
    }

    .p-message-error .p-message-close-button:hover {
        background: dt('message.error.close.button.hover.background');
    }

    .p-message-error.p-message-outlined {
        color: dt('message.error.outlined.color');
        outline-color: dt('message.error.outlined.border.color');
    }

    .p-message-error.p-message-simple {
        color: dt('message.error.simple.color');
    }

    .p-message-secondary {
        background: dt('message.secondary.background');
        outline-color: dt('message.secondary.border.color');
        color: dt('message.secondary.color');
        box-shadow: dt('message.secondary.shadow');
    }

    .p-message-secondary .p-message-close-button:focus-visible {
        outline-color: dt('message.secondary.close.button.focus.ring.color');
        box-shadow: dt('message.secondary.close.button.focus.ring.shadow');
    }

    .p-message-secondary .p-message-close-button:hover {
        background: dt('message.secondary.close.button.hover.background');
    }

    .p-message-secondary.p-message-outlined {
        color: dt('message.secondary.outlined.color');
        outline-color: dt('message.secondary.outlined.border.color');
    }

    .p-message-secondary.p-message-simple {
        color: dt('message.secondary.simple.color');
    }

    .p-message-contrast {
        background: dt('message.contrast.background');
        outline-color: dt('message.contrast.border.color');
        color: dt('message.contrast.color');
        box-shadow: dt('message.contrast.shadow');
    }

    .p-message-contrast .p-message-close-button:focus-visible {
        outline-color: dt('message.contrast.close.button.focus.ring.color');
        box-shadow: dt('message.contrast.close.button.focus.ring.shadow');
    }

    .p-message-contrast .p-message-close-button:hover {
        background: dt('message.contrast.close.button.hover.background');
    }

    .p-message-contrast.p-message-outlined {
        color: dt('message.contrast.outlined.color');
        outline-color: dt('message.contrast.outlined.border.color');
    }

    .p-message-contrast.p-message-simple {
        color: dt('message.contrast.simple.color');
    }

    .p-message-text {
        font-size: dt('message.text.font.size');
        font-weight: dt('message.text.font.weight');
    }

    .p-message-icon {
        font-size: dt('message.icon.size');
        width: dt('message.icon.size');
        height: dt('message.icon.size');
    }

    .p-message-sm .p-message-content {
        padding: dt('message.content.sm.padding');
    }

    .p-message-sm .p-message-text {
        font-size: dt('message.text.sm.font.size');
    }

    .p-message-sm .p-message-icon {
        font-size: dt('message.icon.sm.size');
        width: dt('message.icon.sm.size');
        height: dt('message.icon.sm.size');
    }

    .p-message-sm .p-message-close-icon {
        font-size: dt('message.close.icon.sm.size');
        width: dt('message.close.icon.sm.size');
        height: dt('message.close.icon.sm.size');
    }

    .p-message-lg .p-message-content {
        padding: dt('message.content.lg.padding');
    }

    .p-message-lg .p-message-text {
        font-size: dt('message.text.lg.font.size');
    }

    .p-message-lg .p-message-icon {
        font-size: dt('message.icon.lg.size');
        width: dt('message.icon.lg.size');
        height: dt('message.icon.lg.size');
    }

    .p-message-lg .p-message-close-icon {
        font-size: dt('message.close.icon.lg.size');
        width: dt('message.close.icon.lg.size');
        height: dt('message.close.icon.lg.size');
    }

    .p-message-outlined {
        background: transparent;
        outline-width: dt('message.outlined.border.width');
    }

    .p-message-simple {
        background: transparent;
        outline-color: transparent;
        box-shadow: none;
    }

    .p-message-simple .p-message-content {
        padding: dt('message.simple.content.padding');
    }

    .p-message-outlined .p-message-close-button:hover,
    .p-message-simple .p-message-close-button:hover {
        background: transparent;
    }

    .p-message-enter-active {
        animation: p-animate-message-enter 0.3s ease-out forwards;
        overflow: hidden;
    }

    .p-message-leave-active {
        animation: p-animate-message-leave 0.15s ease-in forwards;
        overflow: hidden;
    }

    @keyframes p-animate-message-enter {
        from {
            opacity: 0;
            grid-template-rows: 0fr;
        }
        to {
            opacity: 1;
            grid-template-rows: 1fr;
        }
    }

    @keyframes p-animate-message-leave {
        from {
            opacity: 1;
            grid-template-rows: 1fr;
        }
        to {
            opacity: 0;
            margin: 0;
            grid-template-rows: 0fr;
        }
    }
`,classes:{root:function(e){var t=e.props;return[`p-message p-component p-message-`+t.severity,{"p-message-outlined":t.variant===`outlined`,"p-message-simple":t.variant===`simple`,"p-message-sm":t.size===`small`,"p-message-lg":t.size===`large`}]},contentWrapper:`p-message-content-wrapper`,content:`p-message-content`,icon:`p-message-icon`,text:`p-message-text`,closeButton:`p-message-close-button`,closeIcon:`p-message-close-icon`}});s(),g(),x();var _e={name:`BaseMessage`,extends:k,props:{severity:{type:String,default:`info`},closable:{type:Boolean,default:!1},life:{type:Number,default:null},icon:{type:String,default:void 0},closeIcon:{type:String,default:void 0},closeButtonProps:{type:null,default:null},size:{type:String,default:null},variant:{type:String,default:null}},style:ge,provide:function(){return{$pcMessage:this,$parentInstance:this}}};function B(e){"@babel/helpers - typeof";return B=typeof Symbol==`function`&&typeof Symbol.iterator==`symbol`?function(e){return typeof e}:function(e){return e&&typeof Symbol==`function`&&e.constructor===Symbol&&e!==Symbol.prototype?`symbol`:typeof e},B(e)}function V(e,t,n){return(t=ve(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function ve(e){var t=ye(e,`string`);return B(t)==`symbol`?t:t+``}function ye(e,t){if(B(e)!=`object`||!e)return e;var n=e[Symbol.toPrimitive];if(n!==void 0){var r=n.call(e,t);if(B(r)!=`object`)return r;throw TypeError(`@@toPrimitive must return a primitive value.`)}return(t===`string`?String:Number)(e)}var H={name:`Message`,extends:_e,inheritAttrs:!1,emits:[`close`,`life-end`],timeout:null,data:function(){return{visible:!0}},mounted:function(){var e=this;this.life&&setTimeout(function(){e.visible=!1,e.$emit(`life-end`)},this.life)},methods:{close:function(e){this.visible=!1,this.$emit(`close`,e)}},computed:{closeAriaLabel:function(){return this.$primevue.config.locale.aria?this.$primevue.config.locale.aria.close:void 0},dataP:function(){return M(V(V({outlined:this.variant===`outlined`,simple:this.variant===`simple`},this.severity,this.severity),this.size,this.size))}},directives:{ripple:F},components:{TimesIcon:I}};function U(e){"@babel/helpers - typeof";return U=typeof Symbol==`function`&&typeof Symbol.iterator==`symbol`?function(e){return typeof e}:function(e){return e&&typeof Symbol==`function`&&e.constructor===Symbol&&e!==Symbol.prototype?`symbol`:typeof e},U(e)}function W(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),n.push.apply(n,r)}return n}function G(e){for(var t=1;t<arguments.length;t++){var n=arguments[t]==null?{}:arguments[t];t%2?W(Object(n),!0).forEach(function(t){be(e,t,n[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):W(Object(n)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))})}return e}function be(e,t,n){return(t=xe(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function xe(e){var t=Se(e,`string`);return U(t)==`symbol`?t:t+``}function Se(e,t){if(U(e)!=`object`||!e)return e;var n=e[Symbol.toPrimitive];if(n!==void 0){var r=n.call(e,t);if(U(r)!=`object`)return r;throw TypeError(`@@toPrimitive must return a primitive value.`)}return(t===`string`?String:Number)(e)}var Ce=[`data-p`],we=[`data-p`],Te=[`data-p`],Ee=[`aria-label`,`data-p`],De=[`data-p`];function Oe(n,o,s,c,l,u){var g=f(`TimesIcon`),_=a(`ripple`);return i(),h(w,e({name:`p-message`,appear:``},n.ptmi(`transition`)),{default:m(function(){return[l.visible?(i(),E(`div`,e({key:0,class:n.cx(`root`),role:`alert`,"aria-live":`assertive`,"aria-atomic":`true`,"data-p":u.dataP},n.ptm(`root`)),[y(`div`,e({class:n.cx(`contentWrapper`)},n.ptm(`contentWrapper`)),[n.$slots.container?t(n.$slots,`container`,{key:0,closeCallback:u.close}):(i(),E(`div`,e({key:1,class:n.cx(`content`),"data-p":u.dataP},n.ptm(`content`)),[t(n.$slots,`icon`,{class:r(n.cx(`icon`))},function(){return[(i(),h(d(n.icon?`span`:null),e({class:[n.cx(`icon`),n.icon],"data-p":u.dataP},n.ptm(`icon`)),null,16,[`class`,`data-p`]))]}),n.$slots.default?(i(),E(`div`,e({key:0,class:n.cx(`text`),"data-p":u.dataP},n.ptm(`text`)),[t(n.$slots,`default`)],16,Te)):T(``,!0),n.closable?p((i(),E(`button`,e({key:1,class:n.cx(`closeButton`),"aria-label":u.closeAriaLabel,type:`button`,onClick:o[0]||=function(e){return u.close(e)},"data-p":u.dataP},G(G({},n.closeButtonProps),n.ptm(`closeButton`))),[t(n.$slots,`closeicon`,{},function(){return[n.closeIcon?(i(),E(`i`,e({key:0,class:[n.cx(`closeIcon`),n.closeIcon],"data-p":u.dataP},n.ptm(`closeIcon`)),null,16,De)):(i(),h(g,e({key:1,class:[n.cx(`closeIcon`),n.closeIcon],"data-p":u.dataP},n.ptm(`closeIcon`)),null,16,[`class`,`data-p`]))]})],16,Ee)),[[_]]):T(``,!0)],16,we))],16)],16,Ce)):T(``,!0)]}),_:3},16)}H.render=Oe;var ke=P.extend({name:`progressbar`,style:`
    .p-progressbar {
        display: block;
        position: relative;
        overflow: hidden;
        height: dt('progressbar.height');
        background: dt('progressbar.background');
        border-radius: dt('progressbar.border.radius');
    }

    .p-progressbar-value {
        margin: 0;
        background: dt('progressbar.value.background');
    }

    .p-progressbar-label {
        color: dt('progressbar.label.color');
        font-size: dt('progressbar.label.font.size');
        font-weight: dt('progressbar.label.font.weight');
    }

    .p-progressbar-determinate .p-progressbar-value {
        height: 100%;
        width: 0%;
        position: absolute;
        display: none;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: width 1s ease-in-out;
    }

    .p-progressbar-determinate .p-progressbar-label {
        display: inline-flex;
    }

    .p-progressbar-indeterminate .p-progressbar-value::before {
        content: '';
        position: absolute;
        background: inherit;
        inset-block-start: 0;
        inset-inline-start: 0;
        inset-block-end: 0;
        will-change: inset-inline-start, inset-inline-end;
        animation: p-progressbar-indeterminate-anim 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
    }

    .p-progressbar-indeterminate .p-progressbar-value::after {
        content: '';
        position: absolute;
        background: inherit;
        inset-block-start: 0;
        inset-inline-start: 0;
        inset-block-end: 0;
        will-change: inset-inline-start, inset-inline-end;
        animation: p-progressbar-indeterminate-anim-short 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
        animation-delay: 1.15s;
    }

    @keyframes p-progressbar-indeterminate-anim {
        0% {
            inset-inline-start: -35%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
        100% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
    }
    @-webkit-keyframes p-progressbar-indeterminate-anim {
        0% {
            inset-inline-start: -35%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
        100% {
            inset-inline-start: 100%;
            inset-inline-end: -90%;
        }
    }

    @keyframes p-progressbar-indeterminate-anim-short {
        0% {
            inset-inline-start: -200%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
        100% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
    }
    @-webkit-keyframes p-progressbar-indeterminate-anim-short {
        0% {
            inset-inline-start: -200%;
            inset-inline-end: 100%;
        }
        60% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
        100% {
            inset-inline-start: 107%;
            inset-inline-end: -8%;
        }
    }
`,classes:{root:function(e){var t=e.instance;return[`p-progressbar p-component`,{"p-progressbar-determinate":t.determinate,"p-progressbar-indeterminate":t.indeterminate}]},value:`p-progressbar-value`,label:`p-progressbar-label`}});s(),x();var K={name:`ProgressBar`,extends:{name:`BaseProgressBar`,extends:k,props:{value:{type:Number,default:null},mode:{type:String,default:`determinate`},showValue:{type:Boolean,default:!0}},style:ke,provide:function(){return{$pcProgressBar:this,$parentInstance:this}}},inheritAttrs:!1,computed:{progressStyle:function(){return{width:this.value+`%`,display:`flex`}},indeterminate:function(){return this.mode===`indeterminate`},determinate:function(){return this.mode===`determinate`},dataP:function(){return M({determinate:this.determinate,indeterminate:this.indeterminate})}}},Ae=[`aria-valuenow`,`data-p`],je=[`data-p`],Me=[`data-p`],Ne=[`data-p`];function Pe(n,r,a,s,c,l){return i(),E(`div`,e({role:`progressbar`,class:n.cx(`root`),"aria-valuemin":`0`,"aria-valuenow":n.value,"aria-valuemax":`100`,"data-p":l.dataP},n.ptmi(`root`)),[l.determinate?(i(),E(`div`,e({key:0,class:n.cx(`value`),style:l.progressStyle,"data-p":l.dataP},n.ptm(`value`)),[n.value!=null&&n.value!==0&&n.showValue?(i(),E(`div`,e({key:0,class:n.cx(`label`),"data-p":l.dataP},n.ptm(`label`)),[t(n.$slots,`default`,{},function(){return[u(o(n.value+`%`),1)]})],16,Me)):T(``,!0)],16,je)):l.indeterminate?(i(),E(`div`,e({key:1,class:n.cx(`value`),"data-p":l.dataP},n.ptm(`value`)),null,16,Ne)):T(``,!0)],16,Ae)}K.render=Pe;var Fe=P.extend({name:`fileupload`,style:`
    .p-fileupload input[type='file'] {
        display: none;
    }

    .p-fileupload-advanced {
        border: 1px solid dt('fileupload.border.color');
        border-radius: dt('fileupload.border.radius');
        background: dt('fileupload.background');
        color: dt('fileupload.color');
    }

    .p-fileupload-header {
        display: flex;
        align-items: center;
        padding: dt('fileupload.header.padding');
        background: dt('fileupload.header.background');
        color: dt('fileupload.header.color');
        border-style: solid;
        border-width: dt('fileupload.header.border.width');
        border-color: dt('fileupload.header.border.color');
        border-radius: dt('fileupload.header.border.radius');
        gap: dt('fileupload.header.gap');
    }

    .p-fileupload-content {
        border: 1px solid transparent;
        display: flex;
        flex-direction: column;
        gap: dt('fileupload.content.gap');
        transition: border-color dt('fileupload.transition.duration');
        padding: dt('fileupload.content.padding');
    }

    .p-fileupload-content .p-progressbar {
        width: 100%;
        height: dt('fileupload.progressbar.height');
    }

    .p-fileupload-file-list {
        display: flex;
        flex-direction: column;
        gap: dt('fileupload.filelist.gap');
    }

    .p-fileupload-file {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        padding: dt('fileupload.file.padding');
        border-block-end: 1px solid dt('fileupload.file.border.color');
        gap: dt('fileupload.file.gap');
    }

    .p-fileupload-file:last-child {
        border-block-end: 0;
    }

    .p-fileupload-file-info {
        display: flex;
        flex-direction: column;
        gap: dt('fileupload.file.info.gap');
    }

    .p-fileupload-file-thumbnail {
        flex-shrink: 0;
    }

    .p-fileupload-file-actions {
        margin-inline-start: auto;
    }

    .p-fileupload-highlight {
        border: 1px dashed dt('fileupload.content.highlight.border.color');
    }

    .p-fileupload-basic .p-message {
        margin-block-end: dt('fileupload.basic.gap');
    }

    .p-fileupload-basic-content {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: dt('fileupload.basic.gap');
    }
`,classes:{root:function(e){return[`p-fileupload p-fileupload-${e.props.mode} p-component`]},header:`p-fileupload-header`,pcChooseButton:`p-fileupload-choose-button`,pcUploadButton:`p-fileupload-upload-button`,pcCancelButton:`p-fileupload-cancel-button`,content:`p-fileupload-content`,fileList:`p-fileupload-file-list`,file:`p-fileupload-file`,fileThumbnail:`p-fileupload-file-thumbnail`,fileInfo:`p-fileupload-file-info`,fileName:`p-fileupload-file-name`,fileSize:`p-fileupload-file-size`,pcFileBadge:`p-fileupload-file-badge`,fileActions:`p-fileupload-file-actions`,pcFileRemoveButton:`p-fileupload-file-remove-button`,basicContent:`p-fileupload-basic-content`}});s(),x(),g();var Ie={name:`BaseFileUpload`,extends:k,props:{name:{type:String,default:null},url:{type:String,default:null},mode:{type:String,default:`advanced`},multiple:{type:Boolean,default:!1},accept:{type:String,default:null},disabled:{type:Boolean,default:!1},auto:{type:Boolean,default:!1},maxFileSize:{type:Number,default:null},invalidFileSizeMessage:{type:String,default:`{0}: Invalid file size, file size should be smaller than {1}.`},invalidFileTypeMessage:{type:String,default:`{0}: Invalid file type, allowed file types: {1}.`},fileLimit:{type:Number,default:null},invalidFileLimitMessage:{type:String,default:`Maximum number of files exceeded, limit is {0} at most.`},withCredentials:{type:Boolean,default:!1},previewWidth:{type:Number,default:50},chooseLabel:{type:String,default:null},uploadLabel:{type:String,default:null},cancelLabel:{type:String,default:null},customUpload:{type:Boolean,default:!1},showUploadButton:{type:Boolean,default:!0},showCancelButton:{type:Boolean,default:!0},chooseIcon:{type:String,default:void 0},uploadIcon:{type:String,default:void 0},cancelIcon:{type:String,default:void 0},style:null,class:null,chooseButtonProps:{type:null,default:null},uploadButtonProps:{type:Object,default:function(){return{severity:`secondary`}}},cancelButtonProps:{type:Object,default:function(){return{severity:`secondary`}}}},style:Fe,provide:function(){return{$pcFileUpload:this,$parentInstance:this}}},q={name:`FileContent`,hostName:`FileUpload`,extends:k,emits:[`remove`],props:{files:{type:Array,default:function(){return[]}},badgeSeverity:{type:String,default:`warn`},badgeValue:{type:String,default:null},previewWidth:{type:Number,default:50},templates:{type:null,default:null}},methods:{formatSize:function(e){var t=1024,n=3,r=this.$primevue.config.locale?.fileSizeTypes||[`B`,`KB`,`MB`,`GB`,`TB`,`PB`,`EB`,`ZB`,`YB`];if(e===0)return`0 ${r[0]}`;var i=Math.floor(Math.log(e)/Math.log(t));return`${parseFloat((e/t**+i).toFixed(n))} ${r[i]}`}},components:{Button:O,Badge:te,TimesIcon:I}},Le=[`alt`,`src`,`width`];function Re(t,a,s,c,l,u){var p=f(`Badge`),g=f(`TimesIcon`),_=f(`Button`);return i(!0),E(C,null,D(s.files,function(a,c){return i(),E(`div`,e({key:a.name+a.type+a.size,class:t.cx(`file`)},{ref_for:!0},t.ptm(`file`)),[y(`img`,e({role:`presentation`,class:t.cx(`fileThumbnail`),alt:a.name,src:a.objectURL,width:s.previewWidth},{ref_for:!0},t.ptm(`fileThumbnail`)),null,16,Le),y(`div`,e({class:t.cx(`fileInfo`)},{ref_for:!0},t.ptm(`fileInfo`)),[y(`div`,e({class:t.cx(`fileName`)},{ref_for:!0},t.ptm(`fileName`)),o(a.name),17),y(`span`,e({class:t.cx(`fileSize`)},{ref_for:!0},t.ptm(`fileSize`)),o(u.formatSize(a.size)),17)],16),n(p,{value:s.badgeValue,class:r(t.cx(`pcFileBadge`)),severity:s.badgeSeverity,unstyled:t.unstyled,pt:t.ptm(`pcFileBadge`)},null,8,[`value`,`class`,`severity`,`unstyled`,`pt`]),y(`div`,e({class:t.cx(`fileActions`)},{ref_for:!0},t.ptm(`fileActions`)),[n(_,{onClick:function(e){return t.$emit(`remove`,c)},text:``,rounded:``,severity:`danger`,class:r(t.cx(`pcFileRemoveButton`)),unstyled:t.unstyled,pt:t.ptm(`pcFileRemoveButton`)},{icon:m(function(n){return[s.templates.fileremoveicon?(i(),h(d(s.templates.fileremoveicon),{key:0,class:r(n.class),file:a,index:c},null,8,[`class`,`file`,`index`])):(i(),h(g,e({key:1,class:n.class,"aria-hidden":`true`},{ref_for:!0},t.ptm(`pcFileRemoveButton`).icon),null,16,[`class`]))]}),_:2},1032,[`onClick`,`class`,`unstyled`,`pt`])],16)],16)}),128)}q.render=Re;function J(e){return Ve(e)||Be(e)||X(e)||ze()}function ze(){throw TypeError(`Invalid attempt to spread non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`)}function Be(e){if(typeof Symbol<`u`&&e[Symbol.iterator]!=null||e[`@@iterator`]!=null)return Array.from(e)}function Ve(e){if(Array.isArray(e))return Z(e)}function Y(e,t){var n=typeof Symbol<`u`&&e[Symbol.iterator]||e[`@@iterator`];if(!n){if(Array.isArray(e)||(n=X(e))||t){n&&(e=n);var r=0,i=function(){};return{s:i,n:function(){return r>=e.length?{done:!0}:{done:!1,value:e[r++]}},e:function(e){throw e},f:i}}throw TypeError(`Invalid attempt to iterate non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`)}var a,o=!0,s=!1;return{s:function(){n=n.call(e)},n:function(){var e=n.next();return o=e.done,e},e:function(e){s=!0,a=e},f:function(){try{o||n.return==null||n.return()}finally{if(s)throw a}}}}function X(e,t){if(e){if(typeof e==`string`)return Z(e,t);var n={}.toString.call(e).slice(8,-1);return n===`Object`&&e.constructor&&(n=e.constructor.name),n===`Map`||n===`Set`?Array.from(e):n===`Arguments`||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?Z(e,t):void 0}}function Z(e,t){(t==null||t>e.length)&&(t=e.length);for(var n=0,r=Array(t);n<t;n++)r[n]=e[n];return r}var Q={name:`FileUpload`,extends:Ie,inheritAttrs:!1,emits:[`select`,`uploader`,`before-upload`,`progress`,`upload`,`error`,`before-send`,`clear`,`remove`,`remove-uploaded-file`],duplicateIEEvent:!1,data:function(){return{uploadedFileCount:0,files:[],messages:[],focused:!1,progress:null,uploadedFiles:[]}},methods:{upload:function(){this.hasFiles&&this.uploader()},onBasicUploaderClick:function(e){e.button===0&&this.$refs.fileInput.click()},onFileSelect:function(e){if(e.type!==`drop`&&this.isIE11()&&this.duplicateIEEvent){this.duplicateIEEvent=!1;return}this.isBasic&&this.hasFiles&&(this.files=[]),this.messages=[],this.files=this.files||[];var t=Y(e.dataTransfer?e.dataTransfer.files:e.target.files),n;try{for(t.s();!(n=t.n()).done;){var r=n.value;!this.isFileSelected(r)&&!this.isFileLimitExceeded()&&this.validate(r)&&(this.isImage(r)&&(r.objectURL=window.URL.createObjectURL(r)),this.files.push(r))}}catch(e){t.e(e)}finally{t.f()}this.$emit(`select`,{originalEvent:e,files:this.files}),this.fileLimit&&this.checkFileLimit(),this.auto&&this.hasFiles&&!this.isFileLimitExceeded()&&this.uploader(),e.type!==`drop`&&this.isIE11()?this.clearIEInput():this.clearInputElement()},choose:function(){this.$refs.fileInput.click()},uploader:function(){var e=this;if(this.customUpload)this.fileLimit&&(this.uploadedFileCount+=this.files.length),this.$emit(`uploader`,{files:this.files});else{var t=new XMLHttpRequest,n=new FormData;this.$emit(`before-upload`,{xhr:t,formData:n});var r=Y(this.files),i;try{for(r.s();!(i=r.n()).done;){var a=i.value;n.append(this.name,a,a.name)}}catch(e){r.e(e)}finally{r.f()}t.upload.addEventListener(`progress`,function(t){t.lengthComputable&&(e.progress=Math.round(t.loaded*100/t.total)),e.$emit(`progress`,{originalEvent:t,progress:e.progress})}),t.onreadystatechange=function(){if(t.readyState===4){if(e.progress=0,t.status>=200&&t.status<300){var n;e.fileLimit&&(e.uploadedFileCount+=e.files.length),e.$emit(`upload`,{xhr:t,files:e.files}),(n=e.uploadedFiles).push.apply(n,J(e.files))}else e.$emit(`error`,{xhr:t,files:e.files});e.clear()}},this.url&&(t.open(`POST`,this.url,!0),this.$emit(`before-send`,{xhr:t,formData:n}),t.withCredentials=this.withCredentials,t.send(n))}},clear:function(){this.files=[],this.messages=null,this.$emit(`clear`),this.isAdvanced&&this.clearInputElement()},onFocus:function(){this.focused=!0},onBlur:function(){this.focused=!1},isFileSelected:function(e){if(this.files&&this.files.length){var t=Y(this.files),n;try{for(t.s();!(n=t.n()).done;){var r=n.value;if(r.name+r.type+r.size===e.name+e.type+e.size)return!0}}catch(e){t.e(e)}finally{t.f()}}return!1},isIE11:function(){return!!window.MSInputMethodContext&&!!document.documentMode},validate:function(e){return this.accept&&!this.isFileTypeValid(e)?(this.messages.push(this.invalidFileTypeMessage.replace(`{0}`,e.name).replace(`{1}`,this.accept)),!1):this.maxFileSize&&e.size>this.maxFileSize?(this.messages.push(this.invalidFileSizeMessage.replace(`{0}`,e.name).replace(`{1}`,this.formatSize(this.maxFileSize))),!1):!0},isFileTypeValid:function(e){var t=Y(this.accept.split(`,`).map(function(e){return e.trim()})),n;try{for(t.s();!(n=t.n()).done;){var r=n.value;if(this.isWildcard(r)?this.getTypeClass(e.type)===this.getTypeClass(r):e.type==r||this.getFileExtension(e).toLowerCase()===r.toLowerCase())return!0}}catch(e){t.e(e)}finally{t.f()}return!1},getTypeClass:function(e){return e.substring(0,e.indexOf(`/`))},isWildcard:function(e){return e.indexOf(`*`)!==-1},getFileExtension:function(e){return`.`+e.name.split(`.`).pop()},isImage:function(e){return/^image\//.test(e.type)},onDragEnter:function(e){!this.disabled&&(!this.hasFiles||this.multiple)&&(e.stopPropagation(),e.preventDefault())},onDragOver:function(e){!this.disabled&&(!this.hasFiles||this.multiple)&&(!this.isUnstyled&&ie(this.$refs.content,`p-fileupload-highlight`),this.$refs.content&&this.$refs.content.setAttribute(`data-p-highlight`,!0),e.stopPropagation(),e.preventDefault())},onDragLeave:function(){this.disabled||(!this.isUnstyled&&N(this.$refs.content,`p-fileupload-highlight`),this.$refs.content&&this.$refs.content.setAttribute(`data-p-highlight`,!1))},onDrop:function(e){if(!this.disabled){!this.isUnstyled&&N(this.$refs.content,`p-fileupload-highlight`),this.$refs.content&&this.$refs.content.setAttribute(`data-p-highlight`,!1),e.stopPropagation(),e.preventDefault();var t=e.dataTransfer?e.dataTransfer.files:e.target.files;(this.multiple||t&&t.length===1)&&this.onFileSelect(e)}},remove:function(e){this.clearInputElement();var t=this.files.splice(e,1)[0];this.files=J(this.files),this.$emit(`remove`,{file:t,files:this.files})},removeUploadedFile:function(e){var t=this.uploadedFiles.splice(e,1)[0];this.uploadedFiles=J(this.uploadedFiles),this.$emit(`remove-uploaded-file`,{file:t,files:this.uploadedFiles})},clearInputElement:function(){this.$refs.fileInput.value=``},clearIEInput:function(){this.$refs.fileInput&&(this.duplicateIEEvent=!0,this.$refs.fileInput.value=``)},formatSize:function(e){var t=1024,n=3,r=this.$primevue.config.locale?.fileSizeTypes||[`B`,`KB`,`MB`,`GB`,`TB`,`PB`,`EB`,`ZB`,`YB`];if(e===0)return`0 ${r[0]}`;var i=Math.floor(Math.log(e)/Math.log(t));return`${parseFloat((e/t**+i).toFixed(n))} ${r[i]}`},isFileLimitExceeded:function(){return this.fileLimit&&this.fileLimit<=this.files.length+this.uploadedFileCount&&this.focused&&(this.focused=!1),this.fileLimit&&this.fileLimit<this.files.length+this.uploadedFileCount},checkFileLimit:function(){this.isFileLimitExceeded()&&this.messages.push(this.invalidFileLimitMessage.replace(`{0}`,this.fileLimit.toString()))},onMessageClose:function(){this.messages=null}},computed:{isAdvanced:function(){return this.mode===`advanced`},isBasic:function(){return this.mode===`basic`},chooseButtonClass:function(){return[this.cx(`pcChooseButton`),this.class]},basicFileChosenLabel:function(){if(this.auto)return this.chooseButtonLabel;if(this.hasFiles){var e;return this.files&&this.files.length===1?this.files[0].name:(e=this.$primevue.config.locale)==null||(e=e.fileChosenMessage)==null?void 0:e.replace(`{0}`,this.files.length)}return this.$primevue.config.locale?.noFileChosenMessage||``},hasFiles:function(){return this.files&&this.files.length>0},hasUploadedFiles:function(){return this.uploadedFiles&&this.uploadedFiles.length>0},chooseDisabled:function(){return this.disabled||this.fileLimit&&this.fileLimit<=this.files.length+this.uploadedFileCount},uploadDisabled:function(){return this.disabled||!this.hasFiles||this.fileLimit&&this.fileLimit<this.files.length},cancelDisabled:function(){return this.disabled||!this.hasFiles},chooseButtonLabel:function(){return this.chooseLabel||this.$primevue.config.locale.choose},uploadButtonLabel:function(){return this.uploadLabel||this.$primevue.config.locale.upload},cancelButtonLabel:function(){return this.cancelLabel||this.$primevue.config.locale.cancel},completedLabel:function(){return this.$primevue.config.locale.completed},pendingLabel:function(){return this.$primevue.config.locale.pending}},components:{Button:O,ProgressBar:K,Message:H,FileContent:q,PlusIcon:le,UploadIcon:R,TimesIcon:I},directives:{ripple:F}},He=[`multiple`,`accept`,`disabled`],Ue=[`accept`,`disabled`,`multiple`];function We(a,s,l,p,g,v){var b=f(`Button`),x=f(`ProgressBar`),S=f(`Message`),w=f(`FileContent`);return v.isAdvanced?(i(),E(`div`,e({key:0,class:a.cx(`root`)},a.ptmi(`root`)),[y(`input`,e({ref:`fileInput`,type:`file`,onChange:s[0]||=function(){return v.onFileSelect&&v.onFileSelect.apply(v,arguments)},multiple:a.multiple,accept:a.accept,disabled:v.chooseDisabled},a.ptm(`input`)),null,16,He),y(`div`,e({class:a.cx(`header`)},a.ptm(`header`)),[t(a.$slots,`header`,{files:g.files,uploadedFiles:g.uploadedFiles,chooseCallback:v.choose,uploadCallback:v.uploader,clearCallback:v.clear},function(){return[n(b,e({label:v.chooseButtonLabel,class:v.chooseButtonClass,style:a.style,disabled:a.disabled,unstyled:a.unstyled,onClick:v.choose,onKeydown:_(v.choose,[`enter`]),onFocus:v.onFocus,onBlur:v.onBlur},a.chooseButtonProps,{pt:a.ptm(`pcChooseButton`)}),{icon:m(function(n){return[t(a.$slots,`chooseicon`,{},function(){return[(i(),h(d(a.chooseIcon?`span`:`PlusIcon`),e({class:[n.class,a.chooseIcon],"aria-hidden":`true`},a.ptm(`pcChooseButton`).icon),null,16,[`class`]))]})]}),_:3},16,[`label`,`class`,`style`,`disabled`,`unstyled`,`onClick`,`onKeydown`,`onFocus`,`onBlur`,`pt`]),a.showUploadButton?(i(),h(b,e({key:0,class:a.cx(`pcUploadButton`),label:v.uploadButtonLabel,onClick:v.uploader,disabled:v.uploadDisabled,unstyled:a.unstyled},a.uploadButtonProps,{pt:a.ptm(`pcUploadButton`)}),{icon:m(function(n){return[t(a.$slots,`uploadicon`,{},function(){return[(i(),h(d(a.uploadIcon?`span`:`UploadIcon`),e({class:[n.class,a.uploadIcon],"aria-hidden":`true`},a.ptm(`pcUploadButton`).icon,{"data-pc-section":`uploadbuttonicon`}),null,16,[`class`]))]})]}),_:3},16,[`class`,`label`,`onClick`,`disabled`,`unstyled`,`pt`])):T(``,!0),a.showCancelButton?(i(),h(b,e({key:1,class:a.cx(`pcCancelButton`),label:v.cancelButtonLabel,onClick:v.clear,disabled:v.cancelDisabled,unstyled:a.unstyled},a.cancelButtonProps,{pt:a.ptm(`pcCancelButton`)}),{icon:m(function(n){return[t(a.$slots,`cancelicon`,{},function(){return[(i(),h(d(a.cancelIcon?`span`:`TimesIcon`),e({class:[n.class,a.cancelIcon],"aria-hidden":`true`},a.ptm(`pcCancelButton`).icon,{"data-pc-section":`cancelbuttonicon`}),null,16,[`class`]))]})]}),_:3},16,[`class`,`label`,`onClick`,`disabled`,`unstyled`,`pt`])):T(``,!0)]})],16),y(`div`,e({ref:`content`,class:a.cx(`content`),onDragenter:s[1]||=function(){return v.onDragEnter&&v.onDragEnter.apply(v,arguments)},onDragover:s[2]||=function(){return v.onDragOver&&v.onDragOver.apply(v,arguments)},onDragleave:s[3]||=function(){return v.onDragLeave&&v.onDragLeave.apply(v,arguments)},onDrop:s[4]||=function(){return v.onDrop&&v.onDrop.apply(v,arguments)}},a.ptm(`content`),{"data-p-highlight":!1}),[t(a.$slots,`content`,{files:g.files,uploadedFiles:g.uploadedFiles,removeUploadedFileCallback:v.removeUploadedFile,removeFileCallback:v.remove,progress:g.progress,messages:g.messages},function(){return[v.hasFiles?(i(),h(x,{key:0,value:g.progress,showValue:!1,unstyled:a.unstyled,pt:a.ptm(`pcProgressbar`)},null,8,[`value`,`unstyled`,`pt`])):T(``,!0),(i(!0),E(C,null,D(g.messages,function(e){return i(),h(S,{key:e,severity:`error`,onClose:v.onMessageClose,unstyled:a.unstyled,pt:a.ptm(`pcMessage`)},{default:m(function(){return[u(o(e),1)]}),_:2},1032,[`onClose`,`unstyled`,`pt`])}),128)),v.hasFiles?(i(),E(`div`,{key:1,class:r(a.cx(`fileList`))},[n(w,{files:g.files,onRemove:v.remove,badgeValue:v.pendingLabel,previewWidth:a.previewWidth,templates:a.$slots,unstyled:a.unstyled,pt:a.pt},null,8,[`files`,`onRemove`,`badgeValue`,`previewWidth`,`templates`,`unstyled`,`pt`])],2)):T(``,!0),v.hasUploadedFiles?(i(),E(`div`,{key:2,class:r(a.cx(`fileList`))},[n(w,{files:g.uploadedFiles,onRemove:v.removeUploadedFile,badgeValue:v.completedLabel,badgeSeverity:`success`,previewWidth:a.previewWidth,templates:a.$slots,unstyled:a.unstyled,pt:a.pt},null,8,[`files`,`onRemove`,`badgeValue`,`previewWidth`,`templates`,`unstyled`,`pt`])],2)):T(``,!0)]}),a.$slots.empty&&!v.hasFiles&&!v.hasUploadedFiles?(i(),E(`div`,c(e({key:0},a.ptm(`empty`))),[t(a.$slots,`empty`)],16)):T(``,!0)],16)],16)):v.isBasic?(i(),E(`div`,e({key:1,class:a.cx(`root`)},a.ptmi(`root`)),[(i(!0),E(C,null,D(g.messages,function(e){return i(),h(S,{key:e,severity:`error`,onClose:v.onMessageClose,unstyled:a.unstyled,pt:a.ptm(`pcMessage`)},{default:m(function(){return[u(o(e),1)]}),_:2},1032,[`onClose`,`unstyled`,`pt`])}),128)),y(`div`,e({class:a.cx(`basicContent`)},a.ptm(`basicContent`)),[n(b,e({label:v.chooseButtonLabel,class:v.chooseButtonClass,style:a.style,disabled:a.disabled,unstyled:a.unstyled,onMouseup:v.onBasicUploaderClick,onKeydown:_(v.choose,[`enter`]),onFocus:v.onFocus,onBlur:v.onBlur},a.chooseButtonProps,{pt:a.ptm(`pcChooseButton`)}),{icon:m(function(n){return[t(a.$slots,`chooseicon`,{},function(){return[(i(),h(d(a.chooseIcon?`span`:`PlusIcon`),e({class:[n.class,a.chooseIcon],"aria-hidden":`true`},a.ptm(`pcChooseButton`).icon),null,16,[`class`]))]})]}),_:3},16,[`label`,`class`,`style`,`disabled`,`unstyled`,`onMouseup`,`onKeydown`,`onFocus`,`onBlur`,`pt`]),a.auto?T(``,!0):t(a.$slots,`filelabel`,{key:0,class:r(a.cx(`filelabel`)),files:g.files},function(){return[y(`span`,{class:r(a.cx(`filelabel`))},o(v.basicFileChosenLabel),3)]}),y(`input`,e({ref:`fileInput`,type:`file`,accept:a.accept,disabled:a.disabled,multiple:a.multiple,onChange:s[5]||=function(){return v.onFileSelect&&v.onFileSelect.apply(v,arguments)},onFocus:s[6]||=function(){return v.onFocus&&v.onFocus.apply(v,arguments)},onBlur:s[7]||=function(){return v.onBlur&&v.onBlur.apply(v,arguments)}},a.ptm(`input`)),null,16,Ue)],16)],16)):T(``,!0)}Q.render=We,l(),s(),x(),g();var Ge={class:`grid grid-cols-1 md:grid-cols-3 gap-6`},Ke={class:`md:col-span-1`},qe={class:`text-lg font-semibold`},Je={key:0,class:`text-xs text-red-500 mt-1`},$={key:0,class:`text-xs text-red-500 mt-1`},Ye={key:0,class:`text-xs text-slate-400 mt-1`},Xe={key:1,class:`text-xs text-green-500 mt-1`},Ze={key:2,class:`text-xs text-red-500 mt-1`},Qe={class:`flex gap-2 mt-2`},$e={class:`md:col-span-2`},et=[`src`],tt={key:1,class:`text-slate-400 text-sm`},nt={class:`flex gap-2`},rt={__name:`Index`,props:{signatures:Array},setup(e){let t=ae(),a=ne({id:null,place_at:``,title:``,signature_file:null}),s=b(!1),c=()=>{s.value?a.post(route(`admin.academic.signatures.update`,a.id),{forceFormData:!0,onSuccess:()=>{a.reset(),s.value=!1}}):a.post(route(`admin.academic.signatures.store`),{onSuccess:()=>a.reset()})},l=e=>{s.value=!0,a.id=e.id,a.place_at=e.place_at,a.title=e.title,a.signature_file=null,a._method=`PUT`},u=()=>{s.value=!1,a.reset(),delete a._method},d=e=>{t.require({message:`Are you sure you want to delete this signature?`,header:`Confirm Deletion`,icon:`pi pi-exclamation-triangle`,accept:()=>{oe.delete(route(`admin.academic.signatures.destroy`,e.id))}})},f=e=>{a.signature_file=e.files[0]};return(t,p)=>(i(),h(se,{title:`Signature`},{default:m(()=>[n(S(re),{title:`Signature`}),p[6]||=y(`div`,{class:`mb-6`},[y(`h1`,{class:`text-2xl font-bold text-slate-800`},`Signature`),y(`p`,{class:`text-sm text-slate-500 mt-1`},`Home - Signatures`)],-1),y(`div`,Ge,[y(`div`,Ke,[n(S(j),{class:`shadow-sm border-none`},{title:m(()=>[y(`span`,qe,o(s.value?`Edit Signature`:`Add New Signature`),1)]),content:m(()=>[y(`form`,{onSubmit:v(c,[`prevent`]),class:`flex flex-col gap-5 mt-2`},[y(`div`,null,[p[2]||=y(`label`,{class:`block text-xs font-medium text-slate-600 mb-1.5`},`Place At`,-1),n(S(A),{modelValue:S(a).place_at,"onUpdate:modelValue":p[0]||=e=>S(a).place_at=e,class:r([`w-full bg-slate-50 border-slate-200`,{"p-invalid":S(a).errors.place_at}]),placeholder:`Place At`},null,8,[`modelValue`,`class`]),S(a).errors.place_at?(i(),E(`p`,Je,o(S(a).errors.place_at),1)):T(``,!0)]),y(`div`,null,[p[3]||=y(`label`,{class:`block text-xs font-medium text-slate-600 mb-1.5`},`Title`,-1),n(S(A),{modelValue:S(a).title,"onUpdate:modelValue":p[1]||=e=>S(a).title=e,class:r([`w-full bg-slate-50 border-slate-200`,{"p-invalid":S(a).errors.title}]),placeholder:`Title`},null,8,[`modelValue`,`class`]),S(a).errors.title?(i(),E(`p`,$,o(S(a).errors.title),1)):T(``,!0)]),y(`div`,null,[p[4]||=y(`label`,{class:`block text-xs font-medium text-slate-600 mb-1.5`},`Signature`,-1),n(S(Q),{mode:`basic`,name:`signature_file`,accept:`image/*`,maxFileSize:2e6,onSelect:f,auto:!1,chooseLabel:`Browse...`,class:r([`w-full`,{"p-invalid":S(a).errors.signature_file}])},null,8,[`class`]),S(a).signature_file?(i(),E(`p`,Xe,o(S(a).signature_file.name),1)):(i(),E(`p`,Ye,`No file selected.`)),S(a).errors.signature_file?(i(),E(`p`,Ze,o(S(a).errors.signature_file),1)):T(``,!0)]),y(`div`,Qe,[n(S(O),{type:`submit`,label:s.value?`Update Signature`:`Add Signature`,loading:S(a).processing,class:`!bg-sky-500 !border-sky-500`},null,8,[`label`,`loading`]),s.value?(i(),h(S(O),{key:0,type:`button`,label:`Cancel`,severity:`secondary`,onClick:u})):T(``,!0)])],32)]),_:1})]),y(`div`,$e,[n(S(j),{class:`shadow-sm border-none`},{title:m(()=>[...p[5]||=[y(`span`,{class:`text-lg font-semibold`},`Signature List`,-1)]]),content:m(()=>[n(S(ce),{value:e.signatures,paginator:``,rows:10,rowsPerPageOptions:[10,20,50],class:`p-datatable-sm mt-2`},{default:m(()=>[n(S(L),{field:`place_at`,header:`Place At`,sortable:``}),n(S(L),{field:`title`,header:`Title`,sortable:``}),n(S(L),{header:`Signature`},{body:m(({data:e})=>[e.signature_path?(i(),E(`img`,{key:0,src:e.signature_path,alt:`signature`,class:`h-10 object-contain`},null,8,et)):(i(),E(`span`,tt,`No Image`))]),_:1}),n(S(L),{header:`Action`,exportable:!1,style:{width:`20%`}},{body:m(({data:e})=>[y(`div`,nt,[n(S(O),{icon:`pi pi-pencil`,severity:`warning`,size:`small`,onClick:t=>l(e)},null,8,[`onClick`]),n(S(O),{icon:`pi pi-trash`,severity:`danger`,size:`small`,onClick:t=>d(e)},null,8,[`onClick`])])]),_:1})]),_:1},8,[`value`])]),_:1})])])]),_:1}))}};export{rt as default};